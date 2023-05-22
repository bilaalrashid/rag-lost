<?php

/**
 * The global config for the site.
 */
class Config {

	private $countdown_start;
	private $start_location_latitude;
	private $start_location_longitude;
	private $donation_total;
	private $donate_url;
	private $charity_name;

	/**
	 * Constructor
	 * @param DateTimeInterface $countdown_start           [The time that the countdown should start from]
	 * @param float             $start_location_latitude   [The latitude of the start location]
	 * @param float             $start_location_longitude  [The longitude of the start location]
	 * @param float             $donation_total            [The total amount of money raised]
	 * @param string            $donate_url                [The URL of the donation page]
	 * @param string            $charity_name              [The name of the charity fundraising for]
	 */
	public function __construct(DateTimeInterface $countdown_start, float $start_location_latitude, float $start_location_longitude, float $donation_total, string $donate_url, string $charity_name) {
		$this->countdown_start = $countdown_start;
		$this->start_location_latitude = $start_location_latitude;
		$this->start_location_longitude = $start_location_longitude;
		$this->donation_total = $donation_total;
		$this->donate_url = $donate_url;
		$this->charity_name = $charity_name;
	}

	/**
	 * Gets the countdown start date
	 * @return DateTimeInterface [The time that the countdown should start from]
	 */
	public function getCountdownStart(): DateTimeInterface {
		return $this->countdown_start;
	}

	/**
	 * Gets the start location latitude
	 * @return float [The latitude of the start location]
	 */
	public function getStartLocationLatitude(): float {
		return $this->start_location_latitude;
	}

	/**
	 * Gets the start location longitude
	 * @return float [The longitude of the start location]
	 */
	public function getStartLocationLongitude(): float {
		return $this->start_location_longitude;
	}

	/**
	 * Gets the donation total
	 * @return float [The total amount of money raised]
	 */
	public function getDonationTotal(): ?float {
		return $this->donation_total;
	}

	/**
	 * Gets the donate URL
	 * @return string [The URL of the donation page]
	 */
	public function getDonateUrl(): ?string {
		return $this->donate_url ? htmlspecialchars($this->donate_url) : null;
	}

	/**
	 * Gets the charity name
	 * @return string [The name of the charity fundraising for]
	 */
	public function getCharityName() {
		return htmlspecialchars($this->charity_name);
	}

}
