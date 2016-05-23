<?php
//---FUNCTION is_locked()--------------------------- 
//---SYNOPSYS---------------------------------------
//---Check-conference-lock-status-------------------
//---arguments: $con_num - conference number
//---return: 	boolean;
//cut----------------------------------------------- 
function is_locked( $con_num )
{
    GLOBAL $ami;
    $locked = false;
    $buffer = array();
    
    $result = $ami->command('meetme list');
    $strings = explode( "\n", $result['data']);
    foreach ( $strings as $s )
    {
	$buffer = explode( " ", $s );
	if( (int)$buffer[0] == (int)$con_num )
	{
	    foreach( $buffer as $b)
	    {
		if ($b == "Yes")
		    $locked = true;
		elseif ($b == "No")
		    $locked = false;
	    }
	}
    }    
    return $locked;
}
?>