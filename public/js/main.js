$(document).ready(function() {
    // Update Btn Ajax
    $('.update-cart-form input[name="quantity"]').on('change', function() {

        let quantity = $(this).val();
        let cartId = $(this).data('id');

        $.ajax({
            method: 'POST',
            url: '../update-cart-item.php',
            data: {quantity: quantity, cartId: cartId},
            success: function() {

            }
        })
    });

    // Delete Btn Ajax
    $('#deleteBtn').on('click', deleteArticleEvent);
    function deleteArticleEvent(e) {
    e.preventDefault();

    let articleId = $(this).parent().find('input[name="articleId"]');

        $.ajax({
            method: 'POST',
            url: '../delete-cart-item.php',
            data: { 
                deleteBtn: true, 
                articleId: articleId.val() 
            },
            dataType: 'json',
            success: function(data) {
			},
		});
	}