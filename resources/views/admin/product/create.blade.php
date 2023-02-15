@extends('layouts.admin')
@section('title', __('Product'))
@section('content')
@php
    $required_fields = ['title', 'description'];
@endphp
    <div class="container mb-5">

        <h3 class="mb-4">{{ __('New product') }}</h3>

        <div class="row">
            <div class="col-12 col-sm-8 col-md-6">

                <form class="submit-via-ajax" action="{{ route('admin.product.store') }}" method="post" data-required_fields="{{\json_encode($required_fields)}}" enctype="multipart/form-data">
                    @csrf

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

                    <div class="tab-content mt-4" id="langTabContent">

                        @foreach (frontend_languages() as $language)
                        @php
                            $locale = $language['locale'];
                            $direction = $language['direction'];
                        @endphp

                            <div class="tab-pane fade {{$loop->first ? 'show active':''}}" id="tab{{ $locale }}" role="tabpanel"
                                aria-labelledby="profile-tab">

                                <div class="form-group">
                                    <label for="title_{{ $locale }}">{{ __('Title') }} ({{ $locale }})</label>
                                    <input type="text" class="form-control input-title" id="title_{{ $locale }}"
                                        name="{{ $locale }}[title]" dir="{{$direction}}">
                                </div>

                                <div class="form-group">
                                    <label for="short_description_{{ $locale }}">{{ __('Short description') }}
                                        ({{ $locale }})
                                    </label>
                                    <textarea name="{{ $locale }}[short_description]"
                                        id="short_description_{{ $locale }}" class="form-control input-short_description"
                                        rows="3" dir="{{$direction}}"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description_{{ $locale }}">{{ __('Description') }}
                                        ({{ $locale }})
                                    </label>
                                    <textarea name="{{ $locale }}[description]"
                                        id="description_{{ $locale }}" class="form-control input-description"
                                        rows="5" dir="{{$direction}}"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('Additional info')}}</label>
                                    <ul class="list-group list-group-flush additional-info-items">
                                        <li class="list-group-item additional-info-item">
                                            <a href="javascript:void(0);" class="float-right ai-remove-item text-danger">x</a>
                                            <div class="row">
                                                <div class="col-4 item-key {{ $direction == 'rtl' ? 'order-1': '' }}">
                                                    <input dir="{{$direction}}" placeholder="Key" class="form-control" name="{{ $locale }}[additional_info][key][]" type="text">
                                                </div>
                                                <div class="col item-value">
                                                    <input dir="{{$direction}}" placeholder="Value" class="form-control" name="{{ $locale }}[additional_info][value][]" type="text">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <a href="javascript:void(0);" class="ai-add-more d-block text-right text-sm mt-1">+{{__('Add')}}</a>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="product_category_id">{{ __('Product category') }}</label>
                        <select class="form-control" name="product_category_id" id="product_category_id" required>
                            @foreach ($categories as $category)
                                <optgroup label="{{$category->title}}">
                                    @include('admin.product._categories', ['category' => $category])
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cover_image">{{ __('Cover image') }}</label>
                        <input type="file" name="cover_image" id="cover_image" accept="image/png,image/gif,image/jpeg,image/jpg">
                    </div>

                    <div class="form-group">
                        <label for="gallery">{{ __('More images') }} ({{__('upto 6 only')}})</label>
                        <input type="file" name="gallery[]" id="gallery" accept="image/png,image/gif,image/jpeg,image/jpg" multiple>
                    </div>

                    {{-- <div class="form-group">
                        <label for="price_type">{{ __('Price type') }}</label>
                        <select class="form-control" name="price_type" id="price_type">
                            <option value="fixed">{{ __('Fixed') }}</option>
                            <option value="bid">{{ __('Bid') }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fixed_price">{{ __('Fixed price') }}</label>
                        <input type="text" class="form-control" name="fixed_price" id="fixed_price">
                    </div> --}}

                    <div class="form-group">
                        <label for="country">{{ __('Country of origin') }}</label>
                        <input type="text" class="form-control" name="country" id="country">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="status" id="status" value="1" checked>
                        <label for="status">{{ __('Status') }}</label>
                    </div>

                    <div class="form-group">
                      <div id="main_div" style="display:none">
                         <p> <strong>{{__('Uploading Image:')}}</strong></p>
                      </div>
                      <div class="row" id="preview_img" style="margin-top:40px"></div><br>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
   
      $('#gallery').on('change', function(){ 
        // alert();
         const fi = document.getElementById('gallery');
         var files = $(this)[0].files;
         if (window.File && window.FileReader && window.FileList && window.Blob)
         {
            $("#preview_img").empty();
            var data = $(this)[0].files; 
            if(fi.files.length){
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
                  }
               });
            }
         }else{
             alert("Your browser doesn't support File API!"); 
         }
      });
   
   });
</script>
@stop
