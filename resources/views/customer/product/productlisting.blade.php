@extends('customer.layouts.main')
@push('custom_css')
@endpush
@section('content')
<section class="tabs-wrapper">
   <div class="container">
      <div class="row">
         @forelse($productlisting as $item)
            <div class="col-lg-3 col-md-6 col-12">
               <div class="electrical-box-wrapper">
                  <div class="electrical-item whitebg-border-box">
                     <a id="favourite_product{{ $item['id'] }}" onclick="favourite_product({{ $item['id'] }})"> 
                        <span class="{{ ($item['is_favourite']==true)?'heart-icon':'grey-heart-icon' }}">
                              <i class="fa fa-heart"></i>
                        </span>
                       
                     </a>
                     <a  onclick="add_product( {{ $item['id'] }} )" >
                     <span class="plus_icon">
                              +
                        </span>
                     </a>
                        <a href="{{route('productdetails',['product_id'=>$item['id'],'catid'=>$catid,'shop_id'=>$shop_id])}}" class="anchor-link">

 			               <img src="{{$item['image']}}" alt="item-1" class="img-fluid">
                     </a>

                    
                  </div>
                  <div class="electrical-item-content">
                     <div class="electrical-item-subtitle">
                        <div class="products-name">
                           <a href="{{route('productdetails',['product_id'=>$item['id'],'catid'=>$catid,'shop_id'=>$shop_id])}}" class="anchor-link">
                              {{$item['title']}} 
                           </a>
                        </div>
                        <!-- <div class="products-name">
                           {{$item['short_description']}}
                        </div> -->
                        <div class="current-type mt-2">{{$item['currency']}}
                           <strong>{{$item['price']}}</strong>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @empty
            <p>No Product Added</p>
         @endforelse
      </div>
   </div>
</section>
@endsection
@push('custom_js')
   <script>
      function favourite_product(id) {
         $.ajax({
            url: "{{ url('add-to-favorite-product') }}" + '/' + id,
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'get',
            dataType: 'json',
            success: function(data) {
               if(data['data']['is_favourite']){
                     $("#favourite_product"+ '' + id).html('<span class="heart-icon"><i class="fa fa-heart"></i></span>');
                     
               }else{
                  $("#favourite_product"+ '' + id).html('<span class="grey-heart-icon"><i class="fa fa-heart"></i></span>');
               }
               
               if(data.status == 1){
                     swal(data.message, {
                     icon: "success",
               });
               }else{
                     swal(data.message, {
                     icon: "warning",
               });
               }

            },
            cache: false,
            contentType: false,
            processData: false,
         });       
      };
   </script>
   <script>
      function add_product(id) {
        
         $.ajax({
            url: "{{ url('add-to-cart') }}" + '/ajax/' + id,
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type: 'get',
            dataType: 'json',
            success: function(data) {
               
               
               if(data.status == 1){
                     swal(data.message, {
                     icon: "success",
               });
               }else{
                     swal(data.message, {
                     icon: "warning",
               });
               }

            },
            cache: false,
            contentType: false,
            processData: false,
         });       
      };
   </script>
@endpush