<?php
include 'core/init.php';
protect_page();
admin_protect();
include 'includes/overall/header.php';
?>
<h1>Email users</h1>

<?php
if(isset($_GET['success']) === true && empty($_GET['success']) === true)
{
	echo '<p>Email has been sent.</p>';
}
else
{
	if(empty($_POST) === false)
	{
		if(empty($_POST['subject']) === true)
		{
			$errors[]='Subject is required';
		}
		
		if(empty($_POST['body']) === true)
		{
			$errors[]='Body is required';
		}
		
		if(empty($errors) === false)
		{
			echo output_errors($errors);
		} else {
			mail_users($_POST['subject'], $_POST['body']);
			header('Location: mail.php?success');
			exit();
		}
	}
	?>

	<form method="post" action="">
		<ul>
			<li>
				Subject*:<br>
				<input type="text" name="subject" value="<?php echo $_POST['subject']; ?>">
			</li>
			<li>
				Body*:<br>
				<textarea name="body"><?php echo $_POST['body']; ?></textarea>
			</li>
			<li>
				<span style="color: lightSlateGray;">WARNING: It sends email to all users, that allowed to sent them an email from us</span><br>
				<input type="submit" value="Send">
			</li>
		</ul>
	</form>

<?php
}
include 'includes/overall/footer.php';
?>