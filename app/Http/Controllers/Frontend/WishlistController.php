<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlistController extends Controller
{
    //
    public function AddToWishList(Request $request, $product_id){

        if (Auth::check()) {

            
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
            
            if (!$exists) {
               Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                'created_at' => Carbon::now(),

               ]);
               return response()->json(['success' => 'Successfully Added To Your Wishlist' ]);
            } else{
                return response()->json(['error' => 'This Product is Already on Your Wishlist' ]);

            } 

        }else{
            return response()->json(['error' => 'You have to login First!' ]);
        }

    } // End Method 


    public function AllWishlist(){

       $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

       $wishQty = count($wishlist); 

        return view('frontend.wishlist.view_wishlist',compact('wishlist','wishQty'));

    }// End Method 


    public function getWishlistCount(){

         $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

         $wishQty = count($wishlist);

         return response()->json(['wishQty' => $wishQty]);

    }// End Method 

    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

        $wishQty = count($wishlist); 

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);

    }// End Method

    public function WishlistRemove($id){

        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Product Remove' ]);
    }// End Method


}
