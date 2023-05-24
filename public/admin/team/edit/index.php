<?php
	set_include_path(__DIR__."/../../../php/");
	require_once "files/autoload.php";
	$class = "EditTeamController";
	$title = "Edit Team";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <?php require_once "../../../tpl/admin/head.php"; ?>
	<body>
    <?php require_once "../../../tpl/admin/header.php"; ?>
		<section>
			<div class="wrapper">
        <p><a href="/admin">Home</a> > Edit Team</p>
        <h1>Edit Team</h1>
        <form method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <label for="team_name">Team Name</label>
            <span>This is a name for the team</span>
            <input type="text" name="team_name" placeholder="Some text here..." id="team_name" value="<?php echo $model->getTeamName(); ?>" required>
          </div>
          <div class="form-row">
            <label for="members">Members</label>
            <span>Optional. A brief line of text containing the members name, or something like that</span>
            <input type="text" name="members" placeholder="Some text here..." id="members" value="<?php echo $model->getMembers(); ?>">
          </div>
          <div class="form-row">
            <label for="description">Team Description</label>
            <span>Optional. A whity pun from the team, or some heartwarming message about why they like charity, etc.</span>
            <input type="text" name="description" placeholder="Some text here..." id="description" value="<?php echo $model->getTeamDescription(); ?>">
          </div>
          <div class="form-row">
            <label for="donate_url">Donation Link</label>
            <span>A link to donate to the team (or just put the main donation link if there is none)</span>
            <input type="url" name="donate_url" placeholder="A URL here..." id="donate_url" value="<?php echo $model->getDonateURL(); ?>" required>
          </div>
          <h2>Advanced Properties</h2>
          <div class="form-row">
            <label for="team_color">Team Colour</label>
            <span>The team's colour. This was auto-generated for you, but you can edit it here if you don't like it.</span>
            <input type="color" name="team_color" placeholder="A URL here..." id="team_color" value="<?php echo $model->getTeamColor(); ?>" required>
          </div>
          <div class="form-row">
            <table>
              <tr>
                <td>
                  <img src="<?php echo $model->getTeamImageURL(); ?>" alt="Currently uploaded photo" />
                </td>
                <td>
                  <label for="team_image">Team Photo</label>
                  <span>A square profile photo for the team (it will be auto resized if it isn't already a square). Accepts JPEG, PNG and GIF. Maximum 5MB.</span>
                  <input type="file" name="team_image" id="team_image" accept="image/png, image/gif, image/jpeg" data-max-size="5000000">
                </td>
              </tr>
            </table>
          </div>
          <button type="submit">Save</button>
        </form>
        <?php if (isset($post) && !$post) { ?>
        <div class="error">
          <p>Error. Basically you've inputted something wrong here or missed an item (or you have failed at hacking us - in which case, ha!)</p>
        </div>
				<?php } ?>
        <details>
          <summary>Delete</summary>
          <form method="POST" action="/admin/team/delete/index.php">
            <input type="hidden" name="id" value="<?php echo $model->getID(); ?>">
            <div class="form-row">
              <label for="confirm_delete">Confirm Delete</label>
              <span>If you are sure that you want to do this, click "Delete" below</span>
              <button type="submit">Delete</button>
            </div>
          </form>
        </details>
			</div>
      <script src="/js/admin/file-upload.js"></script>
		</section>
	</body>
</html>
