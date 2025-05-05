function clearCart() {
    $.ajax({
        url: 'deleteCartProducts.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response) {
                console.log('Cart cleared successfully.');
            } else {
                console.error('Failed to clear cart');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
}
