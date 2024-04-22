function Search_GetText(){
    var text = $("#searching-text").val();
    var oldText = $("#searching-text").attr("old-data");
    if (text != oldText) {
        Searching_(text);
        $("#searching-text").attr("old-data", text);
    }
}

function Searching_(Text){
    if (Text.length > 0) {
        $.ajax ({
            url: "./sameparts/searchbox.php",
            method: "POST",
            data: {
                searchingText: Text
            },
            success: function(data){
                $("#searching-items-ul").remove();
                data = data.trim();
                if (data.length > 0) {
                    $("#searching-items").append("<ul id='searching-items-ul'>");
                    $("#searching-items-ul").append(data);
                    $("#searching-items").append("</ul>");
                }
            }
        });
    }else{
        $("#searching-items-ul").remove();
    }
}