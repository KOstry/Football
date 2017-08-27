     <style>
    body
    {
      background-image: url(images.jpeg);
    }

    button
     {
        border: solid black 2px;
        border-radius: 10px;
        cursor: pointer;
        height: 30px;
        width: 14%;
        margin-left: 15%;
        float: left;
        position: fixed;
     }

     button:hover
     {
      background: red;
      font-weight: bold;
     }


    #rounds
    {
      float: right;
      margin-right: 0px;
      width: 50%;
    }

    #rounds table
    {
      border-collapse: collapse;
      float: right;
      margin-right: 0px;

    }

    #leaguetable
    { 
      margin-top: 50px;
      width: 50%;
      padding-right: 5%;
      position: fixed;
      max-width: auto;
    }

    #rounds td
    {
      border: solid black 1px;
      text-align: center;
    }

    #leaguetable td
    {
      text-align: center;
      border: solid black 1px;
      width: 2em;
    }
    

    #leaguetable table 
    {
      border: solid black 3px;
      border-collapse: collapse;
      font-size: 18px;
      overflow: auto;
    }

    #leaguetable tr:nth-child(3)
    {
      background-color: lightgreen;
    }

    #leaguetable tr:last-child
    {
      background-color: red;
    }
   
    tr:nth-child(even)
    {
      background-color: lightgrey;
    }

    tr:nth-child(odd)
    {
      background-color: darkgrey;
    }

    input[type=number]
    {
      width: 55px;
      text-align: center;
      position: center;
    }

    .week
    {
      background-color: gold;
      font-size: 28px;
    }


    </style>
    <?php
    
    $competitionName = $_POST['competitionName'];
    $teams = explode(',', $_POST['teamNames']);

    $rounds = array(); // Tu trzymamy zapis kolejki
    function matches($order, $teams) { // Dodatkowa funkcja, która nam z przeliczonej linii stworzy pary zespołów :)
      $round = array();
      $count = count($teams);
      for($i = 0, $len=$count/2; $i<$len; ++$i) {
        $round[] = array($order[$i], $order[$count-$i-1]);
      }
      return $round;   
    }

    if (count($teams) % 2 == 0)
    {
    // Pierwsza kolejka jest banalna, bo to po prostu stworzenie par z istniejącej tabeli zespołów
      $rounds[] = array('order' => array_keys($teams), 'round' => matches(array_keys($teams), $teams));
      for ($i = 0, $len = count($teams)-2, $jump = ceil(count($teams)/2); $i<$len; ++$i ) {
        $line = $rounds[$i]['order']; // pobranie ostatniej linii sparowania zespołów
        for($curr = 0, $last = $len+1; $curr < $last; ++$curr ) {
          $line[$curr] += $jump; // dodanie niezmiennika ceil(n/2)
          if($line[$curr] > $len) { 
            $line[$curr] -= $last; // jeśli za duży odjęcie (n-1)
          }
        }
        $rounds[] = array('order' => $line, 'round' => matches($line, $teams)); // zapis do rundy kolejności w kolejce i sparowania drużyn
      }
    } else 
    {
      // Pierwsza kolejka jest banalna, bo to po prostu stworzenie par z istniejącej tabeli zespołów
      $rounds[] = array('order' => array_keys($teams), 'round' => matches(array_keys($teams), $teams));
      for ($i = 0, $len = count($teams)-1, $jump = ceil(count($teams)/2); $i<$len; ++$i ) {
        $line = $rounds[$i]['order']; // pobranie ostatniej linii sparowania zespołów
        for($curr = 0, $last = $len+1; $curr < $last; ++$curr ) {
          $line[$curr] += $jump; // dodanie niezmiennika ceil(n/2)
          if($line[$curr] > $len) { 
            $line[$curr] -= $last; // jeśli za duży odjęcie (n-1)
          }
        }
        $rounds[] = array('order' => $line, 'round' => matches($line, $teams)); // zapis do rundy kolejności w kolejce i sparowania drużyn
      }
    }

    $wyniki = array_fill(0, count($teams), array('point' => 0, 'scoregoals' => 0,'concidedgoals' => 0, 'goaldifference' =>0 ,'W' => 0, "R" => 0, "P" => 0, "M" => 0));//Tablica do przechowywania rezultatów poszczególnej druzyny
    for ($i = 0; $i < count($teams) ; $i++) { 
      $wyniki[$i]['name'] = $teams[$i];
    }

    $a = 0;
   
  if (isset($_POST['result'])){   
    foreach ($_POST['result'] as $match) {
        
        list($home, $away) = array_keys($match);
        if (($match[$home] != "") && ($match[$away] != "")) 
        {
          
          $wyniki[$home]['scoregoals'] += $match[$home]; 
          $wyniki[$home]['concidedgoals'] += $match[$away]; 
          $wyniki[$away]['scoregoals'] += $match[$away]; 
          $wyniki[$away]['concidedgoals'] += $match[$home];
          $diff = $match[$home]-$match[$away];
          $wyniki[$home]['goaldifference'] += $diff;
          $wyniki[$away]['goaldifference'] -= $diff; 
          if ($match[$home] == $match[$away])
          {
            $wyniki[$home]['M'] +=1;
            $wyniki[$away]['M'] +=1;
            $wyniki[$home]['point'] += 1;
            $wyniki[$away]['point'] += 1;
            $wyniki[$home]['R'] += 1;
            $wyniki[$away]['R'] += 1;
          }elseif ($match[$home] > $match[$away])
          {
            $wyniki[$home]['M'] +=1;
            $wyniki[$away]['M'] +=1;
            $wyniki[$home]['point'] += 3;
            $wyniki[$home]['W'] += 1;
            $wyniki[$away]['P'] += 1;
          }else
          {
            $wyniki[$home]['M'] +=1;
            $wyniki[$away]['M'] +=1;
            $wyniki[$away]['point'] += 3;
            $wyniki[$home]['P'] += 1;
            $wyniki[$away]['W'] += 1;
          }

        }
    }    
  }  
   
   $matches = $_POST['matchesBetween'];

     echo '<form action="" method="post">'; 
       echo '<input type="hidden" name="teamNames" value="'.$_POST['teamNames'].'">';
       echo '<input type="hidden" class="competitionName" name="competitionName" value="'.$competitionName.'">';
       echo '<input type="hidden" name ="matchesBetween" value="'.$_POST['matchesBetween'].'">';
    echo '<button>&darr; Aktualizuj wyniki &darr;</button>';  
    echo '<div id="rounds">'; 
   
    $counter = 1;  
    for ($i=1; $i <= $matches ; $i++) { 
       
    if ($i % 2 !== 0){ 
     
    foreach ($rounds as $line) {
      
      $a++;
   
      echo "<table>";
      echo "<tr>";
      echo '<th colspan=3 class="week"><---------------Kolejka '.$a.'---------------></th>';
       foreach ($line['round'] as $teamsId) {
        if ($teams[$teamsId[0]] == $teams[$teamsId[1]] )
          continue;    
        echo "<tr>";
        echo '<td>'.$teams[$teamsId[0]].'</td>';
        if (isset($_POST['result']))
        {
        echo '<td><input name="result['.$counter.']['.$teamsId[0].']" type="number" min="0" value="'.$_POST['result'][$counter][$teamsId[0]].'">'.' vs '.'<input name="result['.$counter.']['.$teamsId[1].']" type="number" min="0" value="'.$_POST['result'][$counter][$teamsId[1]].'"></td>';
        }else 
        {
          echo '<td><input name="result['.$counter.']['.$teamsId[0].']" type="number" min="0">'.' vs '.'<input name="result['.$counter.']['.$teamsId[1].']" type="number" min="0"></td>';
        }
        echo '<td>'.$teams[$teamsId[1]].'</td>';
        echo "</tr>";  
        $counter++;
        
       }
       echo "</tr>";
     echo "</table>";  
      } // wyświetlenie wyników
      } else if ($i % 2 == 0){
        

    foreach ($rounds as $line) {
      
      $a++;
   
     
      echo "<table>";
      echo "<tr>";
      echo '<th colspan=3 class="week"><---------------Kolejka '.$a.'---------------></th>';
       foreach ($line['round'] as $teamsId) {
        if ($teams[$teamsId[0]] == $teams[$teamsId[1]] )
          continue;    
        echo "<tr>";
        echo '<td>'.$teams[$teamsId[1]].'</td>';
        if (isset($_POST['result']))
        {
        echo '<td><input name="result['.$counter.']['.$teamsId[1].']" type="number" min="0" value="'.$_POST['result'][$counter][$teamsId[1]].'">'.' vs '.'<input name="result['.$counter.']['.$teamsId[0].']" type="number" min="0" value="'.$_POST['result'][$counter][$teamsId[0]].'"></td>';
        }else 
        {
          echo '<td><input name="result['.$counter.']['.$teamsId[1].']" type="number" min="0">'.' vs '.'<input name="result['.$counter.']['.$teamsId[0].']" type="number" min="0"></td>';
        }
        echo '<td>'.$teams[$teamsId[0]].'</td>';
        echo "</tr>";  
        $counter++;
       }
       echo "</tr>";
     echo "</table>";  
      } // wyświetlenie wyników
      }
    }
     echo '</form>';
     echo '</div>';
     
      echo '<div id="leaguetable" class="sortable">';
     echo "<table>";
     echo '<th colspan=10 >'.$competitionName.'</th>';
     echo "<tr><td><b>Lp</td><td><b>Drużyna</td><td><b>M</td><td><b>W</td><td><b>R</td><td><b>P</td><td><b>G+</td><td><b>G-</td><td><b>G+/-</td><td><b>Pkt</td></tr>";
     $lp = 1;
     
     array_multisort(array_column($wyniki, 'point'), SORT_DESC, array_column($wyniki, 'goaldifference'), SORT_DESC, array_column($wyniki, 'scoregoals'), SORT_DESC, array_column($wyniki, 'W'), SORT_DESC, $wyniki);//sortowanie tabeli

     for ($i = 0; $i < count($teams) - 1; $i++)
    {

    }

     foreach ($wyniki as $wynik) {
      
       echo "<tr><b><td>".$lp.'</td><td style="width:80em;">'.$wynik['name']."</td><td>".$wynik['M']."</td><td>".$wynik['W']."</td><td>".$wynik['R']."</td><td>".$wynik['P']."</td><td>".$wynik['scoregoals']."</td><td>".$wynik['concidedgoals']."</td><td>".($wynik['goaldifference'])."</td><td>".$wynik['point']."</td></b></tr>";
       $lp++;
     }
     echo "</table>";
     
     echo "</div>";