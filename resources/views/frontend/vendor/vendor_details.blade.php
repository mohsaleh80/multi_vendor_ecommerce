@extends('frontend.master_dashboard')
@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('welcome')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Vendor<span></span> {{$vendor->name}}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="archive-header-2 text-center pt-80 pb-50">
            <h1 class="display-2 mb-50">{{$vendor->name}}</h1>
            
        </div>
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{$vpcount}}</strong> items for you!</p>
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
                            <!--
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>-->
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
                           <!--
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                            -->
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
                           <!--
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                            -->
                        </div>
                        <!-- End Sort -->

                    </div>
                </div>
                <div class="row product-grid">
                    
                    @foreach($vproducts as $product)
                           
                           
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
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
                                            <a href="{{route('category.details',[$product['category']['id'],$product['category']['category_slug']])}}" target="_blank">{{$product['category']['category_name']}}</a>
                                        </div>
                                        <h2><a href="{{'/product/details/'.$product->id.'/'.$product->product_slug}}" target="_blank">{{$product->product_name}}</a></h2>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                        <div>
                                            <span class="font-small text-muted">By <a href="{{route('vendor.details',$vendor->id)}}" target="_blank">{{$vendor->name}}</a></span>
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
                         
                    @endforeach
                    <!--end product card-->
                    
                    
                </div>
                
                <!--product grid Pagination-->
                <!--
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <li class="page-item">
                                <i class=" page-link fi-rs-arrow-small-left"></i>
                            </li>
                            {{-- 
                            <li class="page-item @if($skip == 0) active @endif"><a class="page-link" href="{{route('vendor.details',$vendor->id)}}">1</a></li>
                            @for($i = 1; $i < ($vpcount/5); $i++)
                             @php $newskip = $i*5 @endphp
                            <li class="page-item @if($skip == $newskip) active @endif"><a class="page-link" href="{{route('vendor.pagination',[$vendor->id,$newskip])}}">{{$i+1}}</a></li>
                            
                            @endfor
                            --}}

                            <li class="page-item">
                                <i class="page-link fi-rs-arrow-small-right"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
            -->
            @if($show_flag == 0)  
            {{ $vproducts->links() }}
            @endif
                <!--End Deals-->
            </div>

            <!--Vendor Info-->
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                    <div class="vendor-logo mb-30">
                        <img src="{{asset($vendor->photo)}}" alt="" />
                    </div>
                    <div class="vendor-info">
                        <div class="product-category">
                            <span class="text-muted">Since {{$vendor->created_at->format('Y')}}</span>
                        </div>
                        <h4 class="mb-5"><a href="vendor-details-1.html" class="text-heading">{{$vendor->name}}</a></h4>
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                        </div>
                        <div class="vendor-des mb-30">
                            <p class="font-sm text-heading">{{$vendor->short_description}}</p>
                        </div>
                        <div class="follow-social mb-20">
                            <h6 class="mb-15">Follow Us</h6>
                            <ul class="social-network">
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/social-fb.svg')}}" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/social-insta.svg')}}" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="{{asset('frontend/assets/imgs/theme/icons/social-pin.svg')}}" alt="" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="vendor-info">
                            <ul class="font-sm mb-20">
                                <li><img class="mr-5" src="{{asset('frontend/assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address: </strong> <span>{{$vendor->address}}</span></li>
                                <li><img class="mr-5" src="{{asset('frontend/assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Call Us:</strong><span>{{$vendor->phone}}</span></li>
                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /> <strong>Email:</strong><span>{{$vendor->email}}</span></li>
                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-clock.svg') }}" alt="" /> <strong>Hours:</strong><span>10:00 - 18:00, Mon - Sat</span></li>
                            </ul>
                            <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                
                
               
                
            </div>
            <!--End Vendor Info-->
        </div>
    </div>
</main>
<script type="text/javascript">
  		
    $(document).ready(function(){
      $('select[name="sort_flag"]').on('change', function(){
        var sort_flag = $(this).val();
      //alert(sort_flag);
      

       if (sort_flag) {

            var id = {{ Js::from($vendor->id) }};
            var url = "{{ route('vendor.product.sort',[':sort_flag' ,':id']) }}";
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

            var id = {{ Js::from($vendor->id) }};
            var url = "{{ route('vendor.product.filter',[':filter_flag' ,':id']) }}";
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

            var id = {{ Js::from($vendor->id) }};
            var url = "{{ route('vendor.product.show',[':show_flag' ,':id']) }}";
            url = url.replace(':show_flag', show_flag);
            url = url.replace(':id', id);
        
            location.href = url;
        } 
       
      });
    });
  </script>

@endsection