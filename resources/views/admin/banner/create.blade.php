@extends('layouts.admin')
@section('title', __('Banner'))
@section('content')
@php
    $required_fields = ['title', 'short_description'];
@endphp
    <div class="container mb-5">

        <h3 class="mb-4">{{ __('New banner') }}</h3>

        <div class="row">
            <div class="col-12 col-sm-8 col-md-6">

                <form class="submit-via-ajax" action="{{ url('admin/banner/store') }}" method="post" data-required_fields="{{\json_encode($required_fields)}}">
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

                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="image">{{ __('Image') }}</label>
                        <input class="show_image_preview file-check-size-res" data-target="#preview-image" type="file" name="image" id="image" accept="image/png,image/gif,image/jpeg,image/jpg" data-min_width="1600" data-min_height="1050">
                        <img id="preview-image" src="" height="140" width="120" style="display: none">
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                </form>
            </div>
        </div>
    </div>
@endsection
