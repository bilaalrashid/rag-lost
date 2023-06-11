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

/****** Geocode ******/

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

/**
 * Performs a reverse geocode lookup, converting coordinates to a human-readable address.
 *
 * NOTE: Fair use limits apply to this community hosted version of Nominatim, so please don't use heavily.
 * See https://operations.osmfoundation.org/policies/nominatim/
 *
 * @param {lat} number The latitude to reverse geocode
 * @param {lng} number The longitude to reverse geocode
 */
const reverseGeocode = async (lat, lng) => {
  const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)

  if (!response.ok) {
    return null
  }

  const data = await response.json()
  return data
}

/****** Map search ******/

document.querySelector('.map-search').addEventListener('keydown', async (e) => {
  if (e.key == "Enter") {
    const query = document.querySelector('.map-search').value;

    if (!query || query.length < 4) {
      alert("Please a longer search query.");
      return;
    }

    const result = await geocode(query);

    if (result && result.length > 0) {
      // Debug call
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

/****** Select location on map ******/

const removeAllMarkers = () => {
  map.eachLayer(function(layer) {
    if (layer instanceof L.Marker) {
      map.removeLayer(layer)
    }
  })
}

const reverseGeocodeAreaName = async (lat, lng) => {
  const result = await reverseGeocode(lat, lng);
  // Debug call
  console.log(result);

  if (result && result.address) {
    return result.address.town
      || result.address.city
      || result.address.city_district
      || result.address.village
      || result.address.quarter
      || result.address.state_district
      || result.address.county
      || result.address.state;
  }

  return null;
}

map.on('click', async (e) => {
  removeAllMarkers();
  new L.marker(e.latlng).addTo(map);
  
  // Display coordinates on the page
  document.querySelector('#latitude').value = e.latlng.lat;
  document.querySelector('#longitude').value = e.latlng.lng;

  // Display reverse geocode on the page
  const locationName = await reverseGeocodeAreaName(e.latlng.lat, e.latlng.lng);
  if (document.querySelector('#location_name')) document.querySelector('#location_name').value = locationName || 'Unknown';
});

/****** Display location on map ******/

const showLocationOnMap = (animate = false) => {
  const latitude = document.querySelector('#latitude').value;
  const longitude = document.querySelector('#longitude').value;

  if (!latitude || !longitude) {
    alert("Please enter a latitude and longitude.");
    return;
  }

  removeAllMarkers();
  new L.marker([latitude, longitude]).addTo(map);
  if (animate) {
    map.flyTo([latitude, longitude], 17);
  } else {
    map.setView([latitude, longitude], 17);
  }
}

document.querySelector('.view-on-map').addEventListener('click', async (e) => {
  e.preventDefault();
  showLocationOnMap(true);
});
