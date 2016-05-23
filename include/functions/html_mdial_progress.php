<?php
//---FUNCTION mdial_progress()----------------------
//---SYNOPSYS---------------------------------------
//---Show-mdialer-progress--------------------------
//---arguments: $con_num - conference number
//---return: 	boolean;
//cut-----------------------------------------------
function html_mdial_progress( $grp_n )
{
    GLOBAL $md_work_dir;
    $result = mysql_query('SELECT DISTINCT grp_name FROM invite'.
		' WHERE grp_n = \''.$grp_n.'\' LIMIT 1;');
    $grp = mysql_fetch_assoc( $result );

    $procent = count_dialed( $grp_n, 1 );
    
    $html = '<h3>&nbsp&nbsp '.'DIAL PROGRESS FOR '.$grp['grp_name'].'</h3>'.
	    '<table style="padding: 1px 10px;" width="100%">'.
		'<tr>'.
			'<td align="center">'.
		'<b>'.'Total progress'.' : '.count_dialed( $grp_n, 0 ).'</b>'.
	    		'</td>'.
		'</tr>'.
		'<tr>'.
			'<td>'.
		'<div id="progressbar" class="ui-progressbar '.
			'ui-widget ui-widget-content ui-corner-all"'.
			' role="progressbar"'.
			' aria-valuemin="0" aria-valuemax="100" aria-valuenow="'.
		$procent.'">'.
				'<div class="ui-progressbar-value ui-widget-header ui-corner-all"'.
					' style="width: '.$procent.'%;"/>'.
				'</div>'.
			'</td>'.
		'</tr>'.
	    '</table><br>'.
		'<h3>&nbsp&nbsp '.'Dial abonents'.':</h3>';
    $fjob = file( $md_work_dir.$grp_n.'.job' );
    $html = $html.'<table style="padding: 1px 10px">';
    foreach( $fjob as $j )
    {
        $abon = make_md_abonents( $j );
	$html = $html.$abon;
    }
	if($procent >  99)
	{
    $html = $html.'</table><br><table width="100%" style="padding: 1px 10px;">'.
	'<tr><td align="left">'.
	'<input type="button" value="reDial"'.
		' onClick="reDial(\''.$grp_n.'\');"></td>'.
	'<td align="right"><input type="button" value="Clear" onClick="clearMD(\''.$grp_n.'\');">'.
    	'</td></tr></table>';
	}
	return $html;
}
?>