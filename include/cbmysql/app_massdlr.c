//This Asterisk module allows you to playback .wav to many-many humans by telephone
//MassDialer by KoD

#include <string.h>
#include <pthread.h>
#include <stdlib.h>
#include "asterisk.h"
#include "asterisk/module.h"
#include "asterisk/logger.h"
#include "asterisk/cli.h"
#include "asterisk/channel.h"
#include "asterisk/pbx.h"
#include "asterisk/frame.h"
#include "asterisk/frame_defs.h"

ASTERISK_FILE_VERSION(__FILE__, "$Revision: $");

struct outgoing{
  char *tech;
  char *dest;
  char *app;
  char *exten;
  char *appdata;
  unsigned short int timeout;
  format_t format;
  int reason;
  char *cid_num;
  char *cid_name;
  struct ast_variable *vars;
  struct ast_flags options;
  int thr_n;
  char *grp_n;
} *outcalls;

static int *pth_runing;

ast_mutex_t mutex;

static void *pthr_process_call(void *param)
{
  struct outgoing *o = param;
  int result;
  FILE *fjob;
  result = ast_pbx_outgoing_app(o->tech, o->format, (void *) o->dest, o->timeout, 
			        o->app, o->appdata, &o->reason, 2 , o->cid_num, 
				o->cid_name, o->vars, NULL, NULL);
  ast_mutex_lock(&mutex);
    if((fjob = fopen(o->grp_n, "a")) == NULL){
      ast_log(LOG_WARNING, "Can`t open .job file.\n");
      fclose(fjob);
      ast_mutex_unlock(&mutex);
      pth_runing[o->thr_n] = 0;
      return NULL;
    }
    if(!result) fprintf(fjob, "%s/%s 1\n", o->tech, o->dest);
      else fprintf(fjob, "%s/%s 0\n", o->tech, o->dest);
    fclose(fjob);
  ast_mutex_unlock(&mutex);
  
  pth_runing[o->thr_n] = 0;
  return NULL;
}

static int scheduler_main(const char *grp_n, int thr_num, const char* cid_nm, const char* cid_n, int timeout, const char* sfname)
{
  pthread_t *threads;
  int i, sch = 1, ret, eof = 0;
  char fline[256], *n, jobname[512];
  FILE *fp = fopen(grp_n, "a+");
  
  strcat(grp_n, ".job");
  
  if(!fp){
    ast_log(LOG_WARNING, "Can`t open group file.\n");
    return 0;
  }
  
  threads = (pthread_t*)calloc(thr_num, sizeof(pthread_t));
  pth_runing = (int*)calloc(thr_num, sizeof(int));
  outcalls = (struct outgoing*)calloc(thr_num, sizeof(struct outgoing));
  
  ast_mutex_init(&mutex);
  
  while(sch){
    if(!eof){
      for(i = 0; i < thr_num; i++){
	if((!pth_runing[i])){
	  if(fgets(fline, 20, fp)){
	    if(*fline != '\n'){
	      pth_runing[i] = 1;
	      
	      outcalls[i].tech = "SIP";
	      outcalls[i].format = AST_FORMAT_ULAW;
	      n = strchr(fline, '\n');	
	      *n = '\0';
	      outcalls[i].dest = fline;
	      outcalls[i].app = "Playback";
	      outcalls[i].appdata = sfname;
	      outcalls[i].timeout = timeout * 1000;
	      outcalls[i].cid_name = cid_nm;
	      outcalls[i].cid_num = cid_n;
	      outcalls[i].thr_n = i;
	      outcalls[i].grp_n = grp_n;
	      if ((ret = ast_pthread_create_detached(&threads[i], NULL, pthr_process_call, &outcalls[i]))) {
		ast_log(LOG_WARNING, "Unable to create thread :( (returned error: %d)\n", ret);
	      }
	    }
	  } else {
	      eof = 1;
	      break;
	  }	
	}
      }
    } else {
      sch = 0;
      for(i = 0; i < thr_num; i++){
	if(pth_runing[i]){
	  sch = 1;
	  break;
	}
      }
    }
  }
  
  free(threads);
  free(pth_runing);
  free(outcalls);
  
  fclose(fp);
  
  return 0;
}

static char *mass_cmd(struct ast_cli_entry *e, int cmd, struct ast_cli_args *a)
{
  switch (cmd) {
	case CLI_INIT:
		e->command = "mass {dial}";
		e->usage =
			"\tUsage: mass dial <file_name> <threads_numumber> <cid_name> <cid_num> <timeout(sec)> <audiofile>\n\tExample: mass dial /home/kod/customers kod 777 20 15 hello-world\n\n";
		return NULL;
	case CLI_GENERATE:
		return NULL;
    
  }
  /* Check for length so no buffer will overflow... */
  int i;  
  for (i = 0; i < a->argc; i++) {
    if (strlen(a->argv[i]) > 100){
      ast_cli(a->fd, "Invalid Arguments.\n");
      return CLI_SHOWUSAGE;
    }    
  }
  
  if (a->argc != 8)
    return CLI_SHOWUSAGE;

  scheduler_main(a->argv[2], atoi(a->argv[3]), a->argv[4], a->argv[5], atoi(a->argv[6]), a->argv[7]);
  
  return CLI_SUCCESS;
}

static struct ast_cli_entry mass_cli_cmd[] = {
    AST_CLI_DEFINE(mass_cmd, "MassDialer")
};

static int load_module(void)
{
    ast_cli_register_multiple( mass_cli_cmd, ARRAY_LEN(mass_cli_cmd));
    return AST_MODULE_LOAD_SUCCESS;
}

static int unload_module(void)
{

  return 0;
}

AST_MODULE_INFO_STANDARD( ASTERISK_GPL_KEY, "MassDialer" );
