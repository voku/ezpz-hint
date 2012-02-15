<?php
if (isset($_POST['submitted'])) {
        $echo = "E-Mail: " . $_POST['email'] . "<br/>";
        $echo .= "Password: " . $_POST['password'];
        echo $echo;
} else {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>The EZPZ Way &ndash; EZPZ Hint</title>
<script type="text/javascript" charset="utf-8" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
<script src="./jquery.ezpz_hint.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$("input#search").ezpz_hint();
		$("input.login_hint").ezpz_hint();
	});
</script>

</head>
<body>

<h1><a href="/demos/ezpz-hint">EZPZ Hint Demo</a></h1>
<h2>Search form</h2>
<p><input type="text" name="search" value="" class="hint" id="search" title="Search"/></p>
<div>

<h2>Login form</h2>
<form name="test1" id="form_test1" name="form_test1">
	<input type="text" name="email" value="" class="login_hint" id="email" title="E-Mail"/><br/>
	<input type="password" name="password" value="" class="login_hint" id="password" title="Password"/><br/>
	<input type="hidden" name="submitted" value="1"/>
	<input type="submit" name="submit" value="Submit"/>
</form>

<div id="text_submit"></div>

<script type="text/javascript" charset="utf-8">
/*
var txtval_default = $(\'#email\').val();
$(function(){
	var input = $(\'#email\');
	var txtval = $(input).val();
	$(input).focus(function(){
		if($(this).val() == txtval_default){
			$(this).val(\'\')
		}
	});
	$(input).blur(function(){
		if($(this).val() == ""){ $(this).val(txtval); }
	});
});
*/

$('#form_test1').submit( function(e) {
	e.preventDefault();
	var submittedData = $(this).serialize();
	$.post('index.php', submittedData, function(data){
		$('#text_submit').html('<span style="color: red;">'+data+'</span>');
	});
});
</script>

</body>
</html>

<?php
}
?>
