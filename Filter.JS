document.addEventListener("DOMContentLoaded", () => {
  const platformSelect = document.getElementById("platform");
  const genreSelect = document.getElementById("Genre");
  const priceRange = document.getElementById("Price");
  const priceValueDisplay = document.getElementById("PriceValue");
  const filterButton = document.querySelector(".main-filter button[type='submit']");

  
  priceRange.addEventListener("input", () => {
      priceValueDisplay.textContent = priceRange.value; 
  });

  
  filterButton.addEventListener("click", (event) => {
      event.preventDefault(); 

      const selectedPlatform = platformSelect.value;
      const selectedGenre = genreSelect.value;
      const maxPrice = parseInt(priceRange.value, 10); 

      
      const tables = document.querySelectorAll(".home_img table");

      tables.forEach(table => {
          
          const itemPriceText = table.querySelector("h5").textContent; 
          const itemPrice = parseInt(itemPriceText, 10); 
          const itemGenre = table.getAttribute("data-Genre"); 
          const itemPlatform = table.getAttribute("data-platform"); 

          
          const platformMatch = selectedPlatform === itemPlatform || selectedPlatform === "All"; 
          const genreMatch = selectedGenre === itemGenre || selectedGenre === "All"; 
          const priceMatch = itemPrice <= maxPrice;

          
          if (platformMatch && genreMatch && priceMatch) {
              table.style.display = ""; 
          } else {
              table.style.display = "none"; 
          }
      });
  });
});
