<?php 
session_start();

function flash_message($message = '', $class = 'success')
{
	if (!empty($_SESSION['flash_message'])) {
		unset($_SESSION['flash_message']);
		unset($_SESSION['flash_message_class']);
	}

	$_SESSION['flash_message'] = $message;
	$_SESSION['flash_message_class'] = 'alert-' . $class;
}
