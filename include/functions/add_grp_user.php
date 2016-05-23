<?php
//---FUNCTION add_grp_user()------------------------ 
//---SYNOPSYS---------------------------------------
//---Add-user-into-'invite'-table-------------------
//---arguments: $params - array of conference params
//			  ['grp_name']  - group name
//			  ['usr_name']	- user name
//			  ['grp_owner'] - owner name
//			  ['phn'] 	- phone number
//					  with proto
//                        ['email']     - email 
//---return: 	true
//cut----------------------------------------------- 
function add_grp_user( $params )
{
    GLOBAL $auth_info;
    $result 	= 0;   
    $grp_n = get_valid_grp_n( $params['grp_name'] );
    
    $query = "INSERT INTO invite ( grp_n,". 
				   "grp_name,".
                            	   "usr_name,".
                                   "grp_owner,".
                                   "phn,".
                                   "email ) ".
	     "VALUES('".$grp_n."',".
	            "'".$params['grp_name']."',".
	            "'".$params['usr_name']."',".
	            "'".$auth_info['username']."',".
	            "'".$params['phn']."',".
	            "'".$params['email']."')";    
    $result = mysql_query( $query );
    if ( !$result )
    {
	echo "ERROR: ".mysql_errno()." ".mysql_error();
	return false;
    }
    //---SUCCESSFULY---
    echo html_get_users_invite_table( $grp_n, 1 );    
    return true;
}
?>