<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Students</title>
</head>
<body>
    <h1 style="text-align: center;">All Students</h1>

    <table border="1" style="width: 70%; margin: 30px auto; font-size: 18px; text-align: center; cell-padding: 10px;">
        <thead>
            <tr>
                <th style="padding: 12px;">ID</th>
                <th style="padding: 12px;">Name</th>
                <th style="padding: 12px;">Track</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td style="padding: 10px;">{{ $student['id'] }}</td>
                    <td style="padding: 10px;">
                        <a href="/students/{{ $student['id'] }}">
                            {{ $student['name'] }}
                        </a>
                    </td>
                    <td style="padding: 10px;">{{ $student['track'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>