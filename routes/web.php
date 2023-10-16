<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Backend\ShippingAreaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', function () {
    return view('frontend.index');
})->name('welcome');
*/
Route::get('/', [IndexController::class, 'Index'])->name('welcome');



Route::get('/dashboard', function () {

    $role = Auth::user()->role;

    if($role == 'admin'){
        return redirect()->Route('admin.dashboard');
    }elseif($role == 'vendor'){
        return redirect()->Route('vendor.dashboard');
    }elseif($role == 'user'){
       // return view('dashboard');
       return redirect()->Route('user.dashboard');
    }
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// User
Route::middleware(['auth','role:user'])->group(function () {
    
    Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
    
});

// Admin
Route::middleware(['auth','role:admin'])->group(function () {
    
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    
});

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [VendorController::class, 'vendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');

//Vendor
Route::middleware(['auth','role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'destroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/update', [VendorController::class, 'vendorProfileUpdate'])->name('vendor.profile.update');
    Route::get('/vendor/change/password', [VendorController::class, 'vendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password', [VendorController::class, 'vendorUpdatePassword'])->name('vendor.update.password');
});
    
Route::middleware(['auth','role:admin'])->group(function () {    

        Route::controller(BrandController::class)->group(function(){

            Route::get('/brand/all','index')->name('brand.all'); 
            Route::get('/brand/add','create')->name('brand.add'); 
            Route::post('/brand/add','store')->name('brand.add');
            Route::get('/brand/{id}/edit','edit')->name('brand.edit');
            Route::put('/brand/{id}','update')->name('brand.update'); 
            Route::delete('/brand/{id}','destroy')->name('brand.destroy');
        });

});

//Category
Route::middleware(['auth','role:admin'])->group(function () {    

    Route::controller(CategoryController::class)->group(function(){

        Route::get('/category/all','index')->name('category.all'); 
        Route::get('/category/add','create')->name('category.add'); 
        Route::post('/category/add','store')->name('category.add');
        Route::get('/category/{id}/edit','edit')->name('category.edit');
        Route::put('/category/{id}','update')->name('category.update'); 
       // Route::delete('/category/{id}','destroy')->name('category.destroy');
        Route::get('/category/{id}','delete')->name('category.delete');
    });

});

//SubCategory
Route::middleware(['auth','role:admin'])->group(function () {    

    Route::controller(SubCategoryController::class)->group(function(){

        Route::get('/subcategory/all','index')->name('subcategory.all'); 
        Route::get('/subcategory/add','create')->name('subcategory.add'); 
        Route::post('/subcategory/add','store')->name('subcategory.add');
        Route::get('/subcategory/{id}/edit','edit')->name('subcategory.edit');
        Route::put('/subcategory/{id}','update')->name('subcategory.update'); 
       // Route::delete('/subcategory/{id}','destroy')->name('subcategory.destroy');
        Route::get('/subcategory/{id}','delete')->name('subcategory.delete');

        Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');
        
    });

});

//Admin Active and inactive Vendor
Route::middleware(['auth','role:admin'])->group(function () {    

    Route::controller(AdminController::class)->group(function(){

        Route::get('/inactive/vendor','getInActiveVendors')->name('inactive.vendor'); 
        Route::get('/active/vendor','getActiveVendors')->name('active.vendor'); 
        Route::get('/inactive/vendor/details/{id}' , 'InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/activate/vendor','activateVendor')->name('activate.vendor'); 
        Route::get('/active/vendor/details/{id}' , 'activeVendorDetails')->name('active.vendor.details');
        Route::post('/deactivate/vendor','deactivateVendor')->name('deactivate.vendor');
    });

});


//Admin Product
Route::middleware(['auth','role:admin'])->group(function () {    

    Route::controller(ProductController::class)->group(function(){

        Route::get('/all/product','getAllProducts')->name('all.product'); 
        Route::get('/add/product','AddProduct')->name('add.product'); 
        Route::post('/store/product' , 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}' , 'EditProduct')->name('edit.product');
        Route::post('/update/product/{id}' , 'UpdateProduct')->name('update.product');
        Route::post('/update/product/multiimage/{id}' , 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::get('/delete/product/multiimage/{id}' , 'DeleteProductMultiimage')->name('delete.product.multiimage');
        Route::get('/change/status/product/{id}','ChangeStatusProduct')->name('change.status.product');
        Route::get('/delete/product/{id}' , 'DeleteProduct')->name('delete.product');
    });

});


//Vendor Product
Route::middleware(['auth','role:vendor'])->group(function () {


  Route::controller(VendorProductController::class)->group(function(){

    Route::get('/vendor/all/product','VendorAllProducts')->name('vendor.all.product'); 
    Route::get('/vendor/add/product','VendorAddProduct')->name('vendor.add.product'); 
    Route::post('/vendor/store/product' , 'VendorStoreProduct')->name('vendor.store.product');
    Route::get('/vendor/edit/product/{id}' , 'VendorEditProduct')->name('vendor.edit.product');
    Route::post('/vendor/update/product/{id}' , 'VendorUpdateProduct')->name('vendor.update.product');
    Route::post('/vendor/update/product/multiimage/{id}' , 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');
    Route::get('/vendor/delete/product/multiimage/{id}' , 'VendorDeleteProductMultiimage')->name('vendor.delete.product.multiimage');
    Route::get('/vendor/detail/product/{id}' , 'VendorDetailProduct')->name('vendor.detail.product');
    Route::get('/vendor/change/status/product/{id}','VendorChangeStatusProduct')->name('vendor.change.status.product');
    Route::get('/vendor/delete/product/{id}' , 'VendorDeleteProduct')->name('vendor.delete.product');
    
    Route::get('/vendor/subcategory/ajax/{category_id}' , 'VendorGetSubCategory');

     
    });


});

//Slider
Route::middleware(['auth','role:admin'])->group(function () {    

    Route::controller(SliderController::class)->group(function(){

        Route::get('/slider/all','index')->name('slider.all'); 
        Route::get('/slider/add','create')->name('slider.add'); 
        Route::post('/slider/add','store')->name('slider.add');
        Route::get('/slider/{id}/edit','edit')->name('slider.edit');
        Route::put('/slider/{id}','update')->name('slider.update'); 
        Route::get('/slider/{id}','delete')->name('slider.delete');
    });

});

//Banner
Route::middleware(['auth','role:admin'])->group(function () {    

    Route::controller(BannerController::class)->group(function(){

        Route::get('/banner/all','index')->name('banner.all'); 
        Route::get('/banner/add','create')->name('banner.add'); 
        Route::post('/banner/add','store')->name('banner.add');
        Route::get('/banner/{id}/edit','edit')->name('banner.edit');
        Route::put('/banner/{id}','update')->name('banner.update'); 
        Route::get('/banner/{id}','delete')->name('banner.delete');
    });

});

//Coupon
Route::middleware(['auth','role:admin'])->group(function () {    

    Route::controller(CouponController::class)->group(function(){

        Route::get('/coupon/all','AllCoupon')->name('coupon.all'); 
        Route::get('/coupon/add','AddCoupon')->name('coupon.add'); 
        Route::post('/coupon/store','StoreCoupon')->name('coupon.store');
        Route::get('/edit/coupon/{id}' , 'EditCoupon')->name('edit.coupon');
        Route::post('/update/coupon' , 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}' , 'DeleteCoupon')->name('delete.coupon');
      
    });

});


 // Shipping Region All Route 
 Route::middleware(['auth','role:admin'])->group(function () {  

    Route::controller(ShippingAreaController::class)->group(function(){
        Route::get('/all/region' , 'AllRegion')->name('all.region');
        Route::get('/add/region' , 'AddRegion')->name('add.region');
        Route::post('/store/region' , 'StoreRegion')->name('store.region');
        Route::get('/edit/region/{id}' , 'EditRegion')->name('edit.region');
        Route::post('/update/region' , 'UpdateRegion')->name('update.region');
        Route::get('/delete/region/{id}' , 'DeleteRegion')->name('delete.region');

    }); 

});


// Shipping Devision All Route 
Route::middleware(['auth','role:admin'])->group(function () {  

    Route::controller(ShippingAreaController::class)->group(function(){
        Route::get('/all/division' , 'AllDivision')->name('all.division');
        Route::get('/add/division' , 'AddDivision')->name('add.division');
        Route::post('/store/division' , 'StoreDivision')->name('store.division');
        Route::get('/edit/division/{id}' , 'EditDivision')->name('edit.division');
        Route::post('/update/division/{id}' , 'UpdateDivision')->name('update.division');
        Route::get('/delete/division/{id}' , 'DeleteDivision')->name('delete.division');

    }); 

});


// Shipping State All Route 
Route::middleware(['auth','role:admin'])->group(function () {  

    Route::controller(ShippingAreaController::class)->group(function(){
        Route::get('/all/state' , 'AllState')->name('all.state');
        Route::get('/add/state' , 'AddState')->name('add.state');
        Route::post('/store/state' , 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}' , 'EditState')->name('edit.state');
        Route::post('/update/state/{id}' , 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}' , 'DeleteState')->name('delete.state');

        Route::get('/division/ajax/{division_id}' , 'GetDivision');
    }); 

});


//Frontend

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

// Vendor
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');
Route::get('/vendor/products/sort/{flag}/{vendor_id}' ,  [IndexController::class,'VendorProductSort'])->name('vendor.product.sort');
Route::get('/vendor/products/show/{flag}/{vendor_id}' ,  [IndexController::class,'VendorProductShow'])->name('vendor.product.show');
Route::get('/vendor/products/filter/{flag}/{vendor_id}' ,  [IndexController::class,'VendorProductFilter'])->name('vendor.product.filter');
//Route::get('/vendor/products/pagination/{id}/{newskip}', [IndexController::class, 'VendorPagination'])->name('vendor.pagination');

Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');
Route::get('/vendor/sort/{flag}' ,  [IndexController::class,'VendorSort'])->name('vendor.sort');
Route::get('/vendor/show/{flag}' ,  [IndexController::class,'VendorShow'])->name('vendor.show');
Route::post('/vendor/search' ,  [IndexController::class,'VendorSearch'])->name('vendor.search');

//About
Route::get('/about', [IndexController::class, 'About'])->name('about');
Route::get('/about/show/{flag}' ,  [IndexController::class,'AboutShow'])->name('about.show');
Route::get('/about/filter/{flag}' ,  [IndexController::class,'AboutFilter'])->name('about.filter');
Route::get('/about/sort/{flag}' ,  [IndexController::class,'AboutSort'])->name('about.sort');

//Category
Route::get('/category/details/{id}/{slug}', [IndexController::class, 'CategoryDetails'])->name('category.details');
Route::get('/category/products/sort/{flag}/{category_id}' ,  [IndexController::class,'CategoryProductSort'])->name('category.product.sort');
Route::get('/category/products/filter/{flag}/{category_id}' ,  [IndexController::class,'CategoryProductFilter'])->name('category.product.filter');
Route::get('/category/products/show/{flag}/{category_id}' ,  [IndexController::class,'CategoryProductShow'])->name('category.product.show');

//SubCategory
Route::get('/subcategory/details/{id}/{slug}', [IndexController::class, 'SubCategoryDetails'])->name('subcategory.details');
Route::get('/subcategory/products/sort/{flag}/{subcategory_id}' ,  [IndexController::class,'SubCategoryProductSort'])->name('subcategory.product.sort');
Route::get('/subcategory/products/filter/{flag}/{subcategory_id}' ,  [IndexController::class,'SubCategoryProductFilter'])->name('subcategory.product.filter');
Route::get('/subcategory/products/show/{flag}/{subcategory_id}' ,  [IndexController::class,'SubCategoryProductShow'])->name('subcategory.product.show');

// Product Modal Quick View With Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);


/// Add to cart store data

/*
Route::middleware(['auth','role:user'])->group(function () {
});
 */ 
    Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
    // Get Data from mini Cart
    Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);
    Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);


/// Add to Wishlist 
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);
/// Add to Compare 
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

/// User All Route
Route::middleware(['auth','role:user'])->group(function() {

    // Wishlist All Route 
   Route::controller(WishlistController::class)->group(function(){

       Route::get('/wishlist' , 'AllWishlist')->name('wishlist'); 
       //Ajax in user dasgboard and frontend Dashboard
       Route::get('/get-wishlist-count' , 'getWishlistCount');
       //After Remove get Products
       Route::get('/get-wishlist-product' , 'GetWishlistProduct');
       Route::get('/wishlist-remove/{id}' , 'WishlistRemove');
   
   }); 

     // Comapre All Route 
     Route::controller(CompareController::class)->group(function(){

        Route::get('/compare' , 'AllCompareList')->name('compare'); 
        //Ajax in user dasgboard and frontend Dashboard
        Route::get('/get-compare-count' , 'getCompareCount');
        Route::get('/get-compare-product' , 'GetCompareProduct');
       Route::get('/compare-remove/{id}' , 'CompareRemove');
    
    }); 

    // Cart All Route 
    Route::controller(CartController::class)->group(function(){
        Route::get('/mycart' , 'MyCart')->name('myCart');
        Route::get('/get-cart-product' , 'GetCartProduct');
        Route::get('/cart/product/remove/{rowId}', [CartController::class, 'RemoveCart']);
        Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
        Route::get('/cart-increment/{rowId}' , 'CartIncrement');
    });
   
}); // end group middleware   





    

