<?php
    $pageTitle = 'Spisak';
    include './include/header.php';
    

?>
        <a href="form.php" >forma</a>
        
        <form method="GET">  
            <div>
                <select name="group">
                    <option value="0">Sve</option>
                   <?php
                   foreach ($groups as $key=>$value) {
                       echo '<option';      
                        if (isset($_GET['group']) && (int)$_GET['group']==$key){
                            echo ' selected ';
                        }
                       echo ' value="'. $key . '">' . $value . 
                            '</option>';
                   }
                   ?>
                </select> <input type="submit" value="Filtriraj" />
            </div>
            
        </form>
        <table border=1>
            <tr>
                <td>Ime:</td>
                <td>Suma:</td>
                <td>Grupa:</td>
            </tr>
           <?php   
           /*
            * Da bismo izvrsili vizualizaciju podataka iz fajla data.txt, prvo moramo da proverimo 
            * da li takav falj postoji, 
            */
            if (file_exists('data.txt')){ 
                /*
                 * Posto svaki zapis u nasem fajlu je na novom redu, moramo nekako svaki novi red da predstavimo 
                 * to cemo uraditi pomocu funkcije file(); ta funkcija za svaki novi red iz naseg fajla vraca array 
                 * nakon toga cemo izvrsiti iteraciju array pomocu foreach();
                 */
                
                $result = file('data.txt');
                $totalSum = 0;
                foreach ($result as $value) {
                    /*
                     * Posto funkcija file() za svaki novi red vraca array, sada trebamo razbiti taj red na tri dela kako 
                     * bismo rezultate stavili u kolone, to radi funcija explode() ona trazi specijalni simbol ! i taj deo 
                     * dokle je simbol pretvara u element array-a
                     * 
                     */
                    $coloms = explode('!', $value);
                    
                    if (isset($_GET['group']) && $_GET['group'] > 0 && (int)$_GET['group']!= (int)$coloms[2]){
                        continue;
                    }
                    
                    $totalSum +=$coloms[1];
                    echo '<tr>
                          <td>'.$coloms[0] .'</td>
                          <td>'.  number_format($coloms[1],2,'.','').'</td>
                          <td>'.$groups[trim($coloms[2])].'</td>
                         </tr>';
                }
                /*Nacin na koji dodajemo total sum, deklarisemo promenljivu $totalSum odmah nakon promenljive $coloms
                 * i za svaku iteraciju koju izvrsi foreach dodajemo u $totalSum trenutnu vrednost promenljive i + $coloms sa elementom[1]
                 * to je element niza koji sadrzi sumu.
                 * 
                 */
                echo '<tr>
                        <td></td>
                        <td>'. number_format($totalSum, 2, '.','') .'</td>
                        <td></td>
                      </tr>';
                
            }
           ?>
            
        </table>
  
<?php
include './include/footer.php';
    
?>