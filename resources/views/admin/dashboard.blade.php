@extends('admin.layouts.admin')

@section('content')


  <!-- content area -->
  <div class="content">
      <div class="row ">
          <div class="col-lg-6" style="display:none">
              <div class="user">
                  Welcome, Mr Landau
              </div>
              <br>
              <h4 class="txt-dash mb-3">Account Balance</h4>
              <h2 class="amount">6,123.00 GBP</h2>
              <div class="row my-2">
                  <div class="col-lg-6 ">
                      <img src="{{ asset('assets/admin/images/card.png')}}" class="img-fluid mt-3 mb-2" alt="">
                      <a href="#" class="d-block fs-14 txt-theme fw-bold">Order a card</a>
                  </div>

                  <div class="col-lg-6  pt-3 d-flex flex-column  ">
                      <a href="#" class="btn-theme bg-primary fs-16 fw-700">Make a
                          donation</a>
                      <a href="#" class="btn-theme bg-secondary fs-16 fw-700">Order voucher books</a>
                      <a href="#" class="btn-theme bg-ternary fs-16 fw-700">Top up account</a>
                  </div>
                  <div class="col-lg-12 mt-4">
                      <div class=" p-3 py-4 mt-2" style="background-color: #D9D9D9;">
                          <div>
                              <div class="txt-secondary fs-32 fw-bold  text-center fw-800">GIFT AID DONATIONS</div>  <br>
                              <div class="txt-secondary fs-24 my-2 fw-500"> Gift Aid donations for this Tax Year : £1250</div> 
                              <div class="txt-secondary fs-24 fw-500"> Gift Aid donations for last Tax Year : £1250</div>
                          </div> 
                      </div>
                  </div>
              </div>
             
          </div>
          <div class="col-lg-6" style="display:none">
              <div class="row mb-5">
                  <div class="col-lg-6">
                      <div class="user">
                          Latest transactions
                      </div>

                  </div>
                  <div class="col-lg-6 text-center">
                      <a href="#" class="btn-theme btn-transaction">View all transactions</a>
                  </div>
              </div>
              <div class="row titleBar my-3 ">
                  <div class="col-lg-6">Description</div>
                  <div class="col-lg-3">Amount</div>
                  <div class="col-lg-3">Balance</div>
              </div>

              <!-- loop start -->
              <div class="row mb-4">
                  <div class="date">
                      Today
                  </div>
                  <div class="row">
                      <div class="col-lg-6 mt-3">
                          <div class="info">Aim Habonim</div>
                          <span class="fs-16 txt-theme">Online donation</span>
                      </div>
                      <div class="col-lg-3 mt-3 d-flex align-items-center ">
                          <div class="info">-£18.00</div>
                      </div>
                      <div class="col-lg-3 mt-3 d-flex align-items-center ">
                          <span class="fs-16 txt-theme">£4.50</span>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-6 mt-3">
                          <div class="info">Initact Solutions Ltd.</div>
                          <span class="fs-16 txt-theme">Company donation</span>
                      </div>
                      <div class="col-lg-3 mt-3 d-flex align-items-center ">
                          <div class="info txt-primary">£20.00</div>
                      </div>
                      <div class="col-lg-3 mt-3 d-flex align-items-center ">
                          <span class="fs-16 txt-theme">£23.50</span>
                      </div>
                  </div>
              </div>

              <!-- end -->

              <!-- loop start -->

              <div class="row mb-4">
                  <div class="date">
                      21 January 23
                  </div>
                  <div class="row">
                      <div class="col-lg-6 mt-3">
                          <div class="info">Aim Habonim</div>
                          <span class="fs-16 txt-theme">Online donation</span>
                      </div>
                      <div class="col-lg-3 mt-3 d-flex align-items-center ">
                          <div class="info">-£18.00</div>
                      </div>
                      <div class="col-lg-3 mt-3 d-flex align-items-center ">
                          <span class="fs-16 txt-theme">£4.50</span>
                      </div>
                  </div> 
              </div>

              <!-- end -->
              <!-- loop start -->

              <div class="row mb-4">
                  <div class="date">
                      20 January 23
                  </div>
                  <div class="row">
                      <div class="col-lg-6 mt-2">
                          <div class="info">Bikur Cholim D’satamar</div>
                          <span class="fs-16 txt-theme">Online donation</span>
                      </div>
                      <div class="col-lg-3 mt-2 d-flex align-items-center ">
                          <div class="info">-£180.00</div>
                      </div>
                      <div class="col-lg-3 mt-2 d-flex align-items-center ">
                          <span class="fs-16 txt-theme">£203.50</span>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-6 mt-2">
                          <div class="info">Bikur Cholim D’satamar</div>
                          <span class="fs-16 txt-theme">Online donation</span>
                      </div>
                      <div class="col-lg-3 mt-2 d-flex align-items-center ">
                          <div class="info txt-primary">-£180.00</div>
                      </div>
                      <div class="col-lg-3 mt-2 d-flex align-items-center ">
                          <span class="fs-16 txt-theme">£203.50</span>
                      </div>
                  </div>
                  
              </div>

              <!-- end -->

          </div>

      </div>
  </div>

@endsection
