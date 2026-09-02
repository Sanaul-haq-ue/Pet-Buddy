<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; color:#303330; line-height:1.6;">
    <h2 style="margin-bottom:4px;">New message from Pet Buddy contact form</h2>
    <p style="color:#5d605c; margin-top:0;">Received {{ now()->format('M d, Y h:i A') }}</p>

    <table cellpadding="8" cellspacing="0" style="border-collapse:collapse; width:100%; max-width:600px;">
        <tr>
            <td style="font-weight:bold; width:120px; vertical-align:top;">Name</td>
            <td>{{ $data['name'] }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold; vertical-align:top;">Email</td>
            <td>{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold; vertical-align:top;">Subject</td>
            <td>{{ $data['subject'] }}</td>
        </tr>
        <tr>
            <td style="font-weight:bold; vertical-align:top;">Message</td>
            <td style="white-space:pre-line;">{{ $data['message'] }}</td>
        </tr>
    </table>
</body>
</html>
