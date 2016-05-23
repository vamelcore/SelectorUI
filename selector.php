<?php
require_once('include/conference.php');
require_once('include/settings.php');
require_once('include/functions.php');

//---Connect-to-AsteriskManager-MySQL-and---
//---initialize-$conferences-variable-------
//---look-include/settings.php--------------

$ami = new AGI_AsteriskManager();
if( !$ami->connect( $amihost, $amilogin, $amipass ))
{
    echo "AsteriskManager connect() error!:<br>".
	 "Check username and password in 'manager.conf'".
	 " or incliude/settings.php";
    exit;
}

$mysql_connection = mysql_connect( $mysql['server'], 
				   $mysql['username'],
		                   $mysql['password'] );
if ( !$mysql_connection )
{
    echo "MySQL connect() error!:<br>".
	 "Check username and password in 'include/settings.php'".
	 "or create user in MySQL.<br>".
	 "ERROR: ".mysql_errno()." ".mysql_error();
    exit;
}
mysql_select_db( 'meetme' );
mysql_query("SET NAMES 'utf8'");
$auth_info = parse_http_digest( $_SERVER['PHP_AUTH_DIGEST'] );
$conferences = get_conferences();
//cut---------------------------------------
//---main()---------------------------------
//   actions: 1  - send conferences
//   	      2  - lock conference
//	      3  - unlock
//	      4  - kick all
//	      5  - remove conference
//	      6  - send add_new_conference form
//	      7  - add new conference into DB
//	      8  - send userlist
//	      9  - mute user 
//	      10 - unmute 
//	      11 - kick
//            12 - send invite form
//	      14 - html add users into group table
//	      15 - show add new group form
//	      16 - add group
//	      17 - show groups form
//	      18 - delete group N=x
//	      19 - delete user from group
//	      20 - invite users
//	      21 - send records form
//	      22 - send settings form
//	      23 - change admin
//

$_GET = clear_sql_inj( $_GET );
switch( $_GET['action'] )
{
    case 1:
      echo html_send_con();
    break;
    case 2:
        $con = new Conference( $_GET['num'] );
        $con->lock();
        echo "OK";
    break;
    case 3:
	$con = new Conference( $_GET['num'] );
	$con->unlock();
	echo "OK";
    break;
    case 4:
	$con = new Conference( $_GET['num'] );
	$con->kick_all();
	echo "OK";
    break;
    case 5:
	$con = new Conference( $_GET['num']);
	echo $con->params['roomNo'];
	if( $con->remove() )
	    echo "OK";
    break;
    case 6:
	echo html_form_add_new();
    break;
    case 7:
	$params = array( 'roomNo' 	=> $_GET['roomNo'],
			 'roomPass'	=> $_GET['roomPass'],
			 'silPass'	=> $_GET['silPass'],
			 'startTime'	=> $_GET['startTime'],
			 'endTime'	=> $_GET['endTime'],
			 'maxUser'	=> $_GET['maxUser'],
			 'confOwner'	=> $auth_info['username'],
			 'confDesc'	=> $_GET['confDesc'],
			 'uFlags'	=> 'D',
			 'aFlags'	=> $_GET['aFlags'] );
	if ( add_conference( $params ))
	    echo "SUCCESSFUL";
	else
	    echo "ERROR";
    break;
    case 8:
	echo html_send_users( $_GET['num'] );
    break;
    case 9:
	$con = new Conference( $_GET['num'] );
	$con->mute_user( $_GET['n'] );
	echo "OK";
    break;
    case 10:
	$con = new Conference( $_GET['num'] );
	$con->unmute_user( $_GET['n'] );
	echo "OK";
    break;
    case 11:
	$con = new Conference( $_GET['num'] );
	$con->kick_user( $_GET['n'] );
	echo "OK";    
    break;
    case 12:
	echo html_invite_users_form( $_GET['num'] );
    break;
    case 14:
	echo html_get_users_invite_table( $_GET['grp_n'], $_GET['edit'] );
    break;
    case 15:
	echo html_add_grp_form();
    break;
    case 16:
	if ( ! add_grp_user( $_GET ) )
	    echo "ADD USER ERROR!!!";
    break;
    case 17:
	echo html_show_groups_form();
    break;
    case 18:
	$query = 'DELETE FROM invite WHERE grp_n = \''.
		 $_GET['grp_n'].'\';';
	
	if( mysql_query( $query ) )		
	    echo "OK";
	else 
	    echo "MySQL: DELETE ERROR!!!"; 
    break;
    case 19:
	$query = 'DELETE FROM invite WHERE usr_n = \''.
		 $_GET['usr_n'].'\';';
	if( mysql_query( $query ) )
	    echo 'OK';
	else 
	    echo 'MySQL: userDelete ERROR!!!';
    break;
    case 20:
	if( invite_users( $_GET['grp_n'], $_GET['roomNo'], $_GET['time'],
	    $_GET['delta'], $_GET['how'] ))
	    echo html_get_users_invite_table( $_GET['grp_n'], 2 );
	else
	    echo "ERROR!!!";
    break;
    case 21:
	echo html_send_records_form();
    break;
    case 22:
	echo html_send_susers_form();
    break;
    case 23:
	echo passwd_operation( $_GET['op_no'], 
			       $_GET['username'], 
			       $_GET['passwd'] );
    break;
    case 25:
 	mass_dial($_GET);
    break;
    case 24:
	echo html_add_new_md_form();
    break;
    case 26:
        echo html_mdial_progress( $_GET['grp_n'] );
    break;
    case 27:
	echo html_add_new_md_form();
    break;
    case 28:
        echo html_invite_users_first_page( $_GET['num'] );
    break;
}

//---Bye-bye-;)-----------------------------
$ami->disconnect();
mysql_close( $mysql_connection );
//cut---------------------------------------
?>
