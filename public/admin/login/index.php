<?php
	set_include_path(__DIR__."/../../php/");
	require_once "files/autoload.php";
	$class = "LoginController";
	$title = "Login";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
	<?php require_once "../../tpl/admin/head.php"; ?>
	<body>
		<section>
			<div class="wrapper">
				<div class="login">
					<img src="/img/rag.png" alt="Southampton RAG Logo" class="logo">
					<h1>Admin Login</h1>
					<form method="POST">
						<div class="form-row">
							<input type="text" name="username" class="user" placeholder="Username" required>
						</div>
						<div class="form-row">
							<input type="password" name="password" class="pass" placeholder="Password" required>
						</div>
						<button type="submit" class="login-submit">Login</button>
					</form>
				</div>
        <?php if (isset($post) && !$post) { ?>
        <div class="login-error">
          <p>Username or password is not correct</p>
        </div>
				<?php } ?>
			</div>
		</section>
	</body>
</html>
