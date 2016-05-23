<?php
//---FUNCTION parse_http_digest()--------------------
//---SYNOPSYS----------------------------------------
//---Take-different-parameters-of-HTTP-auth-digest---
//---arguments: $digest - $_SERVER['PHP_AUTH_DIGEST']
//---return: 	$data	- assoc array 
//			  ['username'] - username
//			  ['algorithm'] - algorithm
//			  ['realm'] - realm
//			  etc...
//cut------------------------------------------------
function parse_http_digest( $digest )
{
    $buffer = array();
    $params = explode(',', $digest);
    for ( $i = 0; $i < count( $params ); $i++ )
    {
	$buffer = explode( "=", $params[$i] );
	$buffer[1] = str_replace( "\"", "", $buffer[1]);
	$data[$buffer[0]] = $buffer[1];
    }
    return $data;
}
?>