// Update Btn Ajax
$('.update-cart-form input[name="quantity"]').on('change', function() {

    let quantity = $(this).val();
    let cartId = $(this).data('id');

    $.ajax({
        method: 'POST',
        url: '../update-cart-item.php',
        data: {quantity: quantity, cartId: cartId},
        success: function() {

        };
    })
});

// Delete Btn Ajax

$('#deleteBtn').on('click', function(e)){
e.preventDefault();

let articleId = $(this).parent().find('input[name="articleId"]');

    $.ajax({
        method: 'POST',
        url: 'delete-cart-item.php',
        data: { // Skickas till add.php i form av POST parametrar
            deleteBtn: true, 
            articleId: articleId.val() 
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
            $('#form-message').html(data['message']);
            appendPunList(data);
        },
    });
}


$('.delete-pun-btn').on('click', deletePunEvent);
	function deletePunEvent(e) {
		e.preventDefault();
		
        let articleId = $(this).parent().find('input[name="punId"]');
		// console.log(punId.val());
		$.ajax({
			method: 'POST',
			url: 'delete.php',
			data: { // Skickas till add.php i form av POST parametrar
				deleteBtn: true, 
				punId: punId.val() 
			},
			dataType: 'json',
			success: function(data) {
				console.log(data);
				$('#form-message').html(data['message']);
				appendPunList(data);
			},
		});
	}