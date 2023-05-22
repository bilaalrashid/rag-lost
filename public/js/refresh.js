const refreshData = async () => {
  const configData = await fetchConfigData();
  updateDonationTotal(configData);
  updateDonationLink(configData);

  const mapData = await fetchMapData();
  updateMap(mapData, configData);
  updateSidebar(mapData);
}

refreshData().catch();
setInterval(refreshData, refreshInterval);
