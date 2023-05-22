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

const fetchData = async () => {
  const response = await fetch('/api/teams.php');
  const json = await response.json();
  return json;
}

const updateMap = (data) => {
  removeAllMarkers();

  addStartIcon();
  addEndIcon();

  data.teams.forEach(team => {
    const currentLocation = team.updates[0];
    const marker = L.marker([currentLocation.latitude, currentLocation.longitude]).addTo(map);
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

const refreshData = async () => {
  const data = await fetchData();
  updateMap(data);
  updateSidebar(data);
}

refreshData().catch();
setInterval(refreshData, refreshInterval);
