<?php
require_once('phpagi/phpagi-asmanager.php');
require_once('functions.php');
require_once('settings.php');

class Conference
{	
	public  $params = array();
	public  $users_count;
	private $users = array();
		
	public function __construct( $con_num )
	{
	    GLOBAL $conferences, $ami;
	        
	    for ( $i = 0; $i < count($conferences); $i++)
		if ( (int)$conferences[$i]['roomNo'] == (int)$con_num )
		    $this->params = $conferences[$i];
	    $this->users = get_con_users( $con_num );
	    $this->users_count = count( $this->users );
	}
	public function kick_all()
	{
	    GLOBAL $ami;
	    $com = 'meetme kick '.$this->params['roomNo'].' all';
	    return $ami->command( $com ); 
	}
	public function kick_user( $user_id )
	{
	    GLOBAL $ami;
	    $com = 'meetme kick '.$this->params['roomNo'].' '.$user_id;
	    return $ami->command( $com );
	}
	public function lock()
	{
	    GLOBAL $ami;
	    $com = 'meetme lock '.$this->params['roomNo'];
	    $this->params['locked'] = true;
	    return $ami->command( $com );
	}
	public function unlock()
	{
	    GLOBAL $ami;	    
	    $com = 'meetme unlock '.$this->params['roomNo'];
	    $this->params['locked'] = false;
	    return $ami->command( $com );
	}
	public function mute_user( $user_id )
	{
	    GLOBAL $ami;
	    $com = 'meetme mute '.$this->params['roomNo'].' '.$user_id;
 	    return $ami->command( $com );
	}
	public function unmute_user( $user_id )
	{
	    GLOBAL $ami;
	    return $ami->command('meetme unmute '.$this->params['roomNo'].
				  ' '.$user_id );
	}
	public function invite_users( $list_of_users, $how )
	{
	    //$how = 1 -by-phone
	    //$how = 2 -by-email
	    switch( $how )
	    {
		case 1:
		    
		break;
		case 2:
		    
		break;		
	    }
	}
	public function remove()
	{
	    GLOBAL $ami, $contexts;
	    $query = "DELETE FROM booking WHERE bookId = '".
		       $this->params['bookId']."';";
	    $this->kick_all();
	    $result = mysql_query( $query );
	    if ( !$result )
	    {
		echo "ERROR: ".mysql_errno()." ".mysql_error();
		exit;
	    }
	    foreach( $contexts as $c )
	    {
		$com = 'dialplan remove extension '.
		    $this->params['roomNo'].'@'.$c;
		$ami->command( $com );
	    }
	    
	    $forig = 'include/meetme.conf';
	    $stemp = file( $forig );
	    $f = fopen( $forig, 'w+' );
	    foreach( $stemp as $str )
	    {
		if( (strstr( $str, $this->params['roomNo'] ) 
			== false) && ( $str != "\n" ) )
		    fputs( $f, $str );
	    }
	    fclose( $f );
	    
	    return true;
	}
}
?>