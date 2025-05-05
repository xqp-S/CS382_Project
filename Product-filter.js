document.addEventListener("DOMContentLoaded", () => {
  const platformSelect = document.getElementById("platform");
  const genreSelect = document.getElementById("Genre");
  const priceRange = document.getElementById("Price");
  const priceValueDisplay = document.getElementById("PriceValue");
  const filterButton = document.getElementById("btn");

  priceRange.addEventListener("input", () => {
    priceValueDisplay.textContent = priceRange.value;
  });

  filterButton.addEventListener("click", () => {
    const selectedPlatform = platformSelect.value;
    const selectedGenre = genreSelect.value;
    const maxPrice = parseInt(priceRange.value, 10);

    const tables = document.querySelectorAll(".home_img table");

    tables.forEach((table) => {
      const itemPriceText = table.querySelector("h5").textContent.trim(); 
      const itemPrice = parseInt(itemPriceText.replace("SR", ""), 10); 

      const itemGenre = table.getAttribute("data-Genre");
      const itemPlatform = table.getAttribute("data-platform");

      const platformMatch = selectedPlatform === "All" || selectedPlatform === itemPlatform;
      const genreMatch = selectedGenre === "All" || selectedGenre === itemGenre;
      const priceMatch = !isNaN(itemPrice) && itemPrice <= maxPrice;

      if (platformMatch && genreMatch && priceMatch) {
        table.style.display = ""; 
      } else {
        table.style.display = "none"; 
      }
    });
  });
});
