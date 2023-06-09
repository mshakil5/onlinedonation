
@component('mail::message')

<h3>Dear Mr {{$array['name']}},</h3> 

<p>
    {!! $array['message'] !!}
</p>

<p>To see your event, please click <a href="https://www.gogiving.co.uk/event/{{$array['eventid']}}">here</a> </p>

Thanks,<br>
<a href="https://www.gogiving.co.uk" target="blank">GoGiving</a>

@endcomponent



