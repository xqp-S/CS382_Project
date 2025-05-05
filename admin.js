function showForm(formId) {
   
    document.querySelectorAll('.form-container').forEach(form => {
        form.style.visibility = 'hidden';
        form.style.position = 'absolute';
    });


    const productListContainer = document.getElementById('productList');
    if (productListContainer) {
        productListContainer.style.display = 'none'; 
    }


    const form = document.getElementById(formId);
    if (form) {
        form.style.visibility = 'visible';
        form.style.position = 'relative';
        localStorage.setItem('visibleForm', formId);
    }

    if (formId === 'viewAllProducts') {
        toggleProductListDisplay(true); 
    }
}


function toggleProductListDisplay(show) {
    const productListContainer = document.getElementById('productList');
    if (show && productListContainer) {
        productListContainer.style.display = 'block'; 
    } else if (productListContainer) {
        productListContainer.style.display = 'none'; 
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const savedFormId = localStorage.getItem('visibleForm');
    if (savedFormId) {
        showForm(savedFormId);
    }
});



document.querySelectorAll('select[name="platform"]').forEach(select => {
    select.addEventListener('change', () => {
        const activeFormId = localStorage.getItem('visibleForm');
        if (activeFormId) {
            showForm(activeFormId); 
        }
    });
});


function performAction(actionType) {
    const activeFormId = localStorage.getItem('visibleForm');
    if (actionType === 'delete') {
        alert("Product Deleted Successfully");
    } else if (actionType === 'update') {
        
    }
    if (activeFormId) {
        showForm(activeFormId);
    }
}



        function fetchProducts() {
            const platform = document.getElementById('platformSelect').value;

            if (platform) {
                fetch(`admin.php?platform=${platform}`)
                    .then(response => response.json())
                    .then(data => {
                        displayProducts(data);
                    })
                    .catch(error => console.error('Error fetching products:', error));
            }
        }

        function displayProducts(products) {
            const productList = document.getElementById('productList');
            productList.innerHTML = '';

            products.forEach(product => {
                const productItem = document.createElement('div');
                productItem.classList.add('product-item');

                const productDetails = document.createElement('span');
                productDetails.textContent = product.Name;

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.onclick = () => deleteProduct(product.ID);

                productItem.appendChild(productDetails);
                productItem.appendChild(deleteButton);
                productList.appendChild(productItem);
            });
        }