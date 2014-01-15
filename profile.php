<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php';

if(isset($_GET['username']) === true && empty($_GET['username']) === false)
{
	$username = $_GET['username'];
	
	if(user_exists($username))
	{
		$user_id = user_id_from_username($username);
		$profile_data = user_data($user_id, 'username', 'first_name', 'last_name', 'email', 'date_registered', 'profile');
		?>
			<h1><?php echo $profile_data['username']; ?>'s Profile</h1>
				<ul>
					<li>
						Profile image:<br>
						<?php echo '<img class="settings" src="'.$profile_data['profile'].'" alt="'.$profile_data['username'].'\'s Profile Image">'; ?>
					</li>
					<li>
						Email:<br>
						<?php echo $profile_data['email']; ?>
					</li>
					<li>
						First name:<br>
						<?php echo $profile_data['first_name']; ?>
					</li>
					<li>
						Last name:<br>
						<?php echo $profile_data['last_name']; ?>
					</li>
					<li>
						Date registered:<br>
						<?php echo date('j F H:i:s', $profile_data['date_registered']); ?>
					</li>
				</ul>
		<?php
	}
	else
	{
		echo 'Sorry, that user doesn\'t exists!';
	}
}
else
{
	header('Location: index.php');
	exit();
}

include 'includes/overall/footer.php'; ?>