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

/**
 * Performs a geocode lookup, converting a human-readable search query to coordinates.
 *
 * NOTE: Fair use limits apply to this community hosted version of Nominatim, so please don't use heavily.
 * See https://operations.osmfoundation.org/policies/nominatim/
 *
 * @param {query} string The search query to lookup
 */
const geocode = async (query) => {
  const response = await fetch(`https://nominatim.openstreetmap.org/search/${query}?format=jsonv2&countrycodes=gb`)

  if (!response.ok) {
    return [];
  }

  const data = await response.json()
  return data
}

document.querySelector('.map-search').addEventListener('keydown', async (e) => {
  if (e.key == "Enter") {
    const query = document.querySelector('.map-search').value;

    if (!query || query.length < 4) {
      alert("Please a longer search query.");
      return;
    }

    const result = await geocode(query);

    if (result && result.length > 0) {
      console.log(result);
      const firstResult = result[0];

      if (firstResult.boundingbox && firstResult.boundingbox.length >= 4) {
        map.fitBounds([
          [firstResult.boundingbox[0], firstResult.boundingbox[2]],
          [firstResult.boundingbox[1], firstResult.boundingbox[3]]
        ]);
      } else {
        const { lat, lon } = firstResult;
        map.flyTo([lat, lon]);
      }
    } else {
      alert("No search results found.");
    }
  }
});
