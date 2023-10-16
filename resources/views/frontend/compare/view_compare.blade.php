@extends('frontend.master_dashboard')
@section('main')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop <span></span> Compare
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <h1 class="heading-2 mb-10">Products Compare</h1>
                <h6 class="text-body mb-40" id="ajaxCompareCount">There are <span class="text-brand">{{$compareQty}}</span> products to compare</h6>
                <div class="table-responsive">
                    <table class="table text-center table-compare">
                        <tbody id="compareProducts">
                            <tr class="pr_image">
                                <td class="text-muted font-sm fw-600 font-heading mw-200" >Preview</td>
                                @foreach ($comparelist as $item)
                                   <td class="row_img"><img src="{{asset($item['product']['product_thambnail'])}}" alt="compare-img" style="max-width: 200px;max-height:200px;"/></td>
                                @endforeach
                            </tr>
                            <tr class="pr_title">
                                <td class="text-muted font-sm fw-600 font-heading">Name</td>
                                @foreach ($comparelist as $item)
                                    <td class="product_name">
                                        <h6><a href="{{'/product/details/'.$item['product']['id'].'/'.$item['product']['product_slug']}}" target="_blank" class="text-heading">{{$item['product']['product_name']}}</a></h6>
                                    </td>
                                @endforeach
                            </tr>
                            <tr class="pr_price">
                                <td class="text-muted font-sm fw-600 font-heading">Price</td>
                                @foreach ($comparelist as $item)
                                @if($item['product']['discount_price'] == null)
                                            <td class="product_price">
                                                <h4 class="price text-brand">{{$item['product']['selling_price']}}</h4>
                                            </td>                                 
                                        @else
                                            <td class="product_price">
                                                <h4 class="price text-brand">{{$item['product']['discount_price']}}</h4>
                                            </td>
                                        @endif
                                    
                                @endforeach
                            </tr>
                            <tr class="pr_rating">
                                <td class="text-muted font-sm fw-600 font-heading">Rating</td>
                                @foreach ($comparelist as $item)
                                <td>
                                    <div class="rating_wrap">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="rating_num">(121)</span>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            <tr class="description">
                                <td class="text-muted font-sm fw-600 font-heading">Description</td>
                                @foreach ($comparelist as $item)
                                    <td class="row_text font-xs">
                                        <p class="font-sm text-muted">{{substr($item['product']['short_descp'], 0, 100)}}</p>
                                    </td>
                                @endforeach
                                
                            </tr>
                            <tr class="pr_stock">
                                <td class="text-muted font-sm fw-600 font-heading">Stock status</td>
                                @foreach ($comparelist as $item)
                                    @if($item['product']['product_qty'] > 0)
                                    <td class="row_stock"><span class="stock-status in-stock mb-0">In Stock</span></td>
                                    @else
                                    <td class="row_stock"><span class="stock-status out-stock mb-0">Out of stock</span></td>
                                    @endif

                                @endforeach         
                                
                            </tr>
                            
                            <tr class="pr_add_to_cart">
                                <td class="text-muted font-sm fw-600 font-heading">Buy now</td>
                                @foreach ($comparelist as $item)
                                    @if($item['product']['product_qty'] > 0)
                                    <td class="row_btn">
                                        <button class="btn btn-sm"><i class="fi-rs-shopping-bag mr-5"></i>Add to cart</button>
                                    </td>
                                    @else
                                    <td class="row_btn">
                                        <button class="btn btn-sm btn-secondary"><i class="fi-rs-headset mr-5"></i>Contact Us</button>
                                    </td>
                                    @endif

                                @endforeach 
           
                            </tr>
                            <tr class="pr_remove text-muted">
                                <td class="text-muted font-md fw-600"></td>
                                @foreach ($comparelist as $item)
                                    <td class="row_remove">
                                        <a type="submit" id="{{$item->id}}" onclick="CompareRemove(this.id)" class="text-muted"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                                    </td>
                                @endforeach 
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection