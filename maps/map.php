<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Tutorial Google Map - Petani Kode</title>
  
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCAzSYdai-ut80wfkpMBzJcIGS0M-p-qPQ&callback=myMap"></script>
<script>
function initialize() {
    // Function Tambah Map
    function addMarker(lat, lng, nama) {
        var marker=new google.maps.Marker({
        position: new google.maps.LatLng(lat,lng),
        title:nama,
        map: peta
    });   
    }

    var propertiPeta = {
        center:new google.maps.LatLng(-1.011488,113.382355),
        zoom:6,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    
    var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
    

    // membuat Marker
    var marker=new google.maps.Marker({
        position: new google.maps.LatLng(-8.5830695,116.3002515),
        title: "Lombok",
        map: peta
    });

    addMarker(0.4340027759053944, 109.28424488134809,"RC Medan");
    addMarker(-2.580866871455998, 111.60236001154902,"Rocket Chicken Pangkalan Bun 1");
    addMarker(-2.8387566615844246, 114.57965479962704,"RC Cilacap");
    addMarker(-2.8387566615844246, 116.20563128905708,"RC Cilacap");

}



// event jendela di-load  
google.maps.event.addDomListener(window, 'load', initialize);
</script>
  
</head>
<body>

  <div id="googleMap" style="width:100%;height:380px;"></div>
  
</body>
</html>