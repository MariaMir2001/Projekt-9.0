
<?php
if (isset($_SESSION["name"])) { //wenn man in der Session des Users ist 
 //include "bootstrap_snippets.php"; 
 include ("user_nav.php"); 
 echo "Eingeloggt als User";
}
else if (isset($_SESSION["nameadmin"])) { //wenn man in der Session des Admins ist 
    //include "bootstrap_snippets.php"; 
   include ("admin_nav.php"); 
    echo "Eingeloggt als Admin";
   }

else{

    include ("bootstrap_snippets.php");
    //nicht eingeloggt.
    echo "Sie sind derzeit nicht eingeloggt. "; 

}
 ?>  
        