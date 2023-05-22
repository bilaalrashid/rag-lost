<?php
	set_include_path(__DIR__."/../../../php/");
	require_once "files/autoload.php";
	$class = "EditLocationUpdateController";
	$title = "Edit Location Update";
	require_once "files/controller.php";
	$head = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>';
?>
<!DOCTYPE html>
<html>
  <?php require_once "../../../tpl/admin/head.php"; ?>
	<body>
    <?php require_once "../../../tpl/admin/header.php"; ?>
		<section>
			<div class="wrapper">
				<div class="split-column-container">
					<div class="split-column">
						<p><a href="/admin">Home</a> > <a href="/admin/location-update/view/?teamID=<?php echo $_GET["teamID"]; ?>">Location Updates</a> > Edit Location Update</p>
						<h1>Edit Location Update</h1>
						<form method="POST">
							<div class="form-row">
								<label for="update_message">Message</label>
								<span>Optional. A fun and whity (or serious if you prefer) message to be displayed with this latest location update</span>
								<input type="text" name="update_message" placeholder="Some text here..." id="update_message" value="<?php echo $model->getUpdateMessage(); ?>">
							</div>
							<div class="form-row">
								<label for="update_timestamp">Time</label>
								<span>The time at which this update is shown as occurring at</span>
								<input type="datetime-local" name="update_timestamp" placeholder="Some text here..." id="update_timestamp" value="<?php echo $model->getUpdateTimestamp()->format("Y-m-d H:i"); ?>" required>
							</div>
							<div class="form-row">
								<label for="latitude">Coordinates</label>
								<span>Fill by selecting a location on the map. <a href="javascript:void(0)" class="view-on-map">(View on map)</a></span>
								<input type="number" step="any" name="latitude" placeholder="Latitude" id="latitude" value="<?php echo $model->getLatitude(); ?>" required>
								<input type="number" step="any" name="longitude" placeholder="Longitude" id="longitude" value="<?php echo $model->getLongitude(); ?>" required>
							</div>
							<div class="form-row">
								<label for="location_name">Location Name</label>
								<span>A short name to describe the location (this was auto-generated for you, but you can edit it here if you don't like it)</span>
								<input type="text" name="location_name" placeholder="Some text here..." id="location_name" value="<?php echo $model->getLocationName(); ?>" required>
							</div>
							<button type="submit">Edit</button>
						</form>
						<?php if (isset($post) && !$post) { ?>
						<div class="error">
							<p>Error. Basically you've inputted something wrong here or missed an item (or you have failed at hacking us - in which case, ha!)</p>
						</div>
						<?php } ?>
            <details>
              <summary>Delete</summary>
              <form method="POST" action="/admin/location-update/delete/index.php">
                <input type="hidden" name="id" value="<?php echo $model->getID(); ?>">
                <input type="hidden" name="team_id" value="<?php echo $_GET["teamID"]; ?>">
                <div class="form-row">
                  <label for="confirm_delete">Confirm Delete</label>
                  <span>If you are sure that you want to do this, click "Delete" below</span>
                  <button type="submit">Delete</button>
							  </div>
              </form>
            </details>
					</div>
					<div class="split-column">
						<div class="map-container">
							<input type="text" placeholder="Search" class="map-search" />
							<div id="map"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="/js/admin/map.js"></script>
    <script>
      showLocationOnMap();
    </script>
	</body>
</html>
