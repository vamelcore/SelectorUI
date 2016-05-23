<?php
//---FUNCTION passwd_operation( $op_no, $username,
//				$passwd ); 
//---SYNOPSYS---------------------------------------
//---Change-admin-passwd,-remove-or-add-user--------
//---arguments: $op_no 	  - operation number
//		$username
//		$passwd
//---return:    "OK", "ERR" for Ajax
//cut----------------------------------------------- 
function passwd_operation( $op_no, $username, $passwd )
{
    $realm = "Selector";
    $lines = file( 'include/passwd' );
    if( $username != 'admin' )
	$f = fopen( 'include/passwd', 'w+' );
    if ( !$f )
    {
	echo 'passwd open() ERROR!!!';
	$ret = "ERR";
    }
    
    switch( $op_no )
    {
	case 0://---change-admin-passwd---
	    foreach( $lines as $line )
	    {
		if( strstr( $line, 'admin:' ) != false )
		    fputs( $f, 'admin:'.$realm.':'.$passwd."\n" );
		else
		    fputs( $f , $line );
	    }
	break;
	case 1://---remove---
	    if ($username != 'admin')
	    {
		foreach( $lines as $line )
		{
		    if( strstr( $line, $username.':' ) == false )
			fputs( $f, $line );
		}
	    }
	break;
	case 2: //---add-user---
	    if ($username != 'admin')
	    {
		foreach( $lines as $line )
		{
		    if ( strstr( $line, $username.':' ) == false )
			fputs( $f, $line );
		}
		fputs( $f, $username.':'.$realm.':'.$passwd."\n" );
	    }
	break;
    }
    fclose( $f );
    $ret = "OK";
    return $ret;
}
?>