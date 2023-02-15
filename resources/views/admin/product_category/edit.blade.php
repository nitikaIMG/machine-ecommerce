@extends('layouts.admin')
@section('title', __('Product category'))
@section('content')
@php
    $required_fields = ['title', 'description'];
@endphp
    <div class="container mb-5">

        <h3 class="mb-4">{{ __('Edit product category') }}</h3>

        <div class="row">
            <div class="col-12 col-sm-8 col-md-6">

                <form class="submit-via-ajax" action="{{ route('admin.product_category.update', ['us_product_category' => $productCategory->id]) }}" method="post" data-required_fields="{{\json_encode($required_fields)}}">
                    @csrf
                    @method('PATCH')

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

                            $productCategory->setDefaultLocale($locale);
                        @endphp

                            <div class="tab-pane fade {{$loop->first ? 'show active':''}}" id="tab{{ $locale }}" role="tabpanel"
                                aria-labelledby="profile-tab">

                                <div class="form-group">
                                    <label for="title_{{ $locale }}">{{ __('Title') }} ({{ $locale }})</label>
                                    <input type="text" class="form-control input-title" id="title_{{ $locale }}"
                                        name="{{ $locale }}[title]" dir="{{$direction}}" value="{{$productCategory->title}}">
                                </div>

                                <div class="form-group">
                                    <label for="short_description_{{ $locale }}">{{ __('Short description') }}
                                        ({{ $locale }})
                                    </label>
                                    <textarea name="{{ $locale }}[short_description]"
                                        id="short_description_{{ $locale }}" class="form-control input-short_description"
                                        rows="3" dir="{{$direction}}">{{$productCategory->short_description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description_{{ $locale }}">{{ __('Description') }}
                                        ({{ $locale }})
                                    </label>
                                    <textarea name="{{ $locale }}[description]"
                                        id="description_{{ $locale }}" class="form-control input-description"
                                        rows="5" dir="{{$direction}}">{{$productCategory->description}}</textarea>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label for="parent_id">{{ __('Parent category') }}</label>
                        <select class="form-control" name="parent_id" id="parent_id">
                            <option value="">{{ __('None') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$productCategory->parent_id == $category->id ? 'selected':''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cover_image">{{ __('Cover image') }}</label>
                        <input type="file" name="cover_image" class="show_image_preview" data-target="#preview-cover-image" id="cover_image" accept="image/png,image/gif,image/jpeg,image/jpg">
                        <img id="preview-cover-image" src="{{storage_url($productCategory->cover_image)}}" height="140" width="120" style="display: {{$productCategory->cover_image ? '':'none'}}">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="status" id="status" value="1" {{$productCategory->status ? 'checked':''}}>
                        <label for="status">{{ __('Status') }}</label>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                </form>
            </div>
        </div>
    </div>
@endsection
