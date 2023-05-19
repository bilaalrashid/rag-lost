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
  const response = await fetch('/api/teams.json');
  const json = await response.json();
  return json;
}

const updateMap = (data) => {
  console.log(data);

  removeAllMarkers();

  data.teams.forEach(team => {
    const marker = L.marker([team.coordinate.latitude, team.coordinate.longitude]).addTo(map);
    const popupContents = `
      <h2>${team.name}</h2>
      <p>${team.members}</p>
      <p>${team.description}</p>
      <p><a href="${team.donateUrl}" target="_blank">Donate Online</a></p>
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
