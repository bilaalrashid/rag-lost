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
        <h1>Location Updates</h1>
        <p><a href="/admin/location-update/add?teamID=<?php echo $_GET["teamID"]; ?>">Add New Update</a></p>
			</div>
		</section>
	</body>
</html>
