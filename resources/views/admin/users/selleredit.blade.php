@extends('layouts.admin')
@section('title', __('Vendor'))
@section('pageheading')
{{ __('Vendor') }}
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">{{ __('Edit vendor') }}</h3>
            </div>
            <form action="{{ route('admin.users.update', ['user' => $user,'user_shop'=>$user_shop]) }}" method="post" enctype="multipart/form-data">
               @csrf
               @method('put')
               <div class="card-body row">
                  <div class="form-group col-6">
                     <label for="name">{{ __('Name of the company') }}</label>
                     <input type="text" class=" form-control col-12 @error('name') is-invalid @enderror" placeholder="Name of the company*" value="{{ old('name',$user->name ?? null) }}"  name ="name" autocomplete="false">
                     @error('name')
                     <span class="invalid-feedback" id="name_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="license">{{ __('Registration/license number') }}</label>
                     <input type="text" class=" form-control col-12 @error('license') is-invalid @enderror" placeholder="License Number*" name ="license" autocomplete="false" value="{{ old('registration_no',$user_shop->registration_no ?? null) }}" >
                     @error('license')
                     <span class="invalid-feedback" id="license_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="email">{{ __('Email address') }}</label>
                     <input type="text" name ="email"  class=" form-control @error('email') is-invalid @enderror" placeholder="E-mail*" value="{{ old('email',$user->email ?? null) }}" autocomplete="off">
                     @error('email')
                     <span class="invalid-feedback" id="email_sell_err"  role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="phone">{{ __('Phone') }}</label>
                     <input id="telephone_input" type="tel"  name="phone" class=" form-control @error('phone') is-invalid @enderror" placeholder="Phone Number*" min="0" value="{{ old('phone',$user->phone ?? null) }}" autocomplete="false">
                     @error('phone')
                     <span class="invalid-feedback" id="phone_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="country">{{ __('Country') }}</label>
                     <select name="country" id="countryId" class="countries  form-control @error('country') is-invalid @enderror">
                        @if(!empty($user->country))
                        <option value="{{$user->country }}" @if($user->country) selected @endif>{{$user->country}}</option>
                        @else
                        <option value="" >{{ __('Select Country') }}</option>
                        @endif
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
                     <label for="state">{{ __('State') }}</label>
                     <select name="state" id="stateId" class=" states form-control @error('state') is-invalid @enderror">
                        @if(!empty($user->state))
                        <option value="{{$user->state }}" @if($user->state) selected @endif>{{$user->state}}</option>
                        @else
                        <option value="">{{ __('Select State') }}</option>
                        @endif
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
                  <div class="form-group col-6">
                     <label for="city">{{ __('City') }}</label>
                     <select name="city" id="cityId" class="cities  form-control @error('city') is-invalid @enderror">
                        @if(!empty($user->city))
                        <option value="{{$user->city }}" @if($user->city) selected @endif>{{$user->city}}</option>
                        @else
                        <option value="">{{ __('Select City') }}</option>
                        @endif
                     </select>
                     @error('city')
                     <span class="invalid-feedback" id="city_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="category">{{ __('Category') }}</label>
                     <select name="parent_id[]"  multiple="multiple" class="select2-multiple form-control @error('parent_id') is-invalid @enderror"  id="select2Multiple">
                        {{-- 
                        <option value="">{{ __('Please Select Category') }}</option>
                        --}}
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" <?php if(in_array($category->id,$catArray)){echo("selected");}?>   >{{$category->title}}</option>
                        @endforeach
                     </select>
                     @error('parent_id')
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="address">{{ __('Address line1') }}</label>
                     <input type="text" name="address" class=" form-control " value="{{ old('address_line_1',$user->address_line_1 ?? null) }}" autocomplete="false">
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
                     <label for="address2">{{ __('Address line2') }}</label>
                     <input type="text" name="address2" class=" form-control" value="{{ old('address_line_2',$user->address_line_2 ?? null) }}" autocomplete="false">
                     @error('address2')
                     <span class="invalid-feedback" id="address2_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @else
                     <span class="valid-feedback" role="alert">
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="name">{{ __('Upload id') }}</label>
                     <input type="file" class=" form-control col-12 @error('file') is-invalid @enderror" placeholder="Upload ID*" id="seller_image" name="file" autocomplete="false">
                     @error('file')
                     <span class="invalid-feedback" id="upload_sell_err" role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <input type="hidden" name="type" value="seller">
                  <input type="hidden" name="pro_shop_img_id" id="pro_shop_img_id" value="">
                  <input type="hidden" name="updateShopImage" id="updateShopImage" value="">
                  <input type="hidden" name="images_count" id="images_count" value="">
                  <div class="form-group col-6">
                     <label for="name">{{ __('Upload shop image') }}</label>
                     <input type="file" class=" form-control col-12 @error('photos') is-invalid @enderror" placeholder="Upload Shop Image*" value="{{ old('photos') }}" id="photos" name="photos[]" multiple autocomplete="false">
                     @error('photos')
                     <span class="invalid-feedback"  role="alert">
                     <strong>{{ $message }}</strong>
                     </span>
                     @enderror
                  </div>
                  <div class="form-group col-6">
                     <label for="name">{{ __('Working hours from') }}</label>
                     <input type="text" class=" form-control col-12 @error('work_hours_from') is-invalid @enderror" placeholder="*" value="{{ old('working_hours_from',$user_shop->user_shop->working_hours_from ?? null) }}" name="work_hours_from"  autocomplete="false">
                  </div>
                  <div class="form-group col-6">
                     <label for="name">{{ __('Working hours to') }}</label>
                     <input type="text" class=" form-control col-12 @error('work_hours_to') is-invalid @enderror" placeholder="*" value="{{ old('working_hours_to',$user_shop->user_shop->working_hours_to ?? null) }}" name="work_hours_to"  autocomplete="false">
                  </div>
                  <ul class="nav nav-tabs" id="langTab" role="tablist">
                     @foreach (frontend_languages() as $language)
                     @php
                     $locale = $language['locale'];
                     $title = $language['title'];
                     @endphp
                     <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#tab{{ $locale }}" role="tab"
                        aria-controls="{{ $locale }}"
                        {{ $loop->first ? 'aria-selected="true"' : '' }}>
                        {{ $title }}
                        </a>
                     </li>
                     @endforeach
                  </ul>
                  <div class="form-group col-6 tab-content mt-4" id="langTabContent">
                     @foreach (frontend_languages() as $language)
                     @php
                     $locale = $language['locale'];
                     $direction = $language['direction'];
                     $showlangdata=$user_shop_trans_datas->where('locale',$locale)->first();
                     // $user_shop->setDefaultLocale($locale);
                     @endphp
                     <div class="tab-pane fade {{$loop->first ? 'show active':''}}" id="tab{{ $locale }}" role="tabpanel"
                        aria-labelledby="profile-tab">
                        <div class="form-group">
                           <label for="overview_{{ $locale }}">{{ __('Overview') }} ({{ $locale }})</label>
                           <input type="text" class="form-control input-title" id="overview_{{ $locale }}"
                              name="{{ $locale }}[overview]" dir="{{$direction}}" value="{{$showlangdata->overview ?? null}}" >
                        </div>
                        <div class="form-group">
                           @php
                           if(!empty($showlangdata)){
                           $services = $showlangdata->services ;
                           $services = $services
                           ? array_filter(json_decode($services, true))
                           : [];
                          }
                           @endphp
                           <label for="">{{ __('Services') }}
                           ({{ $locale }})</label>
                           <ul class="list-group list-group-flush additional-info-items">
                              @if(!empty($showlangdata))
                              @forelse ($services as $key => $value)
                              <li class="list-group-item additional-info-item">
                                 <a href="javascript:void(0);" class="float-right ai-remove-item text-danger">x</a>
                                 <div class="row">
                                   {{--  <div class="col-4 item-key {{ $direction == 'rtl' ? 'order-1': '' }}">
                                       <input dir="{{$direction}}" placeholder="Key" class="form-control" name="{{ $locale }}[services][key][]" type="text" value="{{$key ?? null}}">
                                    </div> --}}
                                    <div class="col item-value">
                                       <input dir="{{$direction}}" placeholder="Please Enter Services" class="form-control" name="{{ $locale }}[services][value][]" type="text" value="{{$value ?? null}}">
                                    </div>
                                 </div>
                              </li>
                              @empty
                              <li class="list-group-item additional-info-item">
                                 <a href="javascript:void(0);" class="float-right ai-remove-item text-danger">x</a>
                                 <div class="row">
                                    {{-- <div class="col-4 item-key {{ $direction == 'rtl' ? 'order-1': '' }}">
                                       <input dir="{{$direction}}" placeholder="Key" class="form-control" name="{{ $locale }}[services][key][]" type="text">
                                    </div> --}}
                                    <div class="col item-value">
                                       <input dir="{{$direction}}" placeholder="Value" class="form-control" name="{{ $locale }}[services][value][]" type="text">
                                    </div>
                                 </div>
                              </li>
                              @endforelse
                              @else
                              <li class="list-group-item additional-info-item">
                                 <a href="javascript:void(0);" class="float-right ai-remove-item text-danger">x</a>
                                 <div class="row">
                                   {{--  <div class="col-4 item-key {{ $direction == 'rtl' ? 'order-1': '' }}">
                                       <input dir="{{$direction}}" placeholder="Key" class="form-control" name="{{ $locale }}[services][key][]" type="text" value="{{$key ?? null}}">
                                    </div> --}}
                                    <div class="col item-value">
                                       <input dir="{{$direction}}" placeholder="Please Enter Services" class="form-control" name="{{ $locale }}[services][value][]" type="text" value="{{$value ?? null}}">
                                    </div>
                                 </div>
                              </li>
                              @endif
                           </ul>
                            <a href="javascript:void(0);" class="ai-add-more d-block text-right text-sm mt-1">+{{__('Add')}}</a>
                        </div>
                        {{-- 
                        <div class="form-group">
                           <label for="services_{{ $locale }}">{{ __('Services') }}
                           ({{ $locale }})
                           </label>
                           <input type="text" class="form-control input-services" id="services_{{ $locale }}"
                              name="{{ $locale }}[services]" dir="{{$direction}}" value="{{$showlangdata->services}}">
                           <textarea name="{{ $locale }}[services]"
                              id="services_{{ $locale }}" class="form-control input-services"
                              rows="3" dir="{{$direction}}">{{$showlangdata->services}}</textarea>
                        </div>
                        --}}
                     </div>
                     @endforeach
                  </div>
               </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ __('Update') }}
                  {{ ucfirst($user->type_text) }}</button>
                  <a href="{{route('admin.users.index')}}" class="btn btn-primary btn-cancel">{{ __('Cancel') }}</a>
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
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
   $(document).ready(function(){

      $(".ai-add-more").click(function(e) {
          e.preventDefault();

          var parent = $(this).parent();
          var itemContainer = parent.find(".additional-info-items").first();
          var itemClone = parent.find(".additional-info-item").first().clone();
          itemClone.find("input").val("");

          itemContainer.append(itemClone);
       });

       $(".additional-info-items").on("click", ".ai-remove-item", function(e) {
          e.preventDefault();

          var parent = $(this).parents(".additional-info-items");

          if( parent.children().length < 2 ) return;

          $(this).parent().remove();
       });
      /*Shop Edit Part*/
      var allshopids=[];
      var count=1;
      $(document).on('click','.delShopImg',function(){
       var shop_img_count = "<?php echo count($user_company_photos->toArray()); ?>";
       allshopids.push($(this).data('id'));
       $(this).css('color','red')
       confirm_msg = confirm('Are you sure to delete ? ');
       if(confirm_msg){
         del_img_counts=count++;
         rest_img_count = shop_img_count-del_img_counts;
         console.log(rest_img_count);
         $('#images_count').val(rest_img_count);
         $(`#all_shop_images${$(this).data('id')}`).hide();
      }
       $("input[name=pro_shop_img_id]").val(allshopids.join(','));
       $(this).toggleClass("black");
      })
      var shop_img_count = "<?php echo count($user_company_photos->toArray()); ?>";
      rest_img_count = shop_img_count;
      /*for uploadShopImage*/ 
      var upshopids=[];
      var imageContainer = [];
      $(document).on('click','.uploadShopImage',function(){
      upshopids.push($(this).data('shop_img_id'));
   
      $("input[name=updateShopImage]").val(upshopids.join(','));
   
      })
   
      $('#photos').on('change', function(){ 
         var shop_img_count = "<?php echo count($user_company_photos->toArray()); ?>";
           const fi = document.getElementById('photos');
           // alert(fi.files.length );
           var files = $(this)[0].files;
         // alert(product_img_count)
         if (window.File && window.FileReader && window.FileList && window.Blob)
         {
             $("#preview_img").empty();
             var data = $(this)[0].files;
             // data.append(product_img_count) 
             if(fi.files.length <= 5-rest_img_count){
             $('#main_div').show();
             $.each(data, function(index, file){ 
                 if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type) ){ 
                     var fRead = new FileReader(); 
                     fRead.onload = (function(file){ 
                     return function(e) {
                         var img = $('<img/>').addClass('thumb').attr('src', e.target.result); 
                         $('#preview_img').append(img); 
                     };
                     })(file);
                     fRead.readAsDataURL(file); 
                 // }
                }
             });
         }else{
           if(5-rest_img_count == 0){
               alert('Sorry You have exceed your image limit');
           }
           else if(5-rest_img_count == 1){ 
               alert(' Now,You can only upload '+(5-rest_img_count)+ '  image') 
           }else{
               alert(' Now, You can only upload '+(5-rest_img_count)+ '  images') 
           }
           $('#photos').val('');
           $('#main_div').hide();
           // $('#preview_img').html('You cannot exceed your image');
         }
              
         }else{
             alert("Your browser doesn't support File API!"); 
         }
      });
   
   });
</script>
<script type="text/javascript">
   $('#seller_image').change(function(){
           
   let reader = new FileReader();
   
   reader.onload = (e) => { 
   
     $('#preview-image-app-banner').attr('src', e.target.result); 
   }
     reader.readAsDataURL(this.files[0]); 
   });
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/admin.js') }}"></script>
@stop