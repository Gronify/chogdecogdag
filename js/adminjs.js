function show()  {  
	$.ajax({  
		url: "../admin/fromdatabase.php",  
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
      url:     '../admin/todatabase.php',
      type:     "post",
      dataType: "html",
      data: {
      	'teamid': '3',
      	'questionid': document.getElementById("questionid").value,
      	'question': document.getElementById("questionv").value,
      	'answer': document.getElementById("answer").value,
      	'questioncost': document.getElementById("questioncost").value,
      },
         });
      document.getElementById("questionid").value = Number(document.getElementById("questionid").value) + 1;
    }
function newgame() {
	document.getElementById("questionid").value = 1;



      jQuery.ajax({
      url:     '../admin/todatabase.php',
      type:     "post",
      dataType: "html",
      data: {
      	'teamid': '3',
      	'questionid': '0',
      	'question': 'Готовы?',
      	'answer': '',
      	'questioncost': '0',
      	'gameid': ' ',
      },
         });
    }

function good(id, gameid, questionid) {

      jQuery.ajax({
      url:     '../admin/good.php',
      type:     "post",
      dataType: "html",
      data: {
      	'id': id,
      	'questionid': questionid,
      	'gameid': gameid,
      },
         });
    }
function bad(id, gameid, questionid) {

      jQuery.ajax({
      url:     '../admin/bad.php',
      type:     "post",
      dataType: "html",
      data: {
      	'id': id,
      	'questionid': questionid,
      	'gameid': gameid,
      },
         });
    }