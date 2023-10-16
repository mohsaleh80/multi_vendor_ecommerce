@extends('frontend.master_dashboard')

@section('main')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('welcome') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> {{$product['category']['category_name']}} <span></span>
                {{$product['subcategory']['subcategory_name']}} <span></span>
                {{$product->product_name}}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{asset($product->product_thambnail)}}" id="mainImage" alt="product image" />
                                    </figure>
                                    {{--
                                    @foreach($multiImage as $img)
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($img->photo_name) }}" alt="product image" />
                                        </figure>
                                    @endforeach
                                    --}}
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    <div><img src="{{asset($product->product_thambnail)}}" onclick="replaceMainImg(this.src)" onmouseover="replaceMainImg(this.src)" alt="product image" /></div>
                                    @foreach($multiImage as $img)
                                     <div><img src="{{ asset($img->photo_name) }}" alt="product image" onclick="replaceMainImg(this.src)" onmouseover="replaceMainImg(this.src)"/></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            
                            <div class="detail-info pr-30 pl-30">
                                                                
                                @if ($product->product_qty >0)
                                    <span class="stock-status in-stock"> In Stock</span>  
                                @else
                                    <span class="stock-status out-stock"> Stock Out </span>                            
                                @endif

                                <h2 class="title-detail text-brand" id="details_pname">{{$product->product_name}}</h2>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        @if (is_null($product->discount_price))
                                        <span class="current-price text-brand">{{$product->selling_price}}</span>
                                        @else
                                        <span class="current-price text-brand">{{$product->discount_price}}</span>
                                        <span>
                                            @php
                                            $amount = intval($product->selling_price) - intval($product->discount_price);
						                    $discount = ($amount/intval($product->selling_price)) * 100;
                                            @endphp
                                            <span class="save-price font-md color3 ml-15">{{round($discount)}}% Off</span>
                                            <span class="old-price font-md ml-15">{{$product->selling_price}}</span>
                                        </span>  
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">
                                        {{$product->short_descp}}
                                    </p>
                                </div>
                                @if(! is_null($product->product_size))
                                    <div class="attr-detail attr-size mb-30" id="details_sizeArea">
                                        <strong class="mr-10" style="width:50px;">Size : </strong>
                                        @php
                                        $sizes = explode(",", $product->product_size);
                                        @endphp
                                    
                                        <select class="form-control unicase-form-control" id="details_size">
                                            <option selected="" value="" disabled="">--Choose Size--</option>
                                            @foreach($sizes as $size)
                                            <option value="{{ $size }}">{{ ucwords($size)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if(! is_null($product->product_color))
                                    <div class="attr-detail attr-size mb-30" id="details_colorArea">
                                        <strong class="mr-10" style="width:60px;">Color : </strong>
                                        @php
                                        $colors = explode(",", $product->product_color);
                                        @endphp
                                       
                                        <select class="form-control unicase-form-control" id="details_color">
                                            <option selected="" value="" disabled="">--Choose Color--</option>
                                            @foreach($colors as $color)
                                            <option value="{{ $color }}">{{ ucwords($color)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="detail-extralink mb-50">
                                    <div class="detail-qty border radius">
                                        <a href="javascript:DetailsqtyDown()" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" id="detailsQuanitity" class="qty-val" value="1" min="1">
                                        <a href="javascript:DetailsqtyUp()" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart" onclick="addToCartDetails({{$product->id}})"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" id="{{$product->id}}" onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                </div>
        <div class="font-xs">
        <ul class="mr-50 float-start">
            <li class="mb-5">Brand: <span class="text-brand">{{$product['brand']['brand_name']}}</span></li>
            <li class="mb-5">Category:<span class="text-brand"> {{$product['category']['category_name']}}</span></li>
            <li>Sub Category: <span class="text-brand">{{$product['subcategory']['subcategory_name']}}</span></li>
            <li>Provider: 
                @if(is_null($product->vendor_id))
                    <span class="text-brand"><a href="{{route('about')}}" target="_blank">   
                        MVE</a> </span>
                @else
                    <span class="text-brand"><a href="{{route('vendor.details',$product->vendor_id)}}" target="_blank">   
                        {{$product['vendor']['name']}}</a></span>
                @endif
            </li>
        </ul>
        <ul class="float-start">
            <li class="mb-5">SKU: <span class="text-brand">{{$product->product_code}}</span></li>
            <li class="mb-5">Tags: <span class="text-brand">{{$product->product_tags}}</span> </li>
            <li>Stock:<span class="in-stock text-brand ml-5">{{$product->product_qty}} Items In Stock</span></li>
        </ul>
        </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        {!! $product->long_descp !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Stand Up</th>
                                                <td>
                                                    <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Folded (w/o wheels)</th>
                                                <td>
                                                    <p>32.5″L x 18.5″W x 16.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Folded (w/ wheels)</th>
                                                <td>
                                                    <p>32.5″L x 24″W x 18.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="door-pass-through">
                                                <th>Door Pass Through</th>
                                                <td>
                                                    <p>24</p>
                                                </td>
                                            </tr>
                                            <tr class="frame">
                                                <th>Frame</th>
                                                <td>
                                                    <p>Aluminum</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-wo-wheels">
                                                <th>Weight (w/o wheels)</th>
                                                <td>
                                                    <p>20 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-capacity">
                                                <th>Weight Capacity</th>
                                                <td>
                                                    <p>60 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="width">
                                                <th>Width</th>
                                                <td>
                                                    <p>24″</p>
                                                </td>
                                            </tr>
                                            <tr class="handle-height-ground-to-handle">
                                                <th>Handle height (ground to handle)</th>
                                                <td>
                                                    <p>37-45″</p>
                                                </td>
                                            </tr>
                                            <tr class="wheels">
                                                <th>Wheels</th>
                                                <td>
                                                    <p>12″ air / wide track slick tread</p>
                                                </td>
                                            </tr>
                                            <tr class="seat-back-height">
                                                <th>Seat back height</th>
                                                <td>
                                                    <p>21.5″</p>
                                                </td>
                                            </tr>
                                            <tr class="head-room-inside-canopy">
                                                <th>Head room (inside canopy)</th>
                                                <td>
                                                    <p>25″</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_color">
                                                <th>Color</th>
                                                <td>
                                                    <p>Black, Blue, Red, White</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_size">
                                                <th>Size</th>
                                                <td>
                                                    <p>M, S</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="Vendor-info">
                                   @if(is_null($product->vendor_id)) 
                                    <div class="vendor-logo d-flex mb-30">
                                        <img src="{{ asset('frontend/assets/imgs/theme/logo-bravo-main-2.png') }}" alt="" />
                                        <div class="vendor-name ml-15">
                                            <h6>
                                                <a href="vendor-details-2.html">MVE MultiVendorECommerce Co.</a>
                                            </h6>
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="contact-infor mb-50">
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined Kent, Utah 53127 United States</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Contact Seller:</strong><span>(+91) - 540-025-553</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /><strong>Email:</strong><span>sale@MVE.com</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-clock.svg') }}" alt="" /><strong>Hours:</strong><span>10:00 - 18:00, Mon - Sat</span></li>
                                    </ul>
                                    <div class="d-flex mb-55">
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Rating</p>
                                            <h4 class="mb-0">92%</h4>
                                        </div>
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Ship on time</p>
                                            <h4 class="mb-0">100%</h4>
                                        </div>
                                        <div>
                                            <p class="text-brand font-xs">Chat response</p>
                                            <h4 class="mb-0">89%</h4>
                                        </div>
                                    </div>
                                    <p>MVE MultiVendorECommerce is an American fast-casual restaurant that offers international and American noodle dishes and pasta in addition to soups and salads. Noodles & Company was founded in 1995 by Aaron Kennedy and is headquartered in Broomfield, Colorado. The company went public in 2013 and recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles & Company locations across 29 states and Washington, D.C.</p>
                                   @else
                                   <div class="vendor-logo d-flex mb-30">
                                    <img src="{{ (!is_null($product['vendor']['photo'])) ? url($product['vendor']['photo']):url('uploads/no_image.jpg') }}" alt="" />
                                    <div class="vendor-name ml-15">
                                        <h6>
                                            <a href="vendor-details-2.html">{{$product['vendor']['name']}} .</a>
                                        </h6>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div>
                                    </div>
                                    <ul class="contact-infor mb-50">
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>{{$product['vendor']['address']}}</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Contact Seller:</strong><span> {{$product['vendor']['phone']}}</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /><strong>Email:</strong><span> {{$product['vendor']['email']}}</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-clock.svg') }}" alt="" /><strong>Hours:</strong><span> 10:00 - 18:00, Mon - Sat</span></li>
                                    </ul>
                                    <div class="d-flex mb-55">
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Rating</p>
                                            <h4 class="mb-0">92%</h4>
                                        </div>
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Ship on time</p>
                                            <h4 class="mb-0">100%</h4>
                                        </div>
                                        <div>
                                            <p class="text-brand font-xs">Chat response</p>
                                            <h4 class="mb-0">89%</h4>
                                        </div>
                                    </div>
                                    <p> {{$product['vendor']['short_description']}}</p>

                                   @endif
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    <div class="single-comment justify-content-between d-flex mb-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-2.png" alt="" />
                                                                <a href="#" class="font-heading text-brand">Sienna</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 100%"></div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-3.png" alt="" />
                                                                <a href="#" class="font-heading text-brand">Brenna</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 80%"></div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="assets/imgs/blog/author-4.png" alt="" />
                                                                <a href="#" class="font-heading text-brand">Gemma</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4, 2022 at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 80%"></div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit exercitationem accusantium obcaecati quos voluptate nesciunt facilis itaque modi commodi dignissimos sequi repudiandae minus ab deleniti totam officia id incidunt? <a href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="product-rate d-inline-block mb-30"></div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="#" id="commentForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email" id="email" type="email" placeholder="Email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website" type="text" placeholder="Website" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Related products</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                              @foreach($relatedProducts as $relatedProduct)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{'/product/details/'.$relatedProduct->id.'/'.$relatedProduct->product_slug}}" tabindex="0" target="_blank">
                                                    <img class="default-img" src="{{asset($relatedProduct->product_thambnail)}}" alt="" />
                                                    <img class="hover-img" src="{{asset($relatedProduct->product_thambnail)}}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                                <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @if ($relatedProduct->hot_deals ==1)
                                                    <span class="hot">Hot</span>
                                                @elseif ($relatedProduct->featured ==1)
                                                    <span class="new">Featured</span>
                                                @elseif ($relatedProduct->special_offer ==1)
                                                    <span class="sale">Offer</span>
                                                @elseif ($relatedProduct->special_deals ==1)
                                                    <span class="best">Special</span>
                                                @else
                                                    
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="{{'/product/details/'.$relatedProduct->id.'/'.$relatedProduct->product_slug}}" tabindex="0" target="_blank">
                                                {{$relatedProduct->product_name}}</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span> </span>
                                            </div>
                                            <div class="product-price">
                                                @if(is_null($relatedProduct->discount_price))
                                                <span>{{$relatedProduct->selling_price}}</span>
                                                @else
                                                    <span>{{$relatedProduct->discount_price}}</span>
                                                    <span class="old-price">{{$relatedProduct->selling_price}}</span>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              @endforeach  
                                <!--
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html" tabindex="0">
                                                    <img class="default-img" src="assets/imgs/shop/product-3-1.jpg" alt="" />
                                                    <img class="hover-img" src="assets/imgs/shop/product-4-2.jpg" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="sale">-12%</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="shop-product-right.html" tabindex="0">Smart Bluetooth Speaker</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span> </span>
                                            </div>
                                            <div class="product-price">
                                                <span>$138.85 </span>
                                                <span class="old-price">$145.8</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html" tabindex="0">
                                                    <img class="default-img" src="assets/imgs/shop/product-4-1.jpg" alt="" />
                                                    <img class="hover-img" src="assets/imgs/shop/product-4-2.jpg" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="new">New</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="shop-product-right.html" tabindex="0">HomeSpeak 12UEA Goole</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span> </span>
                                            </div>
                                            <div class="product-price">
                                                <span>$738.85 </span>
                                                <span class="old-price">$1245.8</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6 d-lg-block d-none">
                                    <div class="product-cart-wrap hover-up mb-0">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="shop-product-right.html" tabindex="0">
                                                    <img class="default-img" src="assets/imgs/shop/product-5-1.jpg" alt="" />
                                                    <img class="hover-img" src="assets/imgs/shop/product-3-2.jpg" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="shop-product-right.html" tabindex="0">Dadua Camera 4K 2022EF</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span> </span>
                                            </div>
                                            <div class="product-price">
                                                <span>$89.8 </span>
                                                <span class="old-price">$98.8</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>

    function DetailsqtyUp(){
           
           var qty = parseInt(document.getElementById("detailsQuanitity").value);
           qty = qty+1;
           document.getElementById("detailsQuanitity").value= qty;
           
            
        }
    
        function DetailsqtyDown(){
           
           var qty = parseInt(document.getElementById("detailsQuanitity").value);
           qty = qty - 1;
           // min value = 1;
           if(qty == 0){ qty = 1;}
           document.getElementById("detailsQuanitity").value= qty;
           
            
        }
    </script>

    <script>

          
        
        function replaceMainImg(srcImg){

            //alert(srcImg);
            $('#mainImage').attr('src',srcImg);
        }

    </script>
    
@endsection