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
