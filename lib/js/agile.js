$(document).ready(function(){
	$("#form-item").hide();
	$("#form-task").hide();
});

$('#add-item').click(function(){
	$("#form-item").show();
});

$('#add-task').click(function(){
	$("#form-task").show();
});