<?php
//var_dump($data);
?>
<?php if (isset($data[0]["code"])) : ?>
    <h2><?php echo $data[0]["error"] ?></h2>
<?php else : ?>
    <?php foreach ($data as $weather) : ?>
        <h3>Datum: <?php echo date('Y-m-d', $weather["currently"]["time"]) ?></h3>
        <p>Väder: <?php echo $weather["currently"]["summary"] ?></p>
    <?php endforeach; ?>
    <div id="googleMap" style="width:100%;height:400px;"></div>
    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(parseFloat(<?php echo $data[0]["latitude"] ?>), parseFloat(<?php echo $data[0]["longitude"] ?>)),
                zoom: 5,
            };

            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(<?php echo $data[0]["latitude"] ?>), parseFloat(<?php echo $data[0]["longitude"] ?>)),
            });

            marker.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASvJrS5vkmmvvlOAPnzeoPid_kHIGoOW8&callback=myMap"></script>
<?php endif; ?>