/*function check_Ip_Address(URL){
    // Check Session and ip address
    $.ajax ({
        url: URL,
        success: function(data_msg){
            var data_message = $.parseJSON(data_msg);
            if(data_message.type != "null"){
                // Get Message
                Swal.fire({
                    title: data_message.title,
                    text: data_message.comment,
                    icon: data_message.type,
                    showCancelButton: false,
                    confirmButtonText: data_message.button_text,
                    confirmButtonClass: 'btn btn-success margin-5',
                    buttonsStyling: false
                }).then(function (dismiss) {
                    if (dismiss.value) {
                        // Okay Button
                        location.reload();
                    }
                })
            }
        }
    });
}*/
