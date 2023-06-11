<?php
	set_include_path(__DIR__."/../../../php/");
	require_once "files/autoload.php";
	$class = "AddLocationUpdateController";
	$title = "Add Location Update";
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
						<p><a href="/admin">Home</a> > <a href="/admin/location-update/view/?teamID=<?php echo $_GET["teamID"]; ?>">Location Updates</a> > Add Location Update</p>
						<h1>Add Location Update</h1>
						<form method="POST">
							<div class="form-row">
								<label for="update_message">Message</label>
								<span>Optional. A fun and whity (or serious if you prefer) message to be displayed with this latest location update.</span>
								<input type="text" name="update_message" placeholder="Some text here..." id="update_message">
							</div>
							<div class="form-row">
								<label for="latitude">Coordinates</label>
								<span>Fill by selecting a location on the map. <a href="javascript:void(0)" class="view-on-map">(View on map)</a></span>
								<input type="number" step="any" name="latitude" placeholder="Latitude" id="latitude" required>
								<input type="number" step="any" name="longitude" placeholder="Longitude" id="longitude" required>
							</div>
							<div class="form-row">
								<label for="location_name">Location Name</label>
								<span>A short name to describe the location (this will auto-generated for you when you click on the map, but you can edit it here if you don't like it)</span>
								<input type="text" name="location_name" placeholder="Some text here..." id="location_name" required>
							</div>
							<button type="submit">Add Update</button>
						</form>
						<?php if (isset($post) && !$post) { ?>
						<div class="error">
							<p>Error. Basically you've inputted something wrong here or missed an item (or you have failed at hacking us - in which case, ha!)</p>
						</div>
						<?php } ?>
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
	</body>
</html>
