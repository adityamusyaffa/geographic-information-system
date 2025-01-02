<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <style>
    #map {
      height: 97vh;
    }
  </style>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <title>Gempa terkini</title>
</head>

<body>
  <div id="map"></div>
  <script>
    let map = L.map('map').setView([-0.3155398750904368, 117.1371634207888], 5);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    let earthquakesData = {!! file_get_contents('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json') !!};
    let earthquakes = earthquakesData.Infogempa.gempa
    console.log(earthquakes)

    earthquakes.forEach(earthquake => {
      console.log(earthquake)
      console.log(earthquake.Coordinates)
      let coordinate = earthquake.Coordinates.split(",")
      const latitude = coordinate[0]
      const longitude = coordinate[1]
      let marker = L.marker([latitude, longitude]).addTo(map);
      marker.bindPopup(
        `<b>📍</b>${earthquake.Wilayah} <br />
        <b>📅 </b>${earthquake.Tanggal} <br />
        <b>🕛 </b>${earthquake.Jam} <br />
        <br />
        <b>Magnitudo: </b>${earthquake.Magnitude} <br />
        <b>Kedalaman: </b>${earthquake.Kedalaman} <br />
        <b>Potensi: </b>${earthquake.Potensi} <br />
              `);
    });
  </script>
</body>

</html>
