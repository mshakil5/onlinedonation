@extends('admin.layouts.admin')

@section('content')

<!-- content area -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="pagetitle pb-2">
                Event booking record
            </div>
        </div>
    </div>
    <div class="row"> 
        <div class="col-lg-6 mt-2">
            <a href="{{ route('admin.event')}}" class="btn-theme bg-primary text-center">Back</a>
        </div> 
    </div>
    <div id="contentContainer">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="background-color: #fdf3ee">
                    <div class="card-header">
                        <h3> All Data</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="example">
                            <thead>
                            <tr>
                                <th style="text-align: center">SL</th>
                                <th style="text-align: center">Date</th>
                                <th style="text-align: center">Transaction Id</th>
                                <th style="text-align: center">Customer Name</th>
                                <th style="text-align: center">Customer Email</th>
                                <th style="text-align: center">Customer Phone</th>
                                <th style="text-align: center">Event Name</th>
                                <th style="text-align: center">Quantity</th>
                                <th style="text-align: center">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->eventticket as $key => $sale)
                                <tr>
                                    <td style="text-align: center">{{ $key + 1 }}</td>
                                    <td style="text-align: center" class="fs-16 txt-primary">{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fs-20 txt-primary fw-bold text-center">{{$sale->tran_no}}</span>
                                        </div>
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary">
                                        {{\App\Models\User::where('id',$sale->user_id)->first()->name}}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary">
                                        {{\App\Models\User::where('id',$sale->user_id)->first()->email}}
                                    </td>
                                    
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        {{\App\Models\User::where('id',$sale->user_id)->first()->phone}}
                                    </td>
    
                                    <td style="text-align: center" class="fs-16 txt-primary">
                                        <a href="{{route('frontend.eventDetails',$sale->event_id)}}" target="_blank" class="text-decoration-none bg-primary text-white py-1 px-3 rounded mb-1 text-center">{{$sale->event->title}}</a>
                                    </td>
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
                                        {{$sale->quantity}}
                                    </td>
                                    <td style="text-align: center" class="fs-16 txt-primary text-center">
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
    </div>
    
</div>

@endsection
@section('script')


@endsection