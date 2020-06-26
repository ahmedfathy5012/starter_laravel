
@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Hospitals
            </div>
            <br>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Service</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($services) && $services->count()>0)
                    @foreach($services as $service)
                <tr>
                    <th scope="row">{{$service->id}}</th>
                    <td>{{$service->name}}</td>
                </tr>
                    @endforeach
                @endif
                </tbody>
            </table>


        </div>
    </div>
@stop


