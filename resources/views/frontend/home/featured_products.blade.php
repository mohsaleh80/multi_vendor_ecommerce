@php
   $FeaturedProducts = App\Models\Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(10)->get();

@endphp 

<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>
            
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                
                             @foreach( $FeaturedProducts as $product)   
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">
                                                <img class="default-img" src="{{ asset($product->product_thambnail) }}" alt="" />
                                                <img class="hover-img" src="{{ asset($product->product_thambnail) }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productQuickView(this.id)"> <i class="fi-rs-eye"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up" id="{{$product->id}}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            
                                            @if(is_null($product->discount_price))
                                                <span class="new">Featured</span>
                                            @else
                                                @php
                                                $amount = intval($product->selling_price) - intval($product->discount_price);
                                                $discount = ($amount/intval($product->selling_price)) * 100;
                                                @endphp
                                                <span class="hot">Save {{round($discount)}}%</span>
                                            
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{route('category.details',[$product['category']['id'],$product['category']['category_slug']])}}" target="_blank">{{$product['category']['category_name']}}</a>
                                        </div>
                                        <h2><a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">
                                            {{$product->product_name}}</a></h2>
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <div class="product-price mt-10">
                                                    @if(is_null($product->discount_price))
                                                    <span>{{$product->selling_price}}</span>
                                                    @else
                                                        <span>{{$product->discount_price}}</span>
                                                        <span class="old-price">{{$product->selling_price}}</span>
                                                    @endif
                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> <span class="text-brand">Stock: </span>{{$product->product_qty}}</span>
                                        </div>
                                        <a aria-label="Quick view"  data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productQuickView(this.id)" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                    </div>
                                </div>
                                <!--End product Wrap-->

                             @endforeach
                               
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->

                
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>