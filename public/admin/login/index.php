<?php
	set_include_path(__DIR__."/../../php/");
	require_once "files/autoload.php";
	$class = "LoginController";
	$title = "Login";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <head></head>
	<body>
		<header></header>
		<section>
			<div class="wrapper">
				<div class="login">
					<h2><?php echo $title; ?></h2>
					<form method="POST">
						<div class="input-container">
							<input type="text" name="username" class="user" placeholder="Username" required>
						</div>
						<div class="input-container">
							<input type="password" name="password" class="pass" placeholder="Password" required>
						</div>
						<button type="submit" class="login-submit">Login</button>
					</form>
				</div>
        <?php if (isset($post) && !$post) { ?>
        <div class="login-error">
          <p>Username or password is not correct</p>
        </div>
			</div>
      <?php } ?>
		</section>
		<footer></footer>
	</body>
</html>
