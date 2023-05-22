let startLocation;
let endLocation;

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
  document.querySelector('.donation-link').innerHTML = "Donate Online";
}

const addStartIcon = () => {
  if (startLocation) {
    const startIcon = L.icon({
      iconUrl: '/img/start_pin.png',  
      shadowUrl: '/img/pin_shadow.png',
      iconSize: [30, 30], // size of the icon
      shadowSize: [35, 35], // size of the shadow
      iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
      shadowAnchor: [17, 17],  // the same for the shadow
      popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
    });
    L.marker([startLocation.latitude, startLocation.longitude], { icon: startIcon }).addTo(map).bindPopup("<h3>Mystery Dropoff</h3>");
  }
}

const addEndIcon = () => {
  if (endLocation) {
    const endIcon = L.icon({
      iconUrl: '/img/finish_pin.png',  
      shadowUrl: '/img/pin_shadow.png',
      iconSize: [30, 30], // size of the icon
      shadowSize: [35, 35], // size of the shadow
      iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
      shadowAnchor: [17, 17],  // the same for the shadow
      popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
    });
    L.marker([endLocation.latitude, endLocation.longitude], { icon: endIcon }).addTo(map).bindPopup("<h3>Finish Location</h3>");
  }
}

const refreshConfigData = async () => {
  const data = await fetchConfigData();
  updateDonationTotal(data);
  updateDonationLink(data);
  startLocation = data.startLocation;
  endLocation = data.endLocation;
  // Refresh map data so start and end points show up
  refreshData();
}

refreshConfigData().catch();
setInterval(refreshConfigData, refreshInterval);
