$(function () {
	$(".cancel_order").on('click', function () {
		let id = $(this).data('id');
		$.ajax({
			       url : "orders/cancel",
			       type: "POST",
			       data: {
				       id: id
			       },
			       success : function (response) {
				       response = JSON.parse(response);
				       if(response.success === 'ok'){
							let status = $("#order_status_"+ id);
							status.text('canceled').css("color", "red");
				       }
			       }
		       })
	})
});
