function Redirect() {  
    window.location="./home.php"; 
} 

$(document).ready(function() {
    $('#inscription').on('submit', function(e) {

        e.preventDefault(); 
        var $this = $(this); 

        $.ajax({
        url: $this.attr('action'), 
        type: $this.attr('method'), 
        data: $this.serialize(), 
        dataType: 'json', 
        async : true,
        success: function(json) { 
            switch(json.error) {
                case 1:
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "L'adresse email est invalide";
                    break;
                case 2:
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "Cette adresse email est déjà utilisée.";
                    break;
                case 3:
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "Veuillez saisir votre vrai nom.";
                    break;
                case 4: 
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "Veuillez saisir votre vrai prénom.";
                    break;
                case 5:
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "Numéro de téléphone incorrect.";
                    break;
                case 6:
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "Numéro de téléphone incorrect.";
                    break;
                case 7: 
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "Ce numéro de téléphone est déjà utilisé.";
                    break;
                case 8:
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "La longueur du mot de passe doit être d'au moins 8 caractères.";
                    break;
                case 9:
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "Votre mot de passe doit contenir une majuscule et un caractère spécial.";
                    break;
                case 10:
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".error p").textContent = "Le mot de passe et sa confirmation ne coïncident pas.";
                    break;
                default: 
            }
        },
        error: function(json) {
            if(!json.error) {
                document.querySelector(".error").style.backgroundColor = "#5e992b";
                document.querySelector(".error p").textContent = "Inscription réussie ! Redirection dans 5s ...";
                setTimeout('Redirect()', 5000);
            } 
        }
        });      
    });
    });