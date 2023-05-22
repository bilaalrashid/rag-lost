<?php

class CoordinateUtils {

  /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
  /*::                                                                         :*/
  /*::  This routine calculates the distance between two points (given the     :*/
  /*::  latitude/longitude of those points). It is being used to calculate     :*/
  /*::  the distance between two locations using GeoDataSource(TM) Products    :*/
  /*::                                                                         :*/
  /*::  Definitions:                                                           :*/
  /*::    South latitudes are negative, east longitudes are positive           :*/
  /*::                                                                         :*/
  /*::  Passed to function:                                                    :*/
  /*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
  /*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
  /*::    unit = the unit you desire for results                               :*/
  /*::           where: 'M' is statute miles (default)                         :*/
  /*::                  'K' is kilometers                                      :*/
  /*::                  'N' is nautical miles                                  :*/
  /*::                                                                         :*/
  /*::         GeoDataSource.com (C) All Rights Reserved 2022                  :*/
  /*::                                                                         :*/
  /*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
  static function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
      return 0;
    }
    else {
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);

      if ($unit == "K") {
        return ($miles * 1.609344);
      } else if ($unit == "N") {
        return ($miles * 0.8684);
      } else {
        return $miles;
      }
    }
  }

  /**
   * Performs a reverse geocode lookup, converting coordinates to a human-readable address.
   *
   * NOTE: Fair use limits apply to this community hosted version of Nominatim, so please don't use heavily.
   * See https://operations.osmfoundation.org/policies/nominatim/
   *
   * @param float $latitude   [The latitude to reverse geocode]
   * @param float $longitude  [The longitude to reverse geocode]
   */
  static function reverseGeocode($latitude, $longitude) {
    $url = "https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=$latitude&lon=$longitude";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Make Nominatim happy - we need to identify ourselves so they don't block us
    curl_setopt($ch, CURLOPT_USERAGENT, "Southampton RAG Lost - https://lost.susu.org");
    curl_setopt($ch, CURLOPT_REFERER, 'https://lost.susu.org');
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
  }

}
