<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;

class IndexController extends Controller
{
    
    public function Index(){
        $FashionCategory = Category::where('category_name','Fashion')->first();
        $FashionProducts = Product::where('status',1)->where('category_id',$FashionCategory->id)->orderBy('id','ASC')->limit(5)->get();
        $BeautyCategory = Category::where('category_name','Beauty')->first();
        $BeautyProducts = Product::where('status',1)->where('category_id',$BeautyCategory->id)->orderBy('id','DESC')->limit(5)->get();
        $VapeCategory = Category::where('category_name','Vape')->first();
        $VapeProducts = Product::where('status',1)->where('category_id',$VapeCategory->id)->orderBy('id','ASC')->limit(5)->get();
        // dd($BeautyProducts);

        $HotDeals = Product::where('status',1)->where('hot_deals',1)->where('discount_price','!=',null)->
                             orderBy('id','DESC')->limit(3)->get();
        $SpecialOffers = Product::where('status',1)->where('special_offer',1)->where('discount_price','!=',null)->
                             orderBy('id','DESC')->limit(3)->get(); 
        $Featureds = Product::where('status',1)->where('featured',1)->where('discount_price','!=',null)->
                             orderBy('id','DESC')->limit(3)->get();  
        $SpecialDeals = Product::where('status',1)->where('special_deals',1)->where('discount_price','!=',null)->
                             orderBy('id','DESC')->limit(3)->get();                                                            
       // dd($SpecialOffers);
        return view('frontend.index',compact('FashionProducts','BeautyProducts','VapeProducts','HotDeals','SpecialOffers','Featureds','SpecialDeals'));

    } // End Method 



  //About Page

  public function About(){

    //$vendor = User::findOrFail(2);
    $vproducts = Product::where('vendor_id',null)->get();
    $vpcount= count($vproducts);

    $vproducts = Product::where('vendor_id',null)->paginate(10); 
    $sort_flag =0;
    $show_flag = 0;
    $filter_flag = 0;
    
    return view('frontend.about',compact('vproducts','vpcount','sort_flag','show_flag','filter_flag'));


  }

  public function AboutShow($flag){

    
    $show_flag =$flag;
    $sort_flag =0;
    $filter_flag = 0;
    
    if($flag == 1){
        $vproducts = Product::where('vendor_id',null)->limit(5)->paginate(5);
        $vpcount= count($vproducts);
        
    }elseif($flag == 2){
        $vproducts = Product::where('vendor_id',null)->limit(10)->paginate(10);
        $vpcount= count($vproducts);
        
    }elseif($flag == 3){
        $vproducts = Product::where('vendor_id',null)->limit(15)->paginate(15);
        $vpcount= count($vproducts);
        
    }elseif($flag == 4){
        $vproducts = Product::where('vendor_id',null)->limit(20)->paginate(20);
        $vpcount= count($vproducts);
        
    }
    elseif($flag == 0){
        $vproducts = Product::where('vendor_id',null)->get();
        $vpcount= count($vproducts);
        $vproducts = Product::where('vendor_id',null)->paginate(10);
       
       
    }
    
 
    return view('frontend.about',compact('vproducts','vpcount','sort_flag','show_flag','filter_flag'));

}

public function AboutFilter($flag){
        
    
    $sort_flag =0;
    $show_flag =0;
    $filter_flag = $flag;
   
    if($flag == 1){
        $vproducts = Product::where('vendor_id',null)->where('featured',1)->get();
        $vpcount= count($vproducts);
        $vproducts = Product::where('vendor_id',null)->where('featured',1)->paginate(5);
        
        
    }elseif($flag == 2){
        $vproducts = Product::where('vendor_id',null)->where('hot_deals',1)->get();
        $vpcount= count($vproducts);
        $vproducts = Product::where('vendor_id',null)->where('hot_deals',1)->paginate(5);
        
        
    }elseif($flag == 3){
        $vproducts = Product::where('vendor_id',null)->where('special_offer',1)->get();
        $vpcount= count($vproducts);
        $vproducts = Product::where('vendor_id',null)->where('special_offer',1)->paginate(5);
        
        
    }elseif($flag == 4){
        $vproducts = Product::where('vendor_id',null)->where('special_deals',1)->get();
        $vpcount= count($vproducts);
        $vproducts = Product::where('vendor_id',null)->where('special_deals',1)->paginate(5);
        
        
    }
    elseif($flag == 0){
        $vproducts = Product::where('vendor_id',null)->get();
        $vpcount= count($vproducts);
        $vproducts = Product::where('vendor_id',null)->paginate(10);
        
        
    }
    
    return view('frontend.about',compact('vproducts','vpcount','sort_flag','show_flag','filter_flag'));
}


public function AboutSort($flag){
        
    
    $sort_flag =$flag;
    $show_flag =0;
    $filter_flag = 0;

    $vproducts = Product::where('vendor_id',null)->get();
    $vpcount= count($vproducts);
   
    if($flag == 1){

        $vproducts = Product::where('vendor_id',null)->orderByRaw('CONVERT(selling_price, SIGNED) desc')->orderByRaw("CASE WHEN CONVERT(discount_price, SIGNED) IS NULL THEN CONVERT(selling_price, SIGNED) ELSE CONVERT(discount_price, SIGNED) END desc")->paginate(10);

    }elseif($flag == 2){
        $vproducts = Product::where('vendor_id',null)->orderByRaw('CONVERT(selling_price, SIGNED) asc')->orderByRaw("CASE WHEN CONVERT(discount_price, SIGNED) IS NULL THEN CONVERT(selling_price, SIGNED) ELSE CONVERT(discount_price, SIGNED) END asc")->paginate(10);
        
    }elseif($flag == 3){
        $vproducts = Product::where('vendor_id',null)->OrderBy('created_at','DESC')->paginate(10);
        
    }elseif($flag == 0){
        $vproducts = Product::where('vendor_id',null)->paginate(10);;
       
    }
    
    return view('frontend.about',compact('vproducts','vpcount','sort_flag','show_flag','filter_flag'));
}


//Category

public function CategoryDetails($id,$slug){
 
    $category = Category::findOrFail($id);
    $subcategories = SubCategory::where('category_id',$id)->orderBy('subcategory_name','ASC')->get();
    $products = Product::where('category_id',$id)->orderBy('id','ASC')->get();
    $products_count =count($products);
    $products = Product::where('category_id',$id)->orderBy('id','ASC')->paginate(5);
    $categories = Category::orderBy('category_name','ASC')->get();
    $sort_flag =0;
    $filter_flag=0;
    $show_flag =0;

    return view('frontend.category.category_details',compact('category','subcategories','products','products_count','categories','sort_flag','filter_flag','show_flag'));


}

public function CategoryProductSort($flag,$id){
        
    $category = Category::findOrFail($id);
    $sort_flag =$flag;
    $show_flag =0;
    $filter_flag = 0;

    
    $subcategories = SubCategory::where('category_id',$id)->orderBy('subcategory_name','ASC')->get();
    $products = Product::where('category_id',$id)->orderBy('id','ASC')->get();
    $products_count =count($products);
    $categories = Category::orderBy('category_name','ASC')->get();
   
    if($flag == 1){

        $products = Product::where('category_id',$id)->orderByRaw('CONVERT(selling_price, SIGNED) desc')->orderByRaw("CASE WHEN CONVERT(discount_price, SIGNED) IS NULL THEN CONVERT(selling_price, SIGNED) ELSE CONVERT(discount_price, SIGNED) END desc")->paginate(5);

    }elseif($flag == 2){
        $products = Product::where('category_id',$id)->orderByRaw('CONVERT(selling_price, SIGNED) asc')->orderByRaw("CASE WHEN CONVERT(discount_price, SIGNED) IS NULL THEN CONVERT(selling_price, SIGNED) ELSE CONVERT(discount_price, SIGNED) END asc")->paginate(5);
        
    }elseif($flag == 3){
        $products = Product::where('category_id',$id)->OrderBy('created_at','DESC')->paginate(5);
        
    }elseif($flag == 0){
        $products = Product::where('category_id',$id)->paginate(5);;
       
    }
    
    return view('frontend.category.category_details',compact('category','subcategories','products','products_count','categories','sort_flag','filter_flag','show_flag'));
}

public function CategoryProductFilter($flag,$id){
        
    $category = Category::findOrFail($id);
    $sort_flag =0;
    $show_flag =0;
    $filter_flag = $flag;

    
    $subcategories = SubCategory::where('category_id',$id)->orderBy('subcategory_name','ASC')->get();
    $products = Product::where('category_id',$id)->orderBy('id','ASC')->get();
    $products_count =count($products);
    $categories = Category::orderBy('category_name','ASC')->get();
   
    if($flag == 1){
        $products = Product::where('category_id',$id)->where('featured',1)->paginate(5);
        $products_count= count($products);
        
    }elseif($flag == 2){
        $products = Product::where('category_id',$id)->where('hot_deals',1)->paginate(5);
        $products_count= count($products);
        
    }elseif($flag == 3){
        $products = Product::where('category_id',$id)->where('special_offer',1)->paginate(5);
        $products_count= count($products);
        
    }elseif($flag == 4){
        $products = Product::where('category_id',$id)->where('special_deals',1)->paginate(5);
        $products_count= count($products);
        
    }
    elseif($flag == 0){
        $products = Product::where('category_id',$id)->orderBy('id','ASC')->get();
        $products_count =count($products);
        $products = Product::where('category_id',$id)->paginate(5);
        
        
    }
    
    return view('frontend.category.category_details',compact('category','subcategories','products','products_count','categories','sort_flag','filter_flag','show_flag'));
}


public function CategoryProductShow($flag,$id){

    $category = Category::findOrFail($id);
    $show_flag =$flag;
    $sort_flag =0;
    $filter_flag = 0;

    $subcategories = SubCategory::where('category_id',$id)->orderBy('subcategory_name','ASC')->get();
    $products = Product::where('category_id',$id)->orderBy('id','ASC')->get();
    $products_count =count($products);
    $categories = Category::orderBy('category_name','ASC')->get();


    if($flag == 1){
        $products = Product::where('category_id',$id)->limit(1)->get();
        $products_count= count($products);
        
    }elseif($flag == 2){
        $products = Product::where('category_id',$id)->limit(2)->get();
        $products_count= count($products);
        
    }elseif($flag == 3){
        $products = Product::where('category_id',$id)->limit(3)->get();
        $products_count= count($products);
        
    }elseif($flag == 4){
        $products = Product::where('category_id',$id)->limit(4)->get();
        $products_count= count($products);
        
    }elseif($flag == 5){
        $products = Product::where('category_id',$id)->limit(5)->get();
        $products_count= count($products);
        
    }
    elseif($flag == 0){
        $products = Product::where('category_id',$id)->orderBy('id','ASC')->get();
        $products_count =count($products);
        $products = Product::where('category_id',$id)->paginate(5);
        
       
    }
    
    return view('frontend.category.category_details',compact('category','subcategories','products','products_count','categories','sort_flag','filter_flag','show_flag'));

}

//SubCategory

public function SubCategoryDetails($id,$slug){
 
    $subcategory = SubCategory::findOrFail($id);
    $category = Category::findOrFail($subcategory->category_id);
    $subcategories = SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
    $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->get();
    $products_count =count($products);
    $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->paginate(5);
    $categories = Category::orderBy('category_name','ASC')->get();
    $sort_flag =0;
    $filter_flag=0;
    $show_flag =0;

    return view('frontend.subcategory.subcategory_details',compact('category','subcategory','subcategories','products','products_count','categories','sort_flag','filter_flag','show_flag'));


}

public function SubCategoryProductSort($flag,$id){
        
    $subcategory = SubCategory::findOrFail($id);
    $sort_flag =$flag;
    $show_flag =0;
    $filter_flag = 0;

    
    $category = Category::findOrFail($subcategory->category_id);
    $subcategories = SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
    $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->get();
    $products_count =count($products);
    $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->paginate(5);
    $categories = Category::orderBy('category_name','ASC')->get();
   
    if($flag == 1){

        $products = Product::where('subcategory_id',$id)->orderByRaw('CONVERT(selling_price, SIGNED) desc')->orderByRaw("CASE WHEN CONVERT(discount_price, SIGNED) IS NULL THEN CONVERT(selling_price, SIGNED) ELSE CONVERT(discount_price, SIGNED)  END desc")->paginate(5);
        
    }elseif($flag == 2){
        $products = Product::where('subcategory_id',$id)->orderByRaw('CONVERT(selling_price, SIGNED) asc')->orderByRaw("CASE WHEN CONVERT(discount_price, SIGNED) IS NULL THEN CONVERT(selling_price, SIGNED) ELSE CONVERT(discount_price, SIGNED) END asc")->paginate(5);
        
    }elseif($flag == 3){
        $products = Product::where('category_id',$id)->OrderBy('created_at','DESC')->paginate(5);
        
    }elseif($flag == 0){
        $products = Product::where('subcategory_id',$id)->paginate(5);;
       
    }
    

    return view('frontend.subcategory.subcategory_details',compact('category','subcategory','subcategories','products','products_count','categories','sort_flag','filter_flag','show_flag'));
}

public function SubCategoryProductFilter($flag,$id){
        
    $subcategory = SubCategory::findOrFail($id);
    $sort_flag =0;
    $show_flag =0;
    $filter_flag = $flag;

    
    $category = Category::findOrFail($subcategory->category_id);
    $subcategories = SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
    $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->get();
    $products_count =count($products);
    $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->paginate(5);
    $categories = Category::orderBy('category_name','ASC')->get();
   
    if($flag == 1){
        $products = Product::where('subcategory_id',$id)->where('featured',1)->paginate(5);
        $products_count= count($products);
        
    }elseif($flag == 2){
        $products = Product::where('subcategory_id',$id)->where('hot_deals',1)->paginate(5);
        $products_count= count($products);
        
    }elseif($flag == 3){
        $products = Product::where('subcategory_id',$id)->where('special_offer',1)->paginate(5);
        $products_count= count($products);
        
    }elseif($flag == 4){
        $products = Product::where('subcategory_id',$id)->where('special_deals',1)->paginate(5);
        $products_count= count($products);
        
    }
    elseif($flag == 0){
        $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->get();
        $products_count =count($products);
        $products = Product::where('subcategory_id',$id)->paginate(5);
        
        
    }
    
    return view('frontend.subcategory.subcategory_details',compact('category','subcategory','subcategories','products','products_count','categories','sort_flag','filter_flag','show_flag'));
}

public function SubCategoryProductShow($flag,$id){

    $subcategory = SubCategory::findOrFail($id);
    $show_flag =$flag;
    $sort_flag =0;
    $filter_flag = 0;

    $category = Category::findOrFail($subcategory->category_id);
    $subcategories = SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
    $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->get();
    $products_count =count($products);
    $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->paginate(5);
    $categories = Category::orderBy('category_name','ASC')->get();


    if($flag == 1){
        $products = Product::where('subcategory_id',$id)->limit(1)->get();
        $products_count= count($products);
        
    }elseif($flag == 2){
        $products = Product::where('subcategory_id',$id)->limit(2)->get();
        $products_count= count($products);
        
    }elseif($flag == 3){
        $products = Product::where('subcategory_id',$id)->limit(3)->get();
        $products_count= count($products);
        
    }elseif($flag == 4){
        $products = Product::where('subcategory_id',$id)->limit(4)->get();
        $products_count= count($products);
        
    }elseif($flag == 5){
        $products = Product::where('subcategory_id',$id)->orderBy('id','ASC')->get();
        $products_count =count($products);
        $products = Product::where('subcategory_id',$id)->limit(5)->get();
        
        
    }
    elseif($flag == 0){
        $products = Product::where('subcategory_id',$id)->paginate(5);
        $products_count= count($products);
       
    }
    
    return view('frontend.subcategory.subcategory_details',compact('category','subcategory','subcategories','products','products_count','categories','sort_flag','filter_flag','show_flag'));

}


 // Product   
    //
    public function ProductDetails($id,$slug){
        $product = Product::findOrFail($id);
        $multiImage = MultiImg::where('product_id',$id)->get();
        $relatedProducts = Product::where('subcategory_id',$product->subcategory_id)->
                                    where('id', '!=' , $id)->limit(4)->get();
        return view('frontend.product.product_details',compact('product','multiImage','relatedProducts'));
    }

    //
    public function VendorDetails($id){
        
        $vendor = User::findOrFail($id);
        $vproducts = Product::where('vendor_id',$id)->get();
        $vpcount= count($vproducts);

        $vproducts = Product::where('vendor_id',$id)->paginate(5); 
        $sort_flag =0;
        $show_flag = 0;
        $filter_flag = 0;
        
        return view('frontend.vendor.vendor_details',compact('vendor','vproducts','vpcount','sort_flag','show_flag','filter_flag'));
    }

    


    

    public function VendorProductSort($flag,$id){
        
        $vendor = User::findOrFail($id);
        $sort_flag =$flag;
        $show_flag =0;
        $filter_flag = 0;

        $vproducts = Product::where('vendor_id',$id)->get();
        $vpcount= count($vproducts);
       
        if($flag == 1){

            $vproducts = Product::where('vendor_id',$id)->orderByRaw('CONVERT(selling_price, SIGNED) desc')->orderByRaw("CASE WHEN CONVERT(discount_price, SIGNED) IS NULL THEN CONVERT(selling_price, SIGNED) ELSE CONVERT(discount_price, SIGNED) END desc")->paginate(5);
    
        }elseif($flag == 2){
            $vproducts = Product::where('vendor_id',$id)->orderByRaw('CONVERT(selling_price, SIGNED) asc')->orderByRaw("CASE WHEN CONVERT(discount_price, SIGNED) IS NULL THEN CONVERT(selling_price, SIGNED) ELSE CONVERT(discount_price, SIGNED) END asc")->paginate(5);
            
        }elseif($flag == 3){
            $vproducts = Product::where('vendor_id',$id)->OrderBy('created_at','DESC')->paginate(5);
            
        }elseif($flag == 0){
            $vproducts = Product::where('vendor_id',$id)->paginate(5);;
           
        }
        
        return view('frontend.vendor.vendor_details',compact('vendor','vproducts','vpcount','sort_flag','show_flag','filter_flag'));
    }

    
    public function VendorProductFilter($flag,$id){
        
        $vendor = User::findOrFail($id);
        $sort_flag =0;
        $show_flag =0;
        $filter_flag = $flag;
       
        if($flag == 1){
            $vproducts = Product::where('vendor_id',$id)->where('featured',1)->paginate(5);
            $vpcount= count($vproducts);
            
        }elseif($flag == 2){
            $vproducts = Product::where('vendor_id',$id)->where('hot_deals',1)->paginate(5);
            $vpcount= count($vproducts);
            
        }elseif($flag == 3){
            $vproducts = Product::where('vendor_id',$id)->where('special_offer',1)->paginate(5);
            $vpcount= count($vproducts);
            
        }elseif($flag == 4){
            $vproducts = Product::where('vendor_id',$id)->where('special_deals',1)->paginate(5);
            $vpcount= count($vproducts);
            
        }
        elseif($flag == 0){
            $vproducts = Product::where('vendor_id',$id)->get();
            $vpcount= count($vproducts);
            $vproducts = Product::where('vendor_id',$id)->paginate(5);
            
            
        }
        
        return view('frontend.vendor.vendor_details',compact('vendor','vproducts','vpcount','sort_flag','show_flag','filter_flag'));
    }
    


    public function VendorProductShow($flag,$id){

        $vendor = User::findOrFail($id);
        $show_flag =$flag;
        $sort_flag =0;
        $filter_flag = 0;
        if($flag == 1){
            $vproducts = Product::where('vendor_id',$id)->limit(1)->get();
            $vpcount= count($vproducts);
            
        }elseif($flag == 2){
            $vproducts = Product::where('vendor_id',$id)->limit(2)->get();
            $vpcount= count($vproducts);
            
        }elseif($flag == 3){
            $vproducts = Product::where('vendor_id',$id)->limit(3)->get();
            $vpcount= count($vproducts);
            
        }elseif($flag == 4){
            $vproducts = Product::where('vendor_id',$id)->limit(4)->get();
            $vpcount= count($vproducts);
            
        }elseif($flag == 5){
            $vproducts = Product::where('vendor_id',$id)->limit(5)->get();
            $vpcount= count($vproducts);
            
        }
        elseif($flag == 0){
            $vproducts = Product::where('vendor_id',$id)->get();
            $vpcount= count($vproducts);
            $vproducts = Product::where('vendor_id',$id)->paginate(5);
            
           
        }
        
        return view('frontend.vendor.vendor_details',compact('vendor','vproducts','vpcount','sort_flag','show_flag','filter_flag'));
    
    }

///Vendor All 
    public function VendorAll(){
        $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->get();
        $vendorsCount = count($vendors);
        $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->paginate(4);
        
        $sort_flag =0;
        $show_flag =0;
        return view('frontend.vendor.vendor_all',compact('vendors','vendorsCount','sort_flag','show_flag'));
    }


    public function VendorSort($flag){

        $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->get();
        $vendorsCount = count($vendors);
        
        $sort_flag =$flag;
        $show_flag =0;

        if($flag == 1){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('name','Asc')->paginate(4);
        }elseif($flag == 2){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('name','DESC')->paginate(4);
        }elseif($flag == 3){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('created_at','DESC')->paginate(4);
        }elseif($flag == 0){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->paginate(4);
        }
        //dd($filter_flag);
        return view('frontend.vendor.vendor_all',compact('vendors','vendorsCount','sort_flag','show_flag'));
    }


    public function VendorShow($flag){

        
        $show_flag =$flag;
        $sort_flag =0;
        
        if($flag == 1){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->limit(1)->get();
            $vendorsCount = count($vendors);
            
        }elseif($flag == 2){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->limit(2)->get();
            $vendorsCount = count($vendors);
            
        }elseif($flag == 3){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->limit(3)->get();
            $vendorsCount = count($vendors);
            
        }elseif($flag == 4){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->limit(4)->get();
            $vendorsCount = count($vendors);
            
        }elseif($flag == 0){
            $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','Asc')->paginate(4);
            $vendorsCount = count($vendors);
           
        }
        
        return view('frontend.vendor.vendor_all',compact('vendors','vendorsCount','sort_flag','show_flag'));
    
    }


    public function VendorSearch(Request $request){

        $vendor_name = $request->vendor_name;
     
        
        $vendors = User::where('status','active')->where('role','vendor')->where('name',$vendor_name)->get();
        $vendorsCount = count($vendors);

        $sort_flag =0;
        $show_flag =-1;
        return view('frontend.vendor.vendor_all',compact('vendors','vendorsCount','sort_flag','show_flag'));
    }



// Product Modal Quick View With Ajax

    public function ProductViewAjax($id){

        $product = Product::with('category','subcategory','brand')->findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);
        $multiImage = MultiImg::where('product_id',$id)->get();

        return response()->json(array(

         'product' => $product,
         'color' => $product_color,
         'size' => $product_size,
         'multiImage' => $multiImage,

        ));

     }// End Method

}
