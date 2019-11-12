<h1>Ip Validator</h1>


<?php if (isset($ip)) : ?>
    <h3>Ip info.</h3>
    <p>Sökt IP: <?php echo $ip ?></p>
    <p>Valid Ipv4: <?php echo $validIpv4 ?></p>
    <p>Valid Ipv6: <?php echo $validIpv6 ?></p>
    <p>Domain: <?php echo $domain ?></p>
    <h3>Ip info i JSON format.</h3>
    <pre><?php echo $jsonData ?></pre>
    <?php  ?>
<?php endif; ?>



<p>Skriv in en ip-address för att validera det.</p>
<form method="POST">
    <label>Skriv in ett IP: </label>
    <input type="text" name="ip" value="" placeholder="Skriv in ett ip...">
    <button type="submit">Validera</button>
</form>

<a href="ip/json?ip=172.217.22.164">Valid ip test i json.</a>