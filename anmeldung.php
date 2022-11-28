<?php

session_start();

if (
    $_SERVER["REQUEST_METHOD"] === "POST" //überprüft ob du submit gedrückt hast
    && isset($_POST["logout"]) //wenn logout geklickt wird
    && $_POST["logout"] === "true" //dann wird ausgeloggt 
) {
   // echo "<pre>"; keine Ahnung, wozu das da sein soll ?
    //"</pre>";     gehört eh nicht da her 
    session_destroy();
    header("Anmeldung.php");
    //header
    //die();
}



if (
    $_SERVER["REQUEST_METHOD"] === "POST" //überprüft ob du angemeldet bleiben möchtest (nach Login als Admin)
    && isset($_POST["weiter"]) 
    && $_POST["weiter"] === "true"  //wenn man angemeldet bleiben will, wird man weitergeleitet
) {
   
   // session_destroy();
    header("Reservierung.php"); //ich hab keine Ahnung, was dieser header hier macht. 
    //header
    //die();
}



//Eingeloggt als User:  
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    
    if (
        isset($_POST["username"])
        && isset($_POST["password1"])
        && ($_POST["username"] === "user"
            && $_POST["password1"] === "user"
        )
    ) {
        $_SESSION["name"] = $_POST["username"];
        $_SESSION["password"]=$_POST["password1"];

      }

}

//Eingeloggt als Admin: 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    
    if (
        isset($_POST["username"])
        && isset($_POST["password1"])
        && ($_POST["username"] === "admin"
            && $_POST["password1"] === "admin"
        )
    ) {
        $_SESSION["nameadmin"] = $_POST["username"];
        $_SESSION["passwordadmin"]=$_POST["password1"];

      }

}

$errors = [];
$errors["mail"] = false;
$errors["username"] = false;
$errors["agree"] = false;
$errors["password1"] = false; 


if ($_SERVER["REQUEST_METHOD"] == "POST") { //Fehlermeldungen, falls Felder leer sind
   
    if (empty($_POST["mail"])) {
        $errors["mail"] = true;
    }

    
    if (empty($_POST["username"])) {
        $errors["username"] = true;
    }

    if (empty($_POST["password1"])) {
        $errors["password1"] = true;
    }

    if (!isset($_POST["agree"])) { 
        $errors["agree"] = true;
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


    <title>Anmeldung</title>
</head>


</div>
 
    <!--- <- lEITET dich auf diese Seite weiter--->
<body> 
<?php
include ("adapt_nav.php"); 
?>
         
      
     
<title>Anmeldung</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Anmeldung</h1>
            </div>
        </div>

        <?php if (!isset($_SESSION["name"]) && !isset($_SESSION["nameadmin"]) )  //wenn man den sich eingeloggt hat als user/admin...
              {if(!isset($_SESSION["password1"]) && !isset($_SESSION["password1"])  ){
             ?>
        <form method="post">

        

            <!--- Email - Adresse  !--->
            <div class="form-floating mb-3">
                <input type="email" class="form-control <?php if ($errors['mail']) echo 'is-invalid'; ?>" name="mail" id="mail" placeholder="MaxM@gmx.com" >
                <label for="mail">E-Mail</label>
            </div>

            <!--- Username !--->
            <div class="form-floating mb-3">
                <input type="text" class="form-control <?php if ($errors['username']) echo 'is-invalid'; ?> " name="username" id="username" placeholder="Username" > <!--- Damit es rot wird, wenn der Username leer ist --->
                <?php

                if (isset($usernames)) {  //damit keine vergebenen Usernames submitted werden 
                    if (isset($usernames_length)) {
                        if (isset($uname)) {
                            if (isset($uname_err)) {
                                for ($i = 0; $i < $usernames_length; $i++) {
                                    if ($usernames[$i] == $uname) {
                                        echo $uname_err;
                                        break;
                                    } else {
                                        $usernames[] = $uname;
                                    }
                                }
                            }
                        }
                    }
                }
                ?>

                <label for="username">Username</label>

            </div>
            <!--- Passwort 1 --->

            <div class="form-floating mb-3">
                <input type="password" name="password1" id="password1" class="form-control"><?php if ($errors['password1']) echo 'is-invalid'; ?>
                                                                      
                <label for="password1">Passwort</label>
            </div>


            <!--- AGB Button--->
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input <?php if ($errors['agree']) echo 'is-invalid'; ?>" name="agree" id="agree">
                <label class="form-check-label" for="agree">Hiermit bestätige ich die AGB's gelesen und verstanden zu haben.</label>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
   

        <?php }} else { ?> <!--   --->
        <h2>Hello <?php 
       //  header("Reservierung.php"); keine ahnung, was dieser header macht
           // echo $_SESSION["name"]; //hier ist ein fehler mit dem echo name 
             ?></h2> 
<?php

if (isset($_SESSION["name"])) {
    if(isset($_SESSION["password1"])){
    echo "Du befindest dich in der Session vom User.";
    }
}


if (isset($_SESSION["nameadmin"])) {
    if(isset($_SESSION["password1"])){
    echo "Du befindest dich in der Session vom Admin.";
    }
}
    
?>

        <form method="POST">
            <input type="hidden" name="logout" value="true">  <!--logout Button-->
            <button>Logout</button>
        </form>
       
        

        <form action="Reservierung.php" method="POST">; 

        <form method="POST">
            <input type="hidden" name="weiter" value="true">  <!--eingeloggt bleiben-->
            <button>Weiter</button>
        
        </form>
        </form>


    <?php  } ?>
    </div>


</body>

</html>