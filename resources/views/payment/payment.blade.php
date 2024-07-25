<!DOCTYPE html>
<html>
<head>
    <title>PayHere Payment</title>
</head>
<body>
    <form method="post" action="{{ $payment_url }}">
        @foreach($payment_data as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <input type="submit" value="Pay Now">
    </form>
</body>
</html>
