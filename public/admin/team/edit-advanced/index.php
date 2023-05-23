<?php
	set_include_path(__DIR__."/../../../php/");
	require_once "files/autoload.php";
	$class = "EditAdvancedTeamController";
	$title = "Edit Advanced Team Details";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <?php require_once "../../../tpl/admin/head.php"; ?>
	<body>
    <?php require_once "../../../tpl/admin/header.php"; ?>
		<section>
			<div class="wrapper">
        <p><a href="/admin">Home</a> > Edit Advanced Team Details</p>
        <h1>Edit Advanced Team Details</h1>
        <form method="POST">
          <div class="form-row">
            <label for="team_color">Team Colour</label>
            <span>Optional. A URL to a .jpg or .png (ideally uploaded to this server). Don't touch this if you don't know what you're doing.</span>
            <input type="color" name="team_color" placeholder="A URL here..." id="team_color" value="<?php echo $model->getTeamColor(); ?>">
          </div>
          <div class="form-row">
            <label for="team_image_url">URL to an image of the team</label>
            <span>Optional. A URL to a .jpg or .png (ideally uploaded to this server). Leave blank if you don't want to use this feature.</span>
            <input type="url" name="team_image_url" placeholder="A URL here..." id="team_image_url" value="<?php echo $model->getTeamImageURL(); ?>">
          </div>
          <div class="form-row">
            <label for="pin_url">URL to an image to use as the map pin</label>
            <span>Optional. A URL to a .jpg or .png (ideally uploaded to this server). Don't touch this if you don't know what you're doing.</span>
            <input type="url" name="pin_url" placeholder="A URL here..." id="pin_url" value="<?php echo $model->getPinURL(); ?>">
          </div>
          <button type="submit">Save</button>
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
