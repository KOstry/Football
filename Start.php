
<head>
    <meta charset="UTF-8">
    <title>Generator turnejowy</title>

    <style>
     body
     {
        background: lightgrey;
        width: 70%;
        padding-top: 2%;
        padding-left: 10%;
        position: center;
        line-height: 3em;
     }    

     input[type=number]
     {
        width: 7%;
     }

     input[type=textarea],
     input[type=text]
     {
        width: 100%;
     }

     button
     {
        background: green;
        color: white;
        border: solid black 1px;
        border-radius: 10px;
        cursor: pointer;
        height: 5%;
        width: 15%;
     }

     button:hover
     {
        font-weight: bold;
     }


    </style>
</head>
<body>


        <div class="informationSite">
            <form action="terminarz.php" method="post" role="form">

            <h2>Wprowadź podstawowe dane przed rozpoczęciem turnieju: </h2>
                
               
                <div class="teamNames">        
                    <label><b>Drużyny/Gracze:</b></label> <!-- Input do wpisywania nazw uczestników --> 
                    <br>
                    <input type="textarea" name="teamNames" placeholder="Wpisz nazwy conajmniej dwóch drużyn/graczy odzielając je przecinkiem" required>
                    

                    
                    <label><br>
                    <label><b>Nazwa rozgrywek</b></label> <!-- Pole do wprowadzenia nazwy rozgrywek -->
                <div class="form-group">
                    <input type="text" class="competitionName" name="competitionName" placeholder="Nazwa..." required><br>
                </div>
                    <b>Wybierz rodzaj rozgrywek:</b> <!-- Wybor rodzaju rozgrywek -->
                <br>
                    <input type="radio" name="competitionType" value="League" checked> Liga <br>
                    <input type="radio" name="competitionType" value="Cup" > Puchar <br>
                    <!-- <input type="radio" name="competitionType" value="LeagueAndCup" > Liga + Puchar <br> -->
                </label>   
                <label><b>Liczba spotkań pomiędzy drużynami</b></label><br> <!-- Pole do wprowadzenia liczby spotkan miedzy druzynami-->
                <input type="number" name ="matchesBetween" min="1" step="1" max="4" value="1"><br><br>
                <button type="submit" class="generateCompetition">Gotowe</button>
            </form>
            <br>
             
   
</body>
</html>