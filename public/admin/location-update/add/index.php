<?php
	set_include_path(__DIR__."/../../../php/");
	require_once "files/autoload.php";
	$class = "AddLocationUpdateController";
	$title = "Add Location Update";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <?php require_once "../../../tpl/admin/head.php"; ?>
	<body>
    <?php require_once "../../../tpl/admin/header.php"; ?>
		<section>
			<div class="wrapper">
        <h1>Add Location Update</h1>
				<form method="POST">
          <div class="form-row">
            <label for="update_message">Message</label>
            <span>Optional. A fun and whity (or serious if you prefer) message to be displayed with this latest location update</span>
            <input type="text" name="update_message" placeholder="Some text here..." id="update_message">
          </div>
          <div class="form-row">
            <label for="latitude">Latitude</label>
            <span>Fill by selecting a location on the map</span>
            <input type="number" step="any" name="latitude" placeholder="A coordinate here..." id="latitude" required>
          </div>
          <div class="form-row">
            <label for="longitude">Longitude</label>
            <span>Fill by selecting a location on the map</span>
            <input type="number" step="any" name="longitude" placeholder="A coordinate here..." id="longitude" required>
          </div>
          <button type="submit">Add Update</button>
        </form>
        <?php if (isset($post) && !$post) { ?>
        <div class="error">
          <p>Error. Basically you've inputted something wrong here or missed an item (or you have failed at hacking us - in which case, ha!)</p>
        </div>
				<?php } ?>
			</div>
		</section>
	</body>
</html>
