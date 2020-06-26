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
                <form method="POST" id="offerForm" action="" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">أختر صوره العرض</label>
                        <input type="file" class="form-control" name="photo">
                        <small id="photo_id" class="form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Offer Name</label>
                        <input type="text" class="form-control" name="name_en" placeholder="name_en">
                        <small id="name_en_id" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Offer Name</label>
                        <input type="text" class="form-control" name="name_ar" placeholder="name_ar">
                        <small id="name_ar_id" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Offer Price</label>
                        <input type="text" class="form-control" name="price" placeholder="price">
                        <small id="price_id" class="form-text text-danger"></small>
                    </div>
                    <button id="store_offer" class="btn btn-primary" >Save</button>
                </form>
            </div>
        </div>
    </div>
        @stop


@section('scripts')
   <script>
       $(document).on('click','#store_offer',function (e) {
           e.preventDefault();
           $('#name_ar_id').text('');
           $('#name_en_id').text('');
           $('#price_id').text('');

           var formData = new FormData($('#offerForm')[0])
           $.ajax({
               type: 'POST',
               enctype: "multipart/form-data",
               url: "{{route('ajax.offers.store')}}",
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
                  var response = $.parseJSON(reject.responseText);
                  $.each(response.errors,function (key,val) {
                   $('#'+key+'_id').text(val[0]);
                  });
               },
           });
       })

   </script>
@stop

