@extends('layouts.admin')
@section('title', __('Ads'))
@section('content')
<section class="all_ads_page">
   <section class="ads_presen_top">
      <div class="container">
         <div class="tabcontent_block">
            <div class="google_custom_ads">
               <h1 class="ads_common_heading"> {{ __('ADS presentation') }}</h1>
               <label class="switch">
               @if(!empty($ad_set))
               <input type="checkbox" class="toggle-class" {{ $ad_set->is_enable ? 'checked' : '' }}>
               <span class="slider round"></span>
               @endif
             {{--   @else
               <input type="checkbox" class="toggle-class">
               <span class="slider round"></span>
               @endif --}}
               </label>
              
            </div>
           
         </div>
      </div>
   </section>
   <div class="container">
      <div class="dash_tabs">
         <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'Text_type_Ad')" id="defaultOpen">{{ __('Text Ads') }}</button>
            <button class="tablinks" onclick="openCity(event, 'Image_type_Ad')">{{ __('Image Ads') }}</button>
            <button class="tablinks" onclick="openCity(event, 'Url_type_Ad')">{{ __('URL Ads') }}</button>
         </div>
         {{-- text ad --}} 
         <div id="Text_type_Ad" class="tabcontent">
            <form id="text_form" enctype="multipart/form-data" action="{{route('admin.ads.store')}}" method="post">
               @csrf
               <div class="tabcontent_block" >
                  <h1 class="ads_common_heading">{{ __('Text ads') }}</h1>
                  <div class="addmore_btns" id="dynamicAddRemove">
                     <div class="space_for_div">
                        <div class="ads_input_group">
                           <h2 class="gca_heading">{{ __('Ad title') }}</h2>
                           <div class="custom_input_input">
                              <input type="text" name="ad_title[]"  id="ad_title[]" class="custom_input" placeholder="Please select">
                              <input type="hidden" name="textAds" value="textAds">
                              <input type="hidden" name="active_ad_show_text[]" id="active_ad_show_text" value="">
                              <span class="text-danger span-flush error-text-span error-text_0 ad_title_error"></span>
                           </div>
                        </div>
                        <div class="ads_input_group">
                           <h2 class="gca_heading">{{ __('Ad description') }}</h2>
                           <div class="custom_input_input">
                              <textarea type="text" name="ad_desc[]" id="ad_desc" class="custom_input" rows="4" cols="55" placeholder="Feedback / Suggestion"></textarea>
                              <span class="text-danger span-flush error-text_t_0 ad_desc_error"></span>
                           </div>
                        </div>
                        <div class="addmore_btns_dynamic">
                        </div>
                     </div>
                  </div>
                  <a type="button" name="add" id="add-btn" class="extra-fields-btns">{{ __('Add More') }}</a>
               </div>
               <div class="tabcontent_block no_border">
                  <table class="table table-bordered ads_table">
                     <thead>
                        <tr>
                        <th> {{ __('Ads type') }}    </th>
                        <th> {{ __('Title') }}       </th>
                        <th> {{ __('Description') }} </th>
                        <th> {{ __('Image') }}       </th>
                        <th> {{ __('URL') }}         </th>
                        <th> {{ __('Active') }}      </th>
                        </tr>
                     </thead>
                     <tbody>
                        @if ($allAdsData->count() >0)
                        @foreach ($allAdsData as $ads)
                        <tr>
                           <td class="text-center">{{ $ads->type }} AD</td>
                           <td class="text-center">{{$ads->title}}</td>
                           <td class="text-center">{{$ads->description}}</td>
                           <td class="text-center">@if($ads->type=="Image")<img src="{{ asset("storage/{$ads->image}") }}" alt="{{ $ads->id }}"
                              width="50"> @endif
                           </td>
                           <td class="text-center"><a href="{{$ads->url}}">{{$ads->url}}</a></td>
                           <td class="text-center">
                              <label class="container_bundle">
                              @if($ads->status)
                              <input class="bundle text-ad" name="text_radio"  data-id="{{$ads->id}}" value="{{$ads->id}}" type="radio"  checked>
                              @else
                              <input class="bundle text-ad" name="text_radio"  data-id="{{$ads->id}}" value="" type="radio"  >
                              @endif
                              <input type="hidden" name="text_radio_val" id="text_radio" value="">
                              <span class="checkmark_bundle"></span>
                              </label>
                           </td>
                        </tr>
                       
                        @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
               <div class="footer_btns">
                  <button class="ads_btn_cancel">{{ __('Cancel') }}</button>
                  <button class="ads_btn_save">{{ __('Save') }}</button>
               </div>
            </form>
         </div>
         {{-- end --}}
         {{-- image --}}
         <div id="Image_type_Ad" class="tabcontent"  >
            <form id="img_form" enctype="multipart/form-data" action="{{route('admin.ads.store')}}" method="post">
               @csrf
               <div class="tabcontent_block"  >
                  <h1 class="ads_common_heading">{{ __('Image ads') }}</h1>
                  <div class="addmore_btns" id="dynamicAddRemoveImg">
                     <div class="space_for_div">
                        <div class="ads_input_group">
                           <h2 class="gca_heading">{{ __('Ad title') }}</h2>
                           <div class="custom_input_input">
                              <input type="text" name="ad_img_title[]" id="ad_img_title[]" class="custom_input" placeholder="Please select">
                              <input type="hidden" name="imgAds" value="imgAds">
                              <input type="hidden" name="active_ad_show_img[]" id="active_ad_show_img" value="">
                              {{-- <span class="text-danger error-text ad_img_title_error.0"></span> --}}
                              <span class="text-danger span-flush error-text-img error-text_img_0 ad_img_title_error"></span>
                           </div>
                        </div>
                        <div class="ads_input_group">
                           <h2 class="gca_heading">{{ __('Upload image') }}</h2>
                           <div class="upload_btn_wrapper">
                              Please select
                              <button class="btn_upload">{{ __('Upload') }}</button>
                              <input type="file" name="ad_img_upload[]" id="ad_img_upload" />
                           </div>
                           <div class="col-md-6 pl-4">
                              <img id="preview-image-app-banner" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" 
                                 alt="preview image" style="max-height: 162px; max-width:350px ;margin-left: -24px;">
                           </div>
                           <p class="dmnt_type"><span>{{__('Dimensions:')}}</span> 720 px X 100 px</p>
                           <p class="dmnt_type"><span>{{__('File type allowed:')}}</span>  jpeg, jpg, png.</p>
                           <span class="text-danger span-flush error-text-img error-text_imgt_0 ad_img_upload_error"></span>
                        </div>
                        <div class="addmore_btns_dynamic">
                        </div>
                     </div>
                  </div>
                  <a type="button" name="add" id="add-btn-img" class="extra-fields-btns">{{ __('Add more') }}</a>
               </div>
               <div class="tabcontent_block no_border">
                  <table class="table table-bordered ads_table">
                     <thead>
                        <tr>
                           
                           <th>{{ __('Image') }}</th>
                           <th>{{ __('Active') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if ($imgadsData->count() >0)
                        @foreach ($imgadsData as $ads)
                        <tr>
                          
                           <td class="text-center">  <img src="{{ asset("storage/{$ads->image}") }}" alt="{{ $ads->id }}"
                              width="50">
                           </td>
                           <td class="text-center">
                              <label class="container_bundle">
                              {{-- <input class="bundle" type="radio" name="radio" checked> --}}
                              @if($ads->status)
                              <input class="bundle image-ad" type="radio" name="image_radio"  data-id="{{$ads->id}}" value="" checked>
                              @else
                              <input class="bundle image-ad" type="radio" name="image_radio"  data-id="{{$ads->id}}" value="" >
                              @endif
                              <input type="hidden" name="image_radio_val" id="image_radio" value="">
                              <span class="checkmark_bundle"></span>
                              </label>
                           </td>
                        </tr>
                       
                        @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
               <div class="footer_btns">
                  <button class="ads_btn_cancel">{{ __('Cancel') }}</button>
                  <button class="ads_btn_save">{{ __('Save') }}</button>
               </div>
            </form>
         </div>
         {{-- end --}}
         {{-- url ad --}}
         <div id="Url_type_Ad" class="tabcontent">
            <form id="url_form" enctype="multipart/form-data" action="{{route('admin.ads.store')}}" method="post">
               @csrf
               <div class="tabcontent_block" >
                  <h1 class="ads_common_heading">{{ __('URL ads') }}</h1>
                  <div class="addmore_btns"id="dynamicAddRemoveURL">
                     <div class="space_for_div">
                        <div class="ads_input_group">
                           <h2 class="gca_heading">{{ __('Ad title') }}</h2>
                           <div class="custom_input_input">
                              <input type="text" name="ad_url_title[]"  id="ad_url_title" class="custom_input" placeholder="Please select">
                              <input type="hidden" name="active_ad_show_url[]" id="active_ad_show_url" value="">
                              <input type="hidden" name="urlAds" value="urlAds">
                              <span class="text-danger error-text ad_url_title_error"></span>
                              <span class="text-danger span-flush  error-text-url error-text_url_0 ad_url_title_error"></span>
                           </div>
                        </div>
                        <div class="ads_input_group">
                           <h2 class="gca_heading">{{ __('Ad url') }}</h2>
                           <div class="custom_input_input">
                              <input type="text" name="ad_url[]" class="custom_input" placeholder="Type here">
                              <span class="text-danger span-flush error-text-urll error-text_urll_0 ad_url_error"></span>
                           </div>
                        </div>
                        <div class="addmore_btns_dynamic">
                        </div>
                     </div>
                  </div>
                  <a type="button" name="add" id="add-btn-url" class="extra-fields-btns">{{ __('Add More') }}</a>
               </div>
               <div class="tabcontent_block no_border">
                  <table class="table table-bordered ads_table">
                     <thead>
                        <tr>
                           {{-- 
                           <th>ID</th>
                           <th>Title</th>
                           --}}
                           <th>{{ __('URL') }}</th>
                           <th>{{ __('Active') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if ($urladsData->count() >0)
                        @foreach ($urladsData as $ads)
                        <tr>
                          
                           <td class="text-center"><a href="{{$ads->url}}"> {{$ads->url}}</a></td>
                           <td class="text-center">
                              <label class="container_bundle">
                              @if($ads->status)
                              <input class="bundle url-ad" type="radio" name="url_radio"  data-id="{{$ads->id}}" value="" checked>
                              @else
                              <input class="bundle url-ad" type="radio" name="url_radio"  data-id="{{$ads->id}}" value="" >
                              @endif
                              <input type="hidden" name="url_radio_val" id="url_radio" value="">
                              <span class="checkmark_bundle"></span>
                              </label>
                           </td>
                        </tr>
                     
                        @endforeach
                        @endif
                     </tbody>
                  </table>
               </div>
               <div class="footer_btns">
                  <button class="ads_btn_cancel">{{ __('Cancel') }}</button>
                  <button class="ads_btn_save">{{ __('Save') }}</button>
               </div>
            </form>
         </div>
         {{-- end --}}
      </div>
   </div>
</section>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
   $(function(){

      $("#text_form").on('submit', function(e){
         e.preventDefault();
         $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.span-flush').text('');
            },
            success:function(data){
               console.log(data);
               if(data.status == 0){
                  var i=0;
                  $.each(data.error, function(prefix, val){
                     // alert('error-text_'+i);
                     var parts = prefix.split(".");
                     var result = parts[parts.length - 1]; 
                       console.log(val);
                        if((val[0]).includes("title")){
                         $('span.error-text_'+result).text(val[0]);
                        }else{
                           $('span.error-text_t_'+result).text(val[0]);
                        }
                  });
                }else{
                  $('#text_form')[0].reset();
                  if(data.msg){
                     alert(data.msg);
                     setInterval(function () {
                      // alert("Hello");
                     }, 3000);
                     if(data.redirectvalue==0)
                     window.location.reload();
                     else
                     window.location = '{{ route('admin.ads.index') }}';

                  }
               }
            }
         });
      });
      
      $("#img_form").on('submit', function(e){
         e.preventDefault();
         $.ajax({
               url:$(this).attr('action'),
               method:$(this).attr('method'),
               data:new FormData(this),
               processData:false,
               dataType:'json',
               contentType:false,
               beforeSend:function(){
                  $(document).find('span.span-flush').text('');
               },
               success:function(data){
                  console.log(data);
                   if(data.status == 0){
                     var i=0;
      
                       $.each(data.error, function(prefix, val){
                          // $('span.'+'ad_img_title'+'_error'+'.'+i+'').text(val[0]);
                          var parts = prefix.split(".");
                          var result = parts[parts.length - 1]; // Or parts.pop();
                        // alert(result)
                        console.log(val);
                           if((val[0]).includes("title")){
                            $('span.error-text_img_'+result).text(val[0]);
                           }if(val[0].includes('upload')){
                              // alert('sor')
                               $('span.error-text_imgt_'+result).text(val[0]);
                           }
      
                           else{
                              $('span.error-text_img_t_'+result).text(val[0]);
                           }
                           // $('span.'+prefix+'_error').text(val[0]);
                           // $('span.error-text_img_'+result).text(val[0]);
      
                           // ['+prefix+i']
                           // i++;
                       });
                   }else{
                       $('#img_form')[0].reset();
                        if(data.msg){
                        alert(data.msg);
                        setInterval(function () {
                         // alert("Hello");
                        }, 3000);

                       if(data.redirectvalue==0)
                       window.location.reload();
                       else
                       window.location = '{{ route('admin.ads.index') }}';

                       }
                   }
               }
            });
      });
      
      $("#url_form").on('submit', function(e){
           e.preventDefault();
           $.ajax({
               url:$(this).attr('action'),
               method:$(this).attr('method'),
               data:new FormData(this),
               processData:false,
               dataType:'json',
               contentType:false,
               beforeSend:function(){
                  $(document).find('span.span-flush').text('');
               },
               success:function(data){
                  console.log(data);
                   if(data.status == 0){
                       $.each(data.error, function(prefix, val){
                           var parts = prefix.split(".");
                           var result = parts[parts.length - 1]; // Or parts.pop();
                           console.log(val);
                           if((val[0]).includes("title")){
                            $('span.error-text_url_'+result).text(val[0]);
                           }else{
                              $('span.error-text_urll_'+result).text(val[0]);
                           }
                       });
                   }else{
                     $('#url_form')[0].reset();
                     if(data.msg){
                        alert(data.msg);
                        setInterval(function () {
                         // alert("Hello");
                        }, 3000);

                        if(data.redirectvalue==0)
                        window.location.reload();
                        else
                        window.location = '{{ route('admin.ads.index') }}';
                     
                     }
                  }
               }
            });
      }); 
   })
</script>
<script type="text/javascript">
   var i = 0;
   $("#add-btn").click(function(){
   ++i;
   $content=`   <div class="space_for_div">
   <div class="ads_input_group">
     <h2 class="gca_heading">Ad Title</h2>
     <div class="custom_input_input">
         <input type="text" name="ad_title[]" class="custom_input" placeholder="Please select">
         <span class="text-danger span-flush error-text-span error-text_`+i+` ad_title_error"></span>
     </div>
   </div>
   <div class="ads_input_group">
     <h2 class="gca_heading">Ad Description</h2>
     <div class="custom_input_input">
         <textarea type="text" name="ad_desc[]" class="custom_input" rows="4" cols="55" placeholder="Feedback / Suggestion"></textarea>
         <span class="text-danger span-flush error-text_t_`+i+` ad_desc_error"></span>
     </div>
   </div> <a class=" btn-remove-customer remove-tr">Remove</a> </div> `;
   $("#dynamicAddRemove").append($content);
   });
   $(document).on('click', '.remove-tr', function(){  
      // alert();
   $(this).parents('.space_for_div').remove()
   });  
</script>
{{-- url --}}
<script type="text/javascript">
   var i = 0;
   $("#add-btn-url").click(function(){
   ++i;
   $content=`<div class="space_for_div"> <div class="ads_input_group">
              <h2 class="gca_heading">Add Title</h2>
              <div class="custom_input_input">
               <input type="text" name="ad_url_title[]"  id="ad_url_title" class="custom_input" placeholder="Please select">
               <span class="text-danger span-flush error-text-url error-text_url_`+i+` ad_url_title_error"></span>
              </div>
          </div>
          <div class="ads_input_group">
              <h2 class="gca_heading">Add URL</h2>
              <div class="custom_input_input">
                  <input type="text" name="ad_url[]" class="custom_input" placeholder="Type here">
                  <span class="text-danger span-flush error-text-urll error-text_urll_`+i+` ad_url_error"></span>
              </div>
          </div> <a class=" btn-remove-customer remove-tr">Remove</a></div>`;
   $("#dynamicAddRemoveURL").append($content);
   });
   $(document).on('click', '.remove-tr', function(){  
   $(this).parents('.space_for_div').remove();
   });  
</script>
{{-- end --}}
{{-- image ad --}}
<script type="text/javascript">
   var i = 0;
   $("#add-btn-img").click(function(){
   ++i;
   test(i);
   $content=`<div class="space_for_div">  <div class="ads_input_group">
   <h2 class="gca_heading">Add Title</h2>
   <div class="custom_input_input">
      <input type="text" name="ad_img_title[]" id="ad_img_title[]" class="custom_input" placeholder="Please select">
      <input type="hidden" name="imgAds" value="imgAds">
      <input type="hidden" name="active_ad_show_img[]" id="active_ad_show_img" value="">
      <span class="text-danger span-flush  error-text-img error-text_img_`+i+` ad_img_title_error"></span>
   </div>
   </div>
   <div class="ads_input_group">
   <h2 class="gca_heading">Upload Image</h2>
   <div class="upload_btn_wrapper">
      Please select
      <button class="btn_upload">Upload</button>
      <input type="file" name="ad_img_upload[]" class="ad_img_upload" value="`+i+`" />
   </div>
      <div class="col-md-6 pl-4">
      <img class="preview-image-app-banner2`+i+`" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" value="no"
         alt="preview image" style="max-height: 162px; max-width:350px ;margin-left: -24px;">
     </div>
      <p class="dmnt_type"><span>Dimensions:</span> 720 px X 100 px</p>
      <p class="dmnt_type"><span>File type allowed:</span>  jpeg, jpg, png.</p>
      <span class="text-danger span-flush error-text-img error-text_imgt_`+i+` ad_img_upload_error"></span>
   </div> <a class="btn-remove-customer remove-tr">Remove</a></div>`;
   $("#dynamicAddRemoveImg").append($content);
   });
   $(document).on('click', '.remove-tr', function(){  
   $(this).parents('.space_for_div').remove();
   });  
</script>
{{-- end --}}
<script type="text/javascript">
   function test(i){
   $(document).on('change','.ad_img_upload',function(){
   let reader = new FileReader();
   reader.onload = (e) => { 
   // alert($('.preview-image-app-banner2'+i+'').attr('value'))
   
      if($(this).attr('value') == i){
         var abc =$(this).parent().next().html("<img class='preview-image-app-banner2"+i+"' src='https://www.riobeauty.co.uk/images/product_image_not_found.gif' value='no' alt='preview image' style='max-height: 162px; max-width:350px ;margin-left: -24px;'>");
         
         if($('.preview-image-app-banner2'+i+'').attr('value')=="no"){
           $('.preview-image-app-banner2'+i+'').attr('value', 'yes'); 
         
           $('.preview-image-app-banner2'+i+'').attr('src', e.target.result); 
         }
      }
   }
   reader.readAsDataURL(this.files[0]); 
   })
   }
</script>
<script type="text/javascript">
   $('#ad_img_upload').change(function(){   
   let reader = new FileReader();
   reader.onload = (e) => { 
   $('#preview-image-app-banner').attr('src', e.target.result); 
   }
   reader.readAsDataURL(this.files[0]); 
   });
</script>
<script>
   function openCity(evt, cityName) {
       var i, tabcontent, tablinks;
       tabcontent = document.getElementsByClassName("tabcontent");
       for (i = 0; i < tabcontent.length; i++) {
           tabcontent[i].style.display = "none";
       }
       tablinks = document.getElementsByClassName("tablinks");
       for (i = 0; i < tablinks.length; i++) {
           tablinks[i].className = tablinks[i].className.replace(" active", "");
       }
       document.getElementById(cityName).style.display = "block";
       evt.currentTarget.className += " active";
   }
   
   // Get the element with id="defaultOpen" and click on it
   document.getElementById("defaultOpen").click();
</script>
<script src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- new js 23-02-2022 -->
<script>
   $(document).ready(function(){
       $("input[name='text_radio']").click(function(){
        // alert();
        var val=$(this).attr('data-id');
        // alert(val);
        $('.text-ad').val(val);
     });
   
     $("input[name='image_radio']").click(function(){
        // alert();
        var val=$(this).attr('data-id');
        // alert(val);
        $('.image-ad').val(val);
     });
   
     $("input[name='url_radio']").click(function(){
        // alert();
        var val=$(this).attr('data-id');
        // alert(val);
        $('.url-ad').val(val);
     });
     
     
   });
</script>
<script>
   $(function() {
     $('.toggle-class').change(function() {
         var status = $(this).prop('checked') == true ? 1 : 0; 
         $.ajax({
             type: "GET",
             dataType: "json",
             url: '{{url('admin/changeShowStatus')}}',
             data: {'status': status},
             success: function(data){
               toastr.options.timeOut = 20000;
               toastr.options.positionClass = 'toast-top-right';
               toastr.success(data.success);
               window.location.reload();
            }
         });
     })
   })
</script>
<script type="text/javascript">
   $(function () {
      $("#ads_type").change(function () {
           var selectedText = $(this).find("option:selected").text();
           var selectedValue = $(this).val();
           alert("Selected Text: " + selectedText + " Value: " + selectedValue);
           $('#active_ad_show_url').val(selectedValue);
           $('#active_ad_show_img').val(selectedValue);
           $('#active_ad_show_text').val(selectedValue);
      });
   });
</script>
@endsection