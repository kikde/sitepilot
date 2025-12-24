<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Complaint Details</title>
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f3f4f6;
        }
        h2 {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

<h2>{{ $setting->title ?? 'New Complaint' }}</h2>

<table>
    <tr>
        <th style="width: 25%;">Name</th>
        <td>{{ $mailform->name }}</td>
    </tr>

    <tr>
        <th>Mobile</th>
        <td>{{ $mailform->mobile }}</td>
    </tr>
     
      <tr>
        <th>Email</th>
        <td>{{ $mailform->email }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ $mailform->address }}</td>
    </tr>

    <tr>
        <th>Message</th>
        <td>{{ $mailform->message }}</td>
    </tr>

    <tr>
        <th>Description</th>
        <td>{{ $mailform->description }}</td>
    </tr>

    <tr>
        <th>Video URL</th>
        <td>
            @if(!empty($mailform->video_url))
                <a href="{{ $mailform->video_url }}" target="_blank">
                    {{ $mailform->video_url }}
                </a>
            @else
                —
            @endif
        </td>
    </tr>

    <tr>
        <th>Attachments</th>
        <td>
            @php
                $fileNames = [];
                if ($mailform->file('file1')) {
                    $fileNames[] = $mailform->file('file1')->getClientOriginalName();
                }
                if ($mailform->file('file2')) {
                    $fileNames[] = $mailform->file('file2')->getClientOriginalName();
                }
            @endphp

            @if(count($fileNames))
                {{ implode(', ', $fileNames) }}
                <br>
                <small>(Files are attached with this email.)</small>
            @else
                No documents uploaded.
            @endif
        </td>
    </tr>
</table>

</body>
</html>
