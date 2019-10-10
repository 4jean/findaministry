<h1>{{ config('app.name') }}</h1>

@if($claim->approved)

<p> Hello <strong>{{ $claim->user->name }}</strong> </p>

<p>The Claim you submitted for <a href="{{ $claim->ministry->url }}"><strong>{{ $claim->ministry->name }}</strong></a> has been <strong>ACCEPTED</strong>. You now have ownership of the Ministry</p>

@else

<p>The Claim you submitted for <a href="{{ $claim->ministry->url }}"><strong>{{ $claim->ministry->name }}</strong></a> has been <strong>REJECTED</strong>. because your claim did not provide substantial evidence that you own this ministry</p>

<p>If you believe, this was done in error, please <a href="{{ route('contact') }}">Contact Us</a> and we will respond as soon as possible</p>
<br>

Thank you.

@endif

@if($claim->approved)

<p>Below are The Details of Your Ministry</p>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td><strong>Ministry Name: </strong></td>
        <td>{{ $claim->ministry->name }}</td>
    </tr>

    <tr>
        <td><strong>Verified: </strong></td>
        <td>{{ $claim->approved ? 'YES' : 'NO' }}</td>
    </tr>

    <tr>
        <td><strong>Date Requested: </strong></td>
        <td>{{ $claim->created_at }}</td>
    </tr>


</table>

@endif

<br>

<p>Thank you for using <a target="_blank" href="{{ route('home') }}">{{ config('app.name') }}</a></p>
