<?php
//---AMI-settings----------------------------
// in '/etc/asterisk/manager.conf'
//
// [selector]
// secret = selector
// read   = call
// write  = command,originate
//
$amihost  = 'localhost';
$amilogin = 'selector';
$amipass  = 'selector';
//cut----------------------------------------

//---MySQL-settings--------------------------
//
$mysql	= array( 'server'   => 'localhost',
		 'username' => 'asteriskuser',
		 'password' => 'asteriskpass');
//cut----------------------------------------

//---Language--------------------------------
//---Available: ru, en
//---you can send your localization on
//-- kod.ru@inbox.ru   I`ll-be-waiting
//---need: de, es, fr, it, ro
//---Also check encoding in 'index.php'
//---<meta charset="utf-8">
//  
$lang = 'ru';
require_once( 'include/l18n/'.$lang.'.php' );
//cut----------------------------------------

//---TimeZone--------------------------------
//---example-'UTC'---------------------------
//           'Europe/Samara'
//	     'America/Los_Angeles'
//	      etc....
//complete list on:
// php.net/manual/en/timezones.php
//
$timezone = 'Europe/Kiev';
date_default_timezone_set( $timezone );
//cut----------------------------------------

//---Conference-number-range-----------------
//
$room_range = array( 'min' => 7190,
		     'max' => 7199 );
//cut----------------------------------------

//---Dialplan-contexts-where-you-want-to-----
//---include-conferences---------------------
//
$contexts = array( 'from-internal','trunk','from-trunk' );
//cut----------------------------------------

//---Trunks-for-HTML-form--------------------
//
$trunks = '<select id="trunk">'.
   /*local*/'<option></option>'.
//This-is-my-test-CUCM-trunk-----
//	    '<option value="toccm">'.
//		'toccm'.
//	    '</option>'.
//You-may-add-your-trunks--------
//
	    '<option value="g1">'.
		'g1'.
	    '</option>'.
	    '<option value="asterisk_1_118">'.
		'asterisk'.
	    '</option>'.
	    '<option value="alcatel_test">'.
		'alcatel'.
	    '</option>'.
	    '<option value="terratel">'.
	        'terra'.
	    '</option>'.
//
//like-this-one------------------
	  '</select>';
//cut----------------------------------------

//---CALL-file-params------------------------
//
$cf_params = array('WaitTime' 	=> '30',//sec
		   'MaxRetries' => '3', //sec
/*time btw retr*/  'RetryTime'  => '60',//sec
		   'Archieve'   => 'yes' );
//cut----------------------------------------

//---MeetMe-recording------------------------
//---supports: wav, gsm, alaw, ulaw----------
//---you-can-convert-it-into-other-format----
//---using-'sox'-----------------------------
//--- # sox foo-in.gsm -r 44100 -a out.wav --
//
$rec = array( 'format' => 'wav',
//---record-name-format----------------------
       'name_preamble' => 'meetme-conf-rec-',
       'name_date'     => 'U',
//---If-you-uncomment-strings-in-'cron.job'--
//---witch-remove-records-every-week-set-this
//---variable-'true'-------------------------
       'clear_weekly'  => true );
//cut----------------------------------------

//---MassDialer-settings---------------------
//
//$md_work_dir = '/home/massdialer/';
//$aster_sounds_dir = '/var/lib/asterisk/sounds/'.$lang.'/massdial/';
//cut----------------------------------------
?>