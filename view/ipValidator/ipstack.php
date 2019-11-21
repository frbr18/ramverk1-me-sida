<h1>IpStack Validator</h1>


<?php if (isset($ip)) : ?>
    <h3>Ip info.</h3>
    <p>Sökt IP: <?php echo $ip ?></p>
    <p>Ip typ: <?php echo $type ?></p>
    <p>Land: <?php echo $country ?></p>
    <p>Longitude: <?php echo $longitude ?></p>
    <p>Latitude: <?php echo $latitude ?></p>
    <p>Ort: <?php echo $city ?></p>
    <h3>Ip info i JSON format.</h3>
    <pre><?php echo $jsonData ?></pre>
    <?php  ?>
<?php endif; ?>



<p>Skriv in en ip-address för att hämta kordinater.</p>
<form method="POST">
    <label>Skriv in ett IP: </label>
    <input type="text" name="ip" value="<?php echo $default; ?>" placeholder="Skriv in ett ip...">
    <button type="submit">Hämta kordinater.</button>
</form>

<a href="../api/ipstack?ip=172.217.22.164">Valid ipStack test i json.</a>