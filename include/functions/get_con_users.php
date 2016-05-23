<?php
//---FUNCTION get_con_users()----------------------- 
//---SYNOPSYS---------------------------------------
//---Add-conference-to-'booking'-table--------------
//---arguments: $con_num - conference number
//---return: 	$users - array of user in conference
//			 ['n']		- user index
//			 ['user_id']    - user tel
//			 ['channel']	- channel
//			 ['muted']	- is muted?
//		TODO-	 ['speak']	- boolean
//cut----------------------------------------------- 
function get_con_users( $con_num )
{
    GLOBAL $ami;
    
    $com = "meetme list $con_num";
    $result = $ami->command( $com );
    $users = mml_analysis( $con_num ,$result['data'] );
    
    return $users;
}
?>