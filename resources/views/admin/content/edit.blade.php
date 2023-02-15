@extends('layouts.admin')
@section('title', $content->title)
@section('pageheading')
{{Str::headline($content->slug)}} - {{ __('Content')}}
@endsection
@section('content')
@php
$required_fields = ['title', 'page_content'];
@endphp
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 col-12">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">{{ __('Edit content')}} {{$content->title}}</h3>
            </div>
            <form class="submit-via-ajax" action="{{route('admin.content_manager.update',['slug'=>$content->slug])}}"
               method="post" data-required_fields="{{\json_encode($required_fields)}}">
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
                  $content->setDefaultLocale($locale);
                  @endphp
                  <div class="tab-pane fade {{$loop->first ? 'show active':''}}" id="tab{{ $locale }}" role="tabpanel" aria-labelledby="profile-tab">
                     <div class="form-group">
                        <label for="title_{{ $locale }}">{{ __('Title') }} ({{ $locale }})</label>
                        <input type="text" id="title_{{ $locale }}"  name="{{ $locale }}[title]" dir="{{$direction}}" value="{{$content->title}}" class="form-control input-title"
                           >
                     </div>
                     <div class="form-group">
                        <label for="page_content_{{ $locale }}">{{ __('Description') }}
                        ({{ $locale }})
                        </label>
                        <textarea name="{{ $locale }}[page_content]"
                           id="page_content_{{ $locale }}" class="form-control input-page_content"
                           rows="5" dir="{{$direction}}">{{$content->page_content}}</textarea>
                     </div>
                  </div>
                  @endforeach
               </div>
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{__('Update*')}}</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'tiny_basic' );
</script>
@stop