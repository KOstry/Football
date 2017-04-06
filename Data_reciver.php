<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['competitionType']) && isset($_POST['numberOfTeams'])){ 
        switch ($_POST['competitionType']) {
            
            case 'League': //Kod dla rozgrywek ligowych
                  
                    var_dump($_POST[$teams]);
                break;
            }
        } else {
            echo "Dane nie przeszły";
        }
    }
    ?>