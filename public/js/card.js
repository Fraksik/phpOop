$(function () {
	$("#add_to_cart").on('click', function () {
		let id = $(this).data('id');
		$.ajax({
			       url : "/../cart/add",
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