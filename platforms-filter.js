document.addEventListener("DOMContentLoaded", () => {
    const genreSelect = document.getElementById("Genre");
    const priceRange = document.getElementById("Price");
    const priceValueDisplay = document.getElementById("PriceValue");
    const filterButton = document.querySelector(".main-filter button[type='submit']");

    
    priceRange.addEventListener("input", () => {
        priceValueDisplay.textContent = priceRange.value; 
    });

    
    filterButton.addEventListener("click", () => {
        const selectedGenre = genreSelect.value;
        const maxPrice = parseInt(priceRange.value, 10); 

        
        const tables = document.querySelectorAll(".home_img table");

        tables.forEach((table) => {
            const itemPriceText = table.querySelector("h5").textContent.trim(); 
            const itemPrice = parseInt(itemPriceText.replace("SR", ""), 10); 

            const itemGenre = table.getAttribute("data-genre");
            const itemPlatform = table.getAttribute("data-platform");


            const genreMatch = selectedGenre === "All" || selectedGenre === itemGenre;
            const priceMatch = itemPrice <= maxPrice;

            
            if (genreMatch && priceMatch) {
                table.style.display = ""; 
            } else {
                table.style.display = "none"; 
            }
        });
    });
});



