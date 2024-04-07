<?php
	set_include_path(__DIR__."/../../php/");
	require_once "files/autoload.php";
	$class = "EditConfigController";
	$title = "General Settings";
	require_once "files/controller.php";
  $head = '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>';
?>
<!DOCTYPE html>
<html>
  <?php require_once "../../tpl/admin/head.php"; ?>
	<body>
    <?php require_once "../../tpl/admin/header.php"; ?>
		<section>
			<div class="wrapper">
      <div class="split-column-container">
					<div class="split-column">
						<p><a href="/admin">Home</a> > General Settings</p>
						<h1>General Settings</h1>
						<form method="POST">
              <div class="form-row">
								<label for="latitude">Start Location Coordinates</label>
								<span>This is where the start location is. Fill by selecting a location on the map. <a href="javascript:void(0)" class="view-on-map">(View on map)</a>. Make sure to set this after "Event Start Time" (below) is set, otherwise the map will be live with this location set!</span>
								<input type="number" step="any" name="latitude" placeholder="Latitude" id="latitude" value="<?php echo $model->getStartLocationLatitude() ?>" required>
								<input type="number" step="any" name="longitude" placeholder="Longitude" id="longitude" value="<?php echo $model->getStartLocationLongitude() ?>" required>
							</div>
							<div class="form-row">
								<label for="countdown_start">Event Start Time</label>
								<span>This is the time that the tracker becomes public and the countdown starts. Before this, a "Starting Soon" holding page is shown so that the start location isn't leaked.</span>
								<input type="datetime-local" name="countdown_start" id="countdown_start" value="<?php echo $model->getCountdownStart()->format("Y-m-d H:i"); ?>" required>
							</div>
							<div class="form-row">
								<label for="donation_total">Donation Total</label>
								<span>Optional. This is the rolling donation total that is displayed on the map tracker. In £ please.</span>
								<input type="number" step="any" name="donation_total" placeholder="A number here..." id="donation_total" value="<?php echo $model->getDonationTotal(); ?>">
							</div>
							<div class="form-row">
								<label for="charity_name">Charity Name(s)</label>
								<span>The name(s) of the charity this event is raising money for. This is displayed on the holding page before the event starts.</span>
								<input type="text" name="charity_name" placeholder="Some text here..." id="charity_name" value="<?php echo $model->getCharityName(); ?>" required>
							</div>
							<button type="submit">Save</button>
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
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
      <script src="/js/admin/map.js"></script>
      <script>
        showLocationOnMap();
      </script>
		</section>
	</body>
</html>
