<?php 
session_set_cookie_params(3600);
session_start();

    // $_SESSION['email']='huangfrederic2002@gmail.com';
    // $_SESSION['email']='franck.zhuang@htm.fr';
    // $_SESSION['user_type']='Normal';

    // Connect to the db
    include("pages/connect_db.php");


    $movie = 100;

    $price = 11.90;
    $minutes = 135;
    $id_room= 16; 

    // PAS TOUCHER 
    $seance_date = '2023-05-08';
    $start_time = '9:00';
    $language = array('VO','VOSTFR','VOSTENG');
    $random_day_off = rand(2,5);
    // 194 -> 241


    // Add Sessions
    for($i=0;$i<=6;$i++){
        if($i != $random_day_off){
            for($j=0; $j<=5; $j++){
                $q = 'INSERT INTO SESSION(price,seance_date,start_time,id_room,language) VALUES (:price,:seance_date,:start_time,:id_room,:language);';
                $req = $bdd->prepare($q);
                $reponse = $req->execute([
                    'price' => (float)($price+0.3*$j),
                    'seance_date' => date('Y-m-d',strtotime($seance_date.'+' . $i . 'days')),
                    'start_time' => date('G:i',strtotime($start_time . '+' . ($j*$minutes+ (rand(1,5)*5)) . 'minutes')),
                    'id_room' => $id_room,
                    'language' => $language[array_rand($language, 1)],
                ]);
            }
        }
    }

    $q = 'SELECT * FROM SESSION WHERE id_room = :id_room';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id_room' => $id_room
    ]);
    $result= $req -> fetch();

    $first_id = $result['id_session'];
    $last_id = $first_id + 35;

    // INSERT TAKE PLACE 
    for($i=$first_id; $i<=$last_id;$i++){
        $q = 'INSERT INTO TAKE_PLACE(id_session,id_movie) VALUES (:id_session,:id_movie);';
        $req = $bdd->prepare($q);
        $reponse = $req->execute([
            'id_session' => $i,
            'id_movie' => $movie
        ]);
    }

    $q = 'SELECT * FROM TAKE_PLACE WHERE id_movie = :id_movie';
    $req = $bdd->prepare($q);
    $reponse = $req->execute([
        'id_movie' => $movie
    ]);
    $result= $req -> fetchAll();

    echo 'ALLGOOD <br>';
    var_dump($result);