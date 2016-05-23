<?php
//---FUNCTION html_send_records_form()-------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: none
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_send_records_form()
{
    GLOBAL $rec, $l18n, $auth_info;
    $cw = '';
    $folder = array();
    $buff = array();
    
    if( $rec['clear_weekly'] )
	$cw = '<font color="#f78181">'.
		$l18n['cwarning'].
	      '</font>';
    $html_header = '<table style="padding:1px 10px;">'.
		'<tr>'.
		    '<td width="150">'.
			'<h3>'.
			    $l18n['records'].':'.
			'</h3>'.
		    '</td>'.
		    '<td width="320" align="right" valign="top">'.
			$cw.
		    '</td>'.
		'</tr>'.
	    '</table>';
    
    $rec_dir = dir('records');
    $i = 0;
    while( ( $entry = $rec_dir->read() ) !== false )
    {
	if(($entry !== ".") && ($entry !== ".."))
	{
	    $buff  = explode( '.', $entry );
	    $buff  = explode( '-', $buff[0] );
	    $ctime = date( 'H:i', $buff[5] );
	    $ftime = date( 'd-m-Y', $buff[5] );
	    if( $ftime != '01-01-1970' )
	    {
		$folder[$ftime][$i]['ctime']  = $ctime;
		$folder[$ftime][$i]['roomNo'] = $buff[3];
		$folder[$ftime][$i]['owner']  = $buff[4];
		$folder[$ftime][$i]['flink']  = 'records/'.$entry;
		$i++;
	    }
	    else
		unlink( 'records/'.$entry );
	}
    }
    $html_body = '<table style="padding:1px 10px;">';
    foreach( $folder as $key => $value )
    {
	$html_body = $html_body.
		     '<tr>'.
		        '<td>'.
		    	    '<img src="images/icons/calendar.png">'.
		    	    '&nbsp&nbsp <b>'.$key.'</b>'.
		        '</td>'.
		     '</tr>'.
		     '<tr>'.
		        '<td>';
	
	foreach( $value as $file )
	{
	    if( ( $auth_info['username'] == 'admin') ||
		( $auth_info['username'] == $file['owner'] ))
		$html_body = $html_body.
			    '<table style="padding: 1px 20px;">'.
				'<tr>'.
				    '<td width="90" align="center">'.
					'<img src="images/icons/Schedule.png">'.
					'&nbsp&nbsp&nbsp '.
					'<b>'.$file['ctime'].'</b>'.
				    '</td>'.
				    '<td>'.
					'<font color="green">'.$file['owner'].
					'</font>'.
				    '</td>'.
				    '<td width="150">'.
					$l18n['roomno'].' #: <b>'.$file['roomNo'].'</b>'.
				    '</td>'.
				    '<td>'.
					'<a href="'.$file['flink'].'">'.
					'<img src="images/icons/Download.png">'.
					'&nbsp&nbsp '.
					$l18n['dload'].
					'</a>'.
					'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.
				    '</td>'.
				'</tr>'.
			    '</table>';
	}
	
	$html_body = $html_body.
			'<td>'.
		    '</tr>';
    }
    $html_body = $html_body.'</table>';
    $rec_dir->close();
    return $html_header.$html_body;
}
?>