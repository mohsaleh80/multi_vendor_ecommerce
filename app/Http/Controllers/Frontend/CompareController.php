<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CompareController extends Controller
{
    //

    public function AddToCompare(Request $request, $product_id){

        if (Auth::check()) {
      $exists = Compare::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if (!$exists) {
               Compare::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),

               ]);
               return response()->json(['success' => 'Successfully Added To Your Compare List' ]);
            } else{
                return response()->json(['error' => 'This Product is Already on Your Compare List' ]);

            } 

        }else{
            return response()->json(['error' => 'You have to login First!' ]);
        }

    } // End Method 

    public function getCompareCount(){

        $comparelist = Compare::where('user_id',Auth::id())->latest()->get();

        $compareQty = count($comparelist);

        return response()->json(['compareQty' => $compareQty]);

   }// End Method 

   public function AllCompareList(){

    $comparelist = Compare::with('product')->where('user_id',Auth::id())->latest()->get();

    $compareQty = count($comparelist); 

     return view('frontend.compare.view_compare',compact('comparelist','compareQty'));

 }// End Method 

 public function CompareRemove($id){

    Compare::where('user_id',Auth::id())->where('id',$id)->delete();
    return response()->json(['success' => 'Successfully Product Remove' ]);
}// End Method

public function GetCompareProduct(){

    $comparelist = Compare::with('product')->where('user_id',Auth::id())->latest()->get();

    $compareQty = count($comparelist); 

    return response()->json(['comparelist'=> $comparelist, 'compareQty' => $compareQty]);

}// End Method

}
