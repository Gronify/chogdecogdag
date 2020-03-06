function show()  {  
	$.ajax({  
		url: "../fromdatabase.php",  
		cache: false,  
		success: function(html){  
			$("#question").html(html); 
		}
	});
}
/*
function teamdata()  {  
	$.ajax({  
		type: 'post',
		url: "../fromdatabaseteam.php",  
		data: cookie.get('id'),
		cache: false,  
		success: function(data){
		    data = JSON.parse(data);
		    $('#surname').val(data['surname']);
		}
	});
}
*/
$(document).ready(function(){  
	show();  
	setInterval('show()',1000);  
});
function getCookie(name) {
    var v = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
    return v ? v[2] : null;
}
function AjaxFormRequest() {
      jQuery.ajax({
      url:     '../todatabase.php',
      type:     "post",
      dataType: "html",
      data: {
      	'teamid': getCookie('id'),
      	'answer': document.getElementById("answer").value,
      },
         });
    }