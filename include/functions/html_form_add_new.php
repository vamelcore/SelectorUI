<?php
//---FUNCTION html_form_add_new()------------------- 
//---SYNOPSYS---------------------------------------
//---Stored-on-server-because-of-l18n---------------
//---arguments: $conferences - array of all confs---
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_form_add_new()
{
    GLOBAL $auth_info, $timezone, $l18n;
    $valid_num = get_valid_roomno();
    date_default_timezone_set( $timezone );

    $start_time = date( 'Y-m-d H:i', ( date('U') + 600 ));
    $end_time = date( 'Y-m-d H:i', ( date('U') + 4200 ));
    
    $html = '<form id="faddnew" style="padding: 7px;">'.
		'<h3>&nbsp&nbsp '.$l18n['addnewh'].':</h3>'.
		'<table border=0 style="padding: 5px;">'.
		    '<tr id="firstr">'.
			'<td>'.
			    $l18n['connum'].'&nbsp * &nbsp :'.
			'</td>'.
			'<td>'.
			    '<input id="roomNo" type="text"'. 
			    'value="'.$valid_num.'" tabindex=1 size="15">'.
			'</td>'.
			'<td>'.
			    $l18n['options'].':'.
			'</td>'.
			'<td>'.
			    '<input id="aFlags" type="text" value="cTM" '.
			    'size="10" maxlength="35">'.
			'</td>'.
		    '</tr>'.
		    '<tr id="secondr">'.
			'<td>'.
			    $l18n['conname'].':'.
			'</td>'.
			'<td>'.
			    '<input id="confDesc" type="text" tabindex=2 '.
			    'size=15 maxlength="30">'.
			'</td>'.
			'<td>'.
			    $l18n['tlimit'].':'.
			'</td>'.
			'<td>'.
			    '<input id="timelimit" type="text" size=10 '.
			    'maxlength="7">'.
			'</td>'.
		    '</tr>'.
		    '<tr id="thirdr">'.
			'<td>'.
			    $l18n['moderpin'].':'.
			'</td>'.
			'<td>'.
			    '<input id="silPass" tabindex=3 size=15>'.
			'</td>'.
			'<td>'.
			    $l18n['allowv'].':'.
			'</td>'.
			'<td>'.
			    '<input id="cvideo" type="checkbox">'.
			'</td>'.
		    '</tr>'.
		    '<tr id="fourthr">'.
			'<td>'.
			    $l18n['userpin'].':'.
			'</td>'.
			'<td>'.
			    '<input id="roomPass" type="text" '.
			    'tabindex=4 size=15>'.
			'</td>'.
			'<td>'.
			    $l18n['aexit'].':'.
			'</td>'.
			'<td>'.
			    '<input id="closeaexit" type="checkbox">'.
			'</td>'.
		    '</tr>'.
		    '<tr id="fifthr">'.
			'<td>'.
			    $l18n['stime'].' &nbsp * &nbsp :'.
			'</td>'.
			'<td>'.
			    '<input id="startTime" tabindex=5 size="15" '.
			    'value="'.$start_time.'" align="center">'.
			'</td>'.
			'<td>'.
			    $l18n['astmenu'].':'.
			'</td>'.
			'<td>'.
			    '<input id="cmenu" type="checkbox" checked="true">'.
			'</td>'.
		    '</tr>'.
		    '<tr id="sixthr">'.
			'<td>'.
			    $l18n['etime'].'&nbsp * &nbsp:'.
			'</td>'.
			'<td>'.
			    '<input id="endTime" type="text" tabindex=6'.
			    ' size="15" value="'.$end_time.'" align="center">'.
			'</td>'.
			'<td>'.
			    $l18n['lwait'].':'.
			'</td>'.
			'<td>'.
			    '<input id="cleaderwait" type="checkbox">'.
			'</td>'.			
		    '</tr>'.
		    '<tr id="KoD">'.
			'<td>'.
			    $l18n['maxuser'].':'.
			'</td>'.
			'<td>'.
			    '<input id="maxUser" type="text" tabindex=8 '.
			    'maxlength="4" value="50" size="4">'.
			'</td>'.
			'<td>'.
			    '<img src="images/icons/Record.png">&nbsp '.
			    $l18n['rec'].':'.
			'</td>'.
			'<td>'.
			    '<input id="crecord" type="checkbox">'.
			'</td>'.
		    '</tr>'.
		    '<tr>'.
			'<td>'.
			    ''.
			'</td>'.
			'<td>'.
			    ''.
			'</td>'.
			'<td>'.
			    $l18n['imuted'].':'.
			'</td>'.
			'<td>'.
			    '<input type="checkbox" id="imuted">'.
			'</td>'.
		    '</tr>'.
		'</table>'.
		'<input id="submitbtn" type="button" value="'.
		    $l18n['create'].'">'.
	    '</form>';
    return $html;
}
?>