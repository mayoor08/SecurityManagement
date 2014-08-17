/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#save').on('click', function () {    
  var userData = {
         "name" : $('#name').val(),
         "vModel" : $('#v-model').val(),
         "vRegno" : $('#v-regno').val(),
         "vType" : $('#v-type').val(),
         "house"  : $('#house').val(),
         "apiCall" : 'UserRegistration'
  };
    $.ajax({
        type:'POST',
        url:'apicall.php',
        dataType:'json',
        data:{"uData": userData}     
    }).done(function(data){
        
    }).fail(function(data){
        
    });
});

$('#delete').on('click', function () {    
  var userData = {
         "d-vRegno" : $('#search').val(),
         "apiCall" : 'DeleteUser'
  };
    $.ajax({
        type:'POST',
        url:'apicall.php',
        dataType:'json',
        data:{"uData": userData}     
    }).done(function(data){
        
    }).fail(function(data){
        
    });
});

$('#search-vehicle').keyup(function(){
   if(this.value.length === 12) {
        var searchTerm = {
         "s-vRegno" : this.value,
         "apiCall" : 'SearchVehicle'
    };
     $.ajax({
        type:'POST',
        url:'apicall.php',
        dataType:'json',
        data:{"uData": searchTerm}     
    }).done(function(data){
        if(data){
            $('#reg-verified').removeClass('not-verified').addClass('verified');
            $('#user-status').removeClass('not-verified').addClass('verified');
        }
    }).fail(function(err){
        console.log(err);
    });
       
   }
    
});

$('#user-status').click(function(){
     var setStatus = {
         "s-vRegno" : $('#search-vehicle').val(),
         "apiCall" : 'ChangeInStatus'
    };
     $.ajax({
        type:'POST',
        url:'apicall.php',
        dataType:'json',
        data:{"uData": setStatus}     
    }).done(function(data){
         $('#reg-verified').removeClass('verified').addClass('not-verified');
         $('#user-status').removeClass('verified').addClass('not-verified');
    }).fail(function(err){
        console.log(err);
    });
    
    
});







//login

$("#login").on('click', function () {	
        var loginDetails = {            
            "loginUser" : $("#username").val(),
            "pass"      : $("#password").val(),
            "apiCall"   : 'LoginStatus'
        };	
        var ml = '';
        if(loginDetails.loginUser === ''){
            ml = 'Enter Your Username';
            $('#error-msg').html(ml).removeClass('hide').addClass('show-class');
        }
        else if(loginDetails.pass === ''){
            ml = 'Enter Your Password';
            $('#error-msg').html(ml).removeClass('hide').addClass('show-class');
        }
        else{
	$.ajax({		
                type:"POST",
		dataType:"json",
		url:"apicall.php",
		data: {"uData": loginDetails},
		success: function(data){  
		  if(data == 1){		  	
		  //window.location = 'admin/Dashboard.php';
		    console.log("Admin");
                  $('#error-msg').html(ml).removeClass('show-class').addClass('hide');
		 // window.location = 'admin/admin.html';
		  }
		  else if(data == 2){				
                    console.log("Gaurd");
                  //      window.location = 'trainer/trainer.html';
		  }
                  
                  else{
                    ml = 'The username or password you entered is incorrect.';
                    $('#error-msg').html(ml).removeClass('hide').addClass('show-class');
		}		  	
	    }		
	});
    }	
});



// Image Capture
$('#upload-image').on('click', function () {    
	var capturePhoto = {
            "url" : gb,
            "veh" : $('#v').val(),
            "apiCall" : 'ClickVisitorPhoto'
        };
        
        $.ajax({
            type: "POST",
            url: "apicall.php",			  
            data: {"uData": capturePhoto}
            }).done(function(data) {
            console.log('saved'); 
			  // If you want the file to be visible in the browser 
			  // - please modify the callback in javascript. All you
			  // need is to return the url to the file, you just saved 
			  // and than put the image in your browser.
            });

});

