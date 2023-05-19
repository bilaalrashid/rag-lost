<?php

/**
 * The global config for the site.
 */
class Config {

	private $countdown_start;

	/**
	 * Constructor
	 * @param DateTime $countdown_start    [The time that the countdown should start from]
	 */
	public function __construct(DateTime $countdown_start) {
		$this->countdown_start = $countdown_start;
	}

	/**
	 * Gets the event name
	 * @return string [Event name]
	 */
	public function getCountdownStart(): DateTime {
		return $this->countdown_start;
	}

}
