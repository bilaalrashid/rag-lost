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
				<p>Welcome to the RAG Lost admin panel! This is where you can create, edit and manage details of teams, and update their location on the tracker map. You can also edit global settings for the site here too. For anything else, you will probably need to touch the code, but hopefully it isn't <i>too</i> scary.</p>
				<div>
					<h2>General Settings</h2>
					<a href="/admin/settings">Edit here</a>
				</div>
				<div>
					<h2>Teams</h2>
					<hr />
					<div>
						<h3>Team Name</h3>
						<span><a href="/team/edit">Edit</a> | <a href="/team/location-update">Update Location</a></span>
					</div>
					<hr />
				</div>
			</div>
		</section>
	</body>
</html>
