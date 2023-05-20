<?php

/**
 * A team competing in the competition.
 */
class Team {

	private $id;
  private $team_name;
  private $members;
  private $team_description;
  private $donate_url;
  private $pin_url;
  private $team_image_url;
  private $team_color;

	/**
	 * Constructor
	 * @param int    $id                [The ID of the time]
   * @param string $team_name         [The name of the team]
   * @param string $members           [A summary of all the team members]
   * @param string $team_description  [A description of the team]
   * @param string $donate_url        [The URL to donate directly to the team]
   * @param string $pin_url           [The URL of the pin to display on the map for the team]
   * @param string $team_image_url    [The URL of the team image]
   * @param string $team_color        [The color of the team]
	 */
	public function __construct(int $id, string $team_name, string $members, string $team_description, string $donate_url, string $pin_url, string $team_image_url, string $team_color) {
    $this->id = $id;
    $this->team_name = $team_name;
    $this->members = $members;
    $this->team_description = $team_description;
    $this->donate_url = $donate_url;
    $this->pin_url = $pin_url;
    $this->team_image_url = $team_image_url;
    $this->team_color = $team_color;
	}

  /**
   * Gets the ID of the team
   * @return int [The ID of the team]
   */
  public function getID(): int {
    return $this->id;
  }

  /**
   * Gets the name of the team
   * @return string [The name of the team]
   */
  public function getTeamName(): string {
    return $this->team_name;
  }

  /**
   * Gets the members of the team
   * @return string [A summary of all the team members]
   */
  public function getMembers(): string {
    return $this->members;
  }

  /**
   * Gets the description of the team
   * @return string [A description of the team]
   */
  public function getTeamDescription(): string {
    return $this->team_description;
  }

  /**
   * Gets the URL to donate directly to the team
   * @return string [The URL to donate directly to the team]
   */
  public function getDonateURL(): string {
    return $this->donate_url;
  }

  /**
   * Gets the URL of the pin to display on the map for the team
   * @return string [The URL of the pin to display on the map for the team]
   */
  public function getPinURL(): string {
    return $this->pin_url;
  }

  /**
   * Gets the URL of the team image
   * @return string [The URL of the team image]
   */
  public function getTeamImageURL(): string {
    return $this->team_image_url;
  }

  /**
   * Gets the color of the team
   * @return string [The color of the team]
   */
  public function getTeamColor(): string {
    return $this->team_color;
  }

}
