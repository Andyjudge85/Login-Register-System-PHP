<div class="widget">
	<h2>
	<?php
		if(empty($user_data['profile']) === false)
		{
			$file = end(explode('/', $user_data['profile']));
			
			echo '<a href="'.$user_data['username'].'"><img class="profile" src="images/profile/thumb/'.$file.'" alt="'.$user_data['username'].'\'s Profile Image"></a>';
		}
	?>
	Hello, <?php echo $user_data['username']; ?>!</h2>
	<div class="inner">
		<ul>
			<li>
				<a href="<?php echo $user_data['username']; ?>">Profile</a>
			</li>
			<?php
				if(has_access($session_user_id, 1) === true)
				{
					?>
						<li>
							<a href="admin.php">Admin panel</a>
						</li>
					<?php
				}
			?>
			<li>
				<a href="changepassword.php">Change password</a>
			</li>
			<li>
				<a href="settings.php">Settings</a>
			</li>
			<li>
				<a href="logout.php">Logout</a>	
			</li>
		</ul>
	</div>
</div>