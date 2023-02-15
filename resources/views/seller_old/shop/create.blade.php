@extends('layouts.vendor')
@section('title', __('Shops'))
@section('pageheading')
{{ __('Shops') }}
@endsection

@section('styles')
<style type="text/css">
      .wrapper-map{
  width: 800px;
  height: 400px;
   margin: 0 auto;
   border: #ccc solid 1px;
}

#searchfield{
  width: 100%;
}

#lat, #lng{
  width: 48%;
}
#lat{
  margin-right: 2%;
}

input{
  border: 1px solid #ccc;
  height: 35px;
  margin-bottom: 5px;
}

.wrapper-field{
  width: 800px;
  margin: 0 auto 10px;
}

#map {
   width: 100%;
   height: 100%;
}
</style>
@endsection
@section('scripts')
<script src="{{ asset('js/admin.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyB-Ltp4OCt-4vHQ1Ej656YjDlLDTdDKcWk
"></script>     
<script>
  // google.maps.event.addDomListener(window, 'load', initialize);
  //   function initialize() {
  //     var input = document.getElementById('autocomplete_search');
  //     var autocomplete = new google.maps.places.Autocomplete(input);
  //     autocomplete.addListener('place_changed', function () {
  //     var place = autocomplete.getPlace();
  //     console.log(place);
  //     // place variable will have all the information you are looking for.
  //     $('#lat').val(place.geometry['location'].lat());
  //     console.log(place.geometry.location.lat());
  //     var lat=place.geometry.location.lat();
  //     $('#long').val(place.geometry['location'].lng());
  //     var long=place.geometry.location.lng()
  //     console.log(place.geometry.location.lng());

  //   });
  // }
</script>
<script type="text/javascript">
let Map = {
    mapContainer: document.getElementById('map'),
    inputAutocomplete: document.getElementById('searchfield'),
    inputLat: $("input[name=lat]"),
    inputLng: $("input[name=lng]"),
    map: {},
    geocoder: new google.maps.Geocoder(),
    autocomplete: {},
    init: function () {
        let _this = this;

        this.autocomplete = new google.maps.places.Autocomplete(this.inputAutocomplete);

        let latLng = new google.maps.LatLng(-23.6815314, -46.875502);
        console.log(this.inputLat.val());
        if(this.inputLat.val() && this.inputLng.val()){
            latLng = new google.maps.LatLng(this.inputLat.val(), this.inputLng.val());
        }

        this.map = new google.maps.Map(this.mapContainer, {
            zoom: 15,
            center: latLng
        });

        this.autocomplete.addListener('place_changed', function () {
            let place = _this.autocomplete.getPlace();

            _this.inputLat.val(place.geometry.location.lat());
            _this.inputLng.val(place.geometry.location.lng());

            let latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());

            // create marker
            let marker = new google.maps.Marker({
                position: latlng,
                map: _this.map,
                draggable: true
            });
            _this.map.setCenter(latlng);

            marker.addListener('dragend', function () {
                _this.inputLat.val(marker.getPosition().lat());
                _this.inputLng.val(marker.getPosition().lng());
                _this.geocodePosition(marker.getPosition());
                _this.map.setCenter(marker.getPosition());
            })
        })
    },
    geocodePosition: function (pos) {
        let _this = this;

        this.geocoder.geocode({
            latLng: pos
        }, function (responses) {
            if (responses && responses.length > 0) {
                _this.updateMarkerAddress(responses[0].formatted_address);
            } else {
                _this.updateMarkerAddress('Nenhuma coordenada encontrada');
            }
        });
    },
    updateMarkerAddress: function (str) {
        this.inputAutocomplete.value = str;
    },
    renderMap: function ($el) {
        let _this = this;
        let $markers = $el.find('.marker');

        let args = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
            mapTypeControl: false
        };

        let map = new google.maps.Map($el[0], args);

        map.markers = [];

        $markers.each(function () {
            _this.add_marker($(this), map);
        });

        _this.center_map(map);
    },
    add_marker: function ($marker, map) {
        let latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
        let marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
        map.markers.push(marker);
    },
    center_map: function (map) {
        let bounds = new google.maps.LatLngBounds();

        $.each(map.markers, function (i, marker) {
            let latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(latlng);
        });

        if (map.markers.length == 1) {
            map.setCenter(bounds.getCenter());
            map.setZoom(16);
        } else {
            map.fitBounds(bounds);
        }
    },

};

$(document).ready(function(){
    Map.init();
});
</script>
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">{{ __('Add new shop') }}</h3>
            </div>
            <form id="form" action="{{ route('seller.shops.store') }}" method="post" autocomplete="on" enctype="multipart/form-data">
               @csrf
               <div class="card-body row">
                
                  <div class="form-group col-6">
                     <label for="name">{{ __('Owner name') }}</label>
                     <input type="text" class=" form-control col-12 @error('owner_name') is-invalid @enderror" placeholder="Owner Name*" value="{{ old('owner_name') }}" name ="owner_name" autocomplete="false">
                     @error('owner_name')
                     <span class="invalid-feedback" id="name_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>

                  <!-- <div class="col-md-3 col-xs-11">
                     <div id="custom-search-input">
                         <div>
                             <input id="autocomplete_search" name="autocomplete_search" type="text" class="form-control" placeholder="Search" onkeyup="initialize()" data-parsley-error-message="Please Enter Restaurant Address" data-parsley-required /> 
                             <input type="hidden" id="lat" name="lat">
                             <input type="hidden" id="long" name="long">
                             <input type="hidden" id="city" name="city">
                             <input type="hidden" id="zipcode" name="zipcode">
                             <input type="hidden" id="streetnumber" name="streetnumber">

                         </div>
                     </div>
                  </div> -->
                   <div class="wrapper-field">
                     <input id="searchfield" type="search">
                     <input id="lat" type="text" name="lat" placeholder="lat">
                     <input id="lng" type="text" name="lng" placeholder="lng">
                   </div>

                   <div class="wrapper-map">
                     <div id="map"></div>
                   </div>

                  <div class="form-group col-6">
                     <label for="email">{{ __('Shop name') }}</label>
                     <input type="text" name="shop_name"  class=" form-control @error('shop_name') is-invalid @enderror" placeholder="Shop name*" value="{{ old('shop_name') }}" autocomplete="false">
                     @error('shop_name')
                     <span class="invalid-feedback" id="email_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>


                  <div class="form-group col-6">
                     <label for="name">{{ __('Registration no') }}</label>
                     <input type="text" class=" form-control col-12 @error('registration') is-invalid @enderror" placeholder="Registration no*" value="{{ old('registration') }}" name ="registration" autocomplete="false">
                     @error('registration')
                     <strong>{{ $message }}</strong>
                     @enderror
                  </div>

                  <div class="form-group col-6">
                     <label for="name">{{ __('Upload id') }}</label>
                     <input type="file" class=" form-control col-12 @error('file') is-invalid @enderror" placeholder="Upload ID*" value="{{ old('file') }}" name="file" autocomplete="false">
                     @error('file')
                     <span class="invalid-feedback" id="upload_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>


                  <div class="form-group col-6">
                     <label for="name">{{ __('Working hours from') }}</label>
                     <input type="text" class=" form-control col-12 @error('work_hours_from') is-invalid @enderror" placeholder="*" value="{{ old('work_hours_from') }}" name="work_hours_from"  autocomplete="false">
                     {{--  @error('work_hours_from')
                     <span class="invalid-feedback"  role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror --}}
                  </div>
                  <div class="form-group col-6">
                     <label for="name">{{ __('Working hours to') }}</label>
                     <input type="text" class=" form-control col-12 @error('work_hours_to') is-invalid @enderror" placeholder="*" value="{{ old('work_hours_to') }}" name="work_hours_to"  autocomplete="false">
                     {{-- @error('work_hours_to')
                     <span class="invalid-feedback"  role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror --}}
                  </div>
                  <div class="form-group col-6">
                     <label for="phone">{{ __('Shop contact') }}</label>
                     <input id="telephone_input" type="tel"  name="phone" class=" form-control @error('phone') is-invalid @enderror" placeholder="Phone Number*" min="0" value="{{ old('phone') }}" autocomplete="false">
                     @error('phone')
                     <span class="invalid-feedback" id="phone_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>

                  <div class="form-group col-6">
                     <label for="phone">{{ __('Shop email') }}</label>
                     <input id="telephone_input" type="text"  name="shop_email" class=" form-control @error('shop_email') is-invalid @enderror" placeholder="Shop Email*" min="0" value="{{ old('shop_email') }}" autocomplete="false">
                     @error('shop_email')
                     <span class="invalid-feedback" id="phone_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>

                  <div class="form-group col-6">
                     <label for="country">{{__('Country')}}</label>
                     <select name="country" id="-countryId" class="countries  form-control @error('country') is-invalid @enderror">
                        <option value="">{{__('Select country')}}</option>
                        <option value="SA">{{__('Saudi Arabia')}}</option>
                        <option value="BHR">{{__('Bahrain')}}</option>
                        <option value="KWT">{{__('Kuwait')}}</option>
                        <option value="UAE">{{__('United Arab Emirates')}}</option>
                     </select>
                     @error('country')
                     <span class="invalid-feedback" id="country_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="state">{{__('State')}}</label>
                     <select name="state" id="-stateId" class=" states form-control @error('state') is-invalid @enderror">
                        <option value="">{{__('Select state')}}</option>
                        <option value="Riyadh Region">{{ __('Riyadh Region') }}</option>
                        <option value="Mecca Region">{{ __('Mecca Region') }}</option>
                        <option value="Eastern Region">{{ __('Eastern Region') }}</option>
                        <option value="'Asir Region">{{ __('\'Asir Region') }}</option>
                        <option value="Jazan Region">{{ __('Jazan Region') }}</option>
                        <option value="Tabuk Region">{{ __('Tabuk Region') }}</option>
                        <option value="Najran Region">{{ __('Najran Region') }}</option>
                     </select>
                     @error('state')
                     <span class="invalid-feedback" id=state_sell_err role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <!-- <div class="form-group col-6">
                     <label for="city">{{__('City')}}</label>
                     <select name="city" id="cityId" class="cities  form-control @error('city') is-invalid @enderror">
                        <option value="">{{__('Select city')}} </option>
                     </select>
                     @error('city')
                     <span class="invalid-feedback" id="city_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div> -->

                    <div class="form-group col-6">
                     <label for="address">{{__('Address line1')}}</label>
                     <input type="text" name="address" class=" form-control " autocomplete="false">
                     @error('address')
                     <span class="invalid-feedback" id="address_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="address2">{{__('Address line2')}}</label>
                     <input type="text" name="address2" class=" form-control" autocomplete="false">
                     @error('address2')
                     <span class="invalid-feedback" id="address2_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>

                  <input type="hidden" name="role" value="customer">    
               </div>
               {{-- end card --}}
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary" id="btn_submit">{{ __('Submit') }}</button>
                  <a href="{{route('seller.shops.index')}}" class="btn btn-primary btn-cancel">{{ __('Cancel') }}</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')

@stop