<!doctype html>
<html lang="en">
<head>
    <title>Map View</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('settings.app.company_name') }} | @yield('title')</title>
    <meta name="robots" content="noindex, follow"/>
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css"/>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDUPClCAvO-EIlmJajX4Sc3bpGgi57-LnE&libraries=places"
            type="text/javascript"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyDUPClCAvO-EIlmJajX4Sc3bpGgi57-LnE"
            type="text/javascript"></script>

</head>
<body>
<div data-role="page" id="map_page">
    <div data-role="header">

    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-6 m-auto">
            <label for="route_name">Route name</label>
            <select class="form-control" name="route_name" id="route_name">
                <option value="" disabled selected> Select location</option>
                @foreach($route_data as $item)
                    <option value="{{ $item->id }}}"> {{$item->route_name }}</option>@endforeach
            </select>
        </div>
    </div>
    <div data-role="content">
        <div class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
            <div id="map_canvas" style="height:300px;"></div>
            <div data-role="fieldcontain">
                <label for="from">From</label>
                <input type="text" id="from" value="{{ @$location->start_location }}"/>
            </div>
            <div data-role="fieldcontain">
                <label for="to">To</label>
                <input type="text" id="to" value="{{ @$location->end_location }}"/>
            </div>
            <div data-role="fieldcontain">
                <label for="mode" class="select">Transportation method:</label>
                <select name="select-choice-0" id="mode">
                    <option value="DRIVING">Driving</option>
                    <option value="WALKING">Walking</option>
                </select>
            </div>
            <a data-icon="search" data-role="button" href="#" id="submit">Get directions</a>
        </div>
        <div id="results" style="display:none;">
            <div id="directions"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("pageinit", "#map_page", function () {
        initialize();
        calculateRoute();
    });

    $(document).on('click', '#submit', function (e) {
        e.preventDefault();
        calculateRoute();
    });

    var directionDisplay,
        directionsService = new google.maps.DirectionsService(),
        map;

    function initialize() {
        var lat = "{{ @$location->start_latitude }}";
        var long = "{{ @$location->end_longitude }}";
        directionsDisplay = new google.maps.DirectionsRenderer();
        var mapCenter = new google.maps.LatLng(lat, long);

        var myOptions = {
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: mapCenter
        }

        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directions"));
    }

    function calculateRoute() {
        var selectedMode = $("#mode").val(),
            start = $("#from").val(),
            end = $("#to").val();

        if (start == '' || end == '') {
            // cannot calculate route
            $("#results").hide();
            return;
        } else {
            var request = {
                origin: start,
                destination: end,
                travelMode: google.maps.DirectionsTravelMode[selectedMode]
            };

            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    $("#results").show();
                    /*
                        var myRoute = response.routes[0].legs[0];
                        for (var i = 0; i < myRoute.steps.length; i++) {
                            alert(myRoute.steps[i].instructions);
                        }
                    */
                } else {
                    $("#results").hide();
                }
            });

        }
    }
</script>
</body>
</html>
