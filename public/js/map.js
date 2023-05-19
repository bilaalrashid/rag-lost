const initialCenter = [51.505, -0.09];
const initialZoom = 13;

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

const fetchData = async () => {
  const response = await fetch('/api/teams.json');
  const json = await response.json();
  return json;
}

const updateMap = (data) => {
  console.log(data);
}

const refreshData = async () => {
  const data = await fetchData();
  updateMap(data);
}

refreshData().catch();
setInterval(refreshData, 10_000);
