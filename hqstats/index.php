<!DOCTYPE html>
<html lang="en">

<?php
$filepath = dirname(__FILE__)."/../";
require_once($filepath.'global.php');?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/stylesheet.css"/>
    <link rel="icon" href="https://susurag.org/wp-content/uploads/2016/06/cropped-rag_logo_square-32x32.jpg" sizes="32x32"/>
    <title>Jailbreak Tracker</title>
</head>
<body>
<script type="text/javascript">
    <?php

    include($filepath.'RandomColor.php');
    include($filepath.'CoordinateDistance.php');
    require_once($filepath.'DummyData.php');
    require_once($filepath.'dataGet.php');
    $teams = getCSVData();
    usort($teams, function($a, $b){
        $distance = distance($a['path'][0]['lat'],$a['path'][0]['lng'],$a['lastEvent']['lat'],$a['lastEvent']['lng'],"M");
        $distance2 = distance($b['path'][0]['lat'],$b['path'][0]['lng'],$b['lastEvent']['lat'],$b['lastEvent']['lng'],"M");
        return $distance2 - $distance;
           });
    echo json_encode($teams);
    ?>
</script>

<div id="teamSelector">
    <?php
    $height = 5;
    foreach ($teams as $team) {
        $lastEvent = $team['lastEvent'];

        $cardType = 'card';
        if ($lastEvent['responseBy'] < new DateTime('NOW')){
            $cardType = "card-danger  card-inverse";
            $cardType = $lastEvent['responseBy'];
        } elseif (date_sub($lastEvent['responseBy'], new DateInterval("PT30M")) < new DateTime('NOW')) {
            $cardType = "card-warning";
        }
        echo "<div class=\"" . $cardType . " text-xs-center\" style=\"border-color:". $team['color'] . "\" >\n";
        echo "<div class='team-color' style=\"background-color:". $team['color'] ."; height:". $height ."px\"> </div>";
        echo "<div class=\"card-block\">\n";
        echo "<h4 class=\"card-title team-name\" >". $team['id'] . " - " . $team['name'] . "</h4>\n";
        echo $lastEvent['message'];
        $firstEvent = $team['path'][0];
        $distanceFromStart = round(distance($firstEvent['lat'], $firstEvent['lng'], $lastEvent['lat'], $lastEvent['lng'], 'M'));
        echo "<p class=\"card-text teamCurrentLocation\" >" . $distanceFromStart .  "mi - " . $lastEvent['location'] . "</p>\n";
        foreach ($team['path'] as $event) {
            $distanceFromStart = round(distance($firstEvent['lat'], $firstEvent['lng'], $event['lat'], $event['lng'], 'M'));
            echo "<div class=\"teamHistory\">";
            echo "<div style=\"background-color:lightgrey; height:1px\"> </div>";
            $timestamp = date_format($event['timeStamp'], "H:i");
            echo "<p class=\"card-text\" >" . $timestamp . " - " . $distanceFromStart . "mi - " . $event['location'] . "</p>\n";
            echo "<p class=\"card-text\" >" . $event['message'] . "</p>\n";
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
        //$height += 2;
    }
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $(".teamCard").find(".teamHistory").hide(); <?php // TODO: Find proper fix ?>
        $(".teamCard").find(".expandSymbol").show();

        $(".teamCard").click(function(){
            $(this).find(".expandSymbol").slideToggle(325);
            $(this).find(".teamHistory").slideToggle(325);

        });
    });

</script>
</body>
</html>