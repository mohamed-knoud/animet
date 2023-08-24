

  fetch('https://api-consumet-one.vercel.app/meta/anilist/trending')
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json(); // Assuming the API response is in JSON format
  })
  .then(data => {
    // Process the data you received from the API
    console.log(data); // You can replace this with your own logic
  })
  .catch(error => {
    console.error('Fetch error:', error);
  });