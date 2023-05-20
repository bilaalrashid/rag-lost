<?php
	set_include_path(__DIR__."/../php/");
	require_once "files/autoload.php";
	$class = "AdminController";
	$title = "Admin";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <?php require_once "../tpl/admin/head.php"; ?>
	<body>
    <?php require_once "../tpl/admin/header.php"; ?>
		<section>
			<div class="wrapper">
				<p>
					Welcome to the RAG Lost admin panel!
					This is where you can create, edit and manage details of teams, and update their location on the tracker map.
					You can also edit global settings for the site here too.
					For anything else, you will probably need to touch the code, but hopefully it isn't <i>too</i> scary. 
					RAG Love ❤️
				</p>
				<div>
					<h1>General Settings</h1>
					<a href="/admin/settings">Edit here</a>
				</div>
				<div>
					<h1>Teams</h1>
					<p><a href="/admin/team/add">Create Team</a></p>
					<hr />
					<?php 
						if (empty($model)) {
							echo "<p>No teams found :(</p>";
						} else {
							foreach ($model as $team) {
					?>
							<div>
								<h3><?php echo $team->getTeamName(); ?></h3>
								<p><?php echo $team->getMembers(); ?></p>
								<p><a href="/team/edit">Edit Details</a> | <a href="/team/location-update">Update Location</a></p>
							</div>
							<hr />
					<?php
							}
						} 
					?>
				</div>
			</div>
		</section>
	</body>
</html>
