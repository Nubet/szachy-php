<!DOCTYPE HTML>
</html lang="pl">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles.css">
</head>
    <body>
        <?php
         $litery = ["a", "b", "c", "d", "e", "f", "g", "h"];


         echo '<div id="szachownica">';
         for($i=0; $i<8; $i++)
         {

            echo '<div class="linia">';
            for($j=0; $j<8; $j++)
            {
                    if ($i % 2 == 0) // jedna "linia"(kreska podlozna) ma 8 pol czyli ostatnia liczba jest podzielna przez 2 a pierwsza nie, wiec wystarczy sprawdzac podzielnosc przez 2 aby wiedziec czy jest czarne czy biale pole
                    {    
                        if($j % 2 == 0)
                            echo '<div class="pole bp" id="'.$litery[$j],8-$i.'">'; // zapis class="pole bp" oznacza ze div ma 2 klasy -  pole oraz  bp
                        else 
                            echo '<div class="pole cp" id="'.$litery[$j],8-$i.'">';
                    }
                    else 
                    {
                        if($j % 2 == 0)
                             echo '<div class="pole cp" id="'.$litery[$j],8-$i.'">';
                        else 
                             echo '<div class="pole bp" id="'.$litery[$j],8-$i.'">';
                    }

                   //dla bialych
                   if($i == 7)
                   {
                        if ($j == 0 || $j == 7)
                             echo '<img src="zdj/figury/biale/wieza.png" class="figura" >';
                        if ($j == 1 || $j == 6)
                             echo '<img src="zdj/figury/biale/skoczek.png" class="figura">';
                        if ($j == 2 || $j == 5)
                             echo '<img src="zdj/figury/biale/goniec.png" class="figura">';
                        if ($j == 3)
                            echo '<img src="zdj/figury/biale/hetman.png" class="figura">';
                        if ($j == 4)
                            echo '<img src="zdj/figury/biale/krol.png" class="figura">';
                   }
                   else if($i == 6){
                        echo '<img src="zdj/figury/biale/pionek.png" class="figura" >';
                   }
                   //dla czarnych
                   if($i == 0)
                    {
                          if ($j == 0 || $j == 7)
                               echo '<img src="zdj/figury/czarne/wieza.png" class="figura">';
                          if ($j == 1 || $j == 6)
                               echo '<img src="zdj/figury/czarne/skoczek.png" class="figura">';
                          if ($j == 2 || $j == 5)
                               echo '<img src="zdj/figury/czarne/goniec.png" class="figura">';
                          if ($j == 3)
                              echo '<img src="zdj/figury/czarne/hetman.png" class="figura">';
                          if ($j == 4)
                              echo '<img src="zdj/figury/czarne/krol.png" class="figura">';
                     }
                     else if($i == 1){
                          echo '<img src="zdj/figury/czarne/pionek.png" class="figura" >';
                     }
                     else if ($i == 2 || $i == 3 || $i == 4 || $i == 5 || $i == 6 ){// kazde pole gdzie nie ma figury
                        echo '<img src="zdj/figury/puste.png" class="figura">';
                     }
                   echo '</div>';
            }
            echo '<div style="clear: both;">';
            echo '</div>'; // zakoczenie diva linia
        }
        echo '</div>'; // zakoczenie diva szachownica
        ?>

            <script type="text/JavaScript">
                 var wszystkie_figury = document.querySelectorAll('.figura');
                 var ktory_przesuwany;
                for (var i = 0; i < wszystkie_figury.length; i++) {
                    wszystkie_figury[i].setAttribute('draggable', true);
                    wszystkie_figury[i].addEventListener('dragstart', function(e) {// funkcja wykonuje sie odrazu po zlapaniu zdj myszka (przed puszczeniem myszki)
                    e.dataTransfer.setData("text/plain", e.target.getAttribute('src'));
                    // console.log(e.path[1]); // tym sposobem zwracam diva ktorego przesuwam
                    ktory_przesuwany = e.path[1]; // przypisuje caly div
                });
                }

                for (var i = 0; i < wszystkie_figury.length; i++) {
                    wszystkie_figury[i].addEventListener('dragover', function(e) {
                    e.preventDefault();
                });
                wszystkie_figury[i].addEventListener('drop', function(e) { // po puszczeniu myszki
                    e.preventDefault();
                    var src = e.dataTransfer.getData("text/plain"); //figura(zdj) ktora zlapalismy
                    var docelowySrc = e.target.getAttribute('src'); // figura na ktora upuszczamy druga
                    console.log("src: " + src);
                    console.log("docelowySrc: " + docelowySrc);
                

                    if(src != docelowySrc ) // dzieki temu sprawdzeniu gdy ktos nacisnie prawy na figure ale ja odrazu pusci czyli defakto nie przesunie ale funckja sie wywola to funkcja sprobowala by podmienic te samo zdj a to samo nie ma w tym nic zlego ale oprocz tego przy okazji wykonala by sie linijka ktora usunela by przesuwana figure
                    {
                            if(src != "zdj/figury/puste.png") //ochrona przed proba przesuniecia pustego pola na jakies inne
                            {
                                e.target.setAttribute('src', src); // lub this.setAttribute('src', src);
                                var przesuwana_figura = ktory_przesuwany.getElementsByTagName('img')[0];
                                przesuwana_figura.setAttribute('src', "zdj/figury/puste.png"); // przezroczyste tlo
                                var z_ktorego_pola_przesuwany = ktory_przesuwany.id;
                                var do_ktorego_pola_przesuwany = e.path[1];
                                //tutaj skrypt php ktory sprawdzi czy probojesz wykonac legalny ruch
                                console.log("z " + z_ktorego_pola_przesuwany + " do " + do_ktorego_pola_przesuwany.id);
                              
                            }
                          
                    }
                   
                   
                    
                });
                }
            
               
                    
            
                   
        </script>
    </body>
</html>