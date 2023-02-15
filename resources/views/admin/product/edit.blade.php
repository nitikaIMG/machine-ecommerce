@extends('layouts.admin')
@section('title', __('Product'))
@section('content')
    @php
    $required_fields = ['title', 'description'];
    @endphp
    <div class="container mb-5">
        <h3 class="mb-4">{{ __('Edit product') }}</h3>
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6">
                <form class="submit-via-ajax" action="{{ route('admin.product.update', ['us_product' => $product->id]) }}"
                    method="post" data-required_fields="{{ \json_encode($required_fields) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <ul class="nav nav-tabs" id="langTab" role="tablist">
                        @foreach (frontend_languages() as $language)
                            @php
                                $locale = $language['locale'];
                                $title = $language['title'];
                            @endphp
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                    href="#tab{{ $locale }}" role="tab" aria-controls="{{ $locale }}"
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
                                $product->setDefaultLocale($locale);
                            @endphp
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab{{ $locale }}"
                                role="tabpanel" aria-labelledby="profile-tab">
                                <div class="form-group">
                                    <label for="title_{{ $locale }}">{{ __('Title') }}
                                        ({{ $locale }})</label>
                                    <input type="text" class="form-control input-title" id="title_{{ $locale }}"
                                        name="{{ $locale }}[title]" dir="{{ $direction }}"
                                        value="{{ $product->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="short_description_{{ $locale }}">{{ __('Short description') }}
                                        ({{ $locale }})
                                    </label>
                                    <textarea name="{{ $locale }}[short_description]" id="short_description_{{ $locale }}"
                                        class="form-control input-short_description" rows="3"
                                        dir="{{ $direction }}">{{ $product->short_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description_{{ $locale }}">{{ __('Description') }}
                                        ({{ $locale }})
                                    </label>
                                    <textarea name="{{ $locale }}[description]" id="description_{{ $locale }}"
                                        class="form-control input-description" rows="5"
                                        dir="{{ $direction }}">{{ $product->description }}</textarea>
                                </div>

                                <div class="form-group">
                                   @php
                                       $additional = $product->additional_info
                                          ? array_filter(json_decode($product->additional_info, true))
                                          : [];
                                   @endphp
                                    <label for="">{{__('Additional info')}}</label>
                                    <ul class="list-group list-group-flush additional-info-items">
                                       @forelse ($additional as $key => $value)

                                       <li class="list-group-item additional-info-item">
                                          <a href="javascript:void(0);" class="float-right ai-remove-item text-danger">x</a>
                                          <div class="row">
                                                <div class="col-4 item-key {{ $direction == 'rtl' ? 'order-1': '' }}">
                                                   <input dir="{{$direction}}" placeholder="Key" class="form-control" name="{{ $locale }}[additional_info][key][]" type="text" value="{{$key}}">
                                                </div>
                                                <div class="col item-value">
                                                   <input dir="{{$direction}}" placeholder="Value" class="form-control" name="{{ $locale }}[additional_info][value][]" type="text" value="{{$value}}">
                                                </div>
                                          </div>
                                       </li>

                                       @empty

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

                                       @endforelse
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
                                <optgroup label="{{ $category->title }}">
                                    @include('admin.product._categories', [
                                        'category' => $category,
                                    ])
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cover_image">{{ __('Cover image') }}</label>
                        <input type="file" name="cover_image" id="cover_image"
                            accept="image/png,image/gif,image/jpeg,image/jpg">
                    </div>
                    <input type="hidden" name="pro_img_id" id="pro_img_id" value="">
                    <input type="hidden" name="updateImage" id="updateImage" value="">
                    <input type="hidden" name="pro_images_count" id="pro_images_count" value="">
                    <div class="form-group">
                        <label for="gallery">{{ __('More images') }} ({{ __('upto 6 only') }})</label>
                        <input type="file" name="gallery[]" id="gallery" accept="image/png,image/gif,image/jpeg,image/jpg"
                            multiple>
                        <p></p>
                        @if (count($product_images) > 0)
                            <p> <strong>{{ __('Product Images') }}:</strong></p>
                            <div class="flex">
                                @foreach ($product_images as $pro)
                                    <div id="all_images{{ $pro->id }}">
                                        <img src="{{ asset("storage/{$pro->image}") }}"
                                            style="max-height: 125px; max-width:450px ;">
                                        <input type="file" class=" form-control col-12 uploadImage "
                                            data-pimg_id="{{ $pro->id }}" placeholder="Upload Product Image*"
                                            name="gallerys[]" id="id_upload" autocomplete="false">
                                        {{-- end --}}
                                        <i class="fas fa-trash del" data-id="{{ $pro->id }}"></i>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <p></p>
                        <div id="main_div" style="display:none">
                            <p id="upload_div"> <strong>{{ __('Uploading Image:') }}</strong></p>
                        </div>
                        <div class="row" id="preview_img" style="margin-top:40px">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="price_type">{{ __('Price type') }}</label>
                        <select class="form-control" name="price_type" id="price_type">
                            <option value="fixed" {{ $product->price_type == 'fixed' ? 'selected' : '' }}>
                                {{ __('Fixed') }}</option>
                            <option value="bid" {{ $product->price_type == 'bid' ? 'selected' : '' }}>{{ __('Bid') }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fixed_price">{{ __('Fixed price') }}</label>
                        <input type="text" class="form-control" name="fixed_price" id="fixed_price"
                            value="{{ $product->fixed_price }}">
                    </div> --}}
                    <div class="form-group">
                        <label for="country">{{ __('Country of origin') }}</label>
                        <input type="text" class="form-control" name="country" id="country"
                            value="{{ $product->country }}">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="status" id="status" value="1" {{ $product->status ? 'checked' : '' }}>
                        <label for="status">{{ __('Status') }}</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
   $(document).ready(function() {
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
    
       var allids = [];
       var count = 1;
       $(document).on('click', '.del', function() {
           var product_img_count = "<?php echo count($product_images->toArray()); ?>";
           allids.push($(this).data('id'));
           $(this).css('color', 'red')
           confirm_msg = confirm('Are you sure to delete ? ');
           if (confirm_msg) {
               delete_img_counts = count++;
               rest_image_count = product_img_count - delete_img_counts;
               console.log(rest_image_count);
               $('#pro_images_count').val(rest_image_count);
               $(`#all_images${$(this).data('id')}`).hide();
           }
           $("input[name=pro_img_id]").val(allids.join(','));
           $(this).toggleClass("black");
       })
       var product_img_count = "<?php echo count($product_images->toArray()); ?>";
       rest_image_count = product_img_count;

       /*for update img */
       var upids = [];
       var imageContainer = [];
       $(document).on('click', '.uploadImage', function() {
           upids.push($(this).data('pimg_id'));
           // alert($(this).data('pimg_id'))
           $("input[name=updateImage]").val(upids.join(','));
       })

       $('#gallery').on('change', function() {
           var product_img_count = "<?php echo count($product_images->toArray()); ?>";
           const fi = document.getElementById('gallery');
           // alert(fi.files.length );
           var files = $(this)[0].files;
           // alert(product_img_count)
           if (window.File && window.FileReader && window.FileList && window.Blob) {
               $("#preview_img").empty();

               var data = $(this)[0].files;
               // data.append(product_img_count) 
               if (fi.files.length <= 6 - rest_image_count) {
                   $('#main_div').show();
                   $.each(data, function(index, file) {
                       // alert(6 - product_img_count)
                       if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                           var fRead = new FileReader();
                           fRead.onload = (function(file) {
                               return function(e) {
                                   var img = $('<img/>').addClass('thumb').attr(
                                       'src', e.target.result);
                                   $('#preview_img').append(img);
                               };
                           })(file);
                           fRead.readAsDataURL(file);
                           // }
                       }
                   });
               } else {
                   if (6 - rest_image_count == 0) {
                       alert('Sorry You have exceed your image limit');
                   } else if (6 - rest_image_count == 1) {
                       alert(' Now,You can only upload ' + (6 - rest_image_count) + '  image')
                   } else {
                       alert(' Now, You can only upload ' + (6 - rest_image_count) + '  images')
                   }
                   $('#gallery').val('');
                   $('#main_div').hide();
                   // $('#preview_img').html('You cannot exceed your image');
               }

           } else {
               alert("Your browser doesn't support File API!");
           }
       });

   });
</script>
@endsection