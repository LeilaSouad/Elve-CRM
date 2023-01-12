$(document).ready(function(){

//check admin password is correct or not
$("#current_pwd").keyup(function(){

var current_pwd = $("#current_pwd").val();
//alert (current_pwd);

$.ajax({
type:'post',
url:'/admin/check-current-pwd',
data:{current_pwd:current_pwd},
success:function(resp)
{//alert(resp);
	if(resp=="false"){
		$("#chkCurrentPwd").html("<font color=red>Неверный пароль</font>");
	}
	else if (resp=="true"){
		$("#chkCurrentPwd").html("<font color=green>Верный пароль</font>");
	}

},error:function(){
	alert("Error");

}


});

});


// Update Banner Status
	$(document).on("click",".updateBannerStatus",function(){	
		var status = $(this).children("i").attr("status");
		var banner_id = $(this).attr("banner_id");
		$.ajax({
			type:'post',
			url:'/admin/update-banner-status',
			data:{status:status,banner_id:banner_id},
			success:function(resp){
				if(resp['status']==0){
					$("#banner-"+banner_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>");	
				}else if(resp['status']==1){
					$("#banner-"+banner_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");	
				}
			},error:function(){
				alert("Error");
			}
		});
	});




//Update Section Status
	$(document).on("click",".updateSectionStatus",function(){
var status = $(this).children("i").attr("status");
	var section_id  = $(this).attr("section_id");
$.ajax({
	type:'post',
	url:'/admin/update-section-status',
	data:{status:status,section_id:section_id},
	success:function(resp){
	
		if(resp['status']==0){
			$("#section-"+section_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>");


		}
			else if(resp['status']==1){
							$("#section-"+section_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");



			}

	},error:function(){
		alert("Error");
	}

});
});
	// Update Brand Status
	$(document).on("click",".updateBrandStatus",function(){	
		var status = $(this).children("i").attr("status");
		var brand_id = $(this).attr("brand_id");
		$.ajax({
			type:'post',
			url:'/admin/update-brand-status',
			data:{status:status,brand_id:brand_id},
			success:function(resp){
				if(resp['status']==0){
					$("#brand-"+brand_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>");	
				}else if(resp['status']==1){
					$("#brand-"+brand_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");	
				}
			},error:function(){
				alert("Error");
			}
		});
	});


		// Update Currency Status
	$(document).on("click",".updateCurrencyStatus",function(){	
		var status = $(this).children("i").attr("status");
		var currency_id = $(this).attr("currency_id");
		$.ajax({
			type:'post',
			url:'/admin/update-currency-status',
			data:{status:status,currency_id:currency_id},
			success:function(resp){
				if(resp['status']==0){
					$("#currency-"+currency_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>");	
				}else if(resp['status']==1){
					$("#currency-"+currency_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");	
				}
			},error:function(){
				alert("Ошибка");
			}
		});
	});
		// Update Warehouse Status
	$(document).on("click",".updateWarehouseStatus",function(){	
		var status = $(this).children("i").attr("status");
		var warehouse_id = $(this).attr("warehouse_id");
		$.ajax({
			type:'post',
			url:'/admin/update-warehouse-status',
			data:{status:status,warehouse_id:warehouse_id},
			success:function(resp){
				if(resp['status']==0){
					$("#warehouse-"+warehouse_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>");	
				}else if(resp['status']==1){
					$("#warehouse-"+warehouse_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");	
				}
			},error:function(){
				alert("Ошибка");
			}
		});
	});

//Update Categories Status
	$(document).on("click",".updateCategoryStatus",function(){
var status = $(this).children("i").attr("status");
	var category_id  = $(this).attr("category_id");
$.ajax({
	type:'post',
	url:'/admin/update-category-status',
	data:{status:status,category_id:category_id},
	success:function(resp){
	
		if(resp['status']==0){
			$("#category-"+category_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>");


		}
			else if(resp['status']==1){
							$("#category-"+category_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");



			}

	},error:function(){
		alert("Error");
	}

});
});

//Append Categories Level
$('#section_id').change(function(){
	var section_id = $(this).val();
	//alert(section_id);
	$.ajax({
		type:'post',
		url:'/admin/append-categories-level',
		data:{section_id:section_id},
		success:function(resp)
		{
			$("#appendCategoriesLevel").html(resp);
			

		},
		error:function()
		{
			alert("Error");
			}
		});
});
//Update Product Status
	$(document).on("click",".updateProductStatus",function(){
var status = $(this).children("i").attr("status");
	var product_id  = $(this).attr("product_id");
$.ajax({
	type:'post',
	url:'/admin/update-product-status',
	data:{status:status,product_id:product_id},
	success:function(resp){
	
		if(resp['status']==0){
			$("#product-"+product_id).html("<i class='fas fa-toggle-off' aria-hidden='true' status='Inactive'></i>");


		}
			else if(resp['status']==1){
							$("#product-"+product_id).html("<i class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");



			}

	},error:function(){
		alert("Error");
	}

});
});


$(document).on("click",".updateImageStatus",function(){

	var status = $(this).text();
	var image_id  = $(this).attr("image_id");
$.ajax({
	type:'post',
	url:'/admin/update-image-status',
	data:{status:status,image_id:image_id},
	success:function(resp){
	
		if(resp['status']==0){
			$("#image-"+image_id).html("Inactive");


		}
			else if(resp['status']==1){
							$("#image-"+image_id).html("Active");



			}

	},error:function(){
		alert("Error");
	}

});
});
//Delete Item from itemTable
$("#itemsTable").on("click", "#DeleteButton", function() {
   $(this).closest("tr").remove();
});
  
//Умножить цену на количество в таблице товаров
 $(document).on("change", '.quantity, .price, .discount', function(){

  $('#itemsTable tbody  tr').each(function() {
	  var quantity = parseFloat($(this).find('.quantity').val()).toFixed(2);
	  var price = parseFloat($(this).find('.price').val()).toFixed(2);
	  var discount = parseFloat($(this).find('.discount').val()).toFixed(2);
	  $(this).find('.subtotal').val(quantity * price  - (quantity * price * (discount * 0.01)));
	   $(this).find('.discountbynumber').val((quantity * price)-(quantity * price  - (quantity * price * (discount * 0.01))));
  });
});
 //Показать скидку
  $('#itemsTable tbody  tr').each(function() {
	  var quantity = parseFloat($(this).find('.quantity').val()).toFixed(2);
	  var price = parseFloat($(this).find('.price').val()).toFixed(2);
	  var discount = parseFloat($(this).find('.discount').val()).toFixed(2);
	   $(this).find('.discountbynumber').val(parseFloat((quantity * price)-(quantity * price  - (quantity * price * (discount * 0.01)))).toFixed(2));
  });
//Показать 2 знака после запятой в числах таблицы
$(".quantity, .price").change(function() {
    var $this = $(this);
    $this.val(parseFloat($this.val()).toFixed(2));        
});
//Изменить цену за кв.м. при перерасчете суммы
	$('.subtotal').change(function() {
	$('#itemsTable').each(function() {
	  var subtotal = parseFloat($(this).find('.subtotal').val());
	  var quantity = parseFloat($(this).find('.quantity').val());

	  $(this).find('.price').val(subtotal / quantity);
  });
});

$(document).on("change", '.product-table', function() {
	var suma = 0;
	$('.subtotal').each(function() {
	suma += parseFloat(this.value);
	});	
	$(this).find('#total').val(suma);
  });
//Посчитать скидку в грн
$(document).on("change", '.product-table', function() {
	var suma = 0;
	$('.discountbynumber').each(function() {
	suma += parseFloat(this.value);
	});	
	$(this).find('#discountnumber').val(parseFloat(suma).toFixed(2));
  });


$(document).ready(function() {
	//Установить сумму долга при 0 оплате
	var paid = parseFloat($("#paid").val()).toFixed(2);
var total = parseFloat($("#total").val()).toFixed(2);
if (paid == 0){
	$('#debt').val(parseFloat(total).toFixed(2));
}
//Показать скидку в грн
	var suma = 0;
$('.discountbynumber').each(function() {
	suma += parseFloat(this.value);
	});	
	$(this).find('#discountnumber').val(parseFloat(suma).toFixed(2));








  });
//борг















$(document).on("change", '#paid', function() {
	var total = parseFloat($("#receipt_total").val()).toFixed(2);
	var paid = parseFloat($("#paid").val()).toFixed(2);

	$('#debt').val(parseFloat(total - paid).toFixed(2));
  });


//Enable Disabled Save Button on any Change
$(document).ready(function() {
  $('.form').on('change','#DeleteButton', function() {
    $('#submit').attr('disabled', false);
  });
})
$(document).ready(function() {
  $('.form').on('click', function() {
    $('#submit').attr('disabled', false);
  });
})
//Confirm Deletion with SweetAlert
$(document).on("click",".confirmDelete",function(){
	var record = $(this).attr("record");
	var recordid = $(this).attr("recordid");
	Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
   
    window.location.href="/admin/delete-"+record+"-"+recordid;
    
  }
});
return false;
});
});