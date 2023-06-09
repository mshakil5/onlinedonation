
@component('mail::message')

<h3>Dear Mr {{$array['name']}},</h3> 

<p>
    {!! $array['message'] !!}
</p>

Thanks,<br>
<a href="https://www.gogiving.co.uk" target="blank">GoGiving</a>

@endcomponent