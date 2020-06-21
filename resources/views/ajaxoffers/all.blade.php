@extends('layouts.app');

@section('content')
    <body>
    <div class="alert alert-success" id="success-msg" style="display: none">
        success
    </div>

    <div class="alert alert-danger" id="fail-msg" style="display: none">
        Fail
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name_ar</th>
            <th scope="col">name_en</th>
            <th scope="col">price</th>
            <th scope="col">Image</th>
            <th scope="col">operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr class="offerRow{{$offer->id}}" >
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name_ar}}</td>
                <td>{{$offer -> name_en}}</td>
                <td>{{$offer -> price}}</td>
                <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <td>
                    <a href="{{url('offers/edit/'.$offer->id)}}" class="btn btn-success">Edit</a>
                    <a href="{{url('offers/delete/'.$offer->id)}}" class="btn btn-danger">delete</a>
                    <a href="{{route('ajax.offers.edit',$offer->id)}}"  id="" class="btn btn-success">ajax.edit</a>
                    <a href="" offer_id={{$offer->id}}  id="" class="delete-btn btn btn-danger">ajax.delete</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
@stop



@section('scripts')
    <script>
        $(document).on('click','.delete-btn',function (e) {
            e.preventDefault();
            var offer_id = $(this).attr('offer_id');
            $.ajax({
                type: 'POST',
                url: "{{route('ajax.offers.delete')}}",
                data: {
                    '_token':"{{csrf_token()}}",
                    'id': offer_id
                },
                success: function (data) {
                    if(data.status){
                        $('#success-msg').show();
                        $('.offerRow'+data.id).remove();
                    }else{
                        $('#fail-msg').show();
                    }
                },
                error: function (reject) {

                },
            });
        })

    </script>
@stop

