<?php

/**
 * A location update for a team.
 */
class LocationUpdate {

	private $id;
  private $latitude;
  private $longitude;
  private $update_message;
  private $update_timestamp;
  private $team_id;

	/**
	 * Constructor
	 * @param int    $id                [The ID of the time]
   * @param float  $latitude          [The latitude of the location update]
   * @param float  $longitude         [The longitude of the location update]
   * @param string $update_message    [The message of the location update]
   * @param string $update_timestamp  [The timestamp of the location update]
   * @param int    $team_id           [The ID of the team that the location update belongs to]
	 */
	public function __construct(int $id, float $latitude, float $longitude, string $update_message, DateTime $update_timestamp, int $team_id) {
    $this->id = $id;
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->update_message = $update_message;
    $this->update_timestamp = $update_timestamp;
    $this->team_id = $team_id;
	}

  /**
   * Gets the ID of the location update
   * @return int [The ID of the location update]
   */
  public function getID(): int {
    return $this->id;
  }

  /**
   * Gets the latitude of the location update
   * @return float [The latitude of the location update]
   */
  public function getLatitude(): float {
    return $this->latitude;
  }

  /**
   * Gets the longitude of the location update
   * @return float [The longitude of the location update]
   */
  public function getLongitude(): float {
    return $this->longitude;
  }

  /**
   * Gets the message of the location update
   * @return string [The message of the location update]
   */
  public function getUpdateMessage(): string {
    return $this->update_message;
  }

  /**
   * Gets the timestamp of the location update
   * @return string [The timestamp of the location update]
   */
  public function getUpdateTimestamp(): DateTime {
    return $this->update_timestamp;
  }

  /**
   * Gets the ID of the team that the location update belongs to
   * @return int [The ID of the team that the location update belongs to]
   */
  public function getTeamID(): int {
    return $this->team_id;
  }

}
