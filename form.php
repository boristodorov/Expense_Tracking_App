
<?php
    mb_internal_encoding('UTF-8');
    $pageTitle = 'Forma';
    include './include/header.php';
    
            
    
   if($_POST){
     //Normalizacija podataka
    /*
     * ako imamo post request onda mozemo da pocnemo normalizaciju i validaciju podataka koji nam dolaze,
     * preko forme
     */
       //funkcija trim() skracuje string za nepotrebne intervale i simbole '    boris    ', 'boris'
       $username = trim($_POST['username']);
       //funkcija srt_replace() prima tri parametra, tazeni simbol , simbol sa kojim menajmo trazeni sibol i treci gde trazimo taj sibol
       $username = str_replace('!', '', $username);
       $sum = (float) $_POST['sum'];
       $selectedGroup = (int)$_POST['groupe'];
       
       //deklarisemo promenljivu $error i dajemo vrednost false, nakon toga u if konstrukciji ako imamo neku gresku dajemo vrednost true
       $error= FALSE;
       
       //Validacija podataka 
       /*
        * mb_strlen() funkcija uzima kao parametar promenljivu i broji koliko sibola ima dati string,
        * ali da bi smo koristili ovu funkciju moramo podesiti encoding na UTF-8, 
        * to radimo pomocu mb_internal_encoding('UTF-8')
        */
       if (mb_strlen($username) <4){
           echo '<p>Pogresno ime</p>';
           $error=TRUE;
       }
       if($sum <= 0){
           echo '<p>Pogresan rashod</p>';
           $error=TRUE;
       }
       
       /*
        *  array_key_exists() funkcija prosto proverava da li postoji dati kljuc u datom array-u, kao argumente 
        * ova funkcija uzima promenljivu koja cuva kljuc i array u kome se nalazi, ali kada bi ova funkcija 
        * bila tacna onda bi usli u if konstrukciju, zato okrecemo logiku 
        *        
        */
       if(!array_key_exists($selectedGroup, $groups)){
           echo '<p>Pogresna grupa</p>';
           $error=TRUE;
       }
       
       /*
        * Podaci koji su uspesno prosli normalizaciju i validaciju zapisujemo u tekstualni fajl,
        * Ako promenljiva $error u if konstrukciji daje vrednost true onda se pokazuju poruke za greske u mi 
        * ne mozemo da zapisemo te podatke, zato opet okrecemo logiku ako promenljiva $error daje vrednost false 
        * onda mozemo da krenemo sa zapisom podataka!
        */
       if (!$error){
           
           /*
            * Definisemo promenljivu $results i u njoj dodajemo promenljive
            *  koje su prosle normalizaciju i validaciju 
            *  $username $phone i $selectedGroupe, ali isto
            * tako da bi smo razgranicili stringove koji koje upisujemo u nas falj
            * dodajemo specijalni simbol '!', ali ako neko u formi napise simbol ! on ce 
            * nam poremetti strukturu podataka koju treba da zapisujemo, zato u normalizaciji podataka 
            * trebamo zameniti ovaj specijalni simbol ! to cemo uraditi sa funkcijom str_replace();
            */
           $results = $username.'!'.$sum.'!'.$selectedGroup."\n";
           if (file_put_contents('data.txt', $results, FILE_APPEND)){
               echo 'Zapis je uspesan!';
           }
       }
       
       
       
   }
    
    
?>

<a href="index.php" >spisak</a>
<form method="POST" >
    <div>Ime: <input type="text" name="username"></div>
    <div>Suma: <input type="text" name="sum"></div>
    <div>
        <select name="groupe">
           <?php
           foreach ($groups as $key=>$value) {
               echo '<option value="'.$key.'">'.$value.'</option>';
           }
           ?>
        </select>
    </div>
    
    <div><input type="submit" value="Dodaj" ></div>   
</form>

<?php
include './include/footer.php';
?>