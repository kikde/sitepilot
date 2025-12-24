<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Complaint Received</title>
</head>
<body>
    <p>Dear {{ $mailform->name }},</p>

    <p>Thank you for contacting {{ $setting->title ?? 'us' }}.  
    We have received your complaint and our team will look into it as soon as possible.</p>

    <p><strong>Summary:</strong></p>
    <ul>
        <li><strong>Mobile:</strong> {{ $mailform->mobile }}</li>
        <li><strong>Address:</strong> {{ $mailform->address }}</li>
        <li><strong>Message:</strong> {{ $mailform->message }}</li>
    </ul>

    <p>This is an automated confirmation. You don’t need to reply to this email.</p>

    <p>Regards,<br>{{ $setting->title ?? config('app.name') }}</p>
</body>
</html>
