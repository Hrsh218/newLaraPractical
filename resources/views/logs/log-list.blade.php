@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Logs Lists</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Subject</th>
                    <th>URL</th>
                    <th>Method</th>
                    <th>Ip</th>
                    <th width="300px">User Agent</th>
                    <th>User Id</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($logs))
                    @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->subject }}</td>
                            <td>{{ $log->url }}</td>
                            <td>{{ $log->method }}</td>
                            <td>{{ $log->ip }}</td>
                            <td>{{ $log->agent }}</td>
                            <td>{{ $log->user_id }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection
