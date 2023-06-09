@extends('frontend.layouts.master')
@section('title')
- Event Ticket Sales Report
@endsection
@section('content')


<section class="bleesed">
    <div class="container"> 

        <div class="row">
            {{-- <div class="row my-4">
                <div class="col-md-12 button-cutom-link ">
                    <a href="{{ route('user.myevent')}}" class="btn-link">Your event</a>
                    <a href="#" class="btn-link">All statement</a>
                    <a href="{{ route('start_new_event')}}" class="btn-link">Start a new event</a>
                    <a href="{{ route('user.eventdocument')}}" class="btn-link">Purchase History </a>
                </div>
            </div> --}}

            <div class="col-lg-6">
                <h2 class="fw-bold darkerGrotesque-bold txt-primary mb-3"> List of event</h2>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-end fs-5"> 

                <form action="" class="d-flex">
                    <div class="me-2">
                        <label for="">From</label>
                        <input type="date" class="form-control fs-5" style="height: 46px;" placeholder="Search">

                    </div>
                    <div class="d-flex align-items-end">
                        <div class="me-2">
                            <label for="">To</label>
                            <input type="date" class="form-control fs-5" style="height: 46px;" placeholder="Search">
                        </div>
                        <button class="btn btn-theme bg-primary m-0" style="height:46px;">
                            <iconify-icon icon="material-symbols:search-sharp"></iconify-icon>
                            </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-12 mb-4 mt-5">
                 
                <div class="table-responsive fs-5 shadow-sm  ">
                    <table class="table table-striped" id="example">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Event Start & End Date </th>
                                <th scope="col">Sale Start & End Date </th>
                                <th scope="col">Price</th>
                                <th scope="col">Number of ticket</th>
                                <th scope="col">Sold</th>
                                <th scope="col">Available</th>
                                <th scope="col">Status</th> 
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $data)
                                <tr>
                                    {{-- <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</td> --}}
                                    <td>
                                        {{$data->title}}<a href="{{route('frontend.eventDetails',$data->id)}}" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center"><iconify-icon class="txt-secondary" icon="ic:outline-remove-red-eye"></iconify-icon></a>
                                    </td>
                                    <td>{{$data->category}} </td>
                                    <td>{{ \Carbon\Carbon::parse($data->event_start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($data->event_end_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->sale_start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($data->sale_end_date)->format('d/m/Y') }}</td>
                                    
                                    <td>£{{$data->price}}</td>
                                    <td>{{$data->quantity}}</td>
                                    <td>{{$data->sold}}</td>
                                    <td>{{$data->available}}</td>
                                    <td> @if ($data->status == 1) Active @else Deactive @endif </td>
                                    <td class="d-flex align-items-center">
                                        <a href="{{route('user.eventEdit', $data->id)}}" class="px-2">
                                            <iconify-icon class="txt-primary" icon="mdi:pencil-outline"></iconify-icon>
                                        </a>
                                        <a href="{{route('user.eventTicketSales', $data->id)}}" class="px-2" title="view all transaction">
                                            <iconify-icon icon="ic:outline-remove-red-eye"></iconify-icon>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            
                          

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-lg-6 mx-auto mt-2">
                <a href="{{ route('start_new_event')}}" class="btn-theme bg-primary mx-auto w-50 text-center d-block">Create New Event</a>
            </div> 
        </div>
    </div>
</section>

<!--referral Modal  Modal -->
<div  class="modal fade" id="referralModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="ermsg"></div>
            <div class="form-custom">

                <div class="title text-center txt-secondary">Link</div>
                <div class="form-group">
                    <input id="ref_link" type="text" class="form-control" name="ref_link" value="" >
                </div>
                <br>
                <div class="form-group">
                    <button onclick="copyToClipboard()" class="btn-theme bg-primary d-block text-center mx-0 w-100">Copy</button>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var url = "{{URL::to('/referral/campaign')}}";
$(document).on('click', '.refBtn', function () {
    campaign = $(this).attr('campaign');
    uid = $(this).attr('uid');
    link = url+'?campaignid='+ campaign +'&uid='+uid;
    $('#referralModal').find('.modal-body #ref_link').val(link);
    // $('#referralModal').find('.modal-body #frombranchid').val(branchid);
});
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    function copyToClipboard() {
        document.getElementById("ref_link").select();
        document.execCommand('copy');
        $(".ermsg").html("<div class='alert alert-success'><b>Copied.</b></div>");
    }
</script>
@endsection
