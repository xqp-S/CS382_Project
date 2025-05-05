function getProducts(column = '*', platform = '*') {
    $(document).ready(function(){
        $.ajax({
            url: 'getproducts.php',
            type: 'GET',
            data: { column: column, platform: platform },
            dataType: 'json',
            success: function (data) {
                for (let i = 0; i < data.length; i++) {
                    let game = data[i];
                    let table = document.createElement('table');
                    table.innerHTML = `
                       <tr>
                            <td><a onclick="displayDetails(${game['ID']})" class="game-link" data-id="${game['ID']}">
                                 <img src="${game['Main-img']}"> </a></td>
                        </tr>
                        <tr>
                            <td> <a onclick="displayDetails(${game['ID']})" class="game-link" data-id="${game['ID']}">
                                    <h4>${game['Name']}</h4>
                                </a></td>
                        </tr>
                        <tr>
                            <td><a>
                                    <h5>${game['Price']} SR</h5>
                                </a></td>
                        </tr>`;
    
                    if (column === 'Popular') {
                        $('.home_img').eq(0).append(table);
                    } else if (column === 'New_Released') {
                        $('.home_img').eq(1).append(table);
                    }else{
                        $('.home_img').append(table);  
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching products:', status, error);
            }
        });
    });
}
