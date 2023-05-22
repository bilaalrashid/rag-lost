const refreshData = async () => {
  const configData = await fetchConfigData();
  updateDonationTotal(configData);
  updateDonationLink(configData);
  startLocation = configData.startLocation;
  endLocation = configData.endLocation;

  const mapData = await fetchMapData();
  updateMap(mapData, configData);
  updateSidebar(mapData);
}

refreshData().catch();
setInterval(refreshData, refreshInterval);
