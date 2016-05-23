<?php
//---FUNCTION mml_analysis()------------------------ 
//---SYNOPSYS---------------------------------------
//---Analyzes-results-of-"meetme list <n>"-command--
//---arguments: $mml_responce - result of asterisk
//				"meetme list <n>"
//---return: 	$users_list   - [n]	  - index
//				[user_id] - number
//				[channel] - ch
//				[muted]   - boolean
//				[speak]	  - boolean	
//cut----------------------------------------------- 
function mml_analysis( $con_num, $mml_responce )
{
    $result 	= array();
    $buffer	= array();
    $explode 	= explode( " ", $mml_responce );
    $channel	= array();
    $number	= array();
        
    for ($i = 0; $i < count( $explode ); $i++ )
    {
	if( $explode[$i] != "" )
	    array_push( $buffer, $explode[$i] );     
    }
    $n = 0;
    $count = count( $buffer );
    for ($i = 0; $i < $count; $i++ )
    {
	switch ( $buffer[$i] )
	{
	    case "#:":
		$result[$n]["n"] = (int)$buffer[$i+1];
		if( substr($buffer[$i+2], 0, 3) == 'usr' )
		    $result[$n]["user_id"] = substr( $buffer[$i+2],
			3, strlen( $buffer[$i+2] ));
		else
		    $result[$n]["user_id"] = $buffer[$i+2];
		$result[$n]["muted"] = false;
	    break;
	    case "Channel:":
		$result[$n]["channel"] = $buffer[$i+1];
	    break;
	    case "(Muted)":
		$result[$n]["muted"] = true;
	    break;
	    case "Muted)":
		$result[$n]["muted"] = true;
	    break;
	    case "(unmonitored)":
		$result[$n]['speak'] = false;
		$n++;
	    break;
	    case "talking)":
		$result[$n]['speak'] = false;
		$n++;
	    break;
	    case "(talking)":
		$result[$n]['speak'] = true;
		$n++;
	    break;
	}
    }
    return $result;
}
?>