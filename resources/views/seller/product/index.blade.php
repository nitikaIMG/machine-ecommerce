@extends('seller.layouts.vendor')
@section('title', 'Manage Shop')
@section('pageheading')
{{__('Manage Shop')}}
@endsection
@section('content')

<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p-3" id="myTab">
            <div class="header">
               <form>
                  <div class="row">
                     <div class="col-md-4 col-lg-4">
                        <div class="title">{{__('Products') }}</div>

                     </div>
		               @if (session('success'))
                        <span style="color:green">{{ session('success') }}</span>
                     @else
                        <span style="color:red">{{ session('error') }}</span>
                     @endif
                  </div>
               </form>
            </div>

            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="News" role="tabpanel" aria-labelledby="News-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">{{__('Request ID') }}</th>
                              <th scope="col">{{__('Title')}}</th>
                              <th scope="col">{{__('Category')}}</th>
                              
                              <th scope="col">{{__('Created at')}}</th>
                              <th scope="col" class="text-center">{{__('Actions')}}</th>
                           </tr>
                        </thead>
                        <tbody>
                            @forelse($subCategory as $sub)
                            @forelse($sub->products->unique() as $product)  
                           <tr>
                           <td>{{$product->id}}</td>
                                    <td>{{$product->title ?? 'NA'}}</td>
                                    <td>{{$product->product_category->title ?? 'NA'}}</td>
                              @if(!empty($product->created_at))
                              <td>{{$product->created_at->format('Y/m/d') }}</td>
                              @else
                              <td>{{'NA'}}</td>
                              @endif
                              <td>
                                 <a href="{{ route('seller.product.edit.category',[$product->id,$shop_id,$cat]) }}" class="accept">{{ __('Edit')}}</a>
                              </td>
                           </tr>
                           @empty
                           @endforelse
                           @empty
                           <tr>
                              <td colspan="5">{{ __('There is no data.') }}</td>
                           </tr>
                           @endforelse                        </tbody>
                     </table>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
   </div>
</section>
@endsection