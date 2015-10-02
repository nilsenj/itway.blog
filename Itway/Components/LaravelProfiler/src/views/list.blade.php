@extends('profiler::layout')
@section('content')
<h3 style="text-align: center;">Nilsenj Profiler Data List</h3>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
    <thead>
    <tr>
    <th>#</th>
    <th>Project</th>
    <th>Route</th>
    <th>Url</th>
    <th>Request</th>
    <th>User ID</th>
    <th>Referer</th>
    <th>Agent</th>
    <th>Cookie</th>
    <th>IP</th>
    <th>Response Time</th>
    <th>Memory Usage</th>
    <th>Date</th>
    </tr>
    </thead>
    <tbody>
    @if($data)
        @foreach ($data as $key => $value)
            <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ ($value->project_code) }}</td>
            <td>{{ ($value->route) }}</td>
            <td><span class="label label-default">{{ ($value->method) }}</span> {{ ($value->url) }}</td>
            <td>
                {{ ($value->request_body) }}
                <br>
                {{ ($value->request_data) }}
            </td>
            <td>{{ ($value->user_id) }}</td>
            <td>{{ ($value->referer) }}</td>
            <td>{{ ($value->agent) }}</td>
            <td>{{ ($value->cookie) }}</td>
            <td>{{ ($value->ip_address) }}</td>
            <td>@if(number_format($value->response_time, 4) >= 0.05) <span class="label label-danger"> @endif {{ number_format($value->response_time, 4) }} @if(number_format($value->response_time, 4) >= 0.05) </span> @endif</td>
            <td>@if(Profiler::readableSizeFormat($value->memory_usage) >= 10) <span class="label label-danger"> @endif {{ Profiler::readableSizeFormat($value->memory_usage) }} @if(Profiler::readableSizeFormat($value->memory_usage) >= 10) </span> @endif</td>
            <td>{{ ($value->idate) }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
    </table>
</div>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
    <tr>
    <td>Total Record</td>
    <td>:</td>
    <td>{{ $total }}</td>
    </tr>
    <tr>
    <td>Average Response Time</td>
    <td>:</td>
    <td>{{ number_format($response_time->time, 4) }} sn</td>
    </tr>
    <tr>
    <td>Average Memory Usage</td>
    <td>:</td>
    <td>{{ Profiler::readableSizeFormat($memory_usage->memory) }}</td>
    </tr>
    </table>
</div>
@stop
