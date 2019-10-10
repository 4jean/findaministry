<h1>{{ config('app.name') }}</h1>

<p> You Have Received a New Message </p>

<p>Below are The Details of The Message</p>
<hr>

<div style="font-size: 14px; margin: 20px;">

        <table width="100%" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <td><strong>Name: </strong></td>
                <td><strong>{{ $cf['name'] }}</strong></td>
            </tr>
            <tr>
                <td><strong>Email: </strong></td>
                <td>{{ $cf['email'] }}</td>
            </tr>

            <tr>
                <td><strong>Message: </strong></td>
                <td>{{ strip_tags($cf['message']) }}</td>
            </tr>

            <tr>
                <td><strong>Date: </strong></td>
                <td>{{ Carbon\Carbon::now()->toDayDateTimeString() }}</td>
            </tr>

        </table>
</div>

