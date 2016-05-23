<?php
//---FUNCTION add_conference()---------------------- 
//---SYNOPSYS---------------------------------------
//---Add-conference-to-'booking'-table--------------
//---arguments: $params - array of conference params
//			  ['roomNo']    - room number
//			  ['roomPass']  - user pin
//			  ['silPass']   - admin pin
//			  ['startTime'] - start time
//			  ['endTime']   - end time
//			  ['maxUser']   - max number of users
//			  ['confDesc']  - description
//			  ['confOwner'] - owner name
//			  ['aFlags']    - admin flags (def 'asdA')
//                        ['uflags']    - user flags (def 'd')
//---return: 	true
//cut----------------------------------------------- 
function add_conference( $params )
{
    GLOBAL $contexts, $ami, $my_context, $rec;
    
    $result 	= 0;    
    $query = "INSERT INTO booking ( roomNo,".
                            	   "roomPass,".
                                   "silPass,".
                                   "startTime,".
                                   "endTime,".
                                   "maxUser,".
                                   "confDesc,".
                                   "confOwner,".
                                   "aFlags,".
                                   "uFlags ) ".
	     "VALUES('".$params['roomNo']."',".
	            "'".$params['roomPass']."',".
	            "'".$params['silPass']."',".
	            "'".$params['startTime']."',".
	            "'".$params['endTime']."',".
	            "'".$params['maxUser']."',".
	            "'".$params['confDesc']."',".
	            "'".$params['confOwner']."',".
	            "'".$params['aFlags']."',".
	            "'".$params['uFlags']."' );";
    $result = mysql_query( $query );
    if ( !$result )
    {
	echo "ERROR: ".mysql_errno()." ".mysql_error();
	return false;
    }
    //---SUCCESSFULY---
    foreach ( $contexts as $c )
    {
	$ami->command( 'dialplan add extension '.
	      $params['roomNo'].',1,Set,MEETME_RECORDINGFORMAT='.
	      $rec['format'].' into '.$c );
	$ami->command( 'dialplan add extension '.
	      $params['roomNo'].',2,Set,MEETME_RECORDINGFILE='.
	      $rec['name_preamble'].
	      $params['roomNo'].'-'.
	      $params['confOwner'].'-'.
	      date( $rec['name_date'], strtotime( $params['startTime'] )).
	      ' into '.$c );
	$ami->command( 'dialplan add extension '.
	      $params['roomNo'].',3,Answer, into '.$c );
	$ami->command( 'dialplan add extension '.
	      $params['roomNo'].',4,MeetMe,'.$params['roomNo'].
	      ','.$params['aFlags'].' into '.$c );
	$ami->command( 'dialplan add extension '.
	      $params['roomNo'].',5,Hangup, into '.$c );
    }
    
    $f = fopen( 'include/meetme.conf', 'a+' );
    
    $string = "\n".'conf => '.$params['roomNo'];
    if ( $params['roomPass'] != '' )
	$string = $string.','.$params['roomPass'];
    if ( ($params['silPass'] != '') && 
	 ($params['roomPass']) != '' )
	$string = $string.','.$params['silPass'];
    elseif ( ($params['silPass'] != '') && 
	     ($params['roomPass'] == '' ))
	$string = $string.',,'.$params['silPass'];
    
    fputs( $f, $string );
    fclose( $f );
    
    return true;
}
?>