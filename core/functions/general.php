<?php
function email($to, $subject, $body)
{
	require_once 'mail/swift_required.php';
	$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
	->setUsername('cinevision.reply@gmail.com')
	->setPassword('moviesupload');
	$mailer = Swift_Mailer::newInstance($transport);
	$message = Swift_Message::newInstance($subject)
	->setFrom(array('cinevision.reply@gmail.com'))
	->setTo(array($to))
	->setBody($body);
	$result = $mailer->send($message);
}

function logged_in_redirect()
{
	if(logged_in() === true)
	{
		header('Location: index.php');
		exit();
	}
}

function protect_page()
{
	if(logged_in() === false)
	{
		header('Location: protected.php');
		exit();
	}
}

function admin_protect()
{
	global $user_data;
	if(has_access($user_data['user_id'], 1) === false)
	{
		header('Location: index.php');
		exit();
	}
}

function array_sanitize(&$item)
{
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data)
{
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function output_errors($errors)
{
	$output = array();
	foreach($errors as $v)
	{
		return '<ul><li>'.implode('</li><li>', $errors).'</li></ul>';
	}
}
?>