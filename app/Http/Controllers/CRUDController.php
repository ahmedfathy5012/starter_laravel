<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\offerRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CRUDController extends Controller
{

    use OfferTrait;


//  public function store(){
//      Offer::create([
//          'name'=>'offer1',
//          'price'=>'200'
//      ]);
//  }
    public function create(){
       return view('offers.create');
    }

    public function store(offerRequest $request){
        // validate before insert into datatbase
//        $validator = Validator::make(
//            $request->all(),
//            $this->getRules(),
//            $this->getMessage()
//        );
//        if($validator->fails()){
//          return redirect()->back()->withErrors($validator)->withInput($request->all());
//        }
        // insert



        $image_name = $this->saveImage($request->file('photo'),'images/offers');

         Offer::create([
           'photo'=>$image_name,
           'name_en'=>$request->name_en,
           'name_ar'=>$request->name_ar,
           'price'=>$request->price
          ]);
        return redirect()->back()->with(['success'=>'OK']);
    }


     public function getAllOffers(){
        $offers = Offer::select('id','name_ar','name_en','price')->get();  // return collection
        return view('offers.all',compact('offers'));
     }


    public function editOffer($offer_id){
        //Offer::findOrFail($offer_id);
        $id = Offer::find($offer_id);
        if(!$offer_id)
            return redirect()->back();
        $offer = Offer::select('id','name_ar','name_en','price')->find($offer_id);  // return collection
        return view ('offers.edit',compact('offer'));
    }

    public function updateOffer(offerRequest $request , $offer_id){
        //validation request
        //check if offer exist
        $offer = Offer::select('id','name_ar','name_en','price')->find($offer_id);  // return collection
        if(!$offer)
            return redirect()->back();
        // update data
        $offer->update($request->all());
        return redirect()->back()->with(['success'=>'تم التنحديث بنجاح']);
    }


    public function deleteOffer($id){
        // check if offer id exist in data base
        $offer  = Offer::find($id);
        if(!$offer)
            return redirect()->back()->with(['error'=>'not exixt']);
        $offer->delete();
        return redirect()->route('offers.all')->with(['success'=>'Offer Has Been Deleted']);

    }


    public  function  getVideo(){
        $video = Video::first();
        event(new VideoViewer($video));
      return view('video')->with('video',$video);
    }

}
