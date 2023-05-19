<!DOCTYPE html>
<html lang="en">
<?php require_once('global.php');?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css"/>
    <link rel="icon" href="img/favicon.ico" sizes="32x32"/>
    <title>Jailbreak Tracker</title>
</head>
<body>

<script type="text/javascript">
    <?php

    include('RandomColor.php');
    include('CoordinateDistance.php');
    require_once('DummyData.php');
    require_once('dataGet.php');
    $teams = getCSVData();

    echo "var teams = [";
    foreach ($teams as $team){
        $path = $team['path'];
        $mapPath = array();
        foreach ($team['path'] as $event){
            array_push($mapPath, json_encode(array("lat" => $event['lat'], "lng" => $event['lng'])));

        }
        $mapPath = str_replace("\"", "", str_replace("\\", "", json_encode($mapPath)));
        $color = $team['color'];
        echo "{\"path\":";
        echo $mapPath;
        echo ", \"color\":\"$color\"";
        echo ", \"name\":\"" . $team['name'] . "\"";
        echo ", \"id\":\"" . $team['id'] . "\"";
        echo "},";

    }
    echo "];";
    ?>


</script>

<div id="map">
    <script>
        var nightMode = [
            {
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#1d2c4d"
                    }
                ]
            },
            {
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#8ec3b9"
                    }
                ]
            },
            {
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#1a3646"
                    }
                ]
            },
            {
                "featureType": "administrative.country",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "administrative.land_parcel",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#64779e"
                    }
                ]
            },
            {
                "featureType": "administrative.province",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#4b6878"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "landscape.man_made",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#334e87"
                    }
                ]
            },
            {
                "featureType": "landscape.natural",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#023e58"
                    }
                ]
            },
            {
                "featureType": "landscape.natural",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "landscape.natural.landcover",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "landscape.natural.terrain",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "landscape.natural.terrain",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#ffffff"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#283d6a"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#6f9ba5"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#1d2c4d"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#023e58"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#3C7680"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#304a7d"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#98a5be"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#1d2c4d"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#2c6675"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#b4b4b4"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#255763"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#b0d5ce"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#023e58"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#98a5be"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#1d2c4d"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#283d6a"
                    }
                ]
            },
            {
                "featureType": "transit.station",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#3a4762"
                    }
                ]
            },
            {
                "featureType": "transit.station.airport",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#0e1626"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "weight": 4
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#4e6d70"
                    }
                ]
            }
        ];

        var colors = {
            aqua: "#00ffff",
            azure: "#f0ffff",
            beige: "#f500ad",
            black: "#000000",
            blue: "#0000ff",
            brown: "#a52a2a",
            cyan: "#00ffff",
            darkblue: "#00008b",
            darkcyan: "#ffb002",
            darkgrey: "#a9a9a9",
            darkgreen: "#006400",
            darkkhaki: "#fff800",
            darkmagenta: "#8b008b",
            darkolivegreen: "#49ff13",
            darkorange: "#ff8c00",
            darkorchid: "#9932cc",
            darkred: "#8b0000",
            darksalmon: "#e9967a",
            darkviolet: "#9400d3",
            fuchsia: "#ff00ff",
            gold: "#ffd700",
            green: "#008000",
            indigo: "#4b0082",
            khaki: "#f0e68c",
            lightblue: "#add8e6",
            lightcyan: "#e0ffff",
            lightgreen: "#90ee90",
            lightgrey: "#d3d3d3",
            lightpink: "#ffb6c1",
            lightyellow: "#ffffe0",
            lime: "#00ff00",
            magenta: "#ff00ff",
            maroon: "#800000",
            navy: "#000080",
            olive: "#808000",
            orange: "#ffa500",
            pink: "#ffc0cb",
            purple: "#800080",
            violet: "#800080",
            red: "#ff0000",
            silver: "#c0c0c0",
            white: "#ffffff",
            yellow: "#ffff00"
        };
        var colorkeys = Object.keys(colors);
        var map;
        function initMap() {
            var bounds = new google.maps.LatLngBounds();
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 50.9, lng: -1.38},
                zoom: 9
            });
            for(var i = 0; i < teams.length; i++){
                var team = teams[i];
                var teamPathCoordinates = teams[i].path;
                var teamPath = new google.maps.Polyline({
                    path: teamPathCoordinates,
                    geodesic: true,
                    strokeColor: teams[i].color,
                    strokeOpacity: 1.0,
                    strokeWeight: 4
                });
                teamPathCoordinates.forEach((location) => bounds.extend({lat: location.lat, lng: location.lng}));
                teamPath.setMap(map);
                (function(team) {google.maps.event.addListener(teamPath, 'click', event => alert("Team " + team.id + ": " + team.name));})(team);

            }
            if(false && (new Date().getHours() >= 19 || new Date().getHours() < 6)){
                map.setOptions({styles : nightMode});
            }
            map.fitBounds(bounds);
        }


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo($mapsKey) ?>&callback=initMap" async defer></script>
</div>

<div id="teamSelector">
    <?php
    $height = 5;
    usort($teams, function ($a, $b) {
        $distance = (int)distance($a['path'][0]['lat'], $a['path'][0]['lng'], $a['lastEvent']['lat'], $a['lastEvent']['lng'], "M");
        $distance2 = (int)distance($b['path'][0]['lat'], $b['path'][0]['lng'], $b['lastEvent']['lat'], $b['lastEvent']['lng'], "M");
        return $distance2 - $distance;
    });
    foreach ($teams as $team) {
        if (false && (date("H") < 6 || date("H") >= 19)) {
            echo "<div class=\"card card-inverse text-xs-center teamCard\" style=\"background-color: #333;border-color:" . $team['color'] . ";\" >\n";
            echo "<div class='card-header text-muted' style=\"background-color: #333;\">" . "" . "</div>\n";
        echo "<div class='team-color' style=\"background-color:" . $team['color'] . "; height:" . $height . "px\"> </div>";
    } else {
            echo "<div class=\"card text-xs-center teamCard\" style=\"border-color:" . $team['color'] . ";\" >\n";
            echo "<div class='card-header text-muted'>" . $team['names'] . "</div>\n";
            echo "<div class='team-color' style=\"background-color:" . $team['color'] . "; height:" . $height . "px\"> </div>";
        }
        echo "<div class=\"card-body\">\n";
        echo "<h4 class=\"card-title team-name\" >" . $team['name'] . "</h4>\n";
        $lastEvent = $team['lastEvent'];
        $firstEvent = $team['path'][0];
        $distanceFromStart = round(distance($firstEvent['lat'], $firstEvent['lng'], $lastEvent['lat'], $lastEvent['lng'], 'M'));
        echo "<p class=\"card-text teamCurrentLocation\" >" . $distanceFromStart .  "mi - " . $lastEvent['location'] . "</p>\n";
        echo "<p class=\"card-text teamCurrentLocation\" >" . $lastEvent['message'] . "</p>\n";
        echo "<div style=\"background-color:lightgrey; height:1px\"> </div>";

        echo "<p class='expandSymbol text-muted'>▼</p>";
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

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $(document).ready(function(){

        $(".teamCard").find(".teamHistory").hide(); <?php // TODO: Find proper fix ?>

        $(".teamCard").click(function(){
            $(this).find(".expandSymbol").slideToggle(325);
            $(this).find(".teamHistory").slideToggle(325);
        });
    });

</script>
</body>
</html>