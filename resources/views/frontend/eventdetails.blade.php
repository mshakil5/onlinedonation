@extends('frontend.layouts.master')

@section('title')
 {{$data->title}}
@endsection
@section('css')
@endsection

@section('content')
<style>
    div#social-links {
        margin: 0 auto;
        max-width: 500px;
    }
    div#social-links ul li {
        display: inline-block;
    }          
    div#social-links ul li a {
        padding: 14px; 
        margin: 1px;
        font-size: 24px;
        color: #0c4c45;
        background-color: #ccc;
    }
</style>

@php

    $cardpriceshow = $data->price;
@endphp
<div class="eventDetails">
    <div class="eventBg">
        <div class="eventBanner container">
            <img src="{{asset('images/event/'.$data->image)}}" alt="">
        </div>
    </div>
    <div class="container py-5">

        <!-- Image loader -->
        <div id='loading' style='display:none ;'>
            <img src="{{ asset('loader.gif') }}" id="loading-image" alt="Loading..." style="height: 225px;" />
        </div>

        
        <div class="row px-3">

            {{-- event details section  --}}
            <div class="col-md-8 mt-5 " id="eventDesc">

                @if(session()->has('error'))
                <p class="alert alert-danger"> {{ session()->get('error') }}</p>
                @endif

                <h3 class="mb-0 darkerGrotesque-semibold txt-secondary">{{ \Carbon\Carbon::parse($data->event_start_date)->isoFormat('MMM Do YYYY')}}</h3>
                <h1 class="darkerGrotesque-bold mb-0">{{$data->title}}</h1>
                <p class="fs-5 mb-0 darkerGrotesque-bold txt-primary">{{$data->organizer}}</p>
                <h5 class="darkerGrotesque-semibold lh-1 fs-5 mt-3 text-dark">
                    <span class="darkerGrotesque-bold">Available :</span>
                    <span class="text-muted">{{$data->available}}</span>
                </h5>
                <h5 class="darkerGrotesque-semibold lh-1 fs-5 mt-3 text-dark">
                    <span class="darkerGrotesque-bold">Summary :</span>
                    <span class="text-muted">{{$data->summery}}</span>
                </h5>
                <div class="row mb-3 mt-4">
                    <div class="col-md-12">
                        <h4 class="fw-bold mb-3">When & where ? </h4>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center ">
                            <div class="">
                                <iconify-icon class="fs-1 me-2 txt-primary" icon="uim:calender"></iconify-icon>
                            </div>
                            <div class="">
                                <h5 class="mb-0 darkerGrotesque-bold txt-primary">Date and time</h5>
                                <h5 class="mb-0 darkerGrotesque-semibold">
                                    {{ \Carbon\Carbon::parse($data->event_start_date)->isoFormat('MMM Do YYYY')}} - {{ \Carbon\Carbon::parse($data->event_end_date)->isoFormat('MMM Do YYYY')}}
                                    {{-- {{$data->event_start_date}}-{{$data->event_end_date}} --}}
                                </h5>
                                <h5 class="mb-0 darkerGrotesque-semibold">
                                    {{ \Carbon\Carbon::parse($data->event_start_date)->isoFormat(' H:m:s A')}} - {{ \Carbon\Carbon::parse($data->event_end_date)->isoFormat(' H:m:s A')}}

                                    {{-- {{$data->event_start_date}}-{{$data->event_end_date}} --}}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex ">
                            <div class="">
                                <iconify-icon class="fs-1 me-2 txt-primary" icon="el:map-marker"></iconify-icon>
                            </div>
                            <div class="">
                                <h5 class="mb-0 darkerGrotesque-bold txt-primary">Location</h5>
                                <h5 class="mb-0 darkerGrotesque-semibold">{{$data->house_number}} {{$data->road_name}} {{$data->town}} {{$data->postcode}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row my-3">
                    <h3 class="darkerGrotesque-bold txt-primary">Refund Policy</h3>
                    <h5 class="mb-0 darkerGrotesque-semibold">Contact the organizer to request a refund.
                        Eventbrite's fee is nonrefundable.</h5>
                </div> --}}
                <div class="row my-3">
                    <h3 class="darkerGrotesque-bold txt-primary">About this event</h3>
                    <h5 class="mb-0 darkerGrotesque-semibold d-flex align-items-center">
                        
                        
                    </h5>
                    <p>
                        {!! $data->description !!}
                    </p>
                </div>
                {{-- <div class="row my-3">
                    <h3 class="darkerGrotesque-bold mb-3 txt-primary">Tags</h3>
                    <div class="d-flex flex-wrap">
                        <span
                            class="badge badge-pill bg-secondary darkerGrotesque-regular fs-5 d-inline me-2">Tag</span>
                        <span
                            class="badge badge-pill bg-secondary darkerGrotesque-regular fs-5 d-inline me-2">Tag</span>
                        <span
                            class="badge badge-pill bg-secondary darkerGrotesque-regular fs-5 d-inline me-2">Tag</span>
                        <span
                            class="badge badge-pill bg-secondary darkerGrotesque-regular fs-5 d-inline me-2">Tag</span>
                        <span class="badge badge-pill bg-secondary  fs-5 d-inline me-2">Tag</span>
                        <span class="badge badge-pill bg-secondary  fs-5 d-inline me-2">Tag</span>
                    </div>
                </div> --}}
            </div>
            {{-- event details section  --}}

            {{-- checkout section  --}}
            <div class="col-md-8 mt-5 " id="paymentSection">
                
                <div class="inner p-4">
                    <div class="row mb-4">
                        <a id="backBtn" class="text-start btn btn-theme bg-primary"><iconify-icon icon="material-symbols:arrow-back-rounded" class="text-white fs-4"></iconify-icon> Back</a>
                    </div>
                    <div class="border shadow-sm p-3 rounded">
                        <div class="title darkerGrotesque-bold lh-1 fs-3">Payment Methods</div>
                        
                        <div class="row">
                            <div class="col-md-12 d-flex align-items-center  lh-1  my-1">
                                <input type="checkbox" id="terms" class="terms">
                                <label for="terms" class="fs-5 fw-bold ps-2 text-dark flex-1 ">
                                    By Continuing, you agree with GoGiving <a href="{{route('frontend.terms')}}">terms</a> and <a href="{{route('frontend.privacy')}}">privacy</a>  notice.
                                </label>
                            </div>
                        </div>

                        <ul class="nav nav-tabs mt-4 border-0 py-4 justify-content-center  bg-transparent" id="paymentTab" role="tablist">

                            <li class="nav-item fs-5 mx-2" role="presentation">
                                <label for="paypal">
                                    <div class="shadow-sm d-flex align-items-center justify-content-center"
                                        id="home-tab" data-bs-toggle="tab" data-bs-target="#home" role="tab"
                                        aria-controls="home" aria-selected="true">
                                        <div class="fw-bold d-flex align-items-center">
                                            <form action="{{ route('payment') }}" method="POST" class="title">
                                                @csrf
                                                <input type="hidden" name="amount" id="paypalamount" value="">
                                                <input type="hidden" name="event_id" value="{{$data->id}}">
                                                <input type="hidden" name="paypalqty" id="paypalqty" value="1">
                                                <button type="submit" class="btn mx-auto">
                                                    <img src="{{ asset('paypal.png')}}" alt="" style="height: 50px; border-radius:5px;">
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </label>
                            </li>
                            <li class="nav-item fs-5 mx-2" role="presentation">
                                <label for="google_pay">
                                    <div class="nav-link shadow-sm d-flex align-items-center justify-content-center"
                                        id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">

                                        <div class="fw-bold d-flex align-items-center">
                                            <input type="radio" class="d-none" id="google_pay" value="google_pay" name="paymentMethod">
                                            <img src="{{ asset('stripe.png')}}" alt="" style="height: 50px; border-radius:5px;">
                                        </div>

                                    </div>
                                </label>
                            </li>

                        </ul>
                        <div class="tab-content shadow-sm" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                {{-- <h5>Pay with paypal</h5> --}}
                                
                                
                                
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                
                                <div class="ermsg">
                                </div>
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                @endif
                                <!-- Include the Stripe Elements JS library -->
                                <script src="https://js.stripe.com/v3/"></script>
        
                                <!-- Create a form to collect card details -->
                                <form id="payment-form">
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Amount</label>
                                            <input class='form-control' id="amount" name="amount" placeholder='£' type='number' step="any" value="" required>
                                        </div>
                                    </div>
        
                                    <div class='form-row row'>
                                        <div class='col-xs-12 form-group required'>
                                            <label class='control-label'>Name on Card</label>
                                            <input class='form-control' id="cardholder-name" name="cardholder_name" size='4' type='text' required>
                                        </div>
                                    </div>
                                    <br> 
                                    <input type="hidden" name="c_amount" id="c_amount" value="">    
                                    <input type="hidden" name="event_id" id="event_id" value="{{$data->id}}">  
                                    <div id="card-element"></div>
                                    <div class="col-lg-12  mt-4 d-flex align-items-center">
                                        <button id="payButton" type="submit" class="btn btn-primary btn-theme mx-auto w-50 bg-primary">Pay</button>
                                    </div>
                                </form>
                            </div>
                            

                        </div>
                    </div>
                </div>

                
            </div>
            {{-- checkout section end --}}


            <div class="col-md-4 mt-5">
                <div class="border shadow-sm p-3 rounded">
                    <div class="p-3 border border-1 rounded shadow-sm bg-white ">
                        <div class="ermsg">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="darkerGrotesque-bold mb-0">General Admission</h4>
   
                            <div class="d-flex">
                                @if ($data->is_free == 1)
                                <button class="btn btn-sm btn-theme bg-primary text-white cart-qty-minus ">
                                    <iconify-icon icon="typcn:minus"></iconify-icon>
                                </button>
                                <span class="mx-2 fs-4 darkerGrotesque-bold showqty" id="showqty">
                                    1
                                </span>
                                <button class="btn btn-sm btn-theme bg-primary px-3 text-white cart-qty-plus">
                                    <iconify-icon icon="typcn:plus"></iconify-icon>
                                </button>
                                @endif

                                
                            </div>


                        </div>
                        @if ($data->is_free == 0) 

                        <div class="d-flex align-items-center justify-content-between">
                            <select name="selectType" id="selectType" class="form-control darkerGrotesque-bold fs-5 darkerGrotesque-medium select2">
                                <option value="">Select</option>
                                @foreach ($data->eventprice as $eprice)
                                <option value="{{$eprice->id}}">{{$eprice->type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="number" id="qty" name="qty" value="" >
                        <input type="number" id="pamount" name="pamount" value="" >

                        {{-- <div class="d-flex align-items-center justify-content-between">
                            <select name="selectqty" id="selectqty" class="form-control darkerGrotesque-bold fs-5 darkerGrotesque-medium select2">
                                <option value="1">Single</option>
                                <option value="2">Couple</option>
                            </select>
                        </div> --}}

                        <div id="qtyNote">
                            
                        </div>
                        <h4 class="darkerGrotesque-bold my-3 txt-primary">£<span id="amtshow">{{ number_format($data->price, 2) }}</span></h4>
                        @else
                        <h4 class="darkerGrotesque-bold my-3 txt-primary"><span>Free</span></h4>
                        <textarea name="note" id="note" cols="30" rows="2" class="form-control" placeholder="Note..."></textarea>
                        @endif
                        
                       

                    </div>
                    
                    @if ($data->available < 1)
                    <h4 class="darkerGrotesque-bold mb-0">No ticket available</h4>

                    @else
                        @if ($data->status == 1)
                            @if (Auth::user())
                                @if ($data->is_free == 0)
                                <a id="chkoutBtn" class="btn btn-theme bg-secondary w-100 mt-2 mx-auto">Checkout</a>
                                @else
                                <a id="freeEvntsub" class="btn btn-theme bg-secondary w-100 mt-2 mx-auto">Submit</a>
                                @endif
                            @else
                               
                            <!-- Button trigger modal -->
                            <button type="button"  class="btn btn-theme bg-secondary w-100 mt-2 mx-auto" style="border: none;background: #18988b;color: white;" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Checkout
                            </button>
                             

                            @endif
                            <button class="btn btn-theme bg-primary w-100 mt-2 mx-auto" data-bs-toggle="modal" data-bs-target="#shareModal">Share</button>
                        @endif
                    @endif

                    
                </div>

                <div class="border shadow-sm p-3 rounded mt-2" id="qrcodeDiv">
                    <div class="p-3 border border-1 rounded shadow-sm bg-white text-center">
                            {!! QrCode::size(250)->generate(URL::current()) !!}
                    </div>
                </div>
            </div>

            



        </div>
    </div>
</div>

    <!--Login  Modal -->
    <div  class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    
                @if(session()->has('message'))
                <p class="alert alert-success"> {{ session()->get('message') }}</p>
                @endif

                @if(session()->has('error'))
                <p class="alert alert-danger"> {{ session()->get('error') }}</p>
                @endif
                 
                <form method="POST" action="{{ route('logintodonate') }}" class="form-custom">
                    @csrf
    
                    <div class="title text-center txt-secondary">LOGIN</div>
                    <div class="form-group">
                        <input type="hidden" name="eventid" id="eventid" value="{{$data->id}}">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn-theme bg-primary d-block text-center mx-0 w-100">Login </button>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                         <a href="{{ route('register')}}" class="btn-theme bg-secondary d-block text-center mx-0 w-100"> Open an account</a>
                    </div>
                </form>
    
    
    
            </div>
          </div>
        </div>
    </div>

    <!-- share modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content fs-5 darkerGrotesque-semibold ">
                <div class="modal-header">
                    <h1 class="modal-title fs-4" id="shareModalLabel">Help by sharing</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-dark lh-1">{{$data->title}}</p>
                    <hr>
                    <div class="shareIcons">
                        {!! $shareComponent !!}
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="text" class="form-control fs-5"  id="myInput" style="height:46px;" value="{{ URL::current() }}">
                        <button class="btn btn-theme bg-primary"  onclick="copyTextFS()">Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!empty(Session::get('error')) && Session::get('error_code') == 5)
    <script>
        $('#loginModal').modal('show');
    </script>
    @endif

@endsection

@section('script')
<script>
    function copyTextFS() {
        // Get the text field
        var copyText = document.getElementById("myInput");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied the text: " + copyText.value);
    }
</script>
<script>
$(document).ready(function () {

    $("#paymentSection").hide();
    $("#chkoutBtn").click(function(){
        $("#paymentSection").show(300);
        $("#eventDesc").hide(300);
        $("#chkoutBtn").hide(300);
        $("#qrcodeDiv").hide(300);
        $(window).scrollTop(450);

    });
    $("#backBtn").click(function(){
        $("#paymentSection").hide(200);
        $("#eventDesc").show(200);
        $("#chkoutBtn").show(200);
        $("#qrcodeDiv").show(200);
    });
    //calculation end 

    

    

    // $("#selectqty").change(function(){
    //     var qty = Number($("#selectqty").val());
    //     // console.log(qty);
    //     var pamount = Number($("#regular_price").val());

    //     if (qty == 2) {
    //         var tamount = 40;
    //     } else {
    //         var tamount = pamount;
    //     }

    //     $("#qty").val(qty);
    //     $("#pamount").val(tamount);
    //     $("#amtshow").html(tamount.toFixed(2));
        
    //     var commission = (tamount * 10)/100;
    //     var net_amount = tamount;
    //     $("#amount").val(net_amount.toFixed(2));
    //     $("#paypalamount").val(net_amount.toFixed(2));
    //     $("#c_amount").val(commission.toFixed(2));
    // });

            // free event ad by fahim
            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            //  make doantion start
            var url = "{{URL::to('/event-book')}}";
            $("#freeEvntsub").click(function(){
                $("#loading").show();
                    var event_id= $("#event_id").val();
                    var quantity= $("#qty").val();
                    var note= $("#note").val();

                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {event_id,quantity,note},
                        success: function (d) {
                            if (d.status == 303) {
                                $(".ermsg").html(d.message);
                            }else if(d.status == 300){
                                $(".ermsg").html(d.message);
                                window.setTimeout(function(){location.reload()},2000)
                            }
                        },
                        complete:function(data){
                            $("#loading").hide();
                        },
                        error: function (d) {
                            console.log(d);
                        }
                    });

            });
            // make donation end 

            // select ticket type
            var urltype = "{{URL::to('/gettype')}}";
            $("#selectType").change(function(){
		            event.preventDefault();
                    var type_id = $(this).val();
                    
                    $.ajax({
                    url: urltype,
                    method: "POST",
                    data: {type_id:type_id},

                    success: function (d) {
                        if (d.status == 303) {
                            console.log(d);
                        }else if(d.status == 300){
                            console.log(d.types.type);
                            $("#amtshow").html(d.types.ticket_price.toFixed(2));
                            
                            $("#paypalamount").val(d.types.ticket_price.toFixed(2));
                            $("#amount").val(d.types.ticket_price.toFixed(2));
                             
                                $("#qty").val(d.types.max_person);
                                $("#paypalqty").val(d.types.max_person);
                                $("#pamount").val(d.types.ticket_price.toFixed(2));
                                $("#qtyNote").html(d.types.note);

                            // $("#customer_id").val(d.customer_id);
                            
                           
                        }
                    },
                    error: function (d) {
                        console.log(d);
                    }
                });

            });


});
</script>


<script>
    // Create a Stripe instance with your publishable key
    // var stripe = Stripe('pk_test_51N5D0QHyRsekXzKiScNvPKU4rCAVKTJOQm8VoSLk7Mm4AqPPsXwd6NDhbdZGyY4tkqWYBoDJyD0eHLFBqQBfLUBA00tj1hNg3q');
   
    var stripe = Stripe('pk_live_Gx0P9OLtn53jOp5TdChtaONF00LxuoVYFb');
  
    // Create a card element and mount it to the card-element div
    var cardElement = stripe.elements().create('card');
    cardElement.mount('#card-element');
  
    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
  
      $("#loading").show();
      // Create a PaymentMethod and confirm the PaymentIntent on the backend
      stripe.createPaymentMethod('card', cardElement).then(function(result) {
        if (result.error) {
            $("#loading").hide();
          // Handle errors (e.g. invalid card details)
          console.error(result.error);
          $(".ermsg").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>"+result.error.message+"</b></div>");
        } else {
          // Send the PaymentMethod ID to your backend
          var paymentMethodId = result.paymentMethod.id;
          confirmPayment(paymentMethodId);
        }
      });
    });
  
    var url = "{{URL::to('/event-payment')}}";
    // Function to confirm the PaymentIntent on the backend
    function confirmPayment(paymentMethodId) {
        
        var amount = $("#amount").val();
        var quantity = $("#qty").val();
        var cardHolderName = $("#cardholder-name").val();
        var event_id = $("#event_id").val();
        var c_amount = $("#c_amount").val();

      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json', // Specify the Accept header for JSON
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },

        body: JSON.stringify({ payment_method_id: paymentMethodId, amount: amount, cardHolderName: cardHolderName, event_id:event_id, c_amount:c_amount, quantity:quantity })
      }).then(function(response) {
        return response.json();
      }).then(function(data) {
        console.log(data);
        // Handle the response from the backend
        if (data.client_secret) {
          stripe.confirmCardPayment(data.client_secret).then(function(result) {
            if (result.error) {
                $("#loading").hide();
                $(".ermsg").html("<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>"+result.error.message+"</b></div>");
              // Handle errors (e.g. authentication required)
              console.error(result.error);
            } else {
                $("#loading").hide();
              // Payment successful
              $(".ermsg").html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Payment Successfull.</b></div>");
              console.log(result.paymentIntent);
              window.setTimeout(function(){location.reload()},2000)
            }
          });
        }
      });
    }
</script>

@endsection