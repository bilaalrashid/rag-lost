<?php

static $dataCSV = "https://docs.google.com/spreadsheets/d/e/2PACX-1vRiTAxiLA3bUYxS1QCExfnDLkB71_Uf-trnT-tBHMrKECjnjsBaNIMWThuXEvaPWcf8Gh6ltuLfK-9v/pub?gid=2136931888&single=true&output=csv";
getCSVData();
function getCSVData()
{
    global $dataCSV;
    include_once('RandomColor.php');
    $handle = fopen($dataCSV, 'r');
    fgetcsv($handle, 10000, ',');
    $data = array();
    while (!feof($handle)) {
        $dataFromFile = fgetcsv($handle);
	$teamno = $dataFromFile[4];
        if ($teamno != "") {
            $eventTime = DateTime::createFromFormat("d/m/Y H:i:s", $dataFromFile[3]);
            $responseBy = DateTime::createFromFormat("d/m/Y H:i:s", "19/11/2017 " . $dataFromFile[3]);
            $trackEvent = array('lat' => floatval($dataFromFile[6]), 'lng' => floatval($dataFromFile[7]), "location" => $dataFromFile[11], "timeStamp" => $eventTime, "message" => filter_var($dataFromFile[9], FILTER_SANITIZE_STRING), "responseBy" => $responseBy);

            if (array_key_exists($teamno, $data)) {
                $team = $data[$teamno];
                $path = $team['path'];
                $team['lastEvent'] = $trackEvent;
                array_push($path, $trackEvent);
                $team['path'] = $path;
                $data[$teamno] = $team;
            } else {
                $path = array($trackEvent);
                $name = filter_var($dataFromFile[21], FILTER_SANITIZE_STRING);
                $names = filter_var(str_replace(',', ', ', $dataFromFile[24]), FILTER_SANITIZE_STRING);
                $newTeam = array('id' => $teamno, 'name' => $name, 'lastEvent' => $trackEvent, 'path' => $path, 'names' => "Team " . $teamno, 'color' => \Colors\RandomColor::one(array('luminosity' => 'bright')));
                $data[$teamno] = $newTeam;
            }
        }
    }
    usort($data, function ($a, $b) {
        $distance = (int)distance($a['path'][0]['lat'], $a['path'][0]['lng'], $a['lastEvent']['lat'], $a['lastEvent']['lng'], "M");
        $distance2 = (int)distance($b['path'][0]['lat'], $b['path'][0]['lng'], $b['lastEvent']['lat'], $b['lastEvent']['lng'], "M");
        return $distance2 - $distance;
    });
    return $data;
}

