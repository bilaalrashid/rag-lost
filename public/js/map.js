let hasLoadedOnce = false;

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

L.control.zoom({
  position: 'bottomleft'
}).addTo(map);

const getTimeFromDateString = (timestamp) => {
  const date = new Date(timestamp);
  return `${date.getHours().toLocaleString('en-gb', { minimumIntegerDigits: 2 })}:${date.getMinutes().toLocaleString('en-gb', { minimumIntegerDigits: 2 })}`
}

const removeAllMarkers = () => {
  map.eachLayer(function(layer) {
    if (layer instanceof L.Marker || layer instanceof L.Polyline) {
      map.removeLayer(layer)
    }
  })
}

const fetchMapData = async () => {
  const response = await fetch('/api/teams.php');
  const json = await response.json();
  return json;
}

const updateMap = (data, config) => {
  removeAllMarkers();

  const startIcon = L.icon({
    iconUrl: '/img/start_pin.png',  
    shadowUrl: '/img/pin_shadow.png',
    iconSize: [30, 30],     // size of the icon
    shadowSize: [35, 35],   // size of the shadow
    iconAnchor: [15, 15],   // point of the icon which will correspond to marker's location
    shadowAnchor: [17, 17], // the same for the shadow
    popupAnchor: [0, 0]     // point from which the popup should open relative to the iconAnchor
  });
  L.marker([config.startLocation.latitude, config.startLocation.longitude], { icon: startIcon }).addTo(map).bindPopup("<h3>Mystery Dropoff</h3>");

  const endIcon = L.icon({
    iconUrl: '/img/finish_pin.png',  
    shadowUrl: '/img/pin_shadow.png',
    iconSize: [30, 30],     // size of the icon
    shadowSize: [35, 35],   // size of the shadow
    iconAnchor: [15, 15],   // point of the icon which will correspond to marker's location
    shadowAnchor: [17, 17], // the same for the shadow
    popupAnchor: [0, 0]     // point from which the popup should open relative to the iconAnchor
  });
  L.marker([config.endLocation.latitude, config.endLocation.longitude], { icon: endIcon }).addTo(map).bindPopup("<h3>Finish Location</h3>");

  data.teams.forEach(team => {
    const currentLocation = team.updates[0];
    const icon = L.icon({
      iconUrl: team.pinUrl,  
      shadowUrl: '/img/pin_shadow.png',
      iconSize: [30, 30],     // size of the icon
      shadowSize: [35, 35],   // size of the shadow
      iconAnchor: [15, 15],   // point of the icon which will correspond to marker's location
      shadowAnchor: [17, 17], // the same for the shadow
      popupAnchor: [0, 0]     // point from which the popup should open relative to the iconAnchor
    });
    const marker = L.marker([currentLocation.latitude, currentLocation.longitude], { icon: icon }).addTo(map);
    const popupContents = `
      <div class="map-popup">
        <img src="${team.teamImageUrl}" style="border-color: ${team.teamColor}" />
        <h2>${team.name}</h2>
        <p class="members">${team.members}</p>
        <p class="description">${team.description}</p>
        <p class="location-update">Last Seen: ${getTimeFromDateString(currentLocation.timestamp)}, ${Math.round(currentLocation.distanceKm)}km, ${currentLocation.locationName}</p>
        <p class="location-update-message">"${currentLocation.message}"</p>
        <p class="donate"><a href="${team.donateUrl}" target="_blank" style="background-color: ${team.teamColor}">Donate Online</a></p>
      </div>
    `;
    marker.bindPopup(popupContents);

    const polylinePoints = team.updates.map(update => [update.latitude, update.longitude]);
    L.polyline(polylinePoints, { color: team.teamColor, weight: 5 }).addTo(map);
  });

  if (!hasLoadedOnce) {
    const allMarkers = data.teams.map(team => {
      const currentLocation = team.updates[0];
      return [currentLocation.latitude, currentLocation.longitude];
    });
    allMarkers.push([config.startLocation.latitude, config.startLocation.longitude]);
    allMarkers.push([config.endLocation.latitude, config.endLocation.longitude]);
    const bounds = L.latLngBounds(allMarkers);
    map.fitBounds(bounds);
  }

  hasLoadedOnce = true;
}

const updateSidebar = (data) => {
  const sidebar = document.querySelector('.sidebar');
  sidebar.innerHTML = '';

  const toggle = document.createElement('a');
  toggle.classList.add('toggle');
  toggle.href = 'javascript:void(0);';
  toggle.innerText = 'Show Teams';
  toggle.onclick = () => {
    toggle.innerText = toggle.innerText === 'Show Teams' ? 'Hide Teams' : 'Show Teams';
    document.querySelectorAll('.team-details').forEach(teamDetails => {
      teamDetails.style.display = (teamDetails.style.display || 'none') === 'none' ? 'block' : 'none';
    });
    document.querySelectorAll('.separator').forEach(divider => {
      divider.style.display = (divider.style.display || 'none') === 'none' ? 'block' : 'none';
    });
  }
  sidebar.appendChild(toggle);

  data.teams.forEach((team, index) => {
    const currentLocation = team.updates[0];

    sidebar.insertAdjacentHTML('beforeend', `
      <div class="team-details">
        <table>
          <tr>
            <td>
              <img src="${team.teamImageUrl}" class="team-image" style="border-color: ${team.teamColor}" />
            </td>
            <td>
              <div class="overview">
                <h2>${team.name}</h2>
                <p class="tagline">${team.members}</p>
                <p class="latest-update">
                  ${getTimeFromDateString(currentLocation.timestamp)}, ${Math.round(currentLocation.distanceKm)}km, ${currentLocation.locationName}
                </p>
              </div>
            </td>
          </tr>
        </table>

        <p class="charity-name">
          Fundraising for <strong>${team.charityName}</strong>
        </p>

        <a href="${team.donateUrl}" target="_blank" class="donate-button" style="background-color: ${team.teamColor};">
          <span>Donate Online</span>
          <img src="/img/external-link.svg" class="external-link" />
        </a>

        <details>
          <summary>View Full History</summary>
          ${
            team.updates.map(update => `
              <div class="update">
                <p class="stats">${getTimeFromDateString(update.timestamp)}, ${Math.round(update.distanceKm)}km, ${update.locationName}</p>
                <p class="message">"${update.message}"</p>
              </div>
            `).join('')
          }
        </details>
      </div>
    `);

    // Don't show after the last team
    if (!Object.is(data.teams.length - 1, index)) {
      sidebar.insertAdjacentHTML('beforeend', `
        <hr class="separator" />
      `);
    }
  });
}
