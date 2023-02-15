@extends('layouts.admin')
@section('title', __('Ads'))
@section('pageheading')
{{ __('Manage Ads') }}
@endsection
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 mb-5">
         <div class="flex">
            <a href="{{ route('admin.ads.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> {{ __('Add new') }}
            </a>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-12">
         <div class="table-responsive">
            <h5>{{ __('Active ads') }}</h5>
            <br>
            <table id="dataTable" class="display table table-striped" style="width:100%">
               <thead>
                  <tr>
                     <th>#</th>
                     <th> {{ __('Ads type') }}    </th>
                     <th> {{ __('Title') }}       </th>
                     <th> {{ __('Description') }} </th>
                     <th> {{ __('Image') }}       </th>
                     <th> {{ __('URL') }}         </th>
                     <th> {{ __('Active') }}      </th>
                  </tr>
               </thead>
               <tbody>
                  @if ($allAdsData->count() >0)
                  @foreach ($allAdsData as $ads)
                  <tr>
                     <td class="text-center">{{ $loop->iteration }} </td>
                     <td class="text-center">{{ $ads->type }} AD</td>
                     <td class="text-center">{{$ads->title}}</td>
                     <td class="text-center">{{$ads->description}}</td>
                     <td class="text-center">@if($ads->type=="Image")<img src="{{ asset("storage/{$ads->image}") }}" alt="{{ $ads->id }}"
                        width="50"> @endif
                     </td>
                     <td class="text-center"><a href="{{$ads->url}}">{{$ads->url}}</a></td>
                     <td class="text-center">
                        <label class="container_bundle">
                        @if($ads->status==1)
                        <input class="bundle text-ad" name="text_radio"  data-id="{{$ads->id}}" value="" type="radio"  checked>
                        @else
                        <input class="bundle text-ad" name="text_radio"  data-id="{{$ads->id}}" value="" type="radio"  >
                        @endif
                        <input type="hidden" name="text_radio_val" id="text_radio" value="">
                        <span class="checkmark_bundle"></span>
                        </label>
                     </td>
                  </tr>
                  @endforeach
                  @endif  
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <!-- /.row -->
</div>
<!-- /.container-fluid -->
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
       $('#dataTable').DataTable();
   });
</script>
@stop