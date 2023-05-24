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
  return `${date.getUTCHours().toLocaleString('en-gb', { minimumIntegerDigits: 2 })}:${date.getUTCMinutes().toLocaleString('en-gb', { minimumIntegerDigits: 2 })}`
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
    iconSize: [30, 30], // size of the icon
    shadowSize: [35, 35], // size of the shadow
    iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
    shadowAnchor: [17, 17],  // the same for the shadow
    popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
  });
  L.marker([config.startLocation.latitude, config.startLocation.longitude], { icon: startIcon }).addTo(map).bindPopup("<h3>Mystery Dropoff</h3>");

  const endIcon = L.icon({
    iconUrl: '/img/finish_pin.png',  
    shadowUrl: '/img/pin_shadow.png',
    iconSize: [30, 30], // size of the icon
    shadowSize: [35, 35], // size of the shadow
    iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
    shadowAnchor: [17, 17],  // the same for the shadow
    popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
  });
  L.marker([config.endLocation.latitude, config.endLocation.longitude], { icon: endIcon }).addTo(map).bindPopup("<h3>Finish Location</h3>");

  data.teams.forEach(team => {
    const currentLocation = team.updates[0];
    const icon = L.icon({
      iconUrl: team.pinUrl,  
      shadowUrl: '/img/pin_shadow.png',
      iconSize: [30, 30], // size of the icon
      shadowSize: [35, 35], // size of the shadow
      iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
      shadowAnchor: [17, 17],  // the same for the shadow
      popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
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

  data.teams.forEach(team => {
    const currentLocation = team.updates[0];
    
    const teamDetails = document.createElement('div');
    teamDetails.classList.add('team-details');

    const table = document.createElement('table');
    const row = document.createElement('tr');
    const imageCell = document.createElement('td');
    const image = document.createElement('img');
    image.src = team.teamImageUrl;
    image.style.borderColor = team.teamColor;
    imageCell.appendChild(image);
    row.appendChild(imageCell);

    const overviewCell = document.createElement('td');
    const overviewContainer = document.createElement('div');
    overviewContainer.classList.add('overview');
    const name = document.createElement('h2');
    name.innerText = team.name;
    overviewContainer.appendChild(name);

    const members = document.createElement('p');
    members.classList.add('tagline');
    members.innerText = team.members;
    overviewContainer.appendChild(members);

    const latestUpdate = document.createElement('p');
    latestUpdate.classList.add('latest-update');
    latestUpdate.innerText = `${getTimeFromDateString(currentLocation.timestamp)}, ${Math.round(currentLocation.distanceKm)}km, ${currentLocation.locationName}`;
    overviewContainer.appendChild(latestUpdate);

    overviewCell.appendChild(overviewContainer);
    row.appendChild(overviewCell);
    table.appendChild(row);
    teamDetails.appendChild(table);

    const details = document.createElement('details');
    const summary = document.createElement('summary');
    summary.innerText = 'View Full History';
    details.appendChild(summary);

    team.updates.forEach(update => {
      const updateDiv = document.createElement('div');
      updateDiv.classList.add('update');

      const stats = document.createElement('p');
      stats.classList.add('stats');
      stats.innerText = `${getTimeFromDateString(update.timestamp)}, ${Math.round(update.distanceKm)}km, ${update.locationName}`;
      updateDiv.appendChild(stats);

      const message = document.createElement('p');
      message.classList.add('message');
      message.innerText = `"${update.message}"`;
      updateDiv.appendChild(message);

      details.appendChild(updateDiv);
    });

    teamDetails.appendChild(details);

    sidebar.appendChild(teamDetails);

    const separator = document.createElement('hr');
    sidebar.appendChild(separator);
  });
}
