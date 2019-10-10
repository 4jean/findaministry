<h1>{{ config('app.name') }}</h1>

<p> <strong>{{ $claim->user->name }}</strong> Has Submitted A New Claim Request for <strong>{{ $claim->ministry->name }}</strong> <a href="{{ route('cj_claims', $claim->ministry_id) }}">Click Here to View Claim</a></p>

<p>Below are The Details and files attached</p>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td><strong>User: </strong></td>
        <td><strong>{{ $claim->user->name.' ('.$claim->user->email.')' }}</strong></td>
    </tr>
    <tr>
        <td><strong>Ministry: </strong></td>
        <td>{{ $claim->ministry->name }}</td>
    </tr>

    <tr>
        <td><strong>Ministry Code: </strong></td>
        <td>{{ $claim->ministry->code }}</td>
    </tr>

    <tr>
        <td><strong>Date Requested: </strong></td>
        <td>{{ $claim->created_at }}</td>
    </tr>

</table>
