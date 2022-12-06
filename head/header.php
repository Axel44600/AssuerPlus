<header class="head">
    <div class="head-left">
        <span class="logo"><?php echo($sitename); ?></span>
        <div class="slogan">Le spécialiste de l'assurance auto depuis 20 ans !</div>
    </div>

    <div class="head-right">
    
        <input type="checkbox" name="menu" id="check" value="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
                
        <ul class="menu-items">
            <li style="border: none;"><a onclick="myFunction()" href="#about">Le groupe <?php echo($sitename); ?></a></li>
            <li><a onclick="myFunction()" href="#map">Nos agences</a></li>
            <li><a onclick="myFunction()" href="#help">Assistance</a></li>
            <li><a onclick="myFunction()" href="./home.php">Mon espace personnel</a></li>
        </ul>

    </div>
</header>