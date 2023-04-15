<?php session_start();
    include("../connect_db.php");

    if (!isset($_POST['firstname']) || !isset($_POST['lastname'])){
        $msg = 'Veuillez remplir les deux champs';
        header('location:profile.php?message=' . $msg);
        exit;
    }

        // Update users information
        $q = 'UPDATE USERS SET first_name=:first_name WHERE email=:email';
        $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
        $reponse = $req->execute([
            'first_name' => $_POST['firstname'],
            'email' => $_SESSION['email']
        ]); // Exécution de la requête préparée (on lui passe les valeurs).

        // Update users information
        $q = 'UPDATE USERS SET last_name=:last_name WHERE email=:email';
        $req = $bdd->prepare($q); // Renvoie une déclaration pdo (statement)
        $reponse = $req->execute([
            'last_name' => $_POST['lastname'],
            'email' => $_SESSION['email']
        ]); // Exécution de la requête préparée (on lui passe les valeurs).

        $msg = 'informations d\'utilisateurs modifiés avec succès';
        header('location:profile.php?message=' . $msg);
        exit;