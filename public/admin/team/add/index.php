<?php
	set_include_path(__DIR__."/../../../php/");
	require_once "files/autoload.php";
	$class = "AddTeamController";
	$title = "Create Team";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <?php require_once "../../../tpl/admin/head.php"; ?>
	<body>
    <?php require_once "../../../tpl/admin/header.php"; ?>
		<section>
			<div class="wrapper">
        <span><a href="/admin">Home</a> > Create Team</span>
        <h1>Create Team</h1>
        <form method="POST">
          <div class="form-row">
            <label for="team_name">Team Name</label>
            <span>This is a name for the team</span>
            <input type="text" name="team_name" placeholder="Some text here..." id="team_name" required>
          </div>
          <div class="form-row">
            <label for="members">Members</label>
            <span>Optional. A brief line of text containing the members name, or something like that</span>
            <input type="text" name="members" placeholder="Some text here..." id="members">
          </div>
          <div class="form-row">
            <label for="description">Team Description</label>
            <span>Optional. A whity pun from the team, or some heartwarming message about why they like charity, etc.</span>
            <input type="text" name="description" placeholder="Some text here..." id="description">
          </div>
          <div class="form-row">
            <label for="donate_url">Donation Link</label>
            <span>A link to donate to the team (or just put the main donation link if there is none)</span>
            <input type="url" name="donate_url" placeholder="A URL here..." id="donate_url" required>
          </div>
          <div class="form-row">
            <label for="team_image_url">URL to an image of the team</label>
            <span>Optional. A URL to a .jpg or .png (ideally uploaded to this server). Leave blank if you don't want to use this feature.</span>
            <input type="url" name="team_image_url" placeholder="A URL here..." id="team_image_url">
          </div>
          <button type="submit">Create</button>
        </form>
			</div>
		</section>
	</body>
</html>
