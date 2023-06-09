@extends('frontend.layouts.master')

@section('title')
- Event Ticket Sales Report
@endsection

@section('content')
<section class="bleesed default">
    <div class="container">
        <div class="row"> 
            <div class="col-lg-6 mt-2">
                <a href="{{ route('user.myevent')}}" class="btn-theme bg-primary text-center">Back</a>
            </div> 
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h2 class="fw-bold darkerGrotesque-bold txt-primary mb-3"> All ticket you have sold</h2>
            </div>
            <div class="col-lg-6 d-flex align-items-center justify-content-end fs-5">

                <form action="" class="d-flex">
                    <div class="me-2">
                        <label for="">From</label>
                        <input type="date" class="form-control fs-5" style="height: 46px;" placeholder="Search">

                    </div>
                    <div class="d-flex align-items-end">
                        <div  class="me-2">
                            <label for="">To</label>
                            <input type="date" class="form-control fs-5" style="height: 46px;" placeholder="Search">
                        </div>
                        <button class="btn btn-theme bg-primary m-0" style="height:46px;">
                            <iconify-icon
                                icon="material-symbols:search-sharp"></iconify-icon>
                            </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12">
                <div class="table-responsive shadow-sm px-4">
                    <table class="table table-theme mt-4 table-striped" id="example">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Transaction Id</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer Email</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Event Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Amount</th>
                                {{-- <th scope="col">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->eventticket as $sale)
                            <tr>
                                <td class="fs-16 txt-primary">{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fs-20 txt-primary fw-bold text-center">{{$sale->tran_no}}</span>
                                    </div>
                                </td>
                                
                                <td class="fs-16 txt-primary">
                                    {{\App\Models\User::where('id',$sale->user_id)->first()->name}}
                                </td>
                                
                                <td class="fs-16 txt-primary">
                                    {{\App\Models\User::where('id',$sale->user_id)->first()->email}}
                                </td>
                                
                                <td class="fs-16 txt-primary text-center">
                                    {{\App\Models\User::where('id',$sale->user_id)->first()->phone}}
                                </td>

                                <td class="fs-16 txt-primary">
                                    <a href="{{route('frontend.eventDetails',$sale->event_id)}}" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center">{{$sale->event->title}}</a>
                                </td>
                                <td class="fs-16 txt-primary text-center">
                                    {{$sale->quantity}}
                                </td>
                                <td class="fs-16 txt-primary text-center">
                                    {{ number_format($sale->total_amount, 2) }}
                                </td>
                                {{-- <td class="fs-16 txt-primary">
                                    <a href="#" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center"><i class="fa fa-download" style="color: #2196f3;font-size:16px;"></i>  Download</a>
                                </td> --}}
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('script')
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script> 
@endsection
