const fetchConfigData = async () => {
  const response = await fetch('/api/config.php');
  const json = await response.json();
  return json;
}

const updateDonationTotal = (data) => {
  const formatter = new Intl.NumberFormat('en-GB', {
    style: 'currency',
    currency: 'GBP',
  });
  document.querySelector('.donation-total').innerHTML = formatter.format(data.donationTotal);
}

const refreshConfigData = async () => {
  const data = await fetchConfigData();
  updateDonationTotal(data);
}

refreshConfigData().catch();
setInterval(refreshConfigData, refreshInterval);
