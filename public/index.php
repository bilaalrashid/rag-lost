<?php
	set_include_path(__DIR__."/php/");
	require_once "files/autoload.php";
	$class = "TrackerController";
	require_once "files/controller.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>RAG Lost</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
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
    <?php include 'tpl/matomo.php' ?>
  </head>
  <body>
    <div class="vertical-layout">
      <div class="main-banner">
        <img src="/img/rag.png" alt="Southampton RAG Logo" class="logo">
        <div class="info">
          <h1>RAG Lost • <?php echo $model->getCountdownStart()->format("jS F o"); ?></h1>
          <p class="description">12 hours to navigate back to Southampton from a mystery location</p>
          <p class="charity-details">Total Raised: <span class="donation-total"></span></p>
        </div>
        <div class="countdown">
          <p class="countdown-timer">12:00</p>
          <p class="label">Time Remaining</p>
        </div>
      </div>
      <div class="horizontal-layout">
        <div id="map"></div>
        <div class="sidebar">
          <!-- The contents are dynamically generated in /js/map.js -->
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="/js/constants.js"></script>
    <script src="/js/map.js"></script>
    <script src="/js/config.js"></script>
    <script src="/js/refresh.js"></script>
  </body>
</html>
