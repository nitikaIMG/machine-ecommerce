@extends('layouts.admin')
@section('title', __('Chats'))
@section('pageheading')
{{ __('Chat') }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="my-4">
                        <h4 class="font-weight-bold m-0">{{ __('Your Messages') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Participants') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $user = Auth::user();
                                @endphp
                                @foreach ($channels as $channel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>You, {{
                                            $channel->participants
                                                ->filter(function($participant) use($user) {
                                                    return $participant->id !== $user->id;
                                                })
                                                ->implode('name', ', ') }}
                                        </td>
                                        <td>
                                            {{ $channel->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.chat.channel.view', ['channel' => $channel->id]) }}" class="btn btn-sm btn-primary">
                                                {{ __('Chat') }}
                                            </a>
                                            {{-- <a href="{{ asset('admin/view_channel/'.$channel->id) }}" class="btn btn-sm btn-primary">
                                                {{ __('Chat') }}
                                            </a> --}}
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var obj = {};

            if( @json(App::isLocale('ar')) ) {
                obj['language'] = DataTableArabicTexts;
            }

            var table = $('#dataTable').DataTable(obj);
        });
    </script>
@endsection
