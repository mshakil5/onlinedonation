@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')

<style>
    .pagetitle{
        font-size: 30px;
    }
</style>
<section class="auth py-4">
    <div class="container">
       
        <div class="row">
            <div class="col-lg-10 mx-auto authBox">
                <div class="row">
                    
                    
                    
                        @if (isset($message))
                        <span class="login-head" role="alert">
                            <strong><p style="color: red">{{ $message }}</p></strong>
                        </span>
                        @endif

                        @if(session()->has('error'))
                        <p class="alert alert-warning"> {{ session()->get('error') }}</p>
                        @endif

                        @if(session()->has('any'))
                        <p class="alert alert-warning"> {{ session()->get('any') }}</p>
                        @endif
                    
                        
                    <div class="row">
                        <div class="col-lg-10  mx-auto">
                            <div class="pagetitle">
                                Charity information
                            </div><hr>
                            <form method="POST" action="#"  enctype="multipart/form-data">
                                @csrf

                            <div class="row mb-2">
                                <div class="col-4">
                                    @if (isset($data->photo))
                                        <img src="{{ asset('images/'.$data->photo)}}" class="img-fluid" alt="">
                                    @else
                                        <img src="https://via.placeholder.com/510x440.png" class="img-fluid" alt="">
                                    @endif
                                </div>


                                <div class="col-8">
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <label style="font-size: 20px">Charity Name </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="{{ $data->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <label style="font-size: 20px">Charity Number </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="{{ $data->phone }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4">
                                            <label style="font-size: 20px">Email </label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" class="form-control" value="{{ $data->email }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="pagetitle">
                                Campaign information
                            </div><hr>

                            <div class="row mb-2">
                                <div class="col-4">
                                    <label style="font-size: 20px">Your starting goal </label>
                                </div>
                                <div class="col-8">
                                    <input type="number" class="form-control fs-4" placeholder="Your starting goal" value="" id="raising_goal" name="raising_goal">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-6">
                                    
                                    <label for="image" class="darkerGrotesque-medium fw-bold">Upload Photo</label>
                                    <input type="file" name="image[]" class="form-control" id="image" multiple required>
                                    
                                    <div class="col-md-12 my-2" style="display: none">
                                        <div class="preview2"></div>
                                    </div>

                                </div>
                                <div class="col-6">
                                    
                                    <label for="video_link" class="darkerGrotesque-medium fw-bold"> Upload Video Link </label>
                                    <input type="text" name="video_link" class="form-control" id="video_link"  value="">

                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4">
                                    
                                    <label for="tagline" class="darkerGrotesque-medium fw-bold">Tagline</label>
                                    <input type="text" name="tagline" value="" class="form-control" id="tagline">

                                </div>

                                <div class="col-4">
                                    <label for="funding_type" class="darkerGrotesque-medium fw-bold">Funding Type</label>
                                    <select name="funding_type" class="form-control" id="funding_type">
                                        <option value="Partial">Partial</option>
                                        <option value="All or Nothing">All or Nothing</option>
                                    </select>

                                </div>
                                
                                <div class="col-4">
                                    <label for="end_date" class="darkerGrotesque-medium fw-bold"> End Date </label>
                                    <input type="date" name="end_date" class="form-control" id="end_date" value="">

                                </div>

                            </div>

                            <div class="pagetitle">
                                Personal information
                            </div><hr>

                            <div class="row mb-2">
                                <div class="col-4">
                                    <label for="email" class="darkerGrotesque-medium fw-bold">Email</label>
                                    <input type="text" name="email" class="form-control" id="email" value="{{Auth::user()->email}}" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="name" class="darkerGrotesque-medium fw-bold">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{Auth::user()->name}}" readonly>
                                </div>
                                <div class="col-4">
                                    <label for="sur_name" class="darkerGrotesque-medium fw-bold"> Surname </label>
                                    <input type="text" name="sur_name" class="form-control" id="sur_name" value="{{Auth::user()->sur_name}}" readonly>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-3">
                                    <label for="house_number" class="darkerGrotesque-medium fw-bold">House Number</label>
                                    <input type="text" name="house_number" class="form-control" id="house_number" value="{{Auth::user()->house_number}}" readonly>
                                </div>
                                <div class="col-3">
                                    <label for="street_name" class="darkerGrotesque-medium fw-bold">Street Name</label>
                                    <input type="text" name="street_name" class="form-control" id="street_name" value="{{Auth::user()->street_name}}" readonly>
                                </div>
                                <div class="col-3">
                                    <label for="town" class="darkerGrotesque-medium fw-bold"> Town </label>
                                    <input type="text" name="town" class="form-control" id="town" value="{{Auth::user()->town}}" readonly>
                                </div>
                                <div class="col-3">
                                    <label for="postcode" class="darkerGrotesque-medium fw-bold"> Surname </label>
                                    <input type="text" name="postcode" class="form-control" id="postcode" value="{{Auth::user()->postcode}}" readonly>
                                </div>
                            </div>


                            <div class="col-lg-12 mt-3">
                                <p class="para mb-3 text-muted fs-6 ">
                                    <input type="checkbox" class="me-2" required>I agree to the <a href="{{route('frontend.terms')}}" style="text-decoration: none;color:#212529"> Terms & Conditions. </a><br>
                                </p>
                            </div>
                            

                            <div class="form-group  text-center">
                                <button type="submit" class="btn-theme bg-primary text-center mx-0 ">Create a new campaign</button>
                            </div>


                        </form>

                        </div>
                    </div>


                    
                    
                    

                   
                </div>
            </div>
        </div>
    </div>
</section> 


@endsection


@section('script')
@endsection