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
        <p><a href="/admin">Home</a> > Create Team</p>
        <h1>Create Team</h1>
        <form method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <label for="team_name">Team Name</label>
            <span>This is a name for the team.</span>
            <input type="text" name="team_name" placeholder="Some text here..." id="team_name" required>
          </div>
          <div class="form-row">
            <label for="members">Members</label>
            <span>Optional. A brief line of text containing the members name, or something like that.</span>
            <input type="text" name="members" placeholder="Some text here..." id="members">
          </div>
          <div class="form-row">
            <label for="description">Team Description</label>
            <span>Optional. A whity pun from the team, or some heartwarming message about why they like charity, etc.</span>
            <input type="text" name="description" placeholder="Some text here..." id="description">
          </div>
          <div class="form-row">
            <label for="charity_name">Charity Name</label>
            <span>The name of the charity this team is raising money for.</span>
            <input type="text" name="charity_name" placeholder="Some text here..." id="charity_name" required>
          </div>
          <div class="form-row">
            <label for="donate_url">Donation Link</label>
            <span>A link to donate to the team (or just put the main donation link if there is none).</span>
            <input type="url" name="donate_url" placeholder="A URL here..." id="donate_url" required>
          </div>
          <div class="form-row">
            <label for="team_image">Square Team Photo</label>
            <span>A square profile photo for the team (it will be auto resized if it isn't already a square). Accepts JPEG, PNG and GIF. Maximum 5MB.</span>
            <input type="file" name="team_image" id="team_image" accept="image/png, image/gif, image/jpeg" data-max-size="5000000" required>
          </div>
          <button type="submit">Create</button>
        </form>
        <?php if (isset($post) && !$post) { ?>
        <div class="error">
          <p>Error. Basically you've inputted something wrong here or missed an item (or you have failed at hacking us - in which case, ha!)</p>
        </div>
				<?php } ?>
			</div>
		</section>
    <script src="/js/admin/file-upload.js"></script>
	</body>
</html>
