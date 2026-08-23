<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Details</title>
</head>
<body style="text-align: center;">
    <h1>Student Details</h1>

    <table border="1" style="width: 50%; margin: 30px auto; font-size: 18px; text-align: left;">
        <tr>
            <th style="padding: 12px; width: 30%;">ID</th>
            <td style="padding: 12px;">{{ $student['id'] }}</td>
        </tr>
        <tr>
            <th style="padding: 12px;">Name</th>
            <td style="padding: 12px;">{{ $student['name'] }}</td>
        </tr>
        <tr>
            <th style="padding: 12px;">Age</th>
            <td style="padding: 12px;">{{ $student['age'] }}</td>
        </tr>
        <tr>
            <th style="padding: 12px;">Track</th>
            <td style="padding: 12px;">{{ $student['track'] }}</td>
        </tr>
    </table>

    <br>
    <a href="/students" style="font-size: 16px;">← Back to All Students</a>
</body>
</html>