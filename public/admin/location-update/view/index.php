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
        <p><a href="/admin/location-update/add?teamID=<?php echo $_GET["teamID"]; ?>">Add New Update</a></p>
				<hr />
				<?php 
						if (empty($get[1])) {
							echo "<p>No updates for that team so far :(</p>";
						} else {
							foreach ($get[1] as $update) {
					?>
							<div>
								<h3><?php echo $update->getUpdateTimestamp()->format("H:i, d/m/Y"); ?></h3>
								<p><?php echo $update->getUpdateMessage(); ?></p>
								<p><?php echo $update->getLatitude(); ?>, <?php echo $update->getLongitude(); ?></p>
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
