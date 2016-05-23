<?php
//---FUNCTION count_dialed()------------------------
//---SYNOPSYS---------------------------------------
//---Show-mdialer-progress--------------------------
//---arguments: $grp_n - group number
//---return: 	formed string x/n
//cut-----------------------------------------------
function count_dialed( $grp_n, $mode )
{
    GLOBAL $md_work_dir;

    $fgrp = array();
    $fgrpjob = array();
    $fname = $md_work_dir.$grp_n;

    $fgrp = file( $fname );
    if( file_exists( $fname ))
	$fgrpjob = file( $fname.".job" );
    if( $mode )
	return round( (count( $fgrpjob ) / count( $fgrp )) * 100 );
    return count( $fgrpjob ).'/'.count( $fgrp );
}
?>