@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')




<section class="how-we-works default" style="display: none">
    <div class="container">
        <div class="row flex-column">
            {{-- <img src="@if (isset(\App\Models\Master::where('name','work')->first()->image))
            {{asset('images/'.\App\Models\Master::where('name','work')->first()->image)}} @else https://via.placeholder.com/260.png @endif" style="width:260px;" class=" mx-auto"/> <br> --}}
            <div class="title darkerGrotesque-bold lh-1">{{\App\Models\Master::where('name','work')->first()->title}}</div>
            <div class="para text-center mt-4">
                {!! \App\Models\Master::where('name','work')->first()->description !!} 
            </div>
            <a href="{{route('newcampaign_show')}}" class="btn-theme bg-secondary mx-auto mt-4">Start your campaign</a>
        </div>
    </div>
</section>

<section class="default contactInfo ">
    <div class="container">
        <div class="row col-md-10 mx-auto">
            <div class="title darkerGrotesque-bold lh-1 mb-5">How we works</div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <div class="work-box text-center">
                    <img src="{{ asset('assets/images/healthcare.png')}}" width="100px">
                    <div class="fs-4 d-flex align-items-center darkerGrotesque-bold">
                        <div class="numbering"><iconify-icon icon="material-symbols:filter-1" class="fs-1 txt-primary "></iconify-icon></div>
                        <div class="txt-secondary">
                            Start your fundraiser
                        </div>
                    </div>
                    <ul class="work-list mt-3 bg-light rounded-3 p-3 shadow-sm">
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Set your fundraiser goal
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Tell your story
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Add a picture or video
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Watch a video tutorial
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <div class="work-box text-center">
                    <img src="{{ asset('assets/images/friends.png')}}" width="100px">
                    <div class="fs-4 d-flex align-items-center darkerGrotesque-bold">
                        <div class="numbering"><iconify-icon class="fs-1 txt-primary "
                            icon="material-symbols:filter-2"></iconify-icon></div>
                        <div class="txt-secondary">
                            Share with friends
                        </div>
                    </div>
                    <ul class="work-list mt-3 bg-light rounded-3 p-3 shadow-sm">
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Send emails
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Send text messages
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Share on social media
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Watch a video tutorial
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <div class="work-box text-center">
                    <img src="{{ asset('assets/images/system-update.png')}}" width="100px">
                    <div class="fs-4 d-flex align-items-center darkerGrotesque-bold">
                        <div class="numbering"><iconify-icon class="fs-1 txt-primary "
                            icon="material-symbols:filter-3"></iconify-icon></div>
                        <div class="txt-secondary">
                            Manage donations
                        </div>
                    </div>
                    <ul class="work-list mt-3 bg-light rounded-3 p-3 shadow-sm">
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Accept donations
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Thank donors
                        </li>
                        <li>
                            <iconify-icon icon="ic:round-play-arrow"></iconify-icon>
                            Withdraw funds
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="  py-5" style="display: none">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row py-5">
                    <div class="col-lg-12  px-3  ">
                        <div class="title darkerGrotesque-bold lh-1 mb-5">
                           Why choose us ?
                        </div> 
                    </div> 
                </div>
                <div class="row">

                    @foreach (\App\Models\WhyChooseUs::orderby('id','DESC')->get() as $whychoose)
                    <div class="col-lg-6 mb-5 ">
                        <div class="row">
                            <div class="col-lg-4 d-flex align-items-center text-center">
                                <img src="@if(isset($whychoose->image)){{asset('images/'.$whychoose->image)}} @else https://via.placeholder.com/160.png @endif" class="me-3 img-fluid" />
                            </div>
                            <div class="col-lg-8">
                                <div class="paratitle">{{$whychoose->title}}</div>
                            <div class="para">
                                {!! $whychoose->description!!}
                            </div>
                            </div>
                        </div> 
                    </div>
                    @endforeach
                    
                   
                </div>
            </div>
        </div>
    </div>
</section>

<section class="client faq default " id="faq">
    <div class="container">
        <div class="row">
            <div class="title txt-primary">
                Frequently asked questions
            </div>
            <br>
            <div class="mt-5">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                How do you charge and how much?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Updating...
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How can I check how much money I have in my charity account?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Updating...
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Can I donate to charities abroad with my Donation account?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Updating...
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                When will my donation reach the recipient?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Updating...
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                What is GoGiving and how does it work?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Updating...

                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="w-100 d-flex align-items-center justify-content-center">
                <a href="{{route('frontend.contact')}}" class="mx-auto mt-5 btn-theme bg-secondary ">Still have questions?</a>
            </div>
        </div>
    </div>
</section>


@endsection

@section('scripts')
@endsection