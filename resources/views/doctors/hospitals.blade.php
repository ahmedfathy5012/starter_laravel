
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
                    <th scope="col">name</th>
                    <th scope="col">address</th>
                    <th scope="col">doctors</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($hospitals) && $hospitals->count()>0)
                    @foreach($hospitals as $hospital)
                        <tr>
                            <th scope="row">{{$hospital->id}}</th>
                            <td>{{$hospital->name}}</td>
                            <td>{!! $hospital->address !!}</td>
                            <td> <a href="{{route('hospital.doctors',$hospital->id)}}"><button class="btn btn-success" >Doctors</button></a></td>
                            <td><a href="{{route('delete.hospital',$hospital->id)}}" class="btn btn-danger">Delete</a></td>
                        </tr>
                    @endforeach
                    @endif



                </tbody>
            </table>


        </div>
    </div>
    @stop


