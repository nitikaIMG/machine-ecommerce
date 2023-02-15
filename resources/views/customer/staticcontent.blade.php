@extends('customer.layouts.main')

@section('content')
    <section class="about-us">
        <div class="abt-banner">
            <div class="txt">{{ $staticcontent['title'] }}</div>
        </div>
        <div class="abt-content">
            <div class="container">

                {{ $staticcontent['content'] }}

            </div>
        </div>
    </section>
@endsection
