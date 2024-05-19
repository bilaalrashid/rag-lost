<?php
	set_include_path(__DIR__."/../php/");
	require_once "files/autoload.php";
	$class = "AdminController";
	$title = "Home";
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
					This is where you will be able to configure and edit most aspects of the tracker map.
					For anything else, you will probably need to touch the <a href="https://github.com/bilaalrashid/rag-lost" target="_blank">source code</a>, but hopefully it isn't <i>too</i> scary. 
					If in doubt, contact <a href="mailto:bilaal@bilaal.co.uk">Bilaal</a>.
					RAG Love ❤️
				</p>
				<div>
					<h1>General Settings</h1>
					<p>You probably won't have to touch this when the event is actually running, except to update the fundraised total that is displayed on the map.</p>
					<a href="/admin/config" class="link-button">General Settings</a>
				</div>
				<div>
					<h1>Teams</h1>
					<p>This is where you can create, edit and delete teams. During the event you will mainly use this to add location updates to each team.</p>
					<p><a href="/admin/team/add" class="link-button">Create Team</a></p>
					<hr />
					<?php 
						if (empty($model)) {
							echo "<p>No teams found :(</p>";
						} else {
							foreach ($model as $team) {
					?>
							<div class="team-list-item">
								<table>
									<tr>
										<td>
											<img src="<?php echo $team->getTeamImageURL(); ?>" style="border-color: <?php echo $team->getTeamColor(); ?>" />
										</td>
										<td>
											<h1><?php echo $team->getTeamName(); ?></h1>
											<p><?php echo $team->getMembers(); ?></p>
											<p><a href="/admin/team/edit?id=<?php echo $team->getID(); ?>" class="link-button">Edit Details</a> | <a href="/admin/location-update/view?teamID=<?php echo $team->getID(); ?>" class="link-button">Location Updates</a></p>
										</td>
									</tr>
								</table>
							</div>
							<hr />
					<?php
							}
						} 
					?>
				</div>
				<div>
					<h1>Export Data</h1>
					<p>Download all the data from this event as a zip file. This is a great way to archive the results from past events so they can be kept for future record. If you're resetting for a new event, it would be a good idea to download this data and store it somewhere permanent.</p>
					<a href="/api/export.php" class="link-button">Download Data</a>
				</div>
			</div>
		</section>
	</body>
</html>
