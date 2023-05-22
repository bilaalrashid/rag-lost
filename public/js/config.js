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

const updateDonationLink = (data) => {
  document.querySelector('.donation-link').href = data.donateUrl;
  document.querySelector('.donation-link').innerHTML = `Donate to ${data.charityName}`;
}
