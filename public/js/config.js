const fetchConfigData = async () => {
  const response = await fetch('/api/config.php');
  const json = await response.json();
  return json;
}

const refreshConfigData = async () => {
  const data = await fetchConfigData();
}

refreshConfigData().catch();
setInterval(refreshConfigData, refreshInterval);
