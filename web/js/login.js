function newUser() {
    document.getElementById("no").style.backgroundColor = "#5e992b";
    document.getElementById("no").style.color = "#FFF";
    document.getElementById("no").style.border = "1px solid #5e992b";
    document.getElementById("yes").style.backgroundColor = "#FFF";
    document.getElementById("yes").style.color = "#1E1E1E";
    document.getElementById("yes").style.border = "1px solid #1E1E1E";
    document.querySelector(".pass h1").textContent = "Nous rejoindre";
    document.querySelector(".first-contain").style.display = "none";
    document.querySelector(".second-contain").style.display = "contents"; 
    document.querySelector(".forgot-pass").style.padding = "10px";
 }

 function newPass() {
    document.getElementById("yes").style.backgroundColor = "#5e992b";
    document.getElementById("yes").style.color = "#FFF";
    document.getElementById("yes").style.border = "1px solid #5e992b";
    document.getElementById("no").style.backgroundColor = "#FFF";
    document.getElementById("no").style.color = "#1E1E1E";
    document.getElementById("no").style.border = "1px solid #1E1E1E";
    document.querySelector(".pass h1").textContent = "Demande de mot de passe";
    document.querySelector(".first-contain").style.display = "contents";
    document.querySelector(".second-contain").style.display = "none"; 
    document.querySelector(".forgot-pass").style.paddingTop = "100px";
 }
