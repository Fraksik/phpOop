$(function () {
	$(".cart_button_add").on('click', function () {
		let id = $(this).data('id');
		let price = $(this).data('price');
		$.ajax({
			       url : "cart/add",
			       type: "POST",
			       data: {
				       id: id,
				       price: price
			       },
			       success : function (response) {
				       response = JSON.parse(response);
				       if(response.success === 'ok'){
					       let status_id = 'cart_count_id_' + id;
					       let status = document.getElementById(status_id);
					       let cart_cost = document.getElementById('cart_cost');
					       status.innerHTML = parseInt(status.innerHTML) + 1;
					       cart_cost.innerHTML = parseInt(cart_cost.innerHTML) + price;
				       }
			       }
		       })
	})
});

$(function () {
	$(".cart_button_delete").on('click', function () {
		let id = $(this).data('id');
		let cart_id = $(this).data('cart_id');
		let price = $(this).data('price');
		$.ajax({
			       url : "cart/delete",
			       type: "POST",
			       data: {
				       id: id,
				       cart_id: cart_id,
				       price: price
			       },
			       success : function (response) {
				       response = JSON.parse(response);
				       if(response.success === 'ok'){
					       let status_id = 'cart_count_id_' + id;
					       let status = document.getElementById(status_id);
					       let status_parent = status.parentElement.parentElement;
					       let cart_cost = document.getElementById('cart_cost');
					       if (parseInt(status.innerHTML) > 1) {
						        status.innerHTML = parseInt(status.innerHTML) - 1;
						        cart_cost.innerHTML = parseInt(cart_cost.innerHTML) - price;
					       } else {
								status_parent.innerHTML = "";
						        cart_cost.innerHTML = parseInt(cart_cost.innerHTML) - price;
					       }
				       }
			       }
		       })
	})
});

$(function () {
	$(".catalog_add").on('click', function () {
		let id = $(this).data('id');
		$.ajax({
			       url : "cart/add",
			       type: "POST",
			       data: {
				       id: id,
			       },
			       success : function (response) {
				       response = JSON.parse(response);
				       if(response.success === 'ok'){

				       }
			       }
		       })
	})
});

$(function () {
	$("#cart_drop").on('click', function () {
		$.ajax({
			       url : "cart/drop",
			       type: "POST",
			       data: {},
			       success : function (response) {
				       response = JSON.parse(response);
				       if(response.success === 'ok'){
							$("#cart_table").empty();
							$("#cart_cost").text(0);
				       }
			       }
		       })
	})
});

$(function () {
	$("#make_order").on('click', function () {
		$.ajax({
			       url : "cart/order",
			       type: "POST",
			       data: {},
			       success : function (response) {
				       response = JSON.parse(response);
				       if(response.success === 'ok'){
					       $("#cart_table").empty();
					       $("#cart_cost").text(0);
				       }
			       }
		       })
	})
});