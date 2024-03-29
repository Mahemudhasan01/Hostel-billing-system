/*******************************************************************************
* Simplified PHP Invoice System                                                *
*                                                                              *
* Version: 1.1.1	                                                               *
* Author:  James Brandon                                    				   *
*******************************************************************************/
function selectStudetnStatus(option, studentData){

		var value = ($("#slct").val() != "") ? $("#slct").val() : option;
		var toAppend = '';

		if(value == "Other"){
			toAppend = "";
			toAppend = $("#status").html(toAppend); return;
		}
		
		if (value == "Student") {
			toAppend = "<div class='panel panel-default'> <div class='panel-heading'> <h4>Student info</h4> </div> <div class='panel-body form-group form-group-sm'> <div class='row'> <div class='col-xs-6'> <div class='form-group'> <input type='text' class='form-control margin-bottom required' name='last_exam'  value='" + (studentData ? studentData.last_exam : '') + "'  id='Student_name_ship' placeholder='Last Exam Name' tabindex='9' required> </div> <div class='form-group'> <input type='text' class='form-control margin-bottom' name='college_name' id='Student_address_2_ship' value='" + (studentData ? studentData.college_name : '') + "' placeholder='Enter College Name' tabindex='11' required> </div><div class='form-group no-margin-bottom'><input type='text' class='form-control required' disabled name='fees' id='Student_county_ship' placeholder='Enter college Address' value='Hostel Fees ₹1200/Month' tabindex='13' required></div> </div> <div class='col-xs-6'><div class='form-group'> <input type='text' class='form-control margin-bottom required' name='current_college_year' value='" + (studentData ? studentData.current_college_year : '') + "' id='Student_address_1_ship' placeholder='Current College Year' tabindex='10' required></div> <div class='form-group'> <input type='text' class='form-control margin-bottom required' name='college_address' id='Student_town_ship' value='" + (studentData ? studentData.college_address : '') + "' placeholder='College Address' tabindex='12' required> </div> <div class='form-group no-margin-bottom'></div> </div> </div> </div> </div>"; $("#status").html(toAppend); return;

		}
		if (value == "Employee") {
			toAppend = "<div class='panel panel-default'> <div class='panel-heading'> <h4>Employee info</h4> </div> <div class='panel-body form-group form-group-sm'> <div class='row'> <div class='col-xs-6'> <div class='form-group'> <input type='text' class='form-control margin-bottom required' name='last_exam' value='" + (studentData ? studentData.last_exam : '') + "' id='Student_name_ship' placeholder='Previous Company' tabindex='9' </div <div class='form-group'> <input type='text' class='form-control margin-bottom' name='college_name' id='Student_address_2_ship' value='" + (studentData ? studentData.college_name : '') + "' placeholder='Enter Current Company name' tabindex='11' required> </div><div class='form-group no-margin-bottom'><input type='text' class='form-control required' disabled name='fees' id='Student_county_ship' placeholder='Enter Company Address' value='Hostel Fees ₹1200/Month' tabindex='13' required></div> </div> <div class='col-xs-6'><div class='form-group'> <input type='text' class='form-control margin-bottom required' name='current_college_year' value='" + (studentData ? studentData.current_college_year : '') + "' id='Student_address_1_ship' placeholder='Enter Job Role' tabindex='10' required></div> <div class='form-group'> <input type='text' class='form-control margin-bottom required' name='college_address' id='Student_town_ship' value='" + (studentData ? studentData.college_address : '') + "' placeholder='Company Address' tabindex='12' required> </div> <div class='form-group no-margin-bottom'>  </div> </div> </div> </div> </div>"; $("#status").html(toAppend); return;
		}
}

$(document).ready(function () {

	// Invoice Type
	$('#invoice_type').change(function () {
		var invoiceType = $("#invoice_type option:selected").text();
		$(".invoice_type").text(invoiceType);
	});

	// Load dataTables
	$("#data-table").dataTable();

	// add product
	$("#action_add_product").click(function (e) {
		e.preventDefault();
		actionAddProduct();
	});

	// password strength
	var options = {
		onLoad: function () {
			$('#messages').text('Start typing password');
		},
		onKeyUp: function (evt) {
			$(evt.target).pwstrength("outputErrorList");
		}
	};
	$('#password').pwstrength(options);

	// add user
	$("#action_add_user").click(function (e) {
		e.preventDefault();
		actionAddUser();
	});

	// update customer
	$(document).on('click', "#action_update_user", function (e) {
		e.preventDefault();
		updateUser();
	});

	// delete user
	$(document).on('click', ".delete-user", function (e) {
		e.preventDefault();

		var userId = 'action=delete_user&delete=' + $(this).attr('data-user-id'); //build a post data structure
		var user = $(this);

		$('#delete_user').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete', function () {
			deleteUser(userId);
			$(user).closest('tr').remove();
		});
	});

	// delete customer
	$(document).on('click', ".delete-customer", function (e) {
		e.preventDefault();
		
		var userId = 'action=delete_customer&delete=' + $(this).attr('data-customer-id'); //build a post data structure
		var user = $(this);

		$('#delete_customer').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete', function () {
			deleteCustomer(userId);
			$(user).closest('tr').remove();
		});
	});

	// update customer
	$(document).on('click', "#action_update_customer", function (e) {
		e.preventDefault();
		updateCustomer();
	});

	// update product
	$(document).on('click', "#action_update_product", function (e) {
		e.preventDefault();
		updateProduct();
	});

	// login form
	$(document).bind('keypress', function (e) {
		e.preventDefault;

		if (e.keyCode == 13) {
			$('#btn-login').trigger('click');
		}
	});

	$(document).on('click', '#btn-login', function (e) {
		e.preventDefault;
		actionLogin();
	});

	// download CSV
	$(document).on('click', ".download-csv", function (e) {
		e.preventDefault;

		var action = 'action=download_csv'; //build a post data structure
		downloadCSV(action);

	});

	// email invoice
	$(document).on('click', ".email-invoice", function (e) {
		e.preventDefault();

		var invoiceId = 'action=email_invoice&id=' + $(this).attr('data-invoice-id') + '&email=' + $(this).attr('data-email') + '&invoice_type=' + $(this).attr('data-invoice-type') + '&custom_email=' + $(this).attr('data-custom-email'); //build a post data structure
		emailInvoice(invoiceId);
	});

	// delete invoice
	$(document).on('click', ".delete-invoice", function (e) {
		e.preventDefault();

		var invoiceId = 'action=delete_invoice&delete=' + $(this).attr('data-invoice-id'); //build a post data structure
		var invoice = $(this);

		$('#delete_invoice').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete', function () {
			deleteInvoice(invoiceId);
			$(invoice).closest('tr').remove();
		});
	});

	// delete product
	$(document).on('click', ".delete-product", function (e) {
		e.preventDefault();

		var productId = 'action=delete_product&delete=' + $(this).attr('data-product-id'); //build a post data structure
		var product = $(this);

		$('#confirm').modal({ backdrop: 'static', keyboard: false }).one('click', '#delete', function () {
			deleteProduct(productId);
			$(product).closest('tr').remove();
		});
	});

	// create customer
	$("#action_create_customer").click(function (e) {
		e.preventDefault();
		actionCreateCustomer();
	});

	$(document).on('click', ".item-select", function (e) {

		e.preventDefault;

		var product = $(this);

		$('#insert').modal({ backdrop: 'static', keyboard: false }).one('click', '#selected', function (e) {

			var itemText = $('#insert').find("option:selected").text();
			var itemValue = $('#insert').find("option:selected").val();

			$(product).closest('tr').find('.invoice_product').val(itemText);
			$(product).closest('tr').find('.invoice_product_price').val(itemValue);

			updateTotals('.calculate');
			calculateTotal();

		});

		return false;

	});

	$(document).on('click', ".select-customer", function (e) {

		e.preventDefault;

		var customer = $(this);

		$('#insert_customer').modal({ backdrop: 'static', keyboard: false });

		return false;

	});

	$(document).on('click', ".customer-select", function (e) {

		var customer_id = $(this).attr('data-customer-id');
		var customer_name = $(this).attr('data-customer-name');
		var customer_email = $(this).attr('data-customer-email');
		var customer_phone = $(this).attr('data-customer-phone');

		var customer_address_1 = $(this).attr('data-customer-address-1');
		var customer_address_2 = $(this).attr('data-customer-address-2');
		var customer_town = $(this).attr('data-customer-town');
		var customer_county = $(this).attr('data-customer-county');
		var customer_postcode = $(this).attr('data-customer-postcode');

		var customer_name_ship = $(this).attr('data-customer-name-ship');
		var customer_address_1_ship = $(this).attr('data-customer-address-1-ship');
		var customer_address_2_ship = $(this).attr('data-customer-address-2-ship');
		var customer_town_ship = $(this).attr('data-customer-town-ship');
		var customer_county_ship = $(this).attr('data-customer-county-ship');
		var customer_postcode_ship = $(this).attr('data-customer-postcode-ship');

		$('#customer_id').val(customer_id);
		$('#customer_name').val(customer_name);
		$('#customer_email').val(customer_email);
		$('#customer_phone').val(customer_phone);

		$('#customer_address_1').val(customer_address_1);
		$('#customer_address_2').val(customer_address_2);
		$('#customer_town').val(customer_town);
		$('#customer_county').val(customer_county);
		$('#customer_postcode').val(customer_postcode);


		$('#customer_name_ship').val(customer_name_ship);
		$('#customer_address_1_ship').val(customer_address_1_ship);
		$('#customer_address_2_ship').val(customer_address_2_ship);
		$('#customer_town_ship').val(customer_town_ship);
		$('#customer_county_ship').val(customer_county_ship);
		$('#customer_postcode_ship').val(customer_postcode_ship);

		$('#insert_customer').modal('hide');

	});

	// create invoice
	$("#action_create_invoice").click(function (e) {
		e.preventDefault();
		actionCreateInvoice();
	});

	// update invoice
	$(document).on('click', "#action_edit_invoice", function (e) {
		e.preventDefault();
		updateInvoice();
	});

	// enable date pickers for due date and invoice date
	var dateFormat = $(this).attr('data-vat-rate');
	$('#invoice_date, #invoice_due_date').datetimepicker({
		showClose: false,
		format: dateFormat
	});

	// copy customer details to shipping
	$('input.copy-input').on("input", function () {
		$('input#' + this.id + "_ship").val($(this).val());
	});

	// remove product row
	$('#invoice_table').on('click', ".delete-row", function (e) {
		e.preventDefault();
		$(this).closest('tr').remove();
		calculateTotal();
	});

	// add new product row on invoice
	var cloned = $('#invoice_table tr:last').clone();
	$(".add-row").click(function (e) {
		e.preventDefault();
		cloned.clone().appendTo('#invoice_table');
	});

	calculateTotal();

	$('#invoice_table').on('input', '.calculate', function () {
		updateTotals(this);
		calculateTotal();
	});

	$('#invoice_totals').on('input', '.calculate', function () {
		calculateTotal();
	});

	$('#invoice_product').on('input', '.calculate', function () {
		calculateTotal();
	});

	$('.remove_vat').on('change', function () {
		calculateTotal();
	});

	function updateTotals(elem) {

		var tr = $(elem).closest('tr'),
			quantity = $('[name="invoice_product_qty[]"]', tr).val(),
			price = $('[name="invoice_product_price[]"]', tr).val(),
			isPercent = $('[name="invoice_product_discount[]"]', tr).val().indexOf('%') > -1,
			percent = $.trim($('[name="invoice_product_discount[]"]', tr).val().replace('%', '')),
			subtotal = parseInt(quantity) * parseFloat(price);

		if (percent && $.isNumeric(percent) && percent !== 0) {
			if (isPercent) {
				subtotal = subtotal - ((parseFloat(percent) / 100) * subtotal);
			} else {
				subtotal = subtotal - parseFloat(percent);
			}
		} else {
			$('[name="invoice_product_discount[]"]', tr).val('');
		}

		$('.calculate-sub', tr).val(subtotal.toFixed(2));
	}

	function calculateTotal() {

		var grandTotal = 0,
			disc = 0,
			c_ship = parseInt($('.calculate.shipping').val()) || 0;

		$('#invoice_table tbody tr').each(function () {
			var c_sbt = $('.calculate-sub', this).val(),
				quantity = $('[name="invoice_product_qty[]"]', this).val(),
				price = $('[name="invoice_product_price[]"]', this).val() || 0,
				subtotal = parseInt(quantity) * parseFloat(price);

			grandTotal += parseFloat(c_sbt);
			disc += subtotal - parseFloat(c_sbt);
		});

		// VAT, DISCOUNT, SHIPPING, TOTAL, SUBTOTAL:
		var subT = parseFloat(grandTotal),
			finalTotal = parseFloat(grandTotal + c_ship),
			vat = parseInt($('.invoice-vat').attr('data-vat-rate'));

		$('.invoice-sub-total').text(subT.toFixed(2));
		$('#invoice_subtotal').val(subT.toFixed(2));
		$('.invoice-discount').text(disc.toFixed(2));
		$('#invoice_discount').val(disc.toFixed(2));

		if ($('.invoice-vat').attr('data-enable-vat') === '1') {

			if ($('.invoice-vat').attr('data-vat-method') === '1') {
				$('.invoice-vat').text(((vat / 100) * finalTotal).toFixed(2));
				$('#invoice_vat').val(((vat / 100) * finalTotal).toFixed(2));
				$('.invoice-total').text((finalTotal).toFixed(2));
				$('#invoice_total').val((finalTotal).toFixed(2));
			} else {
				$('.invoice-vat').text(((vat / 100) * finalTotal).toFixed(2));
				$('#invoice_vat').val(((vat / 100) * finalTotal).toFixed(2));
				$('.invoice-total').text((finalTotal + ((vat / 100) * finalTotal)).toFixed(2));
				$('#invoice_total').val((finalTotal + ((vat / 100) * finalTotal)).toFixed(2));
			}
		} else {
			$('.invoice-total').text((finalTotal).toFixed(2));
			$('#invoice_total').val((finalTotal).toFixed(2));
		}

		// remove vat
		if ($('input.remove_vat').is(':checked')) {
			$('.invoice-vat').text("0.00");
			$('#invoice_vat').val("0.00");
			$('.invoice-total').text((finalTotal).toFixed(2));
			$('#invoice_total').val((finalTotal).toFixed(2));
		}

	}

	function actionAddUser() {

		var errorCounter = validateForm();

		if (errorCounter > 0) {
			$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
			$("#response .message").html("<strong>Error</strong>: It appear's you have forgotten to complete something!");
			$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
		} else {

			$(".required").parent().removeClass("has-error");

			var $btn = $("#action_add_user").button("loading");

			$.ajax({

				url: 'response.php',
				type: 'POST',
				data: $("#add_user").serialize(),
				dataType: 'json',
				success: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
				},
				error: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
				}

			});
		}

	}

	function actionAddProduct() {

		var errorCounter = validateForm();

		if (errorCounter > 0) {
			$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
			$("#response .message").html("<strong>Error</strong>: It appear's you have forgotten to complete something!");
			$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
		} else {

			$(".required").parent().removeClass("has-error");

			var $btn = $("#action_add_product").button("loading");

			$.ajax({

				url: 'response.php',
				type: 'POST',
				data: $("#add_product").serialize(),
				dataType: 'json',
				success: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
				},
				error: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
				}

			});
		}

	}

	function actionCreateCustomer() {

		var errorCounter = validateForm();

		if (errorCounter > 0) {
			$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
			$("#response .message").html("<strong>Error</strong>: It appear's you have forgotten to complete something!");
			$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
		} else {

			var $btn = $("#action_create_customer").button("loading");

			$(".required").parent().removeClass("has-error");

			$.ajax({

				url: 'response.php',
				type: 'POST',
				data: $("#create_customer").serialize(),
				dataType: 'json',
				success: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$("#create_customer").before().html("<a href='./customer-add.php' class='btn btn-primary'>Add New Customer</a>");
					$("#create_cuatomer").remove();
					$btn.button("reset");
				},
				error: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
				}

			});
		}

	}

	function actionCreateInvoice() {

		var errorCounter = validateForm();

		if (errorCounter > 0) {
			$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
			$("#response .message").html("<strong>Error</strong>: It appear's you have forgotten to complete something!");
			$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
		} else {

			var $btn = $("#action_create_invoice").button("loading");

			$(".required").parent().removeClass("has-error");
			$("#create_invoice").find(':input:disabled').removeAttr('disabled');

			$.ajax({

				url: 'response.php',
				type: 'POST',
				data: $("#create_invoice").serialize(),
				dataType: 'json',
				success: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$("#create_invoice").before().html("<a href='../invoice-add.php' class='btn btn-primary'>Create new invoice</a>");
					$("#create_invoice").remove();
					$btn.button("reset");
				},
				error: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
				}

			});
		}

	}

	function deleteProduct(productId) {

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: productId,
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			}
		});

	}

	function deleteUser(userId) {

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: userId,
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			}
		});

	}

	function deleteCustomer(userId) {

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: userId,
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
			}
		});

	}

	function emailInvoice(invoiceId) {

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: invoiceId,
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
			}
		});

	}

	function deleteInvoice(invoiceId) {

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: invoiceId,
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			}
		});

	}

	function updateProduct() {

		var $btn = $("#action_update_product").button("loading");

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: $("#update_product").serialize(),
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			}
		});

	}

	function updateUser() {

		var $btn = $("#action_update_user").button("loading");

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: $("#update_user").serialize(),
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			}
		});

	}

	function updateCustomer() {

		var $btn = $("#action_update_customer").button("loading");

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: $("#update_customer").serialize(),
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			}
		});

	}

	function updateInvoice() {

		var $btn = $("#action_update_invoice").button("loading");
		$("#update_invoice").find(':input:disabled').removeAttr('disabled');

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: $("#update_invoice").serialize(),
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
				$btn.button("reset");
			}
		});

	}

	function downloadCSV(action) {

		jQuery.ajax({

			url: 'response.php',
			type: 'POST',
			data: action,
			dataType: 'json',
			success: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
			},
			error: function (data) {
				$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
				$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
				$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
			}
		});

	}

	// login function
	function actionLogin() {

		var errorCounter = validateForm();

		if (errorCounter > 0) {

			$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
			$("#response .message").html("<strong>Error</strong>: Missing something are we? check and try again!");
			$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);

		} else {

			var $btn = $("#btn-login").button("loading");

			jQuery.ajax({
				url: 'response.php',
				type: "POST",
				data: $("#login_form").serialize(), // serializes the form's elements.
				dataType: 'json',
				success: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");

					window.location = "dashboard.php";
				},
				error: function (data) {
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
				}

			});

		}

	}

	function validateForm() {
		// error handling
		var errorCounter = 0;

		$(".required").each(function (i, obj) {

			if ($(this).val() === '') {
				$(this).parent().addClass("has-error");
				errorCounter++;
			} else {
				$(this).parent().removeClass("has-error");
			}


		});

		return errorCounter;
	}

	$("#toMonth").on("change", function(){
		var fromMonth = $("#fromMonth").val();
		var toMonth = $("#toMonth").val();
		var roomNo = ($("#roomNo").val() != "") ? $("#roomNo").val(): "null";	
		var studntName = ($("#txtSearch").val() != "") ? $("#txtSearch").val(): "null";

		if(fromMonth != "" && toMonth != ""){
			$.ajax({
				url: "admin/findReciept/" + fromMonth + "/" + toMonth + "/" + roomNo + "/" + studntName, 
				type: "GET",
				success: function(response){
					$(".dataTables_empty").remove();
					$("#bodyReceiptData").empty();
					var tableRow = '';
					$.each(response, function(index, item) {
						console.log(item);
						var startMonth = '';
						switch(item.start_month) {
							case '1':
								startMonth = 'Jan';
								break;
							case '2':
								startMonth = 'Feb';
								break;
							case '3':
								startMonth = 'March';
								break;
							case '4':
								startMonth = 'April';
								break;
							case '5':
								startMonth = 'May';
								break;
							case '6':
								startMonth = 'Jun';
								break;
							case '7':
								startMonth = 'July';
								break;
							case '8':
								startMonth = 'Aug';
								break;
							case '9':
								startMonth = 'Sep';
								break;
							case '10':
								startMonth = 'Oct';
								break;
							case '11':
								startMonth = 'Nov';
								break;
							case '12':
								startMonth = 'Dec';
								break;
						}

						var endMonth = '';
						switch(item.end_month) {
							case '1':
								endMonth = 'Jan';
								break;
							case '2':
								endMonth = 'Feb';
								break;
							case '3':
								endMonth = 'March';
								break;
							case '4':
								endMonth = 'April';
								break;
							case '5':
								endMonth = 'May';
								break;
							case '6':
								endMonth = 'Jun';
								break;
							case '7':
								endMonth = 'July';
								break;
							case '8':
								endMonth = 'Aug';
								break;
							case '9':
								endMonth = 'Sep';
								break;
							case '10':
								endMonth = 'Oct';
								break;
							case '11':
								endMonth = 'Nov';
								break;
							case '12':
								endMonth = 'Dec';
								break;
						}

						tableRow += '<tr>' +
							'<td>' + (index + 1) + '</td>' +
							'<td>' + item.receipt + '</td>' +
							'<td>' + item.name + '</td>' +
							'<td>' + startMonth + '</td>' +
							'<td>' + endMonth + '</td>' +
							'<td>' + item.total_paid + '</td>' +
							'<td>' + item.villege + '</td>' +
							'<td>' + item.room_no + '</td>' +
							'<td>' + item.phone + '</td>' +
							'<td><a href="" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>' +
							'<a data-customer-id="' + item.id + '" class="btn btn-danger btn-xs delete-customer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>' +
							'</td>' +
							'</tr>';
					});
					$('#bodyReceiptData').append(tableRow);
				}, error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		}else{
			alert("Please select Months");
		}
	})

	$("#roomNo").on("change", function(){
		var roomNo = ($("#roomNo").val() != "") ? $("#roomNo").val(): "null";
		var fromMonth = $("#fromMonth").val();
		var toMonth = $("#toMonth").val();
		var studntName = ($("#txtSearch").val() != "") ? $("#txtSearch").val(): "null";

		$('#bodyReceiptData').empty();
		if(fromMonth != "" && toMonth != ""){
			$.ajax({
				url: "admin/findReciept/" + fromMonth + "/" + toMonth +  "/" + roomNo + "/" + studntName,
				type: "GET",
				success: function(response){
					$(".dataTables_empty").remove();
					var tableRow = '';
					$.each(response, function(index, item) {
						console.log(item);
						var startMonth = '';
						switch(item.start_month) {
							case '1':
								startMonth = 'Jan';
								break;
							case '2':
								startMonth = 'Feb';
								break;
							case '3':
								startMonth = 'March';
								break;
							case '4':
								startMonth = 'April';
								break;
							case '5':
								startMonth = 'May';
								break;
							case '6':
								startMonth = 'Jun';
								break;
							case '7':
								startMonth = 'July';
								break;
							case '8':
								startMonth = 'Aug';
								break;
							case '9':
								startMonth = 'Sep';
								break;
							case '10':
								startMonth = 'Oct';
								break;
							case '11':
								startMonth = 'Nov';
								break;
							case '12':
								startMonth = 'Dec';
								break;
						}

						var endMonth = '';
						switch(item.end_month) {
							case '1':
								endMonth = 'Jan';
								break;
							case '2':
								endMonth = 'Feb';
								break;
							case '3':
								endMonth = 'March';
								break;
							case '4':
								endMonth = 'April';
								break;
							case '5':
								endMonth = 'May';
								break;
							case '6':
								endMonth = 'Jun';
								break;
							case '7':
								endMonth = 'July';
								break;
							case '8':
								endMonth = 'Aug';
								break;
							case '9':
								endMonth = 'Sep';
								break;
							case '10':
								endMonth = 'Oct';
								break;
							case '11':
								endMonth = 'Nov';
								break;
							case '12':
								endMonth = 'Dec';
								break;
						}

						tableRow += '<tr>' +
							'<td>' + (index + 1) + '</td>' +
							'<td>' + item.receipt + '</td>' +
							'<td>' + item.name + '</td>' +
							'<td>' + startMonth + '</td>' +
							'<td>' + endMonth + '</td>' +
							'<td>' + item.total_paid + '</td>' +
							'<td>' + item.villege + '</td>' +
							'<td>' + item.room_no + '</td>' +
							'<td>' + item.phone + '</td>' +
							'<td><a href="" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>' +
							'<a data-customer-id="' + item.id + '" class="btn btn-danger btn-xs delete-customer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>' +
							'</td>' +
							'</tr>';
					});
					$('#bodyReceiptData').append(tableRow);
				}, error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		}else{
			alert("Please select Months");
		}
	})

	$("#txtSearch").on("keyup", function(){
		var roomNo = ($("#roomNo").val() != "") ? $("#roomNo").val(): "null";
		var fromMonth = $("#fromMonth").val();
		var toMonth = $("#toMonth").val();
		var studntName = $("#txtSearch").val();

		$('#bodyReceiptData').empty();
		if(fromMonth != "" && toMonth != ""){
			$.ajax({
				url: "admin/findReciept/" + fromMonth + "/" + toMonth +  "/" + roomNo + "/" + studntName, 
				type: "GET",
				success: function(response){
					var tableRow = '';
					$.each(response, function(index, item) {
						console.log(item);
						var startMonth = '';
						switch(item.start_month) {
							case '1':
								startMonth = 'Jan';
								break;
							case '2':
								startMonth = 'Feb';
								break;
							case '3':
								startMonth = 'March';
								break;
							case '4':
								startMonth = 'April';
								break;
							case '5':
								startMonth = 'May';
								break;
							case '6':
								startMonth = 'Jun';
								break;
							case '7':
								startMonth = 'July';
								break;
							case '8':
								startMonth = 'Aug';
								break;
							case '9':
								startMonth = 'Sep';
								break;
							case '10':
								startMonth = 'Oct';
								break;
							case '11':
								startMonth = 'Nov';
								break;
							case '12':
								startMonth = 'Dec';
								break;
						}

						var endMonth = '';
						switch(item.end_month) {
							case '1':
								endMonth = 'Jan';
								break;
							case '2':
								endMonth = 'Feb';
								break;
							case '3':
								endMonth = 'March';
								break;
							case '4':
								endMonth = 'April';
								break;
							case '5':
								endMonth = 'May';
								break;
							case '6':
								endMonth = 'Jun';
								break;
							case '7':
								endMonth = 'July';
								break;
							case '8':
								endMonth = 'Aug';
								break;
							case '9':
								endMonth = 'Sep';
								break;
							case '10':
								endMonth = 'Oct';
								break;
							case '11':
								endMonth = 'Nov';
								break;
							case '12':
								endMonth = 'Dec';
								break;
						}

						tableRow += '<tr>' +
							'<td>' + (index + 1) + '</td>' +
							'<td>' + item.receipt + '</td>' +
							'<td>' + item.name + '</td>' +
							'<td>' + startMonth + '</td>' +
							'<td>' + endMonth + '</td>' +
							'<td>' + item.total_paid + '</td>' +
							'<td>' + item.villege + '</td>' +
							'<td>' + item.room_no + '</td>' +
							'<td>' + item.phone + '</td>' +
							'<td><a href="" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>' +
							'<a data-customer-id="' + item.id + '" class="btn btn-danger btn-xs delete-customer"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>' +
							'</td>' +
							'</tr>';
					});
					$('#bodyReceiptData').append(tableRow);
				}, error: function(xhr, status, error) {
					console.error(xhr.responseText);
				}
			});
		}else{
			alert("Please select Months");
		}
	});
});
function confirmDelete(id, name) {
	if (confirm('Are you sure, you want to delete this ' + name + '?')) {
		return true;
	} else {
		// If user cancels, do nothing
		return false;
	}
}

function validatePhoneNo(number){
	var fatherNumber = $("#fatherNumber").val();
	var phoneNumber = $("#phoneNumber").val();

	if(fatherNumber == phoneNumber){
		$("#phoneNumberError").html("Father's number and student number should be different.");
	}else{
		$("#phoneNumberError").html("");
	}
}

function getRoomWiseStudent(){
	var selectedRoom = $("#selctRoom").val();
	var selectedEmpRoom = $("#selctEmpRoom").val();

	if(selectedRoom != undefined && selectedRoom != ""){
		//For Studnet
		var url = "managestudent/" + selectedRoom;
		var tableBody = $('#bodyStudentData');
		var dropDown = "#selctRoom";
		var returnUrl = "managestudent";
		var editUrl = "deleteStudent/";
		var deleteUrl = "editStudent/";
	}else{
		var url = "manageemployee/" + selectedEmpRoom;
		var tableBody = $('#bodyEmployeeData');
		var dropDown = '#selctEmpRoom';
		var returnUrl = "manageemployee";
		var editUrl = "deleteStudent/";
		var deleteUrl = "editStudent/";
	}

	if(selectedRoom || selectedEmpRoom){
			$.ajax({
				url: url, 
				type: "GET",
				async: false,
				success: function(response){
					console.log(response);
					if (response && response.length > 0) {
						// Get the selected value
						var selectedValue = $(dropDown).val();

						// Remove the "Please Select" option if it exists
						$(dropDown + ' option[value=""]').remove();

						// Add the "Return Home" option if it's not already added
						if ($(dropDown + ' option[value="home"]').length == 0) {
							$(dropDown).append($('<option>').attr('value', 'home').text('Return Home'));
						}

						//Table Data
						// tableBody = $('#bodyStudentData');
						tableBody.empty(); // Clear existing rows
						
						// Iterate over each item in the response
						response[0].forEach(function(item, index) {
							var newRow = $('<tr>');
							newRow.append($('<td>').text(index + 1));
							
							// Append image cell
							if (item.photo) {
								newRow.append($('<td>').html('<img src="' + item.photo + '" style="width: 100px; height: 100px; border-radius: 50%;" />'));
							} else {
								newRow.append($('<td>').text('No Photo'));
							}
							
							// Append other cells
							newRow.append($('<td>').text(item.name));
							newRow.append($('<td>').text(item.villege));
							newRow.append($('<td>').text(item.town));
							newRow.append($('<td>').text(item.college_name));
							newRow.append($('<td>').text(item.phone));
							newRow.append($('<td>').text(item.father_phone));
							newRow.append($('<td>').text(item.joining_date));
							
							// Append action buttons
							var actionCell = $('<td>');
							actionCell.append('<a href="editStudent/'+ item.id+'" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>');
							actionCell.append('<a href="deleteStudent/'+ item.id+'" onclick="return confirmDelete(' + item.id + ', \'Student\')" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>');
							newRow.append(actionCell);
							
							$(tableBody).append(newRow);
						});
					}
				}
		});
	}else{
		window.location.href = returnUrl;
	}
	// return false;
}