function conRemove( num )
{
    $('#content').stopTime('ctimer');
    $.get('selector.php?action=5&num='+num, function(data)
    {
	$('#'+num).hide("slow");
    });
    $('#content').everyTime( 5000, 'ctimer', function()
    {
	$.get('selector.php?action=1', function(data)
	{
	    $('#content').html(data);
	});
    });
    return true;
}
function conKickall( num )
{
    $('#content').stopTime('ctimer');
    $.get('selector.php?action=4&num='+num, function(data)
    {
    });
    $.get('selector.php?action=1', function(data)
    {
        $('#content').html(data);
    });
    $('#content').everyTime( 5000, 'ctimer', function()
    {
	$.get('selector.php?action=1', function(data)
	{
	    $('#content').html(data);
	});
    });
    return true;
}
function conLock( num )
{
    $('#content').stopTime('ctimer');
    $.get('selector.php?action=2&num='+num, function(data)
    {
    });
    $.get('selector.php?action=1', function(data)
    {
	$('#content').html(data);
    });
    $('#content').everyTime( 5000, 'ctimer', function()
    {
	$.get('selector.php?action=1', function(data)
	{
	    $('#content').html(data);
	});
    });
    return true;
}
function conUnlock( num )
{
    $('#content').stopTime('ctimer');
    $.get('selector.php?action=3&num='+num, function(data)
    {	
    });
    $.get('selector.php?action=1', function(data)
    {
        $('#content').html(data);
    });
    $('#content').everyTime( 5000, 'ctimer', function()
    {
	$.get('selector.php?action=1', function(data)
	{
	    $('#content').html(data);
	});
    });
    return true;
}
function inviteUsersForm( cnum )
{
    $('#content').stopTime('ctimer');
    $.get('selector.php?action=12',
	{ num : cnum },
	function(data)
	{
	    $('#content').html(data);
	});
    
    return true;
}
function showAddConForm()
{
    $('#content').stopTime('ctimer');
    $.get('selector.php?action=6', function(data)
    {
	$('#content').html(data);
	$('#submitbtn').click( function()
	{
	    $('#faddnew').submit(addNewCon());
	});
    });
    return true;
}

function addNewCon()
{
    var flags = $('#aFlags').val();
    
    if( $('#cvideo').attr('checked') )
	flags = flags + 'v';
    if( $("#closeaexit").attr('checked') )
    	flags = flags + 'x';
    if( $("#cmenu").attr('checked') )
    	flags = flags + 's';
    if( $("#cleaderwait").attr('checked') )
    	flags = flags + 'w';
    if( $("#crecord").attr('checked') )
    	flags = flags + 'r';
    if( $("#imuted").attr('checked') )
	flags = flags + 'm';
    	
    $.get('selector.php?action=7',
	  { roomNo   : 	$('#roomNo').val(), 
	    confDesc : 	$('#confDesc').val(),
	    silPass  :	$('#silPass').val(),
	    roomPass : 	$('#roomPass').val(),
	    startTime:	$('#startTime').val(),
	    endTime  :	$('#endTime').val(),
	    maxUser  :	$('#maxUser').val(),
	    aFlags   : 	flags }, 
	  function(data)
	  {
//	  $('#content').text(data);
	     $.get('selector.php?action=1', function(data)
	    {
	    	$('#content').html(data);
	    });
		$('#content').everyTime( 5000, 'ctimer', function()
		{
		    $.get('selector.php?action=1', function(data)
		    {
			$('#content').html(data);
		    });
		});
    });
}

function showUsers( cnum )
{
    $('#content').stopTime('ctimer');
    $.get( 'selector.php?action=8', 
    { num : cnum }, 
    function(data)
    {
	$('#content').html(data);
	$('#content').everyTime( 500, 'ctimer', function()
	{
	    $.get('selector.php?action=8', { num : cnum }, 
	    function(data)
	    {
		$('#content').html(data);
	    });
	});
    });
}

function usrMute( cnum, n )
{
    $('#content').stopTime();
    $.get('selector.php?action=9',
	{ n   : n,
	  num : cnum },
          function(data)
          {

          });
    $.get('selector.php?action=8', { num : cnum }, 
	    function(data)
	    {
		$('#content').html(data);
	    });
    $('#content').everyTime( 500, 'ctimer', function()
	{
	    $.get('selector.php?action=8', { num : cnum }, 
	    function(data)
	    {
		$('#content').html(data);
	    });
	});   
    return true;
}

function usrUnmute( cnum, n )
{
    $('#content').stopTime();
    $.get('selector.php?action=10',
	{ n   : n,
	  num : cnum },
          function(data)
          {
          
          });
    $.get('selector.php?action=8', { num : cnum }, 
	    function(data)
	    {
		$('#content').html(data);
	    });
    $('#content').everyTime( 500, 'ctimer', function()
	{
	    $.get('selector.php?action=8', { num : cnum }, 
	    function(data)
	    {
		$('#content').html(data);
	    });
	});    
    return true;
}

function usrKick( cnum, n )
{
    var strn = '#u' + String(n);
    $('#content').stopTime('ctimer');
    $.get('selector.php?action=11', 
	{ n   : n,
	  num : cnum },
          function(data)
          {
          });
    $.get('selector.php?action=8', { num : cnum }, 
	    function(data)
	    {
		$('#content').html(data);
	    });
	$('#content').everyTime( 500, 'ctimer', function()
	{
	    $.get('selector.php?action=8', { num : cnum }, 
	    function(data)
	    {
		$('#content').html(data);
	    });
	});    
    return true;
}
function addUserInviteGroup()
{
    var gnum = $('#grp_select :selected').val();
    $.get('selector.php?action=14', 
	{ grp_n : gnum, 
	  edit : 0 },
	function(data)
	{
	    $('#invusr').html(data);
	});
	$('#grp_n').val(gnum);
	$('#invbtn').attr('disabled', '');
	$('#inow').attr('style', 'color: red;');
}

function addUserIntoGroup()
{
    var phone = $('#proto').val() + '/';
    if( $('#grp_name').val() == '' )
    {
		$('#grp_title').attr('color', 'red');
		return false;
	}
	if( $('#usr_name').val() == '' )
    {
		$('#usr_title').attr('color', 'red');
		return false;
	}
	$('#usr_title').attr('color','gray');
	$('#grp_title').attr('color','gray');
	$('#grp_name').attr('readonly','readonly');
	if ( $('#trunk').val() != '' )
	    phone = phone + $('#trunk').val() + '/';
	phone = phone + $('#pn').val();
	$.get('selector.php?action=16',
	    { grp_name : $('#grp_name').val(),
	      usr_name : $('#usr_name').val(),
	      phn      : phone,
	      email    : $('#email').val() },
	    function(data)
	    {
		$('#grptable').html(data);
	    });
	$('#usr_name').val('');
	$('#pn').val('');
	$('#email').val('');
}
function deleteUser(unum, gnum ,grp_name)
{
    $.get('selector.php?action=19',
	{ usr_n : unum },
	function(data)
	{

	});
    $('#un'+unum).html( '<s style="color: black;">'+ 
			$('#un'+unum).text() +'</s>' );
    $('#phn'+unum).html('<s style="color: black;">'+
			$('#phn'+unum).text()+'</s>');
    $('#em'+unum).html('<s style="color: black;">'+
			$('#em'+unum).text()+'</s>');
}
function showAddGroupForm()
{
    $.get('selector.php?action=15',
	function(data)
	{
	    $('#content').html(data);
	});
    return true;
}
function deleteGroup(gnum)
{
    if(confirm("Do you want to delete this group?"))
    {
        $.get('selector.php?action=18', 
	    { grp_n : gnum },
	    function(data)
	    {
	    });
        $('#nm'+gnum).html( '<s style="color: black;">'+
		        $('#nm'+gnum).text() + '</s>');
    }
}
function saveGroup()
{
    $.get('selector.php?action=17',function(data)
    {
	$('#content').html(data);
    });
}
function editGroup( gnum, grp_name )
{
    $.get('selector.php?action=15', function(data)
	{
	    $('#content').html(data);
	});
	$.get('selector.php?action=14',
		{ grp_n : gnum, 
		  edit  : 1 },
			function(data)
			{
				$('#grptable').html(data);
				$('#grp_name').val(grp_name);
				$('#grp_name').attr('readonly','readonly');
			});
}
function inviteGroup()
{
    $.get('selector.php?action=20', 
	{ grp_n : $('#grp_n').val(),
	  time  : $('#startTime').val(),
	  delta : $('#delta').val(),
	  roomNo: $('#roomNo').val(),
	  how   : '0' },
	function(data)
	{
	    $('#invusr').html(data);
	});
}

function edConfirmKP()
{
    if( $('#confed').val() == $('#passed').val() )
	$('#confpic').attr('src','images/icons/ok.gif');
    else
    {
	$('#confpic').attr('src', 'images/icons/error.png');
	$('#chpic').attr('src','images/icons/error.png');
    }
}

function chAdminPass()
{
    if( $('#passed').val() == $('#confed').val() )
    {
	$.get('selector.php?action=23', 
	    { op_no    : 0 ,
	      username : 0 ,
	      passwd   : hex_md5( 'admin:' + 'Selector:' + 
	    			  $('#passed').val()) }, 
	    function(data)
	    {
	    	if( data == "OK" )
		    $('#chpic').attr('src', 'images/icons/ok.gif');
	    });
    }
    else
	$('#chpic').attr('src', 'images/icons/error.png');
}

function rmSUser( uname )
{
    $.get('selector.php?action=23',
	{ op_no    : 1,
	  username : uname,
	  passwd   : 0 },
	  function(data)
	  {
	    
	  });
    $('#'+uname).attr('color', 'black');
    $('#'+uname).html( '<s>'+ $('#'+uname).text() +'</s>' );
}

function addSUser()
{
    if( ($('#username').val() != '') &&
	($('#password').val() != '')   )
    {
	$.get('selector.php?action=23',
	    { op_no    : 2,
	      username : $('#username').val(),
	      passwd   : hex_md5( $('#username').val()+':'+
	    		   'Selector:'+
	    		   $('#password').val() ) },
	    function(data)
	    {
		
	    });
    }
    $('#password').val('');
    $('#username').val('');
    $('#addupic').attr('src', 'images/icons/ok.gif');
    $('#content').oneTime( 5000, function()
	{
	    $.get('selector.php?action=22', function(data)
		{
		    $('#content').html(data);
		});
	});
}

function massDial()
{
	var grp_n = $('#grp_select').val();
	$('#invbtn').attr('diasbled', 'disabled');
	$.get('selector.php?action=25',
	{ grp_n : grp_n,
	  threads_number : '1',
	  cid_name : 'kod',
	  cid_num : '777',
	  timeout : '20',
	  audio_file : 'massdial/message' },
	function(data)
		{
		});
	$('#md_grp').val( grp_n );
	$.get('selector.php?action=26', { grp_n : grp_n }, function(data)
	{
		$('#content').html(data);
		$('#content').everyTime( 5000, 'ctimer', function()
		{
			$.get('selector.php?action=26', { grp_n : grp_n }, function(data)
				{
					$('#content').html(data);
				});
		});
	});
}

function clearMD()
{
	var grp_n = $('#md_grp').val();
	$('#content').stopTime('ctimer');
	$('#md_grp').val('');
	$.get('selector.php?action=27', { grp_n : grp_n },
		function(data){ 
			$('#content').html(data) 
		});
}

$(document).ready( function()
    {
	var grp_n;
	$('#content').everyTime( 500, 'ctimer', function()
	{	    
	});
	$('#content').stopTime('ctimer');	
	$('#datepicker').datepicker();
	$('#content').text('');
	    $('#content').stopTime('ctimer');
//	    $.get('COPYING', function(data)
//	    {
//		$('#content').html(data);
//	    });

        $.get('selector.php?action=28',
	{ num : 7199 },
	function(data)
	{
	    $('#content').html(data);
	});



	$('#contacts').click( function()
	{
		$('#content').text('');
		$('#content').stopTime('ctimer');
		$.get('CONTACTS', function(data)
		{
			$('#content').html(data);
		});
	});
	$('#license').click( function()
	{
	    $('#content').text('');
	    $('#content').stopTime('ctimer');
	    $.get('COPYING', function(data)
	    {
		$('#content').html(data);
	    });
	    return true;
	});
	$('#conferences').click( function()
	{
	    $('#content').text('');
	    $('#content').stopTime('ctimer');
	    $('#content').hide();
	    $.get('selector.php?action=1', function(data)
	    {
	    	$('#content').html(data);
	    });
	    $('#content').show( "fast", function()
	    {
		$('#content').everyTime( 500, 'ctimer', function()
		{
		    $.get('selector.php?action=1', function(data)
		    {
			$('#content').html(data);
		    });
		});
	    });	    
	    return true;    	
	});
	$('#addconf').click( function()
	{
	    $('#content').stopTime('ctimer');
	    
	    $.get('selector.php?action=6', function(data)
		{
		    $('#content').html(data);
			$('#submitbtn').click( function()
			{
				$('#faddnew').submit(addNewCon());
			});			
		});
	});
	
	$('#groups').click( function()
	{
	    $('#content').stopTime('ctimer');
	    
	    $.get('selector.php?action=17', function(data)
		{
		    $('#content').html(data);    
		});
	});
	$('#addgroup').click( function()
	{
	    $('#content').stopTime('ctimer');
	    
	    $.get('selector.php?action=15', function(data)
		{
		    $('#content').html(data);    
		});
	});
	$('#massdial').click( function()
	{
		grp_n = $('#md_grp').val();
		if( grp_n == "" )
		{
			var fname;
			$('#content').stopTime('ctimer');
			$.get('selector.php?action=24', function(data)
				{
					$('#content').html(data);
					$('#file_upload').uploadify({
						'uploader'  : '/include/uploadify/uploadify.swf',
						'script'    : '/include/uploadify/uploadify.php',
						'cancelImg' : '/include/uploadify/cancel.png',
						'folder'    : '/include/sounds',
						'auto'      : true,
						onComplete  : function(data){$('#upl_res').html(data)}
						});
				});
		} else {
			$('#content').stopTime('ctimer');
			$.get('selector.php?action=26', { grp_n : grp_n },
			function(data)
			{
				$('#content').html(data);
			});
			$('#content').everyTime(500, 'ctimer', function()
			{
				$.get('selector.php?action=26', { grp_n : grp_n },
				function(data)
				{
					$('#content').html(data)
				});
			});
		}
	});
	$('#records').click( function()
	{
	    $('#content').stopTime('ctimer');
	    
	    $.get('selector.php?action=21', function(data)
		{
		    $('#content').html(data);
		});
	});
	$('#settings').click( function()
	{
	    $('#content').stopTime('ctimer');
	    
	    $.get('selector.php?action=22', function(data)
		{
		    $('#content').html(data);
		});
	});	
});		    
