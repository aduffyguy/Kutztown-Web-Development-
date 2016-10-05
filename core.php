<?php
/*This file contains ideas of a file that holds funcions
I may implement this and more functions for the final project*/
$messages = array(
'<p> You are now loged in. </p>' 
'<p style="color:red"> User Name and/Or Password Not Found.</p>',
'',
'',
'',
'',
'',
''
);
function messages($msgNum)
{
	if(isset($_GET["msg"]))
	{
	$msg = $_GET["msg"];
	if($msg == $msgNum) {
		echo $messages[$msg];
	}
	}
} 

?>