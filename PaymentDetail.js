document.addEventListener('DOMContentLoaded', () => {
    const selectedPaymentMethod = localStorage.getItem('selectedPaymentMethod')?.toLowerCase();
    console.log('Selected Payment Method:', selectedPaymentMethod);

    if (selectedPaymentMethod) {
        const paymentSection = document.getElementById(selectedPaymentMethod);
        console.log('Payment Section:', paymentSection);

        if (paymentSection) {
            paymentSection.style.display = 'block';
            paymentSection.style.position ='fixed';
            paymentSection.style.top ='50%';
            paymentSection.style.left ='50%';
            paymentSection.style.transform ='translate(-50%, -50%)';
            
        } else {
            alert('Invalid payment method selected.');
        }
    } else {
        alert('No payment method selected. Redirecting back to the shopping cart.');
        window.location.href = 'shoppingcart.html';
    }
    
});

function validate(event) {
    event.preventDefault();  

    const selectedPaymentMethod = "your-payment-method-id"; 
    const visibleInputs = document.querySelectorAll(`#${selectedPaymentMethod} [required]`);
    let isValid = true;

    visibleInputs.forEach(input => {
        if (input.value.trim() === '') { 
            isValid = false;
            input.classList.add('is-invalid'); 
        } else {
            input.classList.remove('is-invalid'); 
        }
    });

    if (!isValid) {
        alert('Please fill out all required fields.');
        return false;
    }

    if (isValid) {
        clearCart();
        alert('Thank you for your purchase, we will contact you soon!');
        window.location.href = "index.html";
        return true; 
    } else {
        alert('Please fill out all required fields.');
        return false;
    }
}
