<?php
//---FUNCTION clear_sql_inj()-----------------------
//---SYNOPSYS---------------------------------------
//---Clear-$_GET-array------------------------------
//---arguments: $dirty_get 	- dirty array
//---return:	$clear		- clear array
//cut-----------------------------------------------
function clear_sql_inj( $dirty_get )
{
	$clean = array();
	foreach( $dirty_get as $key => $value )
	{
		if( get_magic_quotes_gpc() )
		{
			$clean[$key] = mysql_real_escape_string(
				  stripslashes( $value ));
		}
		else
		{
			$clean[$key] = mysql_real_escape_string( $value );
		}
	}
    	return $clean;
}
?>