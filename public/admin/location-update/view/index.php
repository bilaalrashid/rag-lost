<?php
	set_include_path(__DIR__."/../../../php/");
	require_once "files/autoload.php";
	$class = "ViewLocationUpdateController";
	$title = "Location Updates";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <?php require_once "../../../tpl/admin/head.php"; ?>
	<body>
    <?php require_once "../../../tpl/admin/header.php"; ?>
		<section>
			<div class="wrapper">
				<p><a href="/admin">Home</a> > Location Updates</p>
        <h1>Location Updates &#8226; <?php echo $get[0]->getTeamName(); ?></h1>
				<p>Add and edit location updates for the team here. NOTE: You do NOT need to add the start location, that is already included for you on the tracker.</p>
        <p><a href="/admin/location-update/add?teamID=<?php echo $_GET["teamID"]; ?>" class="link-button">Add New Update</a></p>
				<hr />
				<?php 
					if (empty($get[1])) {
						echo "<p>No updates for this team so far :(</p>";
					} else {
						foreach ($get[1] as $update) {
				?>
					<div class="location-update-list-item">
						<h1><?php echo $update->getLocationName(); ?></h1>
						<p><?php echo $update->getUpdateTimestamp()->format("H:i, d/m/Y"); ?></p>
						<p class="message">"<?php echo $update->getUpdateMessage(); ?>"</p>
						<p><a href="/admin/location-update/edit?id=<?php echo $update->getID(); ?>&teamID=<?php echo $_GET["teamID"]; ?>" class="link-button">Edit</a></p>
					</div>
					<hr />
				<?php
						}
					} 
				?>
			</div>
		</section>
	</body>
</html>
