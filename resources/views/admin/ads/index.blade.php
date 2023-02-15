@extends('layouts.admin')
@section('title', __('Ads'))
@section('content')
<section class="all_ads_page">
<div class="container">
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
                        <span class="text-danger error-text-span error-text_0 ad_title_error"></span>
                     </div>
                  </div>
                  <div class="ads_input_group">
                     <h2 class="gca_heading">{{ __('Ad description') }}</h2>
                     <div class="custom_input_input">
                        <textarea type="text" name="ad_desc[]" id="ad_desc" class="custom_input" rows="4" cols="55" placeholder="Feedback / Suggestion"></textarea>
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
                        @if($ads->status==1)
                        <input class="bundle text-ad" name="text_radio"  data-id="{{$ads->id}}" value="" type="radio"  checked>
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
            <button class="ads_btn_cancel">{{ __('Cancel') }} </button>
            <button class="ads_btn_save">{{ __('Save') }}</button>
         </div>
      </form>
   </div>
</div>
@endsection