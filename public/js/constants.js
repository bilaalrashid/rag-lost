const initialCenter = [51.505, -0.09];
const initialZoom = 13;
const refreshInterval = 1000 * 60 * 1; // 1 minute

const map = L.map('map', {
  zoomControl: false,
}).setView(initialCenter, initialZoom);
