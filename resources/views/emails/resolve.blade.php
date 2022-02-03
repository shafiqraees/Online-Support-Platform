<!DOCTYPE html>

<html>

<head>

    <title>Online Support Platform</title>

</head>

<body>

<h1>Ticket Number: {{ $data['ticket_number'] }}</h1>

<p>Status: {{ $data['status'] }}</p>
@if(isset($packet['description']))
<p>Description: {{ $packet['description'] }}</p>
@endif


<p>Thank you</p>

</body>

</html>
