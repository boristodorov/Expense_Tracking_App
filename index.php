<?php
    $pageTitle = 'Spisak';
    include './include/header.php';
    

?>
        <a href="form.php" >forma</a>
        <table border=1>
            <tr>
                <td>Ime:</td>
                <td>Suma:</td>
                <td>Grupa:</td>
            </tr>
           <?php   
           /*
            * Da bi smo izvrsili vizualizaciju podataka iz fajla data.txt, prvo moramo da proverimo 
            * dali takav falj postoji, 
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
                    $totalSum +=$coloms[1];
                    echo '<tr>
                          <td>'.$coloms[0] .'</td>
                          <td>'.$coloms[1].'</td>
                          <td>'.$groups[trim($coloms[2])].'</td>
                         </tr>';
                }
                
                echo '<tr><td></td><td>'.$totalSum.'</td><td></td></tr>';
                
            }
           ?>
            
        </table>
  
<?php
include './include/footer.php';
    
?>