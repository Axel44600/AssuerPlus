$(document).ready(function() {
    $('#connexion').on('submit', function(e) {

        e.preventDefault(); 
        var $this = $(this); 

        $.ajax({
        url: $this.attr('action'), 
        type: $this.attr('method'), 
        data: $this.serialize(), 
        dataType: 'json', 
        async : true,
        success: function(json) { 
            if(!json.fail) {
                document.querySelector(".error").style.display = "block";
            } 
        },
        error: function(json) {
            if(json.fail) {
                document.location.href='./home.php'; 
            } 
        }
        });
        
    });
    });