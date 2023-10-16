<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShipRegion;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    //

    public function AllRegion(){
        $region = ShipRegion::latest()->get();
        return view('backend.ship.region.region_all',compact('region'));
    } // End Method 

    public function AddRegion(){
        return view('backend.ship.region.region_add');
    }// End Method 


    public function StoreRegion(Request $request){ 

        ShipRegion::insert([ 
            'region_name' => $request->region_name, 
        ]);

       $notification = array(
            'message' => 'ShipDivision Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.region')->with($notification); 

    }// End Method

    public function EditRegion($id){

        $region = ShipRegion::findOrFail($id);
        return view('backend.ship.region.region_edit',compact('region'));

    }// End Method 


    public function UpdateRegion(Request $request){

        $region_id = $request->id;

         ShipRegion::findOrFail($region_id)->update([
            'region_name' => $request->region_name,
        ]);

       $notification = array(
            'message' => 'ShipRegion Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.region')->with($notification); 


    }// End Method 



    public function DeleteRegion($id){

        ShipRegion::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipRegion Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 


    //////// Division CRUD ///////

    public function AllDivision(){
        $division = ShipDivision::latest()->get();
        return view('backend.ship.division.division_all',compact('division'));
    } // End Method 

    public function AddDivision(){
        $region = ShipRegion::orderBy('region_name','ASC')->get();
        return view('backend.ship.division.division_add',compact('region'));
    }// End Method 


    public function StoreDivision(Request $request){ 

        ShipDivision::insert([ 
            'region_id' => $request->region_id, 
            'division_name' => $request->division_name,
        ]);

       $notification = array(
            'message' => 'Division Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification); 

    }// End Method 

    public function EditDivision($id){

        $division = ShipDivision::findOrFail($id);
        $region = ShipRegion::latest()->get();
        return view('backend.ship.division.division_edit',compact('region','division'));

    }// End Method 


    public function UpdateDivision(Request $request,$id){

        $region_id = $request->region_id;
        $division_name = $request->division_name;
        
        ShipDivision::findOrFail($id)->update([
            'region_id' => $region_id,
            'division_name' => $division_name
        ]);

       $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.division')->with($notification); 


    }// End Method 

    public function DeleteDivision($id){

        ShipDivision::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 

    //////// State CRUD ///////

    public function AllState(){
        $state = ShipState::latest()->get();
        return view('backend.ship.state.state_all',compact('state'));
    } // End Method 


    public function AddState(){
        $region = ShipRegion::orderBy('region_name','ASC')->get();
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        
         return view('backend.ship.state.state_add',compact('division','region'));
    }// End Method 

    public function GetDivision($region_id){
        $division = ShipDivision::where('region_id',$region_id)->orderBy('division_name','ASC')->get();
            return json_encode($division);

    }// End Method 


    public function StoreState(Request $request){ 

        ShipState::insert([ 
            'region_id' => $request->region_id, 
            'division_id' => $request->division_id, 
            'state_name' => $request->state_name,
        ]);

       $notification = array(
            'message' => 'ShipState Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification); 

    }// End Method

    public function EditState($id){
        $region = ShipRegion::orderBy('region_name','ASC')->get();
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $state = ShipState::findOrFail($id);

         return view('backend.ship.state.state_edit',compact('division','region','state'));
    }// End Method 


    public function UpdateState(Request $request,$state_id){ 

        ShipState::findOrFail($state_id)->update([ 
            'region_id' => $request->region_id, 
            'division_id' => $request->division_id, 
            'state_name' => $request->state_name,
        ]);

       $notification = array(
            'message' => 'ShipState Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification); 

    }// End Method

    public function DeleteState($id){

        ShipState::findOrFail($id)->delete();

         $notification = array(
            'message' => 'ShipState Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    }// End Method 

}
