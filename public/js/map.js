const initialCenter = [51.505, -0.09];
const initialZoom = 13;
const refreshInterval = 1000 * 60 * 15; // 15 minutes

const map = L.map('map', {
  zoomControl: false,
}).setView(initialCenter, initialZoom);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

L.control.zoom({
  position: 'bottomleft'
}).addTo(map);

const removeAllMarkers = () => {
  map.eachLayer(function(layer) {
    if (layer instanceof L.Marker) {
      map.removeLayer(layer)
    }
  })
}

const fetchData = async () => {
  const response = await fetch('/api/teams.php');
  const json = await response.json();
  return json;
}

const updateMap = (data) => {
  console.log(data);

  removeAllMarkers();

  data.teams.forEach(team => {
    const currentLocation = team.updates[0];
    const marker = L.marker([currentLocation.latitude, currentLocation.longitude]).addTo(map);
    const popupContents = `
      <div class="map-popup">
        <h2>${team.name}</h2>
        <p class="members">${team.members}</p>
        <p class="description">${team.description}</p>
        <p class="donate"><a href="${team.donateUrl}" target="_blank">Donate Online</a></p>
      </div>
    `;
    marker.bindPopup(popupContents);
  });
}

const refreshData = async () => {
  const data = await fetchData();
  updateMap(data);
}

refreshData().catch();
setInterval(refreshData, refreshInterval);
