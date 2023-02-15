<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Machine Enquiry')}} {{isset($content->title)?'- '.$content->title:''}}</title>
</head>
<body>
    <section class="about_magazine">
        <div class="container">
            <h1>{{__('Total users')}} - {{$users->count()}}</h1>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="display table table-striped" style="width:100%">
                            <thead>
                               <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('RoleName')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Created')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count())
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div>{{ $user->name }}</div>
                                        </td>
                                        <td>
                                        <div class="badge badge-primary">
                                        {{ $user->role }}
                                        </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>





