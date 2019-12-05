<h1>Väder app</h1>

<h3>Skriv in en ip-address för att se vädret på den platsen.</h3>

<form action="weather/darkskyIp" method="get">
    <label>Skriv in ett IP: </label>
    <input type="text" name="ip" value="" placeholder="Skriv in ett ip..."> <br>
    <input type="radio" name="past" value="past"> 30 dagar i dåtid. <br>
    <input type="radio" name="past" value="future"> 30 dagar i framtiden. <br>
    <button type="submit">skicka</button>
</form>

<h3>Skriv in kordinater för att se vädret på den platsen.</h3>

<form action="weather/darkskyCord" method="get">
    <label>Skriv in latitude: </label>
    <input type="text" name="latitude" value="" placeholder="Skriv in latitude..."><br>
    <label>Skriv in longitude: </label>
    <input type="text" name="longitude" value="" placeholder="Skriv in ett longitude..."><br>
    <input type="radio" name="past" value="past"> 30 dagar i dåtid. <br>
    <input type="radio" name="past" value="future"> 30 dagar i framtiden. <br>
    <button type="submit">Skicka</button>
</form>

<h4>Tester</h4>
<a href="wApi/byCords?lat=500&lon=500&past=future">Invalid Kordinater</a><br>
<a href="wApi/byCords?lat=50&lon=50&past=future">Valid Kordinater</a><br>

<a href="weather/darkskyIp?ip=notan&past=future">Invalid Ip</a><br>
<a href="wApi/byIp?ip=172.217.22.164&past=future">Valid Ip</a><br>