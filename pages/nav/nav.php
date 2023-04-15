<style>
    #nav_body {
    font-family: "Open Sans", sans-serif;
    font-weight: 700;
    font-size: 1.1em;
    width:100vh;
    }

    /* Colors root*/
    :root {
    --white-1: #ffffff;
    --white-2: #f9f9f9;
    --white-3: #f2f3f4;
    --white-4: #ecedee;
    --red: #e32828;
    --grey-1: #3c434b;
    --grey-2: #282a2d;
    --black: #000000;
    --footer: #101114;
    }

    /* ----- navbar ----- */
    .nav_body {
        position: absolute;
        width:100%;
        top:0;
    }

    .modal-open {
    padding-right:0px!important;
    }

    /* --- nav_list --- */
    #nav_link {
    list-style: none;
    }
    #nav_link a {
    color: grey;
    list-style: none;
    margin: 0.3em 0.8em 0 0.3em;
    font-size: 1.1em;
    font-weight: 600;

    }

    #nav_link a:hover {
    color: white;
    }

    /* --- nav_searchbar --- */
    #nav_searchbar {
    margin: 0.2em 0em 1em 1em;
    width: 18em;
    height: 2em;

    background-color: var(--grey-2);
    opacity: 0.7;

    border-radius: 10em;
    }
    #nav_searchbar > input {
    width: 17.5em;
        
    border: none;

    background-color: transparent;
    opacity: 0.7;

    border-radius: 10em;

    position:relative;

    bottom:1.8em;
    left:2em;
    font-size:0.9em;
    }
    #nav_searchbar > input:focus {
    width: 17.5em;

    color: var(--white-1);
    opacity: 1;

    border: none;
    box-shadow: none;
    }
    #nav_searchbar ::placeholder {
    color: var(--white-1);
    opacity: 1;
    }
    #nav_searchbar > button {
    background-color: transparent;
    opacity: 1;

    position: relative;
    top: 0.1em;
    left:0.5em;

    border: none;
    border-radius: 10em;
    box-shadow: none;
    }

    /* --- nav_profile --- */

    #nav_login_sign_in {
    padding: 0.4em 1.5em 0.3em 1.5em;

    background-color: #e32828;
    color: white;
    text-decoration: none;

    border-radius: 0.5em;

    transition: 0.5s;
    }
    #nav_login_sign_up {
    padding: 0.4em 1.5em 0.2em 1.5em;
    color: white;
    text-decoration: none;
    border-radius: 0.5em;
    text-shadow: 1px 2px 10px #000000;

    transition: 0.5s;
    }

    #nav_login_sign_up:hover,
    #nav_login_sign_in:hover {
    opacity: 0.5;
    }

    #nav_profile {
    list-style: none;
    }

    #nav_profile img {
    width: 3em;
    height: 3em;
    object-fit: cover;
    border-radius: 40px;

    position: relative;
    top: -0.3em;
    }

    .dropdown-item {
    font-weight: 600;
    }

    .dropdown-item:hover {
    color: red;
    background-color: white !important;
    }

    /* --- nav_modal--- */
    .modal-content {
    background-color: transparent;
    }

    .modal-backdrop {
    background-color: black;
    opacity: 0.8!important;
    }

    #nav_modal_burger {
    background: transparent;
    border: none;

    background-color: #e32828;

    width: 2.4em;
    height: 2.4em;

    margin: 0em 1em 0em 0em;

    border-radius: 0.5em;
    }
    #nav_modal_burger img {
    width: 2em;
    }

    #nav_modal_btn {
    align-self: flex-end;
    background: transparent;
    color: white;
    border: none;
    }
    #nav_modal_btn img {
    width: 2em;
    }

    #nav_link_modal {
    list-style: none;
    }
    #nav_link_modal a {
    color: grey;
    list-style: none;
    margin: 0.5em 0.8em 0.5em 0.3em;
    font-size: 1.3em;
    font-weight: 600;
    }
    #nav_link_modal a:hover {
    color: white;
    }

    #nav_modal_divider {
    border-top: 3px solid grey;
    margin-top: 1em;
    padding-top: 1em;
    }

    @media screen and (max-width: 1190px) {
    #nav_link {
        display: none !important;
    }
    #nav_profile {
        display: none !important;
    }
    #nav_modal_burger {
        display: flex !important;
        justify-content: center;
        align-items: center;

        margin: 0em 1em 0em 1em;
    }
    }
</style>
<?php 
    if(isset($_SESSION['email'])){
        // Connect to db
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=Flutters;port=3306','debian', '74cBZfxeFSBg', array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_EXCEPTION));
        } catch(Exception $e){
            die('Erreur PDO : ' . $e->getMessage());
        }

        // Get every informations of the user
        $q = 'SELECT avatar FROM USERS WHERE email = :email';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
        'email' => htmlspecialchars($_SESSION['email']),
        ]);
        $result= $req -> fetch();

        if($result['avatar']=='' || !isset($result['avatar'])){
            $avatar = 'default_avatar.png';
        } else {
            $avatar = $result['avatar'];

        }
    }


?>
<!-- Navbar -->
<nav class="d-flex flex-row mt-4 justify-content-between nav_body">
    <div class="d-flex">
        <!-- Flutters Brand -->
        <a href="/"><img class="nav_logo ms-4 d-none d-sm-block" style="width:8em;" src="/pages/nav/img/header-logo.svg"></a>
        <!-- nav list -->
        <ul class="d-flex" id="nav_link">
            <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
            <li class="nav-item"><a class="nav-link" href="/">Films</a></li>
            <li class="nav-item"><a class="nav-link" href="/">Événements</a></li>
            <li class="nav-item"><a class="nav-link" href="/">À propos</a></li>
        </ul>
    </div>
    <div class="d-flex">
        <!-- searchbar -->
        <form class="d-flex d-none d-sm-block" role="search" action="#" method="POST" id="nav_searchbar">
                <button type="submit" style="z-index:100;"><img src="/pages/nav/img/search.svg" alt="Loupe" width="15"
                height="15"></button>
                <input class="form-control me-2" type="text" placeholder="Trouver des films ou évènements" aria-label="Search">
            </form>

        <!-- nav_profile -->
        <?php 
        if (!isset($_SESSION['email'])){
            echo '
                <ul class="d-flex ps-0 me-4" id="nav_profile">
                    <a id="nav_login_sign_up" id="sign_up_button" href="/pages/login/sign_in/sign_in.php">Se connecter</a>
                    <a id="nav_login_sign_in" href="/pages/login/sign_up/sign_up.php">Inscription</a>
                </ul>  
            ';
        } elseif (isset($_SESSION['email']) && $_SESSION['user_type']=="Normal"){
                echo '
                <ul class="ps-0 me-4 ms-4" id="nav_profile">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="profile_avatar" src="/pages/profile/users_avatars/' . $avatar . '">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/pages/profile/profile.php">Profil</a></li>
                            <li><a class="dropdown-item" href="/pages/profile/mes_reservations.php">Mes réservations</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/deconnexion.php">Deconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            ';
        } elseif(isset($_SESSION['email']) && $_SESSION['user_type']=="Admin"){
            echo '
            <ul class="ps-0 me-4 ms-4" id="nav_profile">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img id="profile_avatar" src="/pages/profile/users_avatars/' . $avatar . '">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/pages/profile/profile.php">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/deconnexion.php">Deconnexion</a></li>
                    </ul>
                </li>
            </ul>
        ';
        };
        ?>   

        <!-- Button trigger modal -->
        <button type="button" id="nav_modal_burger" class="d-none" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <img src="/pages/nav/img/nav_modal_burger.svg"> 
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="border:none">
                    <div class="modal-body d-flex flex-column mt-5">
                        <button type="button" id="nav_modal_btn" data-bs-dismiss="modal" aria-label="Close"><img src="/pages/nav/img/white_cross.svg"></button>
                        <ul class="d-flex flex-column align-items-center" id="nav_link_modal">
                            <li class="nav-item"><a class="nav-link" href="/">Accueil</a></li>
                            <li class="nav-item"><a class="nav-link" href="/">Films</a></li>
                            <li class="nav-item"><a class="nav-link" href="/">Événements</a></li>
                            <li class="nav-item"><a class="nav-link" href="/">À propos</a></li>
                            <?php 
                                if (!isset($_SESSION['email'])){
                                    echo '
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="/pages/login/sign_in/sign_in.php">Se connecter</a></li>
                                    <li class="nav-item"><a class="nav-link" href="/pages/login/sign_up/sign_up.php">Inscription</a></li> 
                                    ';
                                } elseif (isset($_SESSION['email']) && $_SESSION['user_type']=="Normal"){
                                    echo '
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="/pages/profile/profile.php">Profil</a></li>
                                    <li class="nav-item"><a href="/pages/profile/mes_reservations.php" class="nav-link">Mes réservations</a></li>
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="/deconnexion.php">Deconnexion</a></li>
                                    ';

                                } elseif(isset($_SESSION['email']) && $_SESSION['user_type']=="Admin"){            
                                    echo '
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="/pages/profile/profile.php">Profil</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link">Dashboard</a></li>
                                    <li class="nav-item" id="nav_modal_divider"><a class="nav-link" href="/deconnexion.php">Deconnexion</a></li>
                                    ';
                                };
                            ?>   
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</nav>