<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generator footballowy</title>
    
</head>
<body>


        <div class="informationSite">
            <form action="" method="post" role="form">
                <legend>Competition name</legend> <!-- Pole do wprowadzenia nazwy rozgrywek -->
                <div class="form-group">
                    <label for=""></label>
                    <input type="text" class="competitionName" name="competitionName" placeholder="Name..."><br><br>
                </div>

                <div class="form-group">
                    <label for="">Number of teams</label><br> <!-- Pole do wprowadzenia liczby uczestnikow -->
                    <input type="number" name ="numberOfTeams" min="1" step="1" placeholder="1"><br>
                </div>
        <label>
            <br>
            Select type of competition: <!-- Wybor rodzaju rozgrywek -->
            <br>
            <input type="radio" name="competitionType" value="League" checked> League <br>
            <input type="radio" name="competitionType" value="Cup" > Cup <br>
            <input type="radio" name="competitionType" value="LeagueAndCup" > League + Cup <br>
            <br>
        </label>    

                <button type="submit" class="confirmButton">Forward</button>
            </form>
        </div>
    </div>
</div>

<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['competitionType']) && isset($_POST['numberOfTeams'])){ 
        switch ($_POST['competitionType']) {
            
            case 'League': //Kod dla rozgrywek ligowych
                ($_POST['numberOfTeams'] % 2 == 0) ? $_POST['numberOfTeams'] : $_POST['numberOfTeams']++;
                $teams = array ();
                for ($i = 1; $i <= ($_POST['numberOfTeams']); $i++){ // Petla generujaca nazwy uczestnikow
                ?>
                <form action="Data_reciver.php" method="post" role="form">
                        <input type="text" class="team" name="team" id="team" placeholder="Put team name "><br><br>
                </form> 
                    <?php
                    $teams[] = $_POST['name'];      
                }
                break;

            case 'Cup': // Kod dla rozgrywek pucharowych
               if ($_POST['numberOfTeams'] % 4 == 0 ){ // Sprawdzanie warunku odpowiedniej liczby druzyn
                $_POST['numberOfTeams'];
                }
                else if ($_POST['numberOfTeams'] % 4 != 0 && ($_POST['numberOfTeams'] % 2 == 0)){
                $_POST['numberOfTeams'] += 2;  
                }
                else if ($_POST['numberOfTeams'] % 4 != 0 && ($_POST['numberOfTeams'] % 2 != 0)){
                $_POST['numberOfTeams']++;
                }
                $teams =  array();
                    for ($i = 1; $i <= ($_POST['numberOfTeams']); $i++){ //Petla generujaca nazwy uczestnikow
                    ?>
                    <form action="Data_reciver.php" method="post" role="form">
                        <input type="text" class="team" name="team" id="team" placeholder="Put team name "><br><br>
                    </form> 
                    <?php
                    $teams[] = $_POST['name'];
                    }       
                break;
            
            case 'LeagueAndCup': // Kod dla rozgrywek grupa + puchar
                if ($_POST['numberOfTeams'] % 4 == 0 ){ // Sprawdzanie warunku odpowiedniej liczby druzyn
                $_POST['numberOfTeams'];
                }
                else if ($_POST['numberOfTeams'] % 4 != 0 && ($_POST['numberOfTeams'] % 2 == 0)){
                $_POST['numberOfTeams'] += 2;  
                }
                else if ($_POST['numberOfTeams'] % 4 != 0 && ($_POST['numberOfTeams'] % 2 != 0)){
                $_POST['numberOfTeams']++;
                }
                    for ($i = 1; $i <= ($_POST['numberOfTeams']); $i++){ //Petla generujaca nazwy uczestnikow
                    ?>
                    <form action="Data_reciver.php" method="post" role="form">
                        <input type="text" class="team" name="team" id="team" placeholder="Put team name "><br><br>
                    </form>
                    <?php
                    }       
                break;           
            } 
            ?>
            <form action="Data_reciver.php" method="post" role="form">
                <label for="">Matches between teams</label><br> <!-- Pole do wprowadzenia liczby spotkan miedzy druzynami-->
                <input type="number" name ="matchesBetween" min="1" step="1" placeholder="1"><br><br>
                <button type="submit" class="generateCompetition">Done</button>
            </form>     
            <?php            
        }
    }  
?>    
</body>
</html>