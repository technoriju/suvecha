<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Get Visitor's Location Using HTML5 Geolocation</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body onload="showPosition()">
    <div id="result">
        <!--Position information will be inserted here-->
    </div>
    <button type="button" onclick="showPosition();">Show Position</button>
    <script>
    // window.onload = showPosition();
    function showPosition()
    {
        if(navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(function(position) {
                var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                document.getElementById("result").innerHTML = positionInfo;
                console.log(position.coords.longitude);
                $.ajax({
                    type: "POST",
                    url: "/address_fetch.php",
                    data: {"longitude": position.coords.longitude,"latitude":position.coords.latitude},
                    success: function(data) {
                         document.getElementById("result").innerHTML = data;
                    }
                  });
            });
        }
        else { alert("Sorry, your browser does not support geolocation."); }
    }
</script>
</body>
</html>
