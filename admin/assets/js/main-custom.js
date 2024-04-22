/* Preloader */

$(document).ready(function() {
	var preloaderFadeOutTime = 300;
	function hidePreloader() {
		var preloader = $('.pre_circle');
		setTimeout(function() {
			preloader.fadeOut(preloaderFadeOutTime);
		}, 300);
	}
	hidePreloader();
});

/* Signout */
/* Change profile information */
$("#profile_edit").on("click", function(){
	$('#profile_edit').css("display", "none")
	$("#input_company").prop("disabled", false);
	$("#input_website").prop("disabled", false);
	$("#input_address").prop("disabled", false);
	//$("#input_country").prop("disabled", false);
	$("#input_city").prop("disabled", false);
	$("#input_tel").prop("disabled", false);
	$("#input_tel2").prop("disabled", false);
	$("#input_activity").prop("disabled", false);
	$("#input_employees").prop("disabled", false);
	$("#input_subcategory").prop("disabled", false);
	$("#input_about").prop("disabled", false);
	$("#responsive-btn").prop("disabled", false);
	$("#responsive-btn2").prop("disabled", false);
	$("#input_postcode").prop("disabled", false);
	$("#form_action").append('<input id="submit_action" type="submit" style="display:none;">');
	$("#update_button").toggle();
	$("#cancel_button").toggle();
});

$("#profile_user_edit").on("click", function(){
	$('#profile_edit').css("display", "none")
	$("#user_name").prop("disabled", false);
	$("#input_website").prop("disabled", false);
	$("#input_address").prop("disabled", false);
	$("#input_country").prop("disabled", false);
	$("#input_city").prop("disabled", false);
	$("#input_tel").prop("disabled", false);
	$("#input_tel2").prop("disabled", false);
	$("#input_activity").prop("disabled", false);
	$("#input_employees").prop("disabled", false);
	$("#responsive-btn").prop("disabled", false);
	$("#input_postcode").prop("disabled", false);
	$("#form_action").append('<input id="submit_action" type="submit" style="display:none;">');
	$("#update_button").toggle();
	$("#cancel_button").toggle();
});

$("#change_div").delegate("#update_button", "click", function(){
	$("#submit_action").click();
});


$("#change_div").delegate("#cancel_button", "click", function(){  
  $('#profile_edit').css("display", "inline-block")  
  $("#input_company").prop("disabled", true);  
  $("#input_website").prop("disabled", true);  
  $("#input_address").prop("disabled", true);  
  $("#input_country").prop("disabled", true);  
  $("#input_city").prop("disabled", true);  
  $("#input_tel").prop("disabled", true);  
  $("#input_about").prop("disabled", true);  
  $("#responsive-btn").prop("disabled", true);  
  $("#input_postcode").prop("disabled", true);  
  $("#submit_action").remove();  
  $("#update_button").toggle();
  $("#cancel_button").toggle();
});



/* Messages */
// Confirm Message
function messageDelete(id_){
    var dlt =$('#DLT'+id_).attr("data");
    var deleteMessage = confirm("Are you sure you want to delete the message dated \""+dlt+"\"");
    if(deleteMessage == true){ Delete(id_, "./pages/message/functions/delete_message.php");}
}

// Delete
function Delete(id_, url_){
 $.ajax({
	url: url_,
	type: "POST",
	data: {message_id: id_},
	success: function(msg){
		$('#msg_'+id_).remove();
	},
	error: function(){	alert("Error");	}
 });
}



// Read Message

function messageRead(id_){

 $.ajax({

	url: "./pages/message/functions/read_message.php",

	type: "POST",

	data: {message_id: id_},

	success: function(msg){
	
		$('#msg_'+id_).css("background", "#e1e1e18c");
	
	},

	error: function(){	alert("Error");	}

 });

}



// Read Message Shortcut

function Shortcut_messageRead(id_){

	$("#shortcutMessage_"+id_+"").remove();

	var count = parseInt($("#message_count").text());

	count += -1;

	$("#message_count").text(count);

	$("#message_count_all").text(count);

}



// Delete Export

function DeleteExport(id_){

	var dlt =$('#exports').attr("data");

    var deleteMessage = confirm("Are you sure you want to delete the message dated "+dlt);

    if(deleteMessage == true){ 
	
        $.ajax({
		
            url: "./pages/profile/functions/delete_export.php",
		
            type: "POST",
		
            data: {export_id: id_},
		
            success: function(msg){
			
				$("#exportsitem"+id_+"").remove();
			
            },
		
            error: function(){  alert("Error");    }
		
        });
	
     }
 
	}

	

// Delete product

function ProductDelete(id, number, text){
var dlt = $('#ProductDelete_'+number+'').attr("data");
var deleteMessage = confirm(text.replace("{date}",dlt));
if(deleteMessage == true){ 

    $.ajax({
	
        url: "./pages/products/functions/delete-product.php",
	
        type: "POST",
	
        data: {product_id: id},
	
        success: function(){
		
			$("#product-"+id+"").remove();
		
        },
	
        error: function(){  alert("Error");    }
	
    });

 }
 
	}



	// Delete product slider in images

	function Product_imageDelete(row){
	
		var path = "https://mcdev.ozceliksoftware.com";
	
		var id = $("#row__").val();
	
		var sliderBG_color = $('#slider_'+(row+1)+'').css("background-color");
	
		var sliderBG_img = $('#slider_'+(row+1)+'').css("background-image");
	
		sliderBG_img = sliderBG_img.split('"').join('');
	
		var dta_img = $('#slider_'+(row+1)+'').attr("data-src");			
	
		if(dta_img != "none"){
		
			dta_img = "url(" + path + $('#slider_'+(row+1)+'').attr("data-src") + ")";
		
		}
	
		if(sliderBG_color != "rgb(206, 225, 255)"){
		
			if (sliderBG_img == dta_img) {
			
				var deleteMessage = confirm("Are you sure you want to delete the slider image?\nNotice: The picture you deleted cannot be undone!");
			
					if(deleteMessage == true){
					
					$.ajax({
					
						url: "./pages/products/functions/delete-slider-image.php",
					
						type: "POST",
					
						data: {product_id: id, slider_row: row},
					
						success: function(msg){
						
							msg = msg.trim();
						
							if (msg == "true") {
							
								window.location.href = "product-view.php";
							
								return;
							
							}
						
							$("#slider-images-values").remove();
						
							$("#slider-images").append("<div id='slider-images-values'>");
						
							$("#slider-images-values").append(""+msg+"");
						
							$("#slider-images").append("</div>");
						
						},
					
						error: function(){alert("Error");}
					
					});
				
				}
			
			}else{
			
				if (dta_img == "none") {
				
					$('#slider_'+(row+1)+'').css("background-image", "");
				
					$('#slider_'+(row+1)+'').css("background-color", "#cee1ff");
				
				}else{
				
					$('#slider_'+(row+1)+'').css("background-image", ""+dta_img+"");
				
				}
			
			}
		
		}
	
	}



	// Delete messages and read messages (checkbox)

	// Delete Message

	function deleteConfirm(){
	
		var result = confirm("Do you really want to delete messages?");
	
		if(result){
		
			return true;
		
		}else{
		
			return false;
		
		}
	
	}



	$("#checkAl").click(function () {
	
		$('input:checkbox').not(this).prop('checked', this.checked);
	
		if ($('input:checkbox').prop('checked')) {
			$("#delete-messages").toggle();
		}else{
			$("#delete-messages").toggle();
		
		}
	
	});
	
	/*
	========================
	Selected Main Category 
	========================
	*/

	$("#activity_main_category").on("change", function() {
		// Selected function
		var main_category = $(this).val();
		$.ajax({

			url: "./pages/dashboard/functions/get_sub_categories.php",
			method: "POST",
			data: {main_category: main_category},
			success: function(data){
				$("#activity_sub_category").empty();
				$("#activity_sub_category").append("<option value='0'>...</option>");
				$("#activity_sub_category").append(data);
			}

		});
	});


