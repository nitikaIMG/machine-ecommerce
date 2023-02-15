<form method="get" class="my-2">
    <h4 class="text-bold">{{__('Filter based on dates:') }} </h4>
    <div class="row align-items-center">
        <div class="col-12 col-sm-4 form-group">
            <label for="">{{__('FROM')}}</label>
            <input type="text" class="form-control datetimepicker" name="starts_at"
                value="{{ request()->query('starts_at') }}" readonly>
        </div>
        <div class="col-12 col-sm-4 form-group">
            <label for="">TO</label>
            <input type="text" class="form-control datetimepicker" name="ends_at"
                value="{{ request()->query('ends_at') }}" readonly>
        </div>
        <div class="col">
            <button class="btn btn-primary">{{__('Filter')}}</button>
        </div>
    </div>
</form>
<div class="pre-d mt-2 mb-4">
    @php
        $now = now();

        $startOfWeek = $now->clone()->startOfWeek();
        $endOfWeek = $now->clone()->endOfWeek();

        $startOfMonth = $now->clone()->startOfMonth();
        $endOfMonth = $now->clone()->endOfMonth();

        $startOfYear = $now->clone()->startOfYear();
        $endOfYear = $now->clone()->endOfYear();

        $btn_type = Request::query('btn_type');
    @endphp
    <div class="d-flex align-items-center flex-wrap">
        <form method="get">
            <input type="hidden" name="starts_at" value="{{ $startOfWeek->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="ends_at" value="{{ $endOfWeek->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="btn_type" value="week">
            <button type="submit" class="btn btn-sm btn-primary {{$btn_type == 'week' ? 'active':''}}">This week</button>
        </form>
        <form method="get" class="ml-2">
            <input type="hidden" name="starts_at" value="{{ $startOfMonth->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="ends_at" value="{{ $endOfMonth->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="btn_type" value="month">
            <button type="submit" class="btn btn-sm btn-primary {{$btn_type == 'month' ? 'active':''}}">This month</button>
        </form>
        <form method="get" class="ml-2">
            <input type="hidden" name="starts_at" value="{{ $startOfYear->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="ends_at" value="{{ $endOfYear->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="btn_type" value="year">
            <button type="submit" class="btn btn-sm btn-primary {{$btn_type == 'year' ? 'active':''}}">This year</button>
        </form>
    </div>
</div>
{{-- <div class="pre-d mt-2 mb-4">
    @php
        $now = now();
        $week = $now->clone()->addWeek();
        $month = $now->clone()->addMonth();
        $endOfYear = $now->clone()->endOfYear();
    @endphp
    <div class="d-flex align-items-center flex-wrap">
        <form method="get">
            <input type="hidden" name="starts_at" value="{{ $now->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="ends_at" value="{{ $week->format('Y-m-d H:i:s') }}">
            <button type="submit" class="btn btn-sm btn-primary">{{__('This week')}}</button>
        </form>
        <form method="get" class="ml-2">
            <input type="hidden" name="starts_at" value="{{ $now->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="ends_at" value="{{ $month->format('Y-m-d H:i:s') }}">
            <button type="submit" class="btn btn-sm btn-primary">{{__('This month')}}</button>
        </form>
        <form method="get" class="ml-2">
            <input type="hidden" name="starts_at" value="{{ $now->format('Y-m-d H:i:s') }}">
            <input type="hidden" name="ends_at" value="{{ $endOfYear->format('Y-m-d H:i:s') }}">
            <button type="submit" class="btn btn-sm btn-primary">{{__('This Year')}}</button>
        </form>
    </div>
</div> --}}
