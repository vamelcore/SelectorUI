<?php
//---FUNCTION get_valid_roomno()-------------------- 
//---SYNOPSYS---------------------------------------
//---Get-valid-room-number-))-----------------------
//---arguments: none
//---return: 	$num - valid room number
//cut----------------------------------------------- 
function get_valid_roomno()
{
    GLOBAL $room_range, $conferences;
    $num = rand( $room_range['min'], $room_range['max'] );
    
    foreach( $conferences as $con )
    {
	if( $num == $con['roomNo'] )
	    $num = get_valid_roomno();
    }
    
    return $num;
}
?>