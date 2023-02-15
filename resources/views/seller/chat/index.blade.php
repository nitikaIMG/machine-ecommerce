@extends('seller.layouts.vendor')
@section('title', 'Chat')
@section('pageheading')
{{__('Chat')}}
@endsection
@section('content')
<section class="center-wraper">
   <div class="row">
      <div class="col-md-12">
         <div class="card p30" id="myTab">
            <div class="header">
               <div class="row">
                  <div class="col-md-12">
                     <div class="title">{{__('Chat')}}</div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
               @php
                                    $user = Auth::user();
                                @endphp
               @forelse ($channels as $channel)
               <a href="{{ route('seller.channel.chat.view', ['channel' => $channel->id]) }}">
                  <div class="chat-block-repeat">
                  @php
                                            $participantimg = $channel->participants
                                                ->filter(function ($participant) use ($user) {
                                                    return $participant->id !== $user->id;
                                                })
                                                ->implode('profile_pic', ', ');
                                        @endphp
                     <figure>
			@if(!empty($participantimg))
                        <img src="{{ asset('public/storage/' . $participantimg) }}" alt="" class="img-fluid">
			@else 
			<img src="{{ asset('seller/images/profie-icon.png') }}" alt="" class="img-fluid">
			@endif
                     </figure>
                     <div class="content">
                        <div class="main-text">
                           <div class="name">{{ $channel->participants->filter(function ($participant) use ($user) {
                                                            return $participant->id !== $user->id;
                                                        })->implode('name', ', ') }}</div>
                           <div class="time">{{ $channel->last_msg }}</div>
                           <div class="time">{{ $channel->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="noti-text">
                           <span class="time">{{ $channel->created_at->format('h:i A') }}</span>
                           @if($channel->unread_msg > 0)
                           <div class="count">{{ $channel->unread_msg }}</div>
                           @endif                             
                        </div>
                     </div>
                  </div>
                </a>                                        
                @empty
                <p class="text-center">{{__('No Chat')}}</p>
                @endforelse
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>


@endsection