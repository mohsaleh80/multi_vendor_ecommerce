<section class="product-tabs section-padding position-relative">
            <div class="container">
                <div class="section-title style-2 wow animate__animated animate__fadeIn">
                    <h3> New Products </h3>

                    @php
                             $Categories = App\Models\Category::orderBy('category_name','ASC')->get(); 
                    @endphp 


                    <ul class="nav nav-tabs links" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                        </li>
                        @foreach($Categories as $category)
                        <li class="nav-item" role="presentation">
                           <!-- <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab"
                             data-bs-target="#tab-two" type="button" role="tab" 
                             aria-controls="tab-two" aria-selected="false">{{$category->category_name}}</button> -->
                             <a class="nav-link" id="nav-tab-two" data-bs-toggle="tab" 
                             href="#category{{ $category->id }}"  type="button" role="tab"
                              aria-controls="tab-two" aria-selected="false">{{ $category->category_name }}</a>
                        </li>
                        @endforeach
                       
                    </ul>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @php
                              $products = App\Models\Product::where('status',1)->orderBy('id','ASC')->limit(60)->get();
                              $i =60; 
                            @endphp 
                            
                            @foreach($products as $product)
                              @if($i%6 == 0 && $i > 0)
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
                                            
                                                <a href="{{route('category.details',[$product['category']['id'],$product['category']['category_slug']])}}" target="_blank">{{$product['category']['category_name']}}</a>
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
                              @endif
                              @php
                                $i--;
                              @endphp
                            @endforeach



                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one-->

                    <!-- Tab Two for Categories -->
                    @php
                      $Categories = App\Models\Category::orderBy('category_name','ASC')->get(); 
                    @endphp

                    @foreach($Categories as $category)

                        <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel" aria-labelledby="tab-two">
                            <div class="row product-grid-4">


                                @php
                                $catwiseProducts = App\Models\Product::where('category_id',$category->id)->orderBy('id','DESC')->limit(10)->get();
                                @endphp
                                
                                @forelse($catwiseProducts as $product)
                                
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
                                                
                                                    <a href="{{route('category.details',[$product['category']['id'],$product['category']['category_slug']])}}" target="_blank">{{$product['category']['category_name']}}</a>
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
                                @empty

                                <h5 class="text-danger"> No Product Found </h5>


                                @endforelse
                            
                            
                            </div>
                            <!--End product-grid-4-->
                        </div>
                        <!--En tab two-->
                    @endforeach
                    
                </div>
                <!--End tab-content-->
            </div>
        </section>


        