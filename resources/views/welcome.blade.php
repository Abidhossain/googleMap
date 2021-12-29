<!doctype html>
<html lang="en">
<head>
    <title>Geo map location</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 </head>
<body>
<div class="container mt-5">
    <form action="{{ route('map.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 m-auto">
                <div class="form-group" id="lat_area">
                    <label for="route_name"> Route name </label>
                    <input type="text" name="route_name" id="route_name" class="form-control" placeholder="Route name" required>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h5 class="card-title text-white">Start Location</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="start_autocomplete"> Location/City/Address </label>
                            <input type="text" name="start_location" id="start_autocomplete" class="form-control"
                                   placeholder="Select Location" required>
                        </div>
                        <div class="form-group d-none" id="lat_area">
                            <label for="start_latitude"> Latitude </label>
                            <input type="text" name="start_latitude" id="start_latitude" class="form-control" readonly>
                        </div>
                        <div class="form-group d-none" id="long_area">
                            <label for="start_longitude"> Longitude </label>
                            <input type="text" name="start_longitude" id="start_longitude" class="form-control"
                                   readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h5 class="card-title text-white">End Location</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="end_autocomplete"> Location/City/Address </label>
                            <input type="text" name="end_location" id="end_autocomplete" class="form-control"
                                   placeholder="Select Location" required>
                        </div>
                        <div class="form-group d-none" id="end_lat_area">
                            <label for="end_latitude"> Latitude </label>
                            <input type="text" name="end_latitude" id="end_latitude" class="form-control" readonly>
                        </div>
                        <div class="form-group d-none" id="end_long_area">
                            <label for="end_longitude"> Longitude </label>
                            <input type="text" name="end_longitude" id="end_longitude" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 m-auto">
                <button type="submit" class="btn btn-block btn-primary mt-5">Submit</button>
            </div>
        </div>

    </form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDUPClCAvO-EIlmJajX4Sc3bpGgi57-LnE&libraries=places" type="text/javascript"></script>
<script>
    google.maps.event.addDomListener(window, 'load', initializeOne);
    google.maps.event.addDomListener(window, 'load', initializeTwo);

    function initializeOne() {
        var input = document.getElementById('start_autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $('#start_latitude').val(place.geometry['location'].lat());
            $('#start_longitude').val(place.geometry['location'].lng());
        });
    }

    function initializeTwo() {
        var input = document.getElementById('end_autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $('#end_latitude').val(place.geometry['location'].lat());
            $('#end_longitude').val(place.geometry['location'].lng());
        });
    }
</script>
</body>
</html>
