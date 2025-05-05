function displayDetails(id){
        window.location.href = `products.php?id=${id}`; 
}

document.querySelectorAll('.game-link').forEach((link) => {
        link.addEventListener('click', (event) => {
            const gameId = link.getAttribute('data-id'); 
            event.preventDefault(); 
            window.location.href = `products.php?id=${gameId}`; 
        });
    });