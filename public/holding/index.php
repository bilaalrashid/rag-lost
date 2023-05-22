<?php
	set_include_path(__DIR__."/../php/");
	require_once "files/autoload.php";
	$class = "TrackerHoldingController";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>RAG Lost | Starting Soon</title>
    <link rel="stylesheet" href="/css/holding.css">
    <meta http-equiv="refresh" content="60">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <img src="/img/rag.png" alt="Southampton RAG Logo" class="logo" />
      <h1>RAG Lost Map Tracker</h1>
      <h2>12 hours to navigate back to Southampton from a mystery location</h2>
      <h3>Raising Money for Young Minds</h3>
      <h3>Event Starting Soon, Check Back Later</h3>
      <p class="donate-container">
        <a href="<?php echo $model->getDonateURL(); ?>" target="_blank" class="donate">Donate Online</a>
      </p>
    </div>
  </body>
</html>
