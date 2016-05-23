<?php
//---FUNCTION invite_users()------------------------ 
//---SYNOPSYS---------------------------------------
//---Invite-users-to-the-conference-by-phone-or-mail
//---arguments: $grp_n     - group index
//		$time      - begining time
//		$delta	   - min before
//		$how       - 1 : e-mail
//			     2 : call
//			     3 : both
//---return: 	true
//cut----------------------------------------------- 
function invite_users( $grp_n, $roomNo , $time, $delta, $how )
{
    GLOBAL $cf_params, $auth_info, $rec; 
    $num = array();
    
    $main_cf = 'include/calltemp/invite.call';
    $call_date   = date("Y.m.d.H.i.", strtotime( $time ));
    $ts = strtotime( $time );
    $invite_time = date( 'Y-m-d H:i', ( date( 'U', $ts ) - ( $delta * 60 )));
            
    $result = mysql_query('SELECT usr_n, phn FROM invite '.
			  'WHERE grp_n = \''.$grp_n.'\' ORDER BY phn ASC;');
    if(!$result)
	return false;
	
    //---by-phone---
    if( ($how == 0) || ($how == 2) )
    {
	for( $i = 0; $i < mysql_num_rows( $result ); $i++ )
	{
	    $usr = mysql_fetch_assoc( $result );
	    
	    $handle = fopen( $main_cf, 'w+');
	    if( !$handle )
	    {
		echo "invite.call open ERROR!!!";
	    }	    
	    $num = explode( "/", $usr['phn'] );
	    fputs( $handle, "Channel: ".$usr['phn']."\n" );
	    fputs( $handle, "CallerID: ".$roomNo."-".
			    $auth_info['username']."Conf".
			    "<usr".$num[count($num)-1].">\n" );
	    fputs( $handle, "Extension: ".$roomNo."\n" );
	    fputs( $handle, "WaitTime: ".$cf_params['WaitTime']."\n" );
	    fputs( $handle, "MaxRetries: ".$cf_params['MaxRetries']."\n" );
	    fputs( $handle, "RetryTime: ".$cf_params['RetryTime']."\n" );
	    fputs( $handle, "Archive: ".$cf_params['Archieve']."\n" );
	    fputs( $handle, "Set: MEETME_RECORDINGFORMAT=".
				  $rec['format']."\n" );
	    fclose( $handle );
	    
	    $call_file = 'include/calltemp/'.$call_date.
			 $usr['usr_n'].'.call';
	    $handle = copy( $main_cf, $call_file );
	    
	    if ( !$handle )
	    {	
		echo ".call copy ";
		return false;
	    }	
	    touch( $call_file, strtotime( $invite_time ));
	    rename( $call_file, 'include/outgoing/'.
				$call_date.$usr['usr_n'].'.call' );
	    fclose( $handle );
	sleep(3);
	}
    }
    
    //---by-email---
    if( ($how == 1) || ($how == 2) )
    {
    
    }
    return true;
}
?>