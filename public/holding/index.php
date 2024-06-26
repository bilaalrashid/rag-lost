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
    <meta name="msapplication-TileColor" content="#D5282A">
    <meta name="msapplication-TileImage" content="/img/favicon/favicon-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="192x192" href="/img/favicon/favicon-192.png">
    <link rel="apple-touch-icon-precomposed" sizes="180x180" href="/img/favicon/favicon-180.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/img/favicon/favicon-152.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/favicon/favicon-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/img/favicon/favicon-120.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/favicon/favicon-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/favicon/favicon-72.png">
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/img/favicon/favicon-60.png">
    <link rel="apple-touch-icon-precomposed" href="/img/favicon/favicon-57.png">
    <link rel="icon" href="/img/favicon/favicon-96.png" sizes="96x96">
    <link rel="icon" href="/img/favicon/favicon-48.png" sizes="48x48">
    <link rel="icon" href="/img/favicon/favicon-32.png" sizes="32x32">
    <link rel="icon" href="/img/favicon/favicon-16.png" sizes="16x16">
    <link href="/favicon.ico" rel="shortcut icon">
    <?php include '../tpl/matomo.php' ?>
  </head>
  <body>
    <div class="wrapper">
      <img src="/img/rag.png" alt="Southampton RAG Logo" class="logo" />
      <h1>RAG Lost Map Tracker</h1>
      <h2>12 hours to navigate back to Southampton from a mystery location</h2>
      <h3>Raising Money for <?php echo $model->getCharityName(); ?></h3>
      <h3>Event Starting Soon, Check Back Later</h3>
    </div>
  </body>
</html>
