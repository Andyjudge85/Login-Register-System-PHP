<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if(empty($_POST) === false)
{
	$required_fields = array('first_name', 'email');
	foreach($_POST as $key=>$value)
	{
		if(empty($value) && in_array($key, $required_fields) === true)
		{
			$errors[]='Fields marked with a star is required';
			break 1 ;
		}
	}
	
	if(empty($errors) === true)
	{
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)
		{
			$errors[]='A valid email is required';
		} else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
			$errors[]='Sorry, the email \''.$_POST['email'].'\' is already in use';
		}
		
		if(isset($_FILES['profile']) === true)
		{
			$allowed = array('jpg', 'jpeg', 'png', 'gif');
			
			$file_name = $_FILES['profile']['name'];
			$file_extn = strtolower(end(explode('.', $file_name)));
			$file_temp = $_FILES['profile']['tmp_name'];
			
			if(in_array($file_extn, $allowed) === true)
			{
				change_profile_image($session_user_id, $file_temp, $file_extn);
				header('Location: '.$current_file);
				exit();
			}
		}
	}
}
?>
<h1>Settings</h1>

<?php
if(isset($_GET['success']) && empty($_GET['success']))
{
	echo 'Your details have been updated!';
}
else
{
	if(empty($_POST) === false && empty($errors) === true)
	{
		$update_data = array(
			'first_name' => $_POST['first_name'],
			'last_name' => $_POST['last_name'],
			'email' => $_POST['email'],
			'profile' => $_FILE['profile'],
			'allow_email' => ($_POST['allow_email'] == 'on') ? 1 : 0
		);
		
		update_user($session_user_id, $update_data);
		header('Location: settings.php?success');
		exit();
	}
	elseif(empty($errors) === false)
	{
		echo output_errors($errors);
	}
	?>

	<form method="post" action="" enctype="multipart/form-data">
		<ul>
			<li>
				<?php
					if(isset($user_data['profile']) === true)
					{
						echo '<img class="settings" src="'.$user_data['profile'].'">';
					}
				?>
				<br>
				Upload profile image:<br>
				<input type="file" name="profile">
			</li>
			<li>
				First name*:<br>
				<input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>" required="required">
			</li>
			<li>
				Last name:<br>
				<input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>">
			</li>
			<li>
				Email*:<br>
				<input type="text" name="email" value="<?php echo $user_data['email']; ?>" required="required">
			</li>
			<li>
				Would you like to receive email from us? <input type="checkbox" name="allow_email" <?php if ($user_data['allow_email'] == 1) { echo 'checked="checked"'; }; ?>>
			</li>
			<li>
				<input type="submit" value="Update">
			</li>
		</ul>
	</form>

<?php
}
include 'includes/overall/footer.php';
?>