<?php

namespace App\Http\Controllers\Relations;

use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RelationsController extends Controller
{
    public function oneToOneRelation(){
        return $user = User::with(['phone'=>function($q){
            $q->select('code','phone','user_id');
        }])->find(1);
    }

    public function oneToOneRelationWhereHas(){
        // return  User::WhereHas('phone')->get();
         return  User::whereDoesntHave('phone')->get();
    }

    public function oneToManyRelationWhereHas(){
        // return  User::WhereHas('phone')->get();
        //return  Hospital::with(['doctors'])->doctors();
        $doctor = Doctor::find(1);
        return $doctor->hospital;
    }

    public function hospitals(){
        $hospitals = Hospital::select('id','name','address')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }

    public function doctors($hospital_id){
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital->doctors;
        return view('doctors.doctors',compact('doctors'));
    }

    public function hospitalHasDoctor(){
    return Hospital::whereHas('doctors')->get();
    }

    public function hospitalHasOnlyMaleDoctors(){
        return Hospital::whereHas('doctors' , function($q){
            $q->where('gender',1);
        })->get();
    }

    public function deleteHospital($hospital_id){
        $hospital = Hospital::find($hospital_id);
        if(!$hospital)
            return abort('404');
        $hospital->doctors()->delete();
        $hospital->delete();
        return redirect()->route('hospitals');
    }

    public function getDoctorServices(){

         $service = Service::find(1);
         $services=  $service->doctors;

         return view('doctors.doctor_services',compact('services'));
    }

    public function getAllServices(){

        $services = Service::all();
        $doctors  = Doctor::all();
        return view('doctors.services',compact('services','doctors'));
    }

    public function saveServicesToDoctor(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        $doctor->services()->syncWithoutDetaching ($request->serviceIds);
        return 'success';
    }

    public function patientDoctor($id){
//        $doctor = Doctor::find(1);
//        $patient = $doctor->patient;
//        $country = Country::with('doctors')->find(1);
//        $doctor = $country->doctors;
         $country = Country::find($id);
         $hospitals = $country->hospitals;
        return $hospitals;
    }


    public function getDoctors(){
        return Doctor::all();
    }

}
