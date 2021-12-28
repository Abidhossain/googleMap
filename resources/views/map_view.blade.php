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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="{{ asset('assets/css/iziToast.css') }}">
</head>
<body>
<input type="hidden" value="{{ url('/') }}" id="url">
<div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 m-auto">

                <div class="col-lg-9">
                    <div class="ltn__myaccount-tab-content-inner">
                        {{-- // map show via firestore user get all map data --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="ltn__map-area">
                                                    <div class="ltn__map-inner">
                                                        <div id="map" style="height: 500px;"></div>
                                                        <div class="mt-5" id="directions_panel"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    <input type="text" hidden id="data_url" value="{{ $array }}">
</div>
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDUPClCAvO-EIlmJajX4Sc3bpGgi57-LnE" type="text/javascript"></script>
<script src="{{ asset('assets/js/googleMap.js') }}"></script>

 </body>
</html>
