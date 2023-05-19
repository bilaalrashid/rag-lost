<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/stylesheet.css"/>
    <link rel="icon" href="https://susurag.org/wp-content/uploads/2016/06/cropped-rag_logo_square-32x32.jpg" sizes="32x32"/>
    <title>Jailbreak Tracker</title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Will Kingsnorth
 * Date: 22/12/2016
 * Time: 13:49
 * Ck2u%OsNn6Fo
 */
require_once("sqilInfo.php");
$mysqli = new mysqli($DBhost, $DBusername, $DBpass, $DBname);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";
//echo $mysqli->host_info();
$mysqli->query("DROP TABLE IF EXISTS test");
$mysqli->query("CREATE TABLE test(id INT)");
$mysqli->query("INSERT INTO test(id) VALUES (1)");
$result = $mysqli->query("SELECT * FROM test");
$resarr = $result->fetch_assoc();
echo "<p>"  . $resarr['id'] . "</p>"
   ?>
<p>test</p>
</body>
</html>