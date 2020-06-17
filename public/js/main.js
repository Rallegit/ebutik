$(document).ready(function() {
//      $('#exampleModal').on('show.bs.modal', function (event) {
//		var button = $(event.relatedTarget); // Button that triggered the modal
//		var article = button.data('article'); // Extract info from data-* attributes
//		var id = button.data('id'); // Extract info from data-* attributes
//
//		var modal = $(this);
//		modal.find(".modal-body input[name='article']").val(article);
//      modal.find(".modal-body input[name='id']").val(id);
        

    //Add Btn Ajax
      $('#addBtn').on('click', function(e){
          e.preventDefault();
          
          let quantity = $('input[name="quantity"]');
          let articleId = $('input[name="articleId"]');
      
	  	$.ajax({
	  		method: 'POST',
	  		url: 'add-cart-item.php',
	  		data: { // Skickas till add.php i form av POST parametrar
                 addToCart: true, 
                  quantity: quantity.val(),
	  			articleId: articleId.val() 
                  }, 
	  		    dataType: 'json',
	  		    success: function(data) {
                 console.log(data);
				
	             $('#form-message').html(data['message']);
	             appendPunList(data);
	  	    },
	  	 });
          })
         });

    // Update Btn Ajax - nya koden
    // $('.update-cart-form input[name="quantity"]').on('change', function() {

    //     let quantity = $(this).val();
    //     let cartId = $(this).data('id');

    //     $.ajax({
    //         method: 'POST',
    //         url: '../update-cart-item.php',
    //         data: {
    //             quantity: true,
    //             $articleItem = ['quantity'], $articleItem = ['quantity'].val(),
    //             articleId: articleId.val()
    //         },
    //         dataType: 'json',
	// 		success: function(data) {
	// 			console.log(data);
	// 			// $('#form-message').html(data['message']);
	// 			// appendPunList(data);
	// 			// $('#exampleModal').modal('toggle');
	// 		},
    //     })
    // });

    // Update Btn Ajax - gamla koden
//    $('.update-cart-form input[name="quantity"]').on('change', function() {
//
//        let quantity = $(this).val();
//        let cartId = $(this).data('id');
//
//        $.ajax({
//            method: 'POST',
//            url: '../update-cart-item.php',
//            data: {quantity: quantity, cartId: cartId},
//            success: function() {
//                console.log(data);
//            }
//        })
//    });
//
//    // Delete Btn Ajax
//    $('#deleteBtn').on('click', deleteArticleEvent);
//    function deleteArticleEvent(e) {
//    e.preventDefault();
//
//    let articleId = $(this).parent().find('input[name="articleId"]');
//        $.ajax({
//            method: 'POST',
//            url: '../delete-cart-item.php',
//            data: { 
//                deleteBtn: true, 
//                articleId: articleId.val() 
//            },
//            dataType: 'json',
//            success: function(data) {
//                console.log(data);
//			},
//        });
//    }
