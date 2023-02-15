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
               <div class="row">
                  <div class="col-md-6">
                     <div class="title">{{__('Manage a Shop')}}</div>
                     <div class="shop-name">
                     {{ $user_shop->shop_name }}
                    
                    
                     </div>
                  </div>
                  
               </div>
            </div>
            <div class="row">
              <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="News" role="tabpanel" aria-labelledby="News-tab">
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr>
                              <th scope="col">{{__('Shop owner') }}</th>
                              <th scope="col">{{ $user_shop->shop_owner }}</th>
                           </tr>

                           <tr>
                              <th scope="col">{{__('Shop name') }}</th>
                              <th scope="col">{{ $user_shop->shop_owner }}</th>
                           </tr>

                           <tr>
                              <th scope="col">{{__('Shop Phone') }}</th>
                              <th scope="col">{{ $user_shop->shop_contact }}</th>
                           </tr>

                           <tr>
                              <th scope="col">{{__('Shop Email') }}</th>
                              <th scope="col">{{ $user_shop->shop_email }}</th>
                           </tr>


                           <tr>
                              <th scope="col">{{__('Shop Address') }}</th>
                              <th scope="col">{{ $user_shop->address_1 }}</th>
                           </tr>


                           <tr>
                              <th scope="col">{{__('Working Hours') }}</th>
                              <th scope="col">From : {{ $user_shop->working_hours_from }} To : {{ $user_shop->working_hours_to }}</th>
                           </tr>
                           <tr>
                              <th scope="col">{{__('Working Days') }}</th>
                              <th scope="col">
                            @php
                                if(isset($user_shop->working_days)){
                                $work = explode(",",$user_shop->working_days);
                                    

                            @endphp

                                @if(in_array('Su',$work)) {{ "Sunday," }}  @endif 
                                @if(in_array('M',$work)) {{ "Monday," }} @endif
                                @if(in_array('Tu',$work)) {{ "Tuesday," }} @endif
                                @if(in_array('W',$work)) {{ "Wednesday," }} @endif
                                @if(in_array('Th',$work)) {{ "Thursday," }} @endif
                                @if(in_array('F',$work)) {{ "Friday," }} @endif 
                                @if(in_array('Sa',$work)) {{ "Saturday" }} @endif
                             
                            @php 
                                }
                            @endphp
                              </th>
                           </tr>

                        </thead>
                        <tbody>
                          
                           <tr>
                           <td></td>
                                  
                           </tr>
                          
                        </tbody>
                     </table>
                  </div>
               </div>
               
            </div>
            </div>
         </div>
      </div>
   
   </div>
</section>
@endsection