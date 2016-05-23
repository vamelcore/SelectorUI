<?php
//---FUNCTION html_show_groups_form()--------------------- 
//---SYNOPSYS---------------------------------------
//---Form-HTML-string-for-AJAX-query----------------
//---arguments: none
//---return: 	$html 	     - formed HTML string
//cut----------------------------------------------- 
function html_show_groups_form()
{
    GLOBAL $l18n;
    $html = '<table style="padding : 1px 10px ;">'.
	    '<tr>'.
		'<td width="230">'.
		    '<h3>'.$l18n['abongrp'].' :</h3>'.
		'</td>'.
		'<td width="225" align="right">'.
		    '<a onMouseDown="showAddGroupForm()" href="#">'.
			'<img src="images/icons/file_add.png">'.
			'&nbsp&nbsp<b>'.$l18n['addnew'].'</b>'.
		    '</a>'.
		'</td>'.
	   '</tr>'.
	   '<tr>'.
		'<td colspan=2>';
    
    $html = $html.html_get_groups( 2 );
    
    $html = $html.'</td>'.
	   '</tr>'.
	'</table>';


    return $html;
}
?>