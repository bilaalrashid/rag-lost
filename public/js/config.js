const fetchConfigData = async () => {
  const response = await fetch('/api/config.php');
  const json = await response.json();
  return json;
}

const refreshConfigData = async () => {
  const data = await fetchConfigData();
  console.log(data);
  
}

refreshConfigData().catch();
setInterval(refreshConfigData, refreshInterval);
