
    
    @extends('layouts.app')


@section('content')
<div class="pt-5">
    <!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-01.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-02.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Converse All Star
							</a>

							<span class="header-cart-item-info">
								1 x $39.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="images/item-cart-03.jpg" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Nixon Porter Leather
							</a>

							<span class="header-cart-item-info">
								1 x $17.00
							</span>
						</div>
					</li>
				</ul>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="{{url('/cart')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						

						<div id="paypal-button"></div>



					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
			@if(Cart::count() > 0)
               
               
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
						<h3>{{Cart::count()}} items in cart</h3>
						
						@if (session()->has('success_message'))
                <div class="alert alert-success">
				
					{{ session()->get('success_message') }}
					
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

		
            





							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4 text-center">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-6"></th>
								</tr>

								
@foreach(Cart::content() as $itemm)
								<tr class="table_row">
									<td class="column-1">	
							

					<form action="{{ route('cart.destroy', $itemm->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="cart-options">Remove</button>
                            </form>

										<div class="how-itemcart1">
									
											<a href="{{url('/shop/'.$itemm->model->slug)}}  ">
											<img src="{{ asset('assets/images/'.$itemm->model->slug.'.jpg') }}" alt="IMG">
											</a>
										</div>
									</td>
									<td class="column-2">
									<a href="{{url('/shop/'.$itemm->model->slug)}}"> 
									@isset( $itemm->model->name)
									
									{{ $itemm->model->name }}
									<br>
									
									{{ str_limit($itemm->model->details, $limit = 15, $end = '...') }}
									@endisset
</a>

									</td>
									<td class="column-3"> {{$itemm->model->presentPrice()}}</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class=" zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product2" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class=" zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">{{Cart::total()}}</td>
									<td class="column-6 pr-2 w-15">

									<form action="{{ route('cart.switchToSaveForLater', $itemm->rowId) }}" method="POST">
                                {{ csrf_field() }}

                                <button type="submit"  class="btn btn-outline-secondary">Save for Later</button>
                            </form>

									</td>
								</tr>
@endforeach




							</table>








						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>

							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
						</div>
					</div>
				</div>

				

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
							{{	Cart::subtotal()}}
								</span>
							</div>
						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									<div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
								32
								</span>
							</div>
						</div>

						<!-- <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout

						</button> -->


						<div id="paypal-button-container"></div>



						
					</div>
				</div>
				@else
				
<div class=" col-md-12 text-center"> 
				<h3>no items in cart</h3>
				<br>
				<a href="{{url('/shop')}}" class="btn btn-primary btn-lg">continue shopping</a>
				</div>
				@endif







<div>
	
				@if (session()->has('success_message'))
                <div class="alert alert-success">
				
					{{ session()->get('success_message') }}
					
                </div>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif




				@if(Cart::instance('saveForLater')->count() > 0)
<br>
<h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h2>
</div>
							<table class="table-shopping-cart">
								<!-- <h3>saved for later!</h3> -->
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4">Quantity</th>
									<th class="column-5">Total</th>
									<th class="column-6"></th>
								</tr>

								
								@foreach (Cart::instance('saveForLater')->content() as $itemm)
									<tr class="table_row">
									<td class="column-1">	
							

					<form action="{{ route('SaveForLater.destroy', $itemm->rowId) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="cart-options">Remove</button>
                            </form>

										<div class="how-itemcart1">
									
											<a href="{{url('/shop/'.$itemm->model->slug)}}  ">
											<img src="{{ asset('assets/images/'.$itemm->model->slug.'.jpg') }}" alt="IMG">
											</a>
										</div>
									</td>
									<td class="column-2">
									<a href="{{url('/shop/'.$itemm->model->slug)}}"> 
									@isset( $itemm->model->name)
									
									{{ $itemm->model->name }}
									<br>
									
									{{ str_limit($itemm->model->details, $limit = 15, $end = '...') }}
									@endisset
</a>

									</td>
									<td class="column-3"> {{$itemm->model->presentPrice()}}</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product2" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5">{{Cart::total()}}</td>
									<td class="column-6">


									                            <form action="{{ route('saveForLater.switchToCart', $itemm->rowId) }}" method="POST">
                                {{ csrf_field() }}

                                <button type="submit" class="cart-options">Move to Cart</button>
                            </form>

									</td>
								</tr>
@endforeach




							</table>




@else
no items saved for later!
@endif
































			</div>
		</div>
</div>
    


   
<div class="container">

<div class="row">
@foreach($mightAlsoLike as $product)

<div class="col-sm-3 p-l-15 p-r-15 p-t-15 p-b-15">
    <!-- Block2 -->
    <div class="block-2">
        <div class="block2-pic hov-img0">
            <img  src="{{asset('assets/images/'.$product->slug.'.jpg')}}" alt="IMG-PRODUCT">

            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                Quick View
            </a>
        </div>

        <div class="block2-txt flex-w flex-t p-t-14">
            <div class="block2-txt-child1 flex-col-l ">
                <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                    {{$product->name}}
                </a>

                <span class="stext-105 cl3">
                    
                    {{$product->presentPrice()}}
                </span>
            </div>

            <div class="block2-txt-child2 flex-r p-t-3">
                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                  <i class="far fa-heart"></i>							
                    
                </a>
            </div>
        </div>
    </div>
</div>

@endforeach



</div>
</div>
        
    </div>
    @endsection