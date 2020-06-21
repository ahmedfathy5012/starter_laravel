@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Add Your Offer
                </div>

                <div class="alert alert-success" id="success-msg" style="display: none">
                  success
                </div>

                <div class="alert alert-danger" id="fail-msg" style="display: none">
                    Fail
                </div>

                <br>
                <form method="POST" id="offerFormUpdate" action="" enctype="multipart/form-data">
                    @csrf

                    <input type="text" class="form-control" name="offer_id" value="{{$offer->id}}" style="display: none">

                    <div class="form-group">
                        <label for="exampleInputEmail1">أختر صوره العرض</label>
                        <input type="file" class="form-control" name="photo" value="{{$offer->photo}}">
                        @error('photo')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Offer Name</label>
                        <input type="text" class="form-control" name="name_en" placeholder="name_en" value="{{$offer->name_en}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Offer Name</label>
                        <input type="text" class="form-control" name="name_ar" placeholder="name_ar" value="{{$offer->name_ar}}">
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Offer Price</label>
                        <input type="text" class="form-control" name="price" placeholder="price" value="{{$offer->price}}">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}}</small>
                        @enderror
                    </div>
                    <button id="update_offer" class="btn btn-primary" >Save</button>
                </form>
            </div>
        </div>
    </div>
        @stop


@section('scripts')
   <script>
       $(document).on('click','#update_offer',function (e) {
           e.preventDefault();
           var formData = new FormData($('#offerFormUpdate')[0]);
           $.ajax({
               type: 'POST',
               enctype: "multipart/form-data",
               url: "{{route('ajax.offers.update')}}",
               data: formData,
               processData: false,
               contentType: false,
               cache: false,
               success: function (data) {
                 if(data.status){
                  $('#success-msg').show();
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

