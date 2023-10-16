@extends('frontend.master_dashboard')

@section('main')

        <!--Start hero slider-->
        @include('frontend.home.slider')
        <!--End hero slider-->

        <!--Start category slider-->
        @include('frontend.home.featured_categories')
        <!--End category slider-->

        <!--Start banners-->
        @include('frontend.home.banner')
        <!--End banners-->



        <!--New Products Tabs-->
        @include('frontend.home.new_products')
        <!--New Products Tabs-->



        <!--Start (Featured Products) Best Sales-->
        @include('frontend.home.featured_products')
        <!--End (Featured Products) Best Sales-->




        <!-- Fashion Category -->
            <section class="product-tabs section-padding position-relative">
                        <div class="container">
                            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                                <h3>Fashion Category </h3>
                            
                            </div>
                            <!--End nav-tabs-->
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                                    <div class="row product-grid-4">


                                        @foreach($FashionProducts as $product)
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
                                                    
                                                        <a href="{{route('subcategory.details',[$product['subcategory']['id'],$product['subcategory']['subcategory_slug']])}}" target="_blank">{{$product['subcategory']['subcategory_name']}}</a>
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
                                    <!--End product-grid-4-->
                                </div>
                            
                            
                            </div>
                            <!--End tab-content-->
                        </div>


            </section>
        <!--End Fashion Category -->





        <!-- Beauty Category -->
            <section class="product-tabs section-padding position-relative">
                        <div class="container">
                            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                                <h3>Beauty Category </h3>
                            
                            </div>
                            <!--End nav-tabs-->
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                                    <div class="row product-grid-4">



                                        @foreach($BeautyProducts as $product)
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
                                                    
                                                        <a href="{{route('subcategory.details',[$product['subcategory']['id'],$product['subcategory']['subcategory_slug']])}}" target="_blank">{{$product['subcategory']['subcategory_name']}}</a>
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
                                        <!--end product card-->



                                        
                                    
                                    </div>
                                    <!--End product-grid-4-->
                                </div>
                            
                            
                            </div>
                            <!--End tab-content-->
                        </div>


            </section>
        <!--End Beauty Category -->








        <!-- Vape Category -->
            <section class="product-tabs section-padding position-relative">
                        <div class="container">
                            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                                <h3>Vape Category </h3>
                            
                            </div>
                            <!--End nav-tabs-->
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                                    <div class="row product-grid-4">

                                        @foreach($VapeProducts as $product)
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
                                                    
                                                        <a href="{{route('subcategory.details',[$product['subcategory']['id'],$product['subcategory']['subcategory_slug']])}}" target="_blank">{{$product['subcategory']['subcategory_name']}}</a>
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
                                        <!--end product card-->

                                        
                                    
                                    </div>
                                    <!--End product-grid-4-->
                                </div>
                            
                            
                            </div>
                            <!--End tab-content-->
                        </div>


            </section>
        <!--End Vape Category -->








            <!--Start 4 columns(Hot Deals | Special Offer | Recently added | Special Deals)-->
            <section class="section-padding mb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                            <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                            <div class="product-list-small animated animated">

                                @foreach($HotDeals as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">
                                            <img src="{{ asset($product->product_thambnail) }}" alt="" /></a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <h6>
                                            <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">{{$product->product_name}}</a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if(is_null($product->discount_price))
                                                    <span>{{$product->selling_price}}</span>
                                                    @else
                                                        <span>{{$product->discount_price}}</span>
                                                        <span class="old-price">{{$product->selling_price}}</span>
                                                    @endif
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                                
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                            <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
                            <div class="product-list-small animated animated">
                                @foreach($SpecialOffers as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">
                                            <img src="{{ asset($product->product_thambnail) }}" alt="" /></a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <h6>
                                            <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">{{$product->product_name}}</a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if(is_null($product->discount_price))
                                                    <span>{{$product->selling_price}}</span>
                                                    @else
                                                        <span>{{$product->discount_price}}</span>
                                                        <span class="old-price">{{$product->selling_price}}</span>
                                                    @endif
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                            <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                            <div class="product-list-small animated animated">
                                @foreach($Featureds as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">
                                            <img src="{{ asset($product->product_thambnail) }}" alt="" /></a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <h6>
                                            <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">{{$product->product_name}}</a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if(is_null($product->discount_price))
                                                    <span>{{$product->selling_price}}</span>
                                                    @else
                                                        <span>{{$product->discount_price}}</span>
                                                        <span class="old-price">{{$product->selling_price}}</span>
                                                    @endif
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                            <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                            <div class="product-list-small animated animated">
                                @foreach($SpecialDeals as $product)
                                <article class="row align-items-center hover-up">
                                    <figure class="col-md-4 mb-0">
                                        <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">
                                            <img src="{{ asset($product->product_thambnail) }}" alt="" /></a>
                                    </figure>
                                    <div class="col-md-8 mb-0">
                                        <h6>
                                            <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">{{$product->product_name}}</a>
                                        </h6>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div class="product-price">
                                            @if(is_null($product->discount_price))
                                                    <span>{{$product->selling_price}}</span>
                                                    @else
                                                        <span>{{$product->discount_price}}</span>
                                                        <span class="old-price">{{$product->selling_price}}</span>
                                                    @endif
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--End 4 columns-->









            <!--Vendor List -->
             @include('frontend.home.vendor_list')       
            <!--End Vendor List -->





    
    
@endsection