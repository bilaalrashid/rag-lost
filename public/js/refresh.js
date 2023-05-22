let countdownStart = null;

const refreshData = async () => {
  const configData = await fetchConfigData();
  updateDonationTotal(configData);
  updateDonationLink(configData);
  countdownStart = configData.countdownStart;

  const mapData = await fetchMapData();
  updateMap(mapData, configData);
  updateSidebar(mapData);
}

refreshData().catch();
setInterval(refreshData, refreshInterval);

const secondsToCountdown = (seconds) => {
  const hours = Math.floor(seconds / 3600);
  const minutes = Math.floor(seconds % 3600 / 60);
  const s = Math.floor(seconds % 3600 % 60);

  let secondsComponent = '';
  if (hours === 0 && minutes === 0) {
    secondsComponent = `:${s.toLocaleString('en-gb', { minimumIntegerDigits: 2 })}`;
  }

  return `${hours.toLocaleString('en-gb', { minimumIntegerDigits: 2 })}:${minutes.toLocaleString('en-gb', { minimumIntegerDigits: 2 })}${secondsComponent}`; 
}

const stripTimezoneFromDate = (date) => {
  date.setMinutes(date.getMinutes() + (-1 * date.getTimezoneOffset()));
  return date;
}

const updateCountdown = () => {
  if (countdownStart) {
    const start = new Date(countdownStart);
    // Strip timezone from date incase of British Summer Time
    const now = stripTimezoneFromDate(new Date());
    if (now > start) {
      const maxTime = 60 * 60 * 12; // 12 hours
      const elapsed = (now - start) / 1000;
      const remaining = maxTime - elapsed;
      if (remaining > 0) {
        document.querySelector('.countdown-timer').innerHTML = secondsToCountdown(remaining);
      } else {
        document.querySelector('.countdown-timer').innerHTML = '00:00';
      }
    }
  }
}

updateCountdown();
setInterval(updateCountdown, 1000);
