@extends('seller.layouts.vendor')
@section('title', 'Manage Shop')
@section('pageheading')
{{__('Manage Shop')}}
@endsection
@section('content')
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
   .wrapper-field{
   width: 800px;
   margin: 0 auto 10px;
   }
   #map {
   width: 100%;
   height: 100%;
   }
</style>
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30 newshop-label" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-6 col-lg-5">
                     <div class="title">{{ __('Add new shop') }}</div>
                  </div>
                  <!-- <div class="col-md-6 col-lg-7 text-md-end">
                     <a class="title underline">Manage Shop</a>
                     </div> -->
               </div>
            </div>

           
                
                 
            @if(isset($seller_shops))
            <form id="profileUpdate" action="{{ route('seller.shops.update',[$seller_shops->id,$seller_shops->user_id]) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @else
            <form id="profileUpdate" action="{{ route('seller.shops.store') }}" method="post" enctype="multipart/form-data">
            @endif
               @csrf
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Shop name') }}</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" name="shop_name" placeholder="Shop Name" value="{{ old('shop_name',isset($seller_shops->shop_name) ? $seller_shops->shop_name : ''  ) }}">
                  </div>
                  @error('shop_name')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Owner name') }}</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" name="owner_name" placeholder="Owner Name" value="{{ old('owner_name',isset($seller_shops->shop_owner) ? $seller_shops->shop_owner : '' ) }}">
                  </div>
                  @error('owner_name')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Shop Phone Number') }}</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" name="shop_phone" placeholder="Shop Phone Number" value="{{ old('shop_phone',isset($seller_shops->shop_contact) ? $seller_shops->shop_contact : '' ) }}">
                  </div>
                  @error('shop_phone')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Shop Email') }}</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" name="shop_email" placeholder="Shop Email" value="{{ old('shop_email',isset($seller_shops->shop_email) ? $seller_shops->shop_email : '') }}">
                  </div>
                  @error('shop_email')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Category') }}:</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <select class="form-control" id="basic-addon1" name="product_categories[]" >
                        <option value="">Select Category</option>
                        @foreach($categories as $row)
                        <option value="{{ $row->id }}" @if($row->id == isset($seller_shops->shop_email) ? $seller_shops->shop_email : '' ) {{ "Selected" }} @endif> {{ $row->title }}</option>
                        @endforeach
                     </select>
                  </div>
                  @error('product_categories')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Add a Shop Photo (Upto 5)') }}</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="file" class="form-control" multiple name="file[]" placeholder="Add a Shop Photo (Upto 5)" value="{{ old('file') }}">
		            @if(!empty($seller_shops_images))
                     @foreach($seller_shops_images as $image)
                  
                           <img src="{{ asset('storage/'.$image->photo) }}" style="height:50px;" />
                     @endforeach
                  @endif
                  <div> 
               </div>
                  </div>
                  @error('file')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Add A Location') }}</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <input type="text" class="form-control" id="searchfield" name="searchfield" placeholder="Search" value="{{ old('searchfield',isset($seller_shops->address_1) ? $seller_shops->address_1: '') }}"><br>
                     <input id="lat" type="hidden" name="lat" placeholder="lat" value="{{ old('lat',isset($seller_shops->latitude) ? $seller_shops->latitude : '') }}">
                     <input id="lng" type="hidden" name="lng" placeholder="lng" value="{{ old('lng',isset($seller_shops->longitude) ? $seller_shops->longitude : '') }}">
                  </div>
                  <div class="wrapper-map col-md-6 col-lg-6">
                     <div id="map"></div>
                  </div>
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Working Hours') }}</label>
                  </div>
                  <div class="col-md-3 col-lg-3">
                     <input type="time" class="form-control" name="work_hours_from"   value="{{ old('work_hours_from',isset($seller_shops->working_hours_from) ? $seller_shops->working_hours_from : '') }}">
                  </div>
                  <div class="col-md-3 col-lg-3">
                     <input type="time" class="form-control" name="work_hours_to"  value="{{ old('work_hours_to',isset($seller_shops->working_hours_to) ? $seller_shops->working_hours_to : '') }}">
                  </div>
               </div>
               @error('work_hours_from')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror

                  @error('work_hours_to')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label">{{ __('Working Days') }}</label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                  @php
                  if(isset($seller_shops->working_days)){
                  $work = explode(",",$seller_shops->working_days);
                   }

                  @endphp
                     <input type="checkbox"   id="allDays" value="All"  ><label for="All"> All</label><br>
                     <input type="checkbox"  name="working_days[]" value="Su" class="days" @if(isset($seller_shops->working_days)) @if(in_array('Su',$work)) {{ "checked" }} @endif @endif ><label for="Sunday"> Sunday</label>
                     <input type="checkbox"  name="working_days[]" value="M" class="days" @if(isset($seller_shops->working_days)) @if(in_array('M',$work)) {{ "checked" }} @endif @endif ><label for="Monday"> Monday</label>
                     <input type="checkbox"  name="working_days[]" value="Tu" class="days" @if(isset($seller_shops->working_days)) @if(in_array('Tu',$work)) {{ "checked" }} @endif @endif><label for="Tuesday"> Tuesday</label>
                     <input type="checkbox"  name="working_days[]" value="W" class="days" @if(isset($seller_shops->working_days)) @if(in_array('W',$work)) {{ "checked" }} @endif @endif><label for="Wednesday"> Wednesday</label><br>
                     <input type="checkbox"  name="working_days[]" value="Th" class="days" @if(isset($seller_shops->working_days)) @if(in_array('Th',$work)) {{ "checked" }} @endif @endif><label for="Thursday"> Thursday</label>
                     <input type="checkbox"  name="working_days[]" value="F" class="days" @if(isset($seller_shops->working_days)) @if(in_array('F',$work)) {{ "checked" }} @endif @endif><label for="Friday"> Friday</label>
                     <input type="checkbox"  name="working_days[]" value="Sa" class="days" @if(isset($seller_shops->working_days)) @if(in_array('Sa',$work)) {{ "checked" }} @endif @endif><label for="Saturday"> Saturday</label>
                  </div>
                  @error('working_days')
                  <span style="color:red">
                  <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="row form-group">
                  <div class="col-md-6 col-lg-3">
                     <label for="" class="label"></label>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <button  class="btn btn-primary">Submit</button>
                  </div>
               </div>
            </form>
            <!-- <div class="row form-group">
               <div class="col-md-6 col-lg-3">
                   <label for="" class="label"></label>
               </div>
               <div class="col-md-6 col-lg-6">
                   <a href="" class="social fa fa-facebook"></a>
                   <a href="" class="social fa fa-linkedin"></a>
                   <a href="" class="social fa fa-instagram"></a>
               </div>
               </div> -->
         </div>
      </div>
   </div>
</section>
@endsection
@push('custom_js')
<script>
   $("#allDays").change(function(e) {
      e.preventDefault();
     
      if(this.checked) {
          $('.days').attr('checked', true);
      }else{
          $('.days').attr('checked', false);
      }
   });
</script>
@endpush
@push('custom_js')
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
   let shopMap = {
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
       shopMap.init();
   });
</script>
@endpush