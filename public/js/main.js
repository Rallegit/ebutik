$(document).ready(function () {
        
        // Delete User Ajax
        // Delete User Ajax
        // Delete User Ajax       
       
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
                '<input type="submit" class="delete-user-btn" name="deleteBtn" value="Delete">' +
                '<input type="hidden" name="id" value="' + texterino["id"] + '">' + 
                '</form>'; 

                };
                    userList.html(html);
             $('.delete-user-btn').on('click', deleteUserEvent)

        };
    
    // Delete Product Ajax
    // Delete Product Ajax
    // Delete Product Ajax

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
    });


    function appendProductList(data){

		let articleList = $('.articleList');
        let html = '';
        
            for (article of data['products']) {
            html += 
                '<tr>' + // '<th scope="row">' + '<img src=' + article['img_url'] + '>' +  '</th>' +
                '<td>' + article['title'] + '</td>' +
                '<td>' + article['description'] + ' </td>' + 
                '<td>' + article['price'] + '</td>' + '<td>' +

                '<form action="updateproduct.php?" method="GET">' + 
                '<input type="submit" class="btn" value="Update">' + 
                '<input type="hidden" name="id" value="' + article['id']+ '">' +
                '</form>' + '</td>' + '<td>' +
                '<form method="POST">' + 
                '<input type="submit" class="delete-product-btn" name="deleteProductBtn" value="Delete">' +
                '<input type="hidden" name="id" value="' + article['id'] + '">' + 
                '</form>' + '</td>' + '</tr>'; 

                };
                articleList.html(html);
                $('.delete-product-btn').on('click', deleteProductEvent)

        };