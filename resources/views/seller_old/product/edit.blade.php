@extends('layouts.vendor')
@section('title', __('Product'))
@section('content')
   
    <div class="container mb-5">
        <h3 class="mb-4">{{ __('Edit product') }}</h3>
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6">
                <form  action="{{ route('seller.product.update', ['us_product' => $product->id]) }}"
                    method="post"  enctype="multipart/form-data">
                    @csrf
                   
                   @method('PATCH')

                   <input type="hidden" name="product_id" value="{{$product->id}}">

                   <input type="hidden" name="seller_id" value="{{Auth()->user()->id ?? null}}">

                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input class="form-control"  value="{{$product->title ?? 'N/A'}}" type="text" name="title" id="title"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <input class="form-control"  value="{{$product->description ?? 'N/A'}}" type="text" name="description" id="description"
                            readonly>
                    </div>
                  
                    
                    <div class="form-group">
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
                    </div>

                     <div class="form-group">
                        <label for="shop">{{ __('Shop') }}</label>
                        <select class="form-control" name="shops" id="shops">
                            <option value="">Please Select Shop</option>
                            @foreach ($shop_datas as $shops)
                            <option value="{{$shops->id}}">{{$shops->shop_name}}</option>
                            @endforeach
                           
                        </select> 
                        @error('shops')
                        <span class="invalid-feedback" style="display:block" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                  

                    <div class="form-group">
                        <label for="quantity">{{ __('Quantity') }}</label>
                        <input type="text" class="form-control" name="quantity" id="quantity">
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