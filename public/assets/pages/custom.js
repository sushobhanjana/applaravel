var Main = {
    init: function () {
    	//Main.menuactive();
		Main.LanguageChange();
		//Main.Medialab();
		//Main.cmsfeatures();
		Main.testimonial_section();
		Main.slider_section();
		Main.ourteam();
		Main.happyclient();
		Main.inventory();
	},
	
	menuactive: function(items){
		$('#realmnu li').removeClass("active");
    	$('#'+items).addClass("active");
	},
	LanguageChange: function () {
        $('.change-lang').click(function () {
            var languagecode = $(this).attr("data-lang");
            
            $.ajax({
            	url: baseurl+"/changelang",
            	type: "post",
            	data: "lang="+languagecode,
            	success:function(result){
					window.location.reload();
					//alert(result);
				}
            });
        });
    },
    appendLoader:function (){
    	App.blockUI({
            boxed: true
        });
	},

	removeLoader:function (){
		App.unblockUI();
	},
	errorToastr:function(items){
		toastr.options = {
		  "closeButton": true,
		  "positionClass": "toast-top-right",
		  "onclick": null,
		  "showDuration": "1000",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
    	Command: toastr['error'](items)
	},
	successToastr:function(items){
		toastr.options = {
		  "closeButton": true,
		  "positionClass": "toast-top-right",
		  "onclick": null,
		  "showDuration": "1000",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
    	Command: toastr['success'](items)
	},
	Medialab:function(){
		$("#add_media").click(function(){
			$("#upload_media_frm").show();
		});
		$("#closeMedia").click(function(){
			$("#upload_media_frm").hide();
		});
		//dropzon file upload
		Dropzone.options.myDropzone = {
	        dictDefaultMessage: "",
	        init: function() {
	            this.on("addedfile", function(file) {
	                // Create the remove button
	                var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>Remove</a>");
	                
	                // Capture the Dropzone instance as closure.
	                var _this = this;
					
					
	                // Listen to the click event
	                removeButton.addEventListener("click", function(e) {
	                  // Make sure the button click doesn't submit the form:
	                  e.preventDefault();
	                  e.stopPropagation();

	                  // Remove the file preview.
	                  _this.removeFile(file);
	                  // If you want to the delete the file on the server as well,
	                  // you can do the AJAX request here.
	                });

	                // Add the button to the file preview element.
	                file.previewElement.appendChild(removeButton);
	            });
	            this.on("queuecomplete", function(file){
	            	window.location.reload();
	            });
	        }            
	    }
	    //view media file
	    $(document).delegate('#viewfiledtl', 'click', function(){
	    	var filename = $(this).attr('data-filename'),
	    		title = $(this).attr('data-title');
	    	$.ajax({
	    		url: baseurl+"/detailsofmedia",
	    		type: "post",
	    		data: "filename="+filename,
	    		dataType: "html",
	    		success:function(data){
					$("#adminModal").modal("show");
					$("#adminModalTitle").html(title);
					$("#adminmodalbody").html(data);
					//console.log(data);
				}
	    	});
	    });
		//trash media file
		$(document).delegate('#removeMedia', 'click', function(){
			var items = $(this).attr('data-filename');
			swal({
				title: "Are you sure?",
				text: "You will not be able to recover this file!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-success",
				cancelButtonClass: "btn-banger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false,
				closeOnCancel: true
			}, function(isConfirm) {
				if(isConfirm) {
					$.ajax({
		            	url: baseurl+"/deletetemedia",
		            	type: "post",
		            	data: "filename="+items,
		            	dataType: "json",
		            	success:function(result){
							if(result.error_code == 1){
								//swal(result.msg);
								swal({
						            title: result.msg
						        }, function() {
						            window.location.reload();
						        });
							}
							else{
								Main.errorToastr(result.msg);
							}
						}
		            });
				}
			});
		});
	},
	testimonial_section:function(){
		
	    $('#testimonialfrm').on('keyup paste', 'textarea', function () {
	        $(this).height(0).height(this.scrollHeight);
	    }).find('textarea').change();
		
		$("#addtestmonial").click(function(){
			var action = $(this).attr('data-action');
			$("#adminModal").modal('show');
			$("#adminModal").find("#adminModalTitle").html("New Testimonial");
			$("#adminModal").find("#adminmodalbody").load(action);
		});
		
		
		$("#testimonialfrm").submit(function(e){
			e.preventDefault();
			var formData = $(this).serialize(),
				action = $(this).attr('action');
			$.ajax({
				url : action,
				type: "post",
				data: formData,
				dataType: "json",
				beforeSend: function(){
					App.blockUI({
		                target: '#adminmodalbody',
		                boxed: true,
		                message: 'Processing...'
		            });
				},
				success: function(data){
					if(data.error_code == 1){
						Main.successToastr(data.msg);
						if(data.frm_reset != 1){
							$("#testimonialfrm")[0].reset();
						}
					}
					else{
						Main.errorToastr(data.msg);
					}
				},
				complete: function(){
					App.unblockUI('#adminmodalbody');
				}
			});
		});
		
		$('#listtestmonial').click(function() {
			var action = $(this).attr('data-action');
            $.ajax({
				url : action,
				type: "get",
				dataType: "html",
				beforeSend: function(){
					Main.appendLoader();
				},
				success: function(data){
					$("#testimonial").html(data);
					$("#tblTestimonial").dataTable({
			    		"bPaginate": false
			    	});
				},
				complete: function(){
					Main.removeLoader();
				}
			});
        });
        
        $("#tblTestimonial").delegate("#vieweditTestimonial", "click", function(){
        	var rowno = $(this).attr('data-rowno');
        	$.ajax({
				url : baseurl+"/viewandedittestimonial",
				type: "get",
				data: "rowno="+rowno,
				dataType: "html",
				beforeSend: function(){
					Main.appendLoader();
				},
				success: function(data){
					$("#adminModal").modal('show');
					$("#adminModal").find("#adminModalTitle").html("View And Edit Testimonial");
					$("#adminModal").find("#adminmodalbody").html(data);
					
					setTimeout(function(){ 
						$("#testimonialfrm textarea[name=content_en]").height( $("#testimonialfrm textarea[name=content_en]")[0].scrollHeight );
						$("#testimonialfrm textarea[name=author_en]").height( $("#testimonialfrm textarea[name=author_en]")[0].scrollHeight );
						$("#testimonialfrm textarea[name=content_he]").height( $("#testimonialfrm textarea[name=content_he]")[0].scrollHeight );
						$("#testimonialfrm textarea[name=author_he]").height( $("#testimonialfrm textarea[name=author_he]")[0].scrollHeight );
					}, 1000);
				},
				complete: function(){
					Main.removeLoader();
				}
			});
        });
        $('#tblTestimonial').delegate('#deleteTestimonial', 'click', function(){
        	var rowno = $(this).attr('data-rowno');
        	var sa_title = $(this).data('title');
        	var nRow = $(this).parents('tr')[0];
        	var sa_confirmButtonText = $(this).data('confirm-button-text');
        	var sa_cancelButtonText = $(this).data('cancel-button-text');
        	swal({
				  title: sa_title,
				  text: '',
				  type: "warning",
				  allowOutsideClick: false,
				  showConfirmButton: true,
				  showCancelButton: true,
				  confirmButtonClass: "btn-info",
				  cancelButtonClass: "btn-danger",
				  closeOnConfirm: true,
				  /*closeOnCancel: false,*/
				  confirmButtonText: sa_confirmButtonText,
				  cancelButtonText: sa_cancelButtonText,
				},
				function(isConfirm){
			        if (isConfirm){
			        	
			        	$.ajax({
							url : baseurl+"/deletetestimonial",
							type: "get",
							data: "rowno="+rowno,
							dataType: "json",
							beforeSend: function(){
								Main.appendLoader();
							},
							success: function(data){
								if(data.error_code > 0 ){
									Main.successToastr(data.msg);
									$("#tblTestimonial").dataTable().fnDeleteRow( nRow );
								}
								else{
									Main.errorToastr(data.msg);
								}
							},
							complete: function(){
								Main.removeLoader();
							}
						});
			        }
				});
        });
        
        $('#adminModal').on('hidden.bs.modal', function (e) {
		  	$('#listtestmonial').trigger('click');
		})
	},
	slider_section:function(){
		$("#addslider").click(function(){
			var action = $(this).attr('data-action'),
				title = $(this).attr('data-title');
			$("#adminModal").modal('show');
			$("#adminModal").find("#adminModalTitle").html(title);
			$("#adminModal").find("#adminmodalbody").load(action);
		});
		
		$("#sliderList").delegate("#viewslider", "click", function(){
			var title = $(this).attr('data-title'),
				action = $(this).attr('data-action'),
				rowno = $(this).attr('data-rowno');
			$.ajax({
				url : action,
				type: "get",
				data: "rowno="+rowno,
				dataType: "html",
				beforeSend: function(){
					Main.appendLoader();
				},
				success: function(data){
					$("#adminModal").modal('show');
					$("#adminModal").find("#adminModalTitle").html(title);
					$("#adminModal").find("#adminmodalbody").html(data);
				},
				complete: function(){
					Main.removeLoader();
				}
			});
		});
		
		$("#sliderList").delegate("#deleteslider", "click", function(){
			var action = $(this).attr('data-action');
			var rowno = $(this).attr('data-rowno');
        	var sa_title = $(this).data('title');
        	var sa_confirmButtonText = $(this).data('confirm-button-text');
        	var sa_cancelButtonText = $(this).data('cancel-button-text');
        	swal({
				  title: sa_title,
				  text: '',
				  type: "warning",
				  allowOutsideClick: false,
				  showConfirmButton: true,
				  showCancelButton: true,
				  confirmButtonClass: "btn-info",
				  cancelButtonClass: "btn-danger",
				  closeOnConfirm: true,
				  /*closeOnCancel: false,*/
				  confirmButtonText: sa_confirmButtonText,
				  cancelButtonText: sa_cancelButtonText,
				},
				function(isConfirm){
			        if (isConfirm){
						$.ajax({
							url : action,
							type: "get",
							data: "rowno="+rowno,
							dataType: "json",
							beforeSend: function(){
								Main.appendLoader();
							},
							success: function(data){
								if(data.error_code > 0 ){
									Main.successToastr(data.msg);
									$("#row"+rowno).remove();
								}
								else{
									Main.errorToastr(data.msg);
								}
							},
							complete: function(){
								Main.removeLoader();
							}
						});
					}
				});
		});
	},
	ourteam:function(){
		$("#listteams").click(function(){
			var action = $(this).attr('data-action');
			$("#teamBody").load(action);
		});
		$("#teamBody").delegate("#addteam", 'click', function(){
			var action = $(this).attr('data-action'),
				title = $(this).attr('data-title');
			$("#adminModal").modal('show');
			$("#adminModal").find("#adminModalTitle").html(title);
			$("#adminModal").find("#adminmodalbody").load(action);
		});
		$("#adminModal").delegate("#teamfrm", "submit", function(e){
			e.preventDefault();
			var formData = new FormData($('#teamfrm')[0]);
			formData.append('photo', $('input[type=file]')[0].files[0]);
			var action = $(this).attr('action');
			$.ajax({
			    type: "POST",
			    url: action,
			    data: formData,
			    //use contentType, processData for sure.
			    contentType: false,
			    processData: false,
			    beforeSend: function() {
			        App.blockUI({
		                target: '#adminmodalbody',
		                boxed: true,
		                message: 'Processing...'
		            });
			    },
			    success: function(response) {
			        if(response.error_code == 1){
			        	Main.successToastr(response.result);
			        	$("#adminModal").find("#teamfrm")[0].reset();
			        	$('#adminModal').modal('toggle');
			        	$('#listteams').trigger('click');
			        }
			        else{
						Main.errorToastr(response.result);
					}
			    },
				complete: function(){
					App.unblockUI('#adminmodalbody');
				}
			});
		});
		$('#adminModal').on('hidden.bs.modal', function (e) {
		  	$('#listteams').trigger('click');
		});
		
		$("#teamBody").delegate("#viewteam", 'click', function(){
			var rowno = $(this).attr('data-rowno'),
				title = $(this).attr('data-title'),
				action = $(this).attr('data-action')+"?rowno="+rowno;
				
			$("#adminModal").modal('show');
			$("#adminModal").find("#adminModalTitle").html(title);
			$("#adminModal").find("#adminmodalbody").load(action);
		});
		
		$('#teamBody').delegate('#deleteTeam', 'click', function(){
        	var rowno = $(this).attr('data-rowno');
        	var sa_title = $(this).data('title');
        	var nRow = $('#team'+rowno);
        	var sa_confirmButtonText = $(this).data('confirm-button-text');
        	var sa_cancelButtonText = $(this).data('cancel-button-text');
        	swal({
				  title: sa_title,
				  text: '',
				  type: "warning",
				  allowOutsideClick: false,
				  showConfirmButton: true,
				  showCancelButton: true,
				  confirmButtonClass: "btn-info",
				  cancelButtonClass: "btn-danger",
				  closeOnConfirm: true,
				  /*closeOnCancel: false,*/
				  confirmButtonText: sa_confirmButtonText,
				  cancelButtonText: sa_cancelButtonText,
				},
				function(isConfirm){
			        if (isConfirm){
			        	$.ajax({
							url : baseurl+"/deleteteam",
							type: "get",
							data: "rowno="+rowno,
							dataType: "json",
							beforeSend: function(){
								Main.appendLoader();
							},
							success: function(data){
								if(data.error_code == 1 ){
									Main.successToastr(data.result);
									nRow.remove();
								}
								else{
									Main.errorToastr(data.result);
								}
							},
							complete: function(){
								Main.removeLoader();
							}
						});
			        }
				});
        });
	},
	happyclient:function(){
		$("#getclientslist").click(function(){
			var action = $(this).attr('data-action');
			$("#clientBody").load(action);
		});
		$("#clientBody").delegate("#addclient", 'click', function(){
			var action = $(this).attr('data-action'),
				title = $(this).attr('data-title');
			$("#adminModal").modal('show');
			$("#adminModal").find("#adminModalTitle").html(title);
			$("#adminModal").find("#adminmodalbody").load(action);
		});
		$("#adminModal").delegate("#clientfrm", "submit", function(e){
			e.preventDefault();
			var formData = new FormData($('#clientfrm')[0]);
			formData.append('photo', $('input[type=file]')[0].files[0]);
			var action = $(this).attr('action');
			$.ajax({
			    type: "POST",
			    url: action,
			    data: formData,
			    //use contentType, processData for sure.
			    contentType: false,
			    processData: false,
			    beforeSend: function() {
			        App.blockUI({
		                target: '#adminmodalbody',
		                boxed: true,
		                message: 'Processing...'
		            });
			    },
			    success: function(response) {
			        if(response.error_code == 1){
			        	Main.successToastr(response.result);
			        	$("#adminModal").find("#clientfrm")[0].reset();
			        	$('#adminModal').modal('toggle');
			        	$('#getclientslist').trigger('click');
			        }
			        else{
						Main.errorToastr(response.result);
					}
			    },
				complete: function(){
					App.unblockUI('#adminmodalbody');
				}
			});
		});
		$('#adminModal').on('hidden.bs.modal', function (e) {
		  	$('#getclientslist').trigger('click');
		});
		$("#clientBody").delegate("#viewclient", 'click', function(){
			var rowno = $(this).attr('data-rowno'),
				title = $(this).attr('data-title'),
				action = $(this).attr('data-action')+"?rowno="+rowno;
				
			$("#adminModal").modal('show');
			$("#adminModal").find("#adminModalTitle").html(title);
			$("#adminModal").find("#adminmodalbody").load(action);
		});
		$('#clientBody').delegate('#deleteclient', 'click', function(){
        	var rowno = $(this).attr('data-rowno');
        	var sa_title = $(this).data('title');
        	var nRow = $('#client'+rowno);
        	var sa_confirmButtonText = $(this).data('confirm-button-text');
        	var sa_cancelButtonText = $(this).data('cancel-button-text');
        	swal({
				  title: sa_title,
				  text: '',
				  type: "warning",
				  allowOutsideClick: false,
				  showConfirmButton: true,
				  showCancelButton: true,
				  confirmButtonClass: "btn-info",
				  cancelButtonClass: "btn-danger",
				  closeOnConfirm: true,
				  /*closeOnCancel: false,*/
				  confirmButtonText: sa_confirmButtonText,
				  cancelButtonText: sa_cancelButtonText,
			},
			function(isConfirm){
		        if (isConfirm){
		        	$.ajax({
						url : baseurl+"/deleteclient",
						type: "get",
						data: "rowno="+rowno,
						dataType: "json",
						beforeSend: function(){
							Main.appendLoader();
						},
						success: function(data){
							if(data.error_code == 1 ){
								Main.successToastr(data.result);
								nRow.remove();
							}
							else{
								Main.errorToastr(data.result);
							}
						},
						complete: function(){
							Main.removeLoader();
						}
					});
		        }
			});
        });
	},
	inventory:function(){
		var table = $('#productstock_tbl');
        // begin first table
        table.dataTable({ // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No records found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "bStateSave": true, 
            "lengthMenu": [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 100,
        });
        
        table.delegate('#deleteproduct', 'click', function(){
        	var rowno = $(this).attr('data-rowno'),
        		total_stock = $(this).attr('data-stock'),
        		available = $(this).attr('data-available'),
        		action = $(this).attr('data-action'),
        		nRow = $(this).parents('tr')[0],
        		sa_title = $(this).data('title'),
	        	sa_confirmButtonText = $(this).data('confirm-button-text'),
	        	sa_cancelButtonText = $(this).data('cancel-button-text'),
	        	msgerror = $(this).attr('data-error-msg');
	        if(total_stock == available){
				swal({
				  title: sa_title,
				  text: '',
				  type: "warning",
				  allowOutsideClick: false,
				  showConfirmButton: true,
				  showCancelButton: true,
				  confirmButtonClass: "btn-info",
				  cancelButtonClass: "btn-danger",
				  closeOnConfirm: true,
				  /*closeOnCancel: false,*/
				  confirmButtonText: sa_confirmButtonText,
				  cancelButtonText: sa_cancelButtonText,
				},
				function(isConfirm){
			        if (isConfirm){
						$.ajax({
							url : action,
							type: "get",
							data: "rowno="+rowno,
							dataType: "json",
							beforeSend: function(){
								Main.appendLoader();
							},
							success: function(data){
								if(data.error_code > 0 ){
									Main.successToastr(data.msg);
									table.dataTable().fnDeleteRow( nRow );
								}
								else{
									Main.errorToastr(data.msg);
								}
							},
							complete: function(){
								Main.removeLoader();
							}
						});
					}
				});
			}
			else{
				Main.errorToastr(msgerror);
			}
        	
        });
		
		/*function attdis(){
			var parent_length = $('.attr-row').length;
			if(parent_length > 1){
				$('.btnclose').removeAttr('disabled');
			}
			else{
				$('.btnclose').attr('disabled', true);
			}
		}*/
		$("#addproduct").click(function(){
			$("#newproduct").modal('show');
			//attdis();
		});
		$("input[name=product_form_type_swap]").change(function(){
			var val = $(this).val();
			checkPriceType(val);
		});
		function checkPriceType(val){
			switch(val){
				case 'RPS':
				$("input[name=price_retail_tax_inclusive]").removeAttr('disabled');
				$("input[name=price_retail_tax_exclusive]").removeAttr('disabled');
				$("input[name=price_cost]").removeAttr('disabled');
				$("input[name=percent_discount]").attr('disabled', true);
				$("input[name=percent_discount]").val('0');
				break;
				case 'DA':
				$("input[name=price_retail_tax_inclusive]").removeAttr('disabled');
				$("input[name=price_retail_tax_exclusive]").removeAttr('disabled');
				$("input[name=price_cost]").attr('disabled', true);
				$("input[name=percent_discount]").attr('disabled', true);
				break;
				case 'DP':
				$("input[name=price_retail_tax_inclusive]").val('0.00');
				$("input[name=price_retail_tax_exclusive]").val('0.00');
				$("input[name=price_cost]").val('0.00');
				$("input[name=price_retail_tax_inclusive]").attr('disabled', true);
				$("input[name=price_retail_tax_exclusive]").attr('disabled', true);
				$("input[name=price_cost]").attr('disabled', true);
				$("input[name=percent_discount]").removeAttr('disabled');
				break;
			}
		};
		$("input[name=quantity_maintain]").click(function(){
			if(this.checked){
				$("input[name=qty]").removeAttr('disabled');
				$("input[name=reorder_at]").removeAttr('disabled');
				$("input[name=desired_stock_lavel]").removeAttr('disabled');
			}
			else{
				$("input[name=qty]").attr('disabled', true);
				$("input[name=reorder_at]").attr('disabled', true);
				$("input[name=desired_stock_lavel]").attr('disabled', true);
			}
		});
		$("input[name=quantity_serialize]").click(function(){
			if(this.checked){
				$("#quantity").css('display', 'none');
				$("#itemserial").css('display', 'block');
			}
			else{
				$("#quantity").css('display', 'block');
				$("#itemserial").css('display', 'none');
			}
		});
		/*$("#stock_unit").on('click', function(){
			var inpt_label = $(this).attr('data-label'),
				child = $("#serial_no").children('.col-sm-6').find('.form-group').length,
				html = '<div class="col-sm-6"><div class="form-group">'+
				        '<label>'+inpt_label+'</label>'+
				        '<input type="text" class="form-control" name="serial_no[]" placeholder="'+inpt_label+'"></div></div>';
			$("#serial_no").append(html);
			$("input[name=stock_unit]").val(child);
			alert(child)
			else{
				for(var s=1; s <= (child-stock); s++){
					$("#serial_no .form-group:last-child").remove();
				}
			}
			
		});*/
		/*$("#addattr").on('click', function(){
			var label1 = $(this).attr('data-label1'),
				label2 = $(this).attr('data-label2'),
				html = '<div class="row attr-row">'+
				        	'<div class="form-group col-sm-5">'+
				        		'<label>'+label1+'</label>'+
				        		'<input type="text" class="form-control" name="attr_name[]" placeholder="'+label1+'">'+ 
				        	'</div>'+
				        	'<div class="form-group col-sm-5">'+
				        		'<label>'+label2+'</label>'+
				        		'<input type="text" class="form-control" name="attr_value[]" placeholder="'+label2+'">'+ 
				        	'</div>'+
				        	'<div class="form-group col-sm-2">'+
				        		'<button class="btn btn-danger btnclose" style="margin-top: 24px"><i class="fa fa-close"></i></button>'+
				        	'</div>'+
				        '</div>';
			$(".attr-row:last").after(html);
			attdis();
		});
		$(document).delegate('.btnclose', 'click', function(){
			$(this).parents('.attr-row').remove();
			attdis();
		});*/
		// form validate
        var form3 = $('#productsave');
        form3.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', //default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                /*brand_name: {
                    required: true
                },*/
                product_name: {
                    required: true
                },  
                product_desc: {
					required: true
				}
                /*product_type: {
                    required: true
                },
                currency: {
                    required: true,
                    maxlength: 5
                },
                price: {
                    required: true,
      				number: true
                },
                sell_price: {
                    required: true,
      				number: true
                },
                stock_unit: {
                	required: true,
                    number: true
                },
                'serial_no[]': {
                    required:true,
                },
                'attr_name[]': {
                    required: true
                },
                'attr_value[]': {
                    required: true
                }*/
            },

            messages: { // custom messages for radio buttons and checkboxes
                membership: {
                    required: "Please select a Membership type"
                },
                service: {
                    required: "Please select  at least 2 types of Service",
                    minlength: jQuery.validator.format("Please select  at least {0} types of Service")
                }
            },

            errorPlacement: function (error, element) { 
            	if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));
                } else if (element.attr("data-error-container")) { 
                    error.appendTo(element.attr("data-error-container"));
                } else {
                    error.insertAfter(element);
                }
            },

            highlight: function (element) { // hightlight error inputs
               $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
            	var formData = $(form).serialize(),
            		action = $(form).attr('action');
            		//console.log(formData);
                $.ajax({
			        url: action, 
			        type: "POST",             
			        data: formData,
			        dataType: "json",
			        cache: false,             
			        processData: false, 
			        beforeSend: function(){
						Main.appendLoader();
					},
					success: function(data){
						if(data.error_code == 1 ){
							Main.successToastr(data.msg);
							/*form3[0].reset();
							$("input[name=price_retail_tax_inclusive]").removeAttr('disabled');
							$("input[name=price_retail_tax_exclusive]").removeAttr('disabled');
							$("input[name=price_cost]").removeAttr('disabled');
							$("input[name=percent_discount]").attr('disabled', true);
							$("input[name=percent_discount]").val('0');
							$('input[name=serial_no]').tagsinput('removeAll');
							$(".bs-select").selectpicker("refresh");
							$("input[name=qty]").attr('disabled', true);
							$("input[name=reorder_at]").attr('disabled', true);
							$("input[name=desired_stock_lavel]").attr('disabled', true);
							$("#quantity").css('display', 'block');
							$("#itemserial").css('display', 'none');*/
						}
						else if(data.error_code == 2){
							Main.successToastr(data.msg);
						}
						else{
							//console.log(data);
							Main.successToastr(data.msg);
						}
					},
					error:function(err){
						console.log(err);
					},
					complete: function(){
						Main.removeLoader();
					}
			    });
			    return false;
            }

        });
        
        table.delegate('#viewproduct', 'click', function(){
        	var rowno = $(this).attr('data-rowno'),
        		action = $(this).attr('data-action');
        	$.ajax({
				url : action,
				type: "get",
				data: "rowno="+rowno,
				dataType: "json",
				beforeSend: function(){
					Main.appendLoader();
				},
				success: function(data){
					//console.log(data);
					if(data.product.length > 0){
						$("#newproduct").modal('show');
						$("#newproduct").find(".modal-body").css('position', 'relative');
						$("#newproduct").find(".overlay").css('display', 'block');
						form3.find('input[name=serial_no]').tagsinput('removeAll');
						form3.find("input[name=rowno]").val(data.product[0].id);
						form3.find("input[name=product_name]").val(data.product[0].product_name);
						form3.find("textarea[name=product_desc]").val(data.product[0].product_desc);
						form3.find("input[name=upc_code]").val(data.product[0].upc_code);
						form3.find('input[name=product_form_type_swap][value='+data.product[0].product_price_type+']').attr('checked', true);
						checkPriceType(data.product[0].product_price_type);
						//$('input[name=product_form_type_swap]').trigger('change');
						form3.find("input[name=price_retail_tax_inclusive]").val(data.product[0].price_retail_tax_inclusive);
						form3.find("input[name=price_retail_tax_exclusive]").val(data.product[0].price_retail_tax_exclusive);
						form3.find("input[name=price_cost]").val(data.product[0].price_cost);
						form3.find("input[name=percent_discount]").val(data.product[0].percent_discount);
						if(data.product[0].taxable == 'Y'){
							form3.find('input[name=taxable]').prop('checked', true);
						}
						else{
							form3.find('input[name=taxable]').prop('checked', false);
						}
						form3.find("textarea[name=product_note]").val(data.product[0].note);
						if(data.product[0].maintain_stock == 'Y'){
							/*form3.find('input[name=quantity_maintain]').parent('.mt-checkbox').find('span').add('::after');*/
							$('input[name=quantity_maintain]').prop('checked', true);
							$('input[name=quantity_maintain]').trigger('click');
						}
						if(data.product[0].serialize_stock == 'Y'){
							form3.find('input[name=quantity_serialize]').prop('checked', true);
							$('input[name=quantity_serialize]').trigger('click');
						}
						form3.find("input[name=qty]").val(data.product[0].quantity);
						var serialid = [];
						$.each(data.serial, function(i, serial) {
							serialid.push(serial.serial_id);
							form3.find('input[name=serial_no]').tagsinput('add', serial.serial_no);
						});
						form3.find("input[name=hidden_serial]").val(serialid);
						form3.find("input[name=reorder_at]").val(data.product[0].reorder_qty);
						form3.find("input[name=desired_stock_lavel]").val(data.product[0].desired_stock);
						form3.find("select[name=category]").val(data.product[0].category_id);
						form3.find("input[name=sort_order]").val(data.product[0].sort_order);
						form3.find("input[name=physical_location]").val(data.product[0].physical_location);
						form3.find("input[name=condition]").val(data.product[0].condition);
						form3.find("textarea[name=warranty]").val(data.product[0].warranty_info);
						form3.find("select[name=vendor]").val(data.product[0].fk_vendor);
						form3.find("select[name=tax_rate]").val(data.product[0].fk_tax);
						$('.bs-select').selectpicker('refresh');
						
					}
					
				},
				complete: function(){
					Main.removeLoader();
				}
			});
        });
        
        $("#editenbproduct").click(function(){
        	$("#newproduct").find(".overlay").css('display', 'none');
        });
        
        $("#newproduct").on("hidden.bs.modal", function () {
		    location.reload();
		});
	}
};