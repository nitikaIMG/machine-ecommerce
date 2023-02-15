@extends('seller.layouts.vendor')
@section('title', 'Chat')
@section('pageheading')
{{__('Chat')}}
@endsection
<style>
   .chat-wraper .chat-content .virtual-chat {
      max-width: 100% !important;
   }

   .chat-wraper .chat-content {
      height: 400px !important;
   }
</style>
@section('content')
<!-- Chat 3nd Block -->
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <!-- <div class="header">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title">{{__('Chat With')}} {{ $participants->implode('name', ',') }}</div>
                  </div>
               </div>
            </div> -->
            <!-- <div class="row">
               <div class="col-md-12">
                  <div class="chat-wraper">
                     <div class="virtual-chat order-chat">
                        <div class="content">
                           <p class="chat">
                              <span class="english">{{ $participants->implode('name', ',') }} </span>

                           </p>
                        </div>
                     </div>
                     <div class="chat-content chat-translate">
                        @foreach ($messages as $message)
                        <div class="virtual-chat {{ $message->user_id === $user->id ? 'even' : '' }}">
                           <div class="content">
                              <p class="chat {{ $message->user_id === $user->id ? 'even' : '' }}">
                                 @if($message->type==1)
                                 <span class="english"><a href="javascript:void(0)" id="chatorderid" class="chatorderid" data-orderid="{{$message->message}}" data-chatorderid="{{ $message->message }}"> Order ID : {{ $message->message }}</a></span>
                                 @elseif($message->type==2)
                                 <span class="translation"><a href="javascript:void(0)" id="productid" class="productid" data-productid="{{ $message->message }}">Product ID: {{ $message->message }}</a></span>
                                 @elseif($message->type==3)
                                 <span class="translation"><a href="javascript:void(0)" id="shopid" class="shopid" data-shopid="{{ $message->message }}">Shop ID: {{ $message->message }}</a></span>
                                 @else
                                 <span class="english">{{ $message->message }}</span>
                                 @endif
                                 <span class="english" style="font-size: 12px;font-weight: 100;
                                    color: #888;"><i>
                                       - {{ $message->created_at->format('M d,Y h:i A') }}</i></span>
                              </p>
                           </div>
                        </div>
                        @endforeach
                     </div>
                     <div class="chat-typing">
                        <form id="chat-submit" class="d-flex align-items-center" action="{{ route('seller.chat.channel.messages.send', ['channel' => $channel->id]) }}" method="post">
                           @csrf
                           <input id="chat-submit-input" type="text" name="message" class="message-input" placeholder="Write a message..." autocomplete="off">
                           <div class="btns">

                              <button type="submit" class="" id="chat-submit-button">
                                 <img src="{{ asset('web/images/send-icon.svg') }}" alt="">
                              </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div> -->
            <div class="chat-wraper">

               <div class="chat-content chat-translate" style="height:400px;">
                  <div class="virtual-chat order-chat">
                     <div class="content">
                        <p class="">
                           <span class="english"><strong>{{ ucwords($participants->implode('name', ',')) }} </strong></span>
                        </p>
                     </div>
                  </div>
                  @foreach ($messages as $message)
                  <div class="virtual-chat {{ $message->user_id === $user->id ? 'even' : '' }}" style="max-width: inherit">
                     <div class="content">
                        <p class="chat {{ $message->user_id === $user->id ? 'even' : '' }}">
                           @if($message->type==1)
                           <span class="english"> <a href="javascript:void(0)" id="chatorderid" class="chatorderid" data-orderid="{{ $message->message }}">Order ID : {{ $message->message }}</a></span>
                           @elseif($message->type==2)
                           <span class="translation"><a href="javascript:void(0)" id="productid" class="productid" data-productid="{{ $message->message }}">Product ID: {{ $message->message }}</a></span>
                           @elseif($message->type==3)
                           <span class="translation"><a href="javascript:void(0)" id="shopid" class="shopid" data-shopid="{{ $message->message }}">Shop ID: {{ $message->message }}</a></span>
                           @else
                           <span class="english"> {{ $message->message }}</span>
                           @endif
                           <span class="english" style="font-size: 12px;font-weight: 100;
                        color: #888;"><i>
                                 - {{ $message->created_at->format('M d,Y h:i A') }}</i></span>
                        </p>
                     </div>
                  </div>
                  @endforeach



                  <!-- <div class="testing"> Mark testing </div> -->

                  <!-- <br><br> -->


               </div>
               <div class="chat-typing">
                  <form id="chat-submit" class="d-flex align-items-center" action="{{ route('seller.chat.channel.messages.send', ['channel' => $channel->id]) }}" method="post">
                     @csrf
                     <input id="chat-submit-input" type="text" name="message" class="message-input" placeholder="Write a message..." autocomplete="off">

                     <div class="btns">
                        <button type="submit" class="" id="chat-submit-button">
                           <img src="{{ asset('web/images/send-icon.svg') }}" alt="">
                        </button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection