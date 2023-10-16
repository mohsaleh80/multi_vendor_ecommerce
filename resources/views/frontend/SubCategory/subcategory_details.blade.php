@extends('frontend.master_dashboard')

@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-6">              
                    <img src="{{ asset($category->category_image) }}"  style="height:100px;width:100px;" alt="" />               
                    <h1 class="mb-15">{{$subcategory->subcategory_name}}</h1>
                    <div class="breadcrumb">
                        <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> {{$category->category_name}} <span></span> {{$subcategory->subcategory_name}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ $products_count }}</strong> items for you!</p>
                </div>
                <div class="sort-by-product-area">
                     <!-- Show -->
                     <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <select name="show_flag" class="form-select" id="inputVendor">
                                    <option value="0" @if ($show_flag ==0) selected @endif></option>
                                    <option value="1" @if ($show_flag ==1) selected @endif>1</option>
                                    <option value="2" @if ($show_flag ==2) selected @endif>2</option>
                                    <option value="3" @if ($show_flag ==3) selected @endif>3</option>
                                    <option value="4" @if ($show_flag ==4) selected @endif>4</option>
                                    <option value="5" @if ($show_flag==5) selected @endif>5</option>
                            </select>
                            </div>
                        </div>
                       
                    </div>
                    <!-- End Show -->

                    <!-- Filter -->
                    <div class="sort-by-cover">
                            
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fadeIn animated bx bx-filter"></i>Filter by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <select name="filter_flag" class="form-select" id="inputVendor">
                                    <option value="0" @if ($filter_flag ==0) selected @endif></option>
                                    <option value="1" @if ($filter_flag ==1) selected @endif>Featured</option>
                                    <option value="2" @if ($filter_flag ==2) selected @endif>Hot</option>
                                    <option value="3" @if ($filter_flag ==3) selected @endif>Offer</option>
                                    <option value="4" @if ($filter_flag ==4) selected @endif>Special</option>
                            </select>
                            </div>
                        </div>
                       
                    </div>
                    <!-- End Filter -->

                    <!-- Sort -->
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <select name="sort_flag" class="form-select" id="inputVendor">
                                    <option value="0" @if ($sort_flag ==0) selected @endif></option>
                                    <option value="1" @if ($sort_flag ==1) selected @endif>Price : High to Low</option>
                                    <option value="2" @if ($sort_flag ==2) selected @endif>Price : Low to High</option>
                                    <option value="3" @if ($sort_flag ==3) selected @endif>Release Date</option>
                            </select>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="row product-grid">

                @foreach($products as $product)
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">
                                    <img class="default-img" src="{{ asset($product->product_thambnail) }}" alt="" />
                                    <img class="hover-img" src="{{ asset($product->product_thambnail) }}" alt="" />
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="Add To Wishlist" class="action-btn" id="{{$product->id}}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                                <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productQuickView(this.id)"><i class="fi-rs-eye"></i></a>
                            </div>
                            <div class="product-badges product-badges-position product-badges-mrg">
                                @if ($product->hot_deals ==1)
                                    <span class="hot">Hot</span>
                                @elseif ($product->featured ==1)
                                    <span class="new">Featured</span>
                                @elseif ($product->special_offer ==1)
                                    <span class="sale">Offer</span>
                                @elseif ($product->special_deals ==1)
                                    <span class="best">Special</span>
                                @else
                                    
                                @endif

                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <div class="product-category">
                                <br/>
                            
                                <a href="{{route('subcategory.details',[$subcategory->id,$subcategory->subcategory_slug])}}">{{$product['subcategory']['subcategory_name']}}</a>
                            </div>
                            <h2><a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">
                                {{$product->product_name}}</a></h2>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                            <div>
                                <span class="font-small text-muted">By 
                                @if(is_null($product->vendor_id)) 
                                <a href="{{route('about')}}" target="_blank">   
                                    MVE</a> 
                                @else
                                <a href="{{route('vendor.details',$product->vendor_id)}}" target="_blank">   
                                    {{$product['vendor']['name']}}</a>
                                @endif
                                </span>
                            </div>
                            <div class="product-card-bottom">
                                <div class="product-price">
                                    @if(is_null($product->discount_price))
                                    <span>{{$product->selling_price}}</span>
                                    @else
                                        <span>{{$product->discount_price}}</span>
                                        <span class="old-price">{{$product->selling_price}}</span>
                                    @endif
                                    
                                </div>
                                <div class="add-cart">
                                    <a class="add" aria-label="Quick view"  data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productQuickView(this.id)"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end product card-->

                @endforeach






            </div>
            <!--product grid
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>-->
          @if($show_flag ==0)
            {{$products->links()}}
            <!--End Deals-->
          @endif

        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">{{$category->category_name}}</h5>
                <ul>
                    @foreach($subcategories as $subitem)

                        @php 
                          $sub_products = App\Models\Product::where('subcategory_id',$subitem->id)->get();
                        @endphp
                        <li>
                            <a href="{{route('subcategory.details',[$subitem->id,$subitem->subcategory_slug])}}"> 
                                <img src="{{ asset($category->category_image) }}" alt="" />
                                {{$subitem->subcategory_name}}</a>
                                <span class="text-brand"> {{count($sub_products)}}</span>
                        </li>
                   @endforeach
                </ul>
            </div>
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">Category</h5>
                <ul>

                    @foreach($categories as $item)

                        @php
                        $products = App\Models\Product::where('category_id',$item->id)->get();
                        @endphp


                        <li>
                            <a href="{{route('category.details',[$item->id,$item->category_slug])}}"> 
                                <img src=" {{ asset($item->category_image) }} " alt="" />{{ $item->category_name }} </a> 
                            <span class="text-brand"> {{ count($products) }}</span>
                        </li>
                    @endforeach 
                </ul>
            </div>
            <!-- Fillter By Price -->

            <!-- Product sidebar Widget 
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="assets/imgs/shop/thumbnail-3.jpg" alt="#" />
                    </div>
                    <div class="content pt-10">
                        <h5><a href="shop-product-detail.html">Chen Cardigan</a></h5>
                        <p class="price mb-0 mt-5">$99.50</p>
                        <div class="product-rate">
                            <div class="product-rating" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="assets/imgs/shop/thumbnail-4.jpg" alt="#" />
                    </div>
                    <div class="content pt-10">
                        <h6><a href="shop-product-detail.html">Chen Sweater</a></h6>
                        <p class="price mb-0 mt-5">$89.50</p>
                        <div class="product-rate">
                            <div class="product-rating" style="width: 80%"></div>
                        </div>
                    </div>
                </div>
                <div class="single-post clearfix">
                    <div class="image">
                        <img src="assets/imgs/shop/thumbnail-5.jpg" alt="#" />
                    </div>
                    <div class="content pt-10">
                        <h6><a href="shop-product-detail.html">Colorful Jacket</a></h6>
                        <p class="price mb-0 mt-5">$25</p>
                        <div class="product-rate">
                            <div class="product-rating" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
            -->

        </div>
    </div>
</div>



<script type="text/javascript">
  		
    $(document).ready(function(){
      $('select[name="sort_flag"]').on('change', function(){
        var sort_flag = $(this).val();
      //alert(sort_flag);
      

       if (sort_flag) {

            var id = {{ Js::from($subcategory->id) }};
            //alert(id);
            var url = "{{ route('subcategory.product.sort',[':sort_flag' ,':id']) }}";
            url = url.replace(':sort_flag', sort_flag);
            url = url.replace(':id', id);
        
            location.href = url;
        } 
       
      });
    });
  </script>

  
<script type="text/javascript">
  		
    $(document).ready(function(){
      $('select[name="filter_flag"]').on('change', function(){
        var filter_flag = $(this).val();
      //alert(filter_flag);
      

       if (filter_flag) {

            var id = {{ Js::from($subcategory->id) }};
            var url = "{{ route('subcategory.product.filter',[':filter_flag' ,':id']) }}";
            url = url.replace(':filter_flag', filter_flag);
            url = url.replace(':id', id);
        
            location.href = url;
        } 
       
      });
    });
  </script>

<script type="text/javascript">
  		
    $(document).ready(function(){
      $('select[name="show_flag"]').on('change', function(){
        var show_flag = $(this).val();
     // alert(qty_flag);
      

       if (show_flag) {

            var id = {{ Js::from($subcategory->id) }};
            var url = "{{ route('subcategory.product.show',[':show_flag' ,':id']) }}";
            url = url.replace(':show_flag', show_flag);
            url = url.replace(':id', id);
        
            location.href = url;
        } 
       
      });
    });
  </script>

@endsection