<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    use OfferTrait;

    public function create(){
        // call a form view to add offer
        return view('ajaxoffers.create');
    }

    public function store(offerRequest $request){
        // store of to DB using ajax
        $image_name = $this->saveImage($request->photo,'images/offers');

        $offer = Offer::create([
            'photo'=>$image_name,
            'name_en'=>$request->name_en,
            'name_ar'=>$request->name_ar,
            'price'=>$request->price
        ]);
        if($offer){
            return response()->json([
                'status'=>'true',
                'message'=>'successful storing',
            ]);
        }else{
            return response()->json([
                'status'=>'false',
                'message'=>'failed in storing',
            ]);
        }

    }


    public function index(){
        $offers = Offer::select('id','name_ar','name_en','price')->get();  // return collection
        return view('ajaxoffers.all',compact('offers'));
    }

    public function delete(Request $request){
        $offer  = Offer::find($request->id);
        if(!$offer)
            return response()->json([
                'status'=>'false',
                'message'=>'this offer does not exist',
            ]);
        $offer->delete();
        return response()->json([
            'status'=>'true',
            'message'=>'successful deleting',
            'id'=> $offer->id
        ]);
    }

    public function edit(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer)
            return response()->json([
                'status'=>'false',
                'message'=>'this offer does not exist',
            ]);
        $offer = Offer::select('id','name_ar','name_en','price')->find($request->id);  // return collection
        return view('ajaxoffers.edit',compact('offer'));
    }

    public function update(offerRequest $request){
        //validation request
        //check if offer exist
        $offer = Offer::select('id','name_ar','name_en','price')->find($request->offer_id);  // return collection
        if(!$offer)
            return response()->json([
                'status'=>'false',
                'message'=>'this offer does not exist',
            ]);
        // update data
        $offer->update($request->all());
        return response()->json([
            'status'=>'true',
            'message'=>'successful Updating',
        ]);
    }
}
