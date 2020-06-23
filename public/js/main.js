$(document).ready(function () {
        
    // Delete User Ajax  -------------------------------------------//
    $('.delete-user-btn').on('click', deleteUserEvent);
    function deleteUserEvent(e) {
        e.preventDefault();
        let id = $(this).parent().find('input[name="id"]');
        console.log(id.val());
        $.ajax({
        method: 'POST',
        url: '../delete-user-ajax.php',
        data: { 
            deleteUserBtn: true, 
            id: id.val() 
        },
        dataType: 'json',
        success: function(data) {
            appendUserList(data);
            console.log(data); 
            },
        });
    }

    function appendUserList(data){
        let userList = $('.userList');
        let html = '';
        
        for (texterino of data['users']) {
        html += 
                '<section>' + texterino["username"] + '</section>' +
                '<section>' + texterino["first_name"] + '</section>' +
                '<section>' + texterino["last_name"] + ' </section>' + 
                '<section>' + texterino["email"] + '</section>' +
                '<section>' + texterino["password"] + '</section>' +
                '<section>' + texterino["phone"] + '</section>' +
                '<section>' + texterino["street"] + '</section>' +
                '<section>' + texterino["postal_code"] + '</section>' + 
                '<section>' + texterino["city"] + '</section>' +
                '<section>' + texterino["register_date"] + ' </section>' +
                '<section>' + texterino["country"] + ' </section>' +
                '<section>' + texterino["id"] + ' </section>' + 
                
                '<form action="updateuser.php?" method="GET">' + 
                '<input type="submit" class="btn" name="id" value="Update">' + 
                '<input type="hidden" name="id" value="' + texterino["id"]+ '">' +
                '</form>' + 
                '<form method="POST">' + 
                '<input type="submit" class="delete-user-btn" name="deleteUserBtn" value="Delete">' +
                '<input type="hidden" name="id" value="' + texterino["id"] + '">' + 
                '</form>'; 
                
                };
                userList.html(html);
        $('.delete-user-btn').on('click', deleteUserEvent)
    };
});
   
    // Delete Product Ajax -------------------------------------------//
    $('.delete-product-btn').on('click', deleteProductEvent);
    function deleteProductEvent(e) {
        e.preventDefault();
        let id = $(this).parent().find('input[name="id"]');
        console.log(id.val());
        $.ajax({
        method: 'POST',
        url: '../delete-product-ajax.php',
        data: { 
            deleteProductBtn: true, 
            id: id.val() 
        },
        dataType: 'json',
        success: function(data) {
            appendProductList(data);
            console.log(data); 
            },
        });
    }

    function appendProductList(data){
        let articleList = $('.articleList');
        let html = '';
        
        for (article of data['products']) {
        html += 
            '<div class="article_img">' + '<img src=' + article['img_url'] + '>' +  '</div>' +
            '<input type="text" name="title" value="' + article['title'] + '">' + '<br>' +
            '<input type="text" name="description" value="' + article['description'] + '">' + '<br>' +
            '<input type="text" name="price" value="' + article['price'] + '">' + '<br>' +
            '<form method="GET">' + 
                '<input type="submit" name="updateProductBtn class="btn bg-white update-product-btn" value="Update">' + 
                '<input type="hidden" name="id" value="' + article['id'] + '">' +
            '</form>' + 
            '<form method="POST">' + 
                '<input type="submit" class="delete-product-btn" name="deleteProductBtn" value="Delete">' +
                '<input type="hidden" name="id" value="' + article['id'] + '">' + 
            '</form>'; 

                };
                articleList.html(html);
        $('.delete-product-btn').on('click', deleteProductEvent)
        $('.update-product-btn').on('click', updateProductEvent)
    };

    // Update Btn Ajax  -------------------------------------------//
    $('.update-cart-form input[name="quantity"]').on('change', function() {

        let quantity = $(this).val();
        let cartId = $(this).data('id');

        $.ajax({
            method: 'POST',
            url: '../update-cart-item-ajax.php',
            data: {quantity: quantity, cartId: cartId},
            success: function() {

            },
        })
    });
    
    // Update Product Ajax  -------------------------------------------//
    $('.update-product-btn').on('click', updateProductEvent);
    function updateProductEvent(e) {
        e.preventDefault();
        let id              = $(this).parent().find('input[name="id"]');
        let title           = $(this).data('input[name="title"]');
        let description     = $(this).data('input[name="description"]');
        let price           = $(this).data('input[name="price"]');
        console.log(id.val());
        $.ajax({
            method: 'POST',
            url: '../admin/updateproduct.php',
            data: {
                updateProductBtn: true,
                title: title, description: description, price: price,
                id: id.val()
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                appendUpdateProductList(data);
                
            },
        });
    };

    
        