<!DOCTYPE html>
<html>

<head>
    <title>Pay Here</title>
</head>

<body>
    <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
        @csrf
        <input type="hidden" name="merchant_id" value="{{ $paymentDetails['merchant_id'] }}">
        <input type="hidden" name="return_url" value="{{ $paymentDetails['return_url'] }}">
        <input type="hidden" name="cancel_url" value="{{ $paymentDetails['cancel_url'] }}">
        <input type="hidden" name="notify_url" value="{{ $paymentDetails['notify_url'] }}">

        <input type="hidden" name="order_id" value="{{ $paymentDetails['order_id'] }}">
        <input type="hidden" name="items" value="{{ $paymentDetails['items'] }}">
        <input type="hidden" name="currency" value="{{ $paymentDetails['currency'] }}">
        <input type="hidden" name="amount" value="{{ $paymentDetails['amount'] }}">

        <input type="hidden" name="first_name" value="{{ $paymentDetails['first_name'] }}">
        <input type="hidden" name="last_name" value="{{ $paymentDetails['last_name'] }}">
        <input type="hidden" name="email" value="{{ $paymentDetails['email'] }}">
        <input type="hidden" name="phone" value="{{ $paymentDetails['phone'] }}">
        <input type="hidden" name="address" value="{{ $paymentDetails['address'] }}">
        <input type="hidden" name="city" value="{{ $paymentDetails['city'] }}">
        <input type="hidden" name="country" value="{{ $paymentDetails['country'] }}">
        <input type="hidden" name="hash" value="{{ $paymentDetails['hash'] }}">

        <input type="submit" value="Buy Now">
    </form>
</body>

</html>
