function proceedToPayment() {
    var selectedPaymentMethod = $('input[name="PM"]:checked');
    var isSignedIn = localStorage.getItem("isSignedIn");

    console.log('isSignedIn:', isSignedIn);

    if (isSignedIn === 'true') {
        if (selectedPaymentMethod.length === 0) {
            alert('Please select a payment method!');
            return;
        }

        localStorage.setItem('selectedPaymentMethod', selectedPaymentMethod.val().toLowerCase());

        window.location.href = 'Payment_Method.html';
    } else {
        alert('You need to log in to proceed to payment!');
        window.location.href = 'login.html';
    }
}
