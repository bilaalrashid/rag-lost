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
  </head>
  <body>
    <div class="vertical-layout">
      <div class="main-banner">
        <img src="img/rag.png" alt="Southampton RAG Logo" class="logo">
        <div class="info">
          <h1>RAG Lost • <?php echo $model->getCountdownStart()->format("jS F o"); ?></h1>
          <p>12 hours to navigate back to Southampton from a mystery location</p>
          <p>Total Raised: <span class="donation-total"></span> | <a href="" target="_blank" class="donation-link"></a></p>
        </div>
        <div class="countdown">
          <p class="countdown-timer">12:00</p>
          <p class="label">Time Remaining</p>
        </div>
      </div>
      <div class="horizontal-layout">
        <div id="map"></div>
        <div class="sidebar">
          <div class="team-details">
            <table>
              <tr>
                <td>
                  <img src="" />
                </td>
                <td>
                  <div class="overview">
                    <h2>Team Name</h2>
                    <p class="tagline">Members Names</p>
                    <p class="latest-update">Time, Distance, Location Name</p>
                  </div>
                </td>
              </tr>
            </table>
            <details>
              <summary>View Full History</summary>
              <div class="update">
                <p class="stats">Time, Distance, Location Name</p>
                <p class="message">"An Update Tagline"</p>
              </div>
            </details>
          </div>
          <hr />
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
