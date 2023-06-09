<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Dashboard</title>
    <link rel="icon" href="{{ asset('assets/admin/images/favicon.png')}}">
    

    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-5.1.3min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/dashboard.css')}}">
    {{--  datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap.min.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Summer note-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body>

    <div class="dashboard-wraper">
        <div class="sidebar " id="sidebar">
            <div class="brand">
              <a href="{{ route('homepage')}}"><img src="{{ asset('images/company/'.\App\Models\CompanyDetail::where('id',1)->first()->header_logo)}}" width="114px" class="mx-auto" alt="logo"></a>
                
            </div>
            <ul class="navigation">
                <li><a href="{{route('admin.dashboard')}}" class="nav-link {{ (request()->is('admin/dashboard*')) ? 'current' : '' }}">Dashboard</a></li>

                

                <div class="accordion" id="dropdownLink">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fundtab" aria-expanded="false" aria-controls="fundtab">
                            Fundraisers
                        </button>
                      </h2>
                      <div id="fundtab" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dropdownLink">
                        <div class="accordion-body">
                            <li><a href="{{route('admin.newfundraiser')}}" class="nav-link {{ (request()->is('admin/new-fundraiser*')) ? 'current' : '' }}">Fundraiser</a></li>
                            <li><a href="{{route('admin.fundraiserBalance')}}" class="nav-link {{ (request()->is('admin/fundraiser-balance*')) ? 'current' : '' }}">Fundraiser Balance</a></li>
                        </div>
                      </div>
                    </div> 
                </div>

                <div class="accordion" id="dropdownLink">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#donortab" aria-expanded="false" aria-controls="donortab">
                            Donors
                        </button>
                      </h2>
                      <div id="donortab" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dropdownLink">
                        <div class="accordion-body">
                            <li><a href="{{route('admin.alldonor')}}" class="nav-link {{ (request()->is('admin/donor*')) ? 'current' : '' }}">Donor</a></li>
                            <li><a href="{{route('admin.alldonor')}}" class="nav-link {{ (request()->is('admin/donor*')) ? 'current' : '' }}">Donor Plus</a></li>
                        </div>
                      </div>
                    </div> 
                </div>

                <div class="accordion" id="dropdownLink">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#charitytab" aria-expanded="false" aria-controls="charitytab">
                            Charity
                        </button>
                      </h2>
                      <div id="charitytab" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dropdownLink">
                        <div class="accordion-body">
                            <li><a href="{{route('admin.allcharity')}}" class="nav-link {{ (request()->is('admin/charity*')) ? 'current' : '' }}">Charity</a></li>
                            <li><a href="{{route('admin.charityBalance')}}" class="nav-link {{ (request()->is('admin/charity-balance*')) ? 'current' : '' }}">Charity Balance</a></li>
                        </div>
                      </div>
                    </div> 
                </div>

                <div class="accordion" id="dropdownLink">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCampaignTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Campaign
                        </button>
                      </h2>
                      <div id="collapseCampaignTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dropdownLink">
                        <div class="accordion-body">
                            <li><a href="{{route('admin.fundraisingsource')}}" class="nav-link {{ (request()->is('admin/fundraising-source*')) ? 'current' : '' }}">Fundraising Source</a></li>
                            <li><a href="{{route('admin.campaign')}}" class="nav-link {{ (request()->is('admin/campaign*')) ? 'current' : '' }}">New Campaign</a></li>
                            <li><a href="{{route('admin.livecampaign')}}" class="nav-link {{ (request()->is('admin/live-campaign*')) ? 'current' : '' }}">Live Campaign</a></li>
                            <li><a href="{{route('admin.closecampaign')}}" class="nav-link {{ (request()->is('admin/close-campaign*')) ? 'current' : '' }}">Close Campaign</a></li>
                            <li><a href="{{route('admin.givinglevel')}}" class="nav-link {{ (request()->is('admin/giving-level*')) ? 'current' : '' }}">Giving Level</a></li>
                        </div>
                      </div>
                    </div> 
                </div>

                <div class="accordion" id="dropdownLink">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEventTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Event
                        </button>
                      </h2>
                      <div id="collapseEventTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#dropdownLink">
                        <div class="accordion-body">
                            
                            <li><a href="{{route('admin.event')}}" class="nav-link {{ (request()->is('admin/event*')) ? 'current' : '' }}">New Event</a></li>
                            <li><a href="#" class="nav-link {{ (request()->is('admin/live-campaign*')) ? 'current' : '' }}">Live Event</a></li>
                            <li><a href="#" class="nav-link {{ (request()->is('admin/close-campaign*')) ? 'current' : '' }}">Close Event</a></li>
                            
                        </div>
                      </div>
                    </div> 
                </div>


                
                <li><a href="{{url('admin/company-detail')}}" class="nav-link {{ (request()->is('admin/company-detail*')) ? 'current' : '' }}">Company Details</a></li>
                <li><a href="{{route('admin.whychooseus')}}" class="nav-link {{ (request()->is('admin/why-choose-us*')) ? 'current' : '' }}">Why Choose Us</a></li>
                <li><a href="{{route('admin.master')}}" class="nav-link {{ (request()->is('admin/all-data*')) ? 'current' : '' }}">All Data</a></li>
                <li><a href="{{route('admin.hometopsection')}}" class="nav-link {{ (request()->is('admin/home-top-section*')) ? 'current' : '' }}">Homepage Top Section</a></li>
                <li><a href="{{route('admin.contact-mail')}}" class="nav-link {{ (request()->is('admin/contact-mail*')) ? 'current' : '' }}">Contact Mail</a></li>
                
                <li><a href="{{route('admin.emailcontent')}}" class="nav-link {{ (request()->is('admin/email-content*')) ? 'current' : '' }}">Email Content</a></li>

                {{-- <li><a href="order-voucher-books.html">Order voucher books</a></li>
                <li><a href="tevini-card.html">Tevini card</a></li>
                <li><a href="view-transactions.html">View transactions</a></li>
                <li><a href="standing-orders.html">Standing orders</a></li>
                <li><a href="maaser-calculator.html">Maaser calculator</a></li>
                <li><a href="contact.html">Contact</a></li> --}}
            </ul>
            <div class="bottom-part">
                {{-- <a href="#" class="btn-theme bg-secondary">Order voucher books</a>
                <a href="#" class="btn-theme bg-primary">Make a donation</a> --}}
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-2 d-flex justify-content-center txt-theme fw-bold align-items-center">
                    <iconify-icon icon="humbleicons:logout"></iconify-icon>
                    &nbsp;Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
            </div>
            <div class="collapsable" onclick="collaps();">
                <iconify-icon class="icon" icon="octicon:sidebar-collapse-24"></iconify-icon>
            </div>
        </div>

        <div class="rightbar">
            <!-- topbar -->
            <div class="topBar position-relative">
                <div class="items d-flex justify-content-between align-items-center flex-wrap">
                    {{-- <label for="" class="position-relative">
                        <iconify-icon class="icon" icon="ic:baseline-search"></iconify-icon>
                        <input type="text" class="inputSearch" placeholder="Search">
                    </label>
                    <div class="txt-theme fs-16">Account Number: <span class="fw-bold">1534</span> </div> --}}
                </div>
                <div class="items position-relative d-flex justify-content-end align-items-center">
                    <div class="dropdown account">
                        <div class="d-flex align-items-center  dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="txt-theme fw-bold fs-16 me-2">{{Auth::user()->name}}</span>
                            <iconify-icon class="fs-2" icon="mdi:user-circle-outline"></iconify-icon>
                        </div>
                        <ul class="dropdown-menu  " aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">My Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>


            @yield('content')

        </div>
    </div>


    <script src="{{ asset('assets/admin/js/jquery-2.2.0.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-5.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/iconify.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/app.js')}}"></script>
    {{-- <script>
        for (var i = 0; i < document.links.length; i++) {
            if (document.links[i].href === document.URL) {
                document.links[i].className = 'nav-link current';
            }
        }
    </script> --}}

    <script>
        // page schroll top
        function pagetop() {
            window.scrollTo({
                top: 100,
                behavior: 'smooth',
            });
        }
        function success(msg){
            $.notify({
                    // title: "Update Complete : ",
                    message: msg,
                    // icon: 'fa fa-check'
                },{
                    type: "info"
                });
            }
        function warning(msg){
            $.notify({
                    // title: "Update Complete : ",
                    message: msg,
                    // icon: 'fa fa-check'
                },{
                    type: "warning"
            });
        }
    function dlt(){
                swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
                    }, function(isConfirm) {
                    if (isConfirm) {
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");

                    }
            });
    }
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap4.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.bootstrap4.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script> 
    <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap-notify.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/sweetalert.min.js')}}"></script>
    <!-- Summer Note Js-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('script')


    
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                responsive: true
            } );
        
        } );
    </script>

    <!--  <script>
        document.onkeydown = function(e) {
          if (e.ctrlKey && e.keyCode === 85) { 
             alert("you cant get my code ever :)");
             return false;
          }
        };
       </script> -->

</body>

</html>