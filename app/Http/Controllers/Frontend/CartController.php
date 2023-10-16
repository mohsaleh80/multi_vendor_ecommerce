<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    //

    public function AddToCart(Request $request, $id){
      
        $product = Product::findOrFail($id);

        

        if(is_null($product->discount_price)){
          $price = intVal($product->selling_price);
        }else{
          $price = intVal($product->discount_price);
        }

        Cart::add(['id' => $id,
                   'name' =>  $request->product_name,
                   'qty' => $request->quantity, 
                   'price' => $price,
                   'weight' => 1, 
                   'options' => ['size' => $request->size,
                                 'color' => $request->color,
                                 'image' => $product->product_thambnail,
                                 'slug' => $product->product_slug]
                  ]
                );

              
             /*  if (Auth::check()) {

                
              
                    if(Cart::restore(strval(Auth::user()->id))){
                        
                          Cart::instance('default')->merge(strval(Auth::user()->id), $keepDiscount, $keepTaxrate, $dispatchAdd, 'default'); 
                      }else{
                       
                          Cart::store(strval(Auth::user()->id));
                      }               
                }
                */

        return response()->json(['success' => 'Product Added to Your Cart' ]);      

    } // End Add To Cart

    



    public function AddMiniCart(){

        if (Auth::check()) { 
           if(Cart::content()->count() > 0){
                   //Cart::instance('default')->merge(strval(Auth::user()->id), $keepDiscount, $keepTaxrate, $dispatchAdd, 'default'); 
             
              }

            }

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal

        ));

      

        
    }// End Method


    public function RemoveMiniCart($rowId){
      
                
        Cart::remove($rowId);

    
        
        return response()->json(['success' => 'Product Removed From Cart']);

    }// End Method


    public function MyCart(){

        return view('frontend.cart.view_mycart');

    }// End Method

    
    public function GetCartProduct(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,  
            'cartTotal' => $cartTotal

        ));

    }// End Method

    public function RemoveCart($rowId){
      
                
        Cart::remove($rowId);

    
        
        return response()->json(['success' => 'Product Removed From Cart']);

    }// End Method

    public function CartDecrement($rowId){

        $row = Cart::get($rowId);
        
        Cart::update($rowId, $row->qty -1);

        return response()->json(['success' => 'Product QTY Updated']);

    }// End Method

    public function CartIncrement($rowId){

        $row = Cart::get($rowId);
        
        Cart::update($rowId, $row->qty +1);

        return response()->json(['success' => 'Product QTY Updated']);

    }// End Method
}
