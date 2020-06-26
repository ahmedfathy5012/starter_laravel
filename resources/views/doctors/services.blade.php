
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
            <br><br>


            <form method="POST" action="{{route('save.services.to.doctor')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Choose Doctor</label>
                    <select class="form-control" name="doctor_id">
                        @if(isset($doctors) && $doctors->count()>0)
                            @foreach($doctors as $doctor)
                        <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Choose Service</label>
                    <select class="form-control" name="serviceIds[]" multiple>
                        @if(isset($services) && $services->count()>0)
                            @foreach($services as $service)
                                <option value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" >Save</button>
            </form>

        </div>
    </div>
@stop


