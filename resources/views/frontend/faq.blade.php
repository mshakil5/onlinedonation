@extends('frontend.layouts.master')

@section('css')
@endsection

@section('content')



<section class="bleesed default">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="title darkerGrotesque-bold lh-1">{{\App\Models\Master::where('name','faq')->first()->title}}</div>
            <div class="para text-center mt-4">

                {!! \App\Models\Master::where('name','faq')->first()->description !!}
                
            </div>
        </div>
    </div>
</section> 



@endsection

@section('scripts')
@endsection