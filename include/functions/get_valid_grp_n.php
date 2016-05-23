<?php
//---FUNCTION get_valid_grp_n()-------------------- 
//---SYNOPSYS--------------------------------------
//---Get-valid-group-number------------------------
//---arguments: $grp_name - group name
//---return: 	$num - valid grp number
//cut---------------------------------------------- 
function get_valid_grp_n( $grp_name )
{
    GLOBAL $auth_info;
    $grp_n = array();
    $result = mysql_query( 'SELECT DISTINCT grp_n, grp_name '. 
			    'FROM invite;');
    $n = rand( 0, 22111985 );
    if ( ! $result )
    {
	$num = $n;
    }
    else
    {
	$count = mysql_num_rows( $result );
	for( $i = 0; $i < $count; $i++ )
	{
	    $grp = mysql_fetch_assoc( $result );
	    if ( $grp['grp_name'] == $grp_name )
		return $grp['grp_n'];
	    $grp_n[] = $grp['grp_n'];
	}
	$count = count( $grp_n );
	for( $i = 0; $i < $count; $i++ )
	{
	    if( $grp_n[$i] == $n )
		get_valid_grp_n( $grp_n );
	}
	$num = $n;
    }    
    return $num;
}
?>