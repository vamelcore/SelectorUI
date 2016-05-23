<?php
//---FUNCTION mass_dial()---------------------------
//---SYNOPSYS---------------------------------------
//---Make-telephone-calls-to-the-group--------------
//---arguments: $params['filename']    - group number
//              $params['threads_number']
//              $params['cid_name'] - callerid name
//              $params['cid_num']  - callerid number
//              $params['timeout']  - how long wait
//				      called party
//              $params['audio_file']
//---return: 	boolean;
//cut----------------------------------------------- 
function mass_dial( $params )
{
    	GLOBAL $ami, $md_work_dir;
	$com = '';
	$f = fopen($md_work_dir.$params['grp_n'], 'w+');
	if(!$f)
	{
		echo $md_work_dir.$params['grp_n'].': fopen() error!';
		return false;
	}
	$sql = 'SELECT phn FROM invite WHERE grp_n = '.
	       $params['grp_n'].';';
	$result = mysql_query($sql);
	if(!$result)
	{
		echo "MySQL query error. mass_dial.php at line 23";
	}

	$num = mysql_num_rows($result);
	for($i = 0; $i < $num; $i++)
	{
		$usr = mysql_fetch_assoc($result);
		$phn = explode('/', $usr['phn']);
		$usr['phn'] = $phn[1];
		if(count($phn) > 2)
			$usr['phn'] = $usr['phn'].'/'. $phn[2];
		fputs($f, $usr['phn']."\n");
	}
	$com = 'mass dial '.
		      $md_work_dir.$params['grp_n'].' '.
		      $params['threads_number'].' '.
		      $params['cid_name'].' '.
		      $params['cid_num'].' '.
		      $params['timeout'].' '.
		      $params['audio_file'];
	fclose($f);
	$ami->command( $com );
	return true;
}
?>