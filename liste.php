<?php

    $monfichier = file('employé.bin');
    $nombreDeLigne = count($monfichier);
    
    for ($i=0; $i < $nombreDeLigne; $i++) {
    
        $var = explode(' ', $monfichier[$i]);

        $tableau[$i] = array($var[0], $var[1], $var[2], $var[3], $var[4], $var[5], $var[6]);
    }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="main.css" class="rel">
</head>
<body>
    <?php
    if (isset($_POST['editer'])) {
        ?>
    <div>
    <form method="POST">
            <h1>Modifiacation de l'employé <?php echo $_POST['editer']; ?></h1>
            <table>
                <tr>
                    <td><label for="" >Matricule</label></td>
                    <td><input type="text" name="matricule" disabled="disabled"></td>
                </tr>
                <tr>
                    <td><label for="">Nom</label></td>
                    <td><input type="text" name="nom"></td>
                </tr>
                <tr>
                    <td><label for="">Prenom</label></td>
                    <td><input type="text" name="prenom"></td>
                </tr>
                <tr>
                    <td><label for="">Date de naissance</label></td>
                    <td><input type="text" name="birthday"></td>
                </tr>
                <tr>
                    <td><label for="">Salaire</label></td>
                    <td><input type="text" name="salaire"></td>
                </tr>
                <tr>
                    <td><label for="">Téléphone</label></td>
                    <td><input type="text" name="phone"></td>
                </tr>
                <tr>
                    <td><label for="">Email</label></td>
                    <td><input type="text" name="mail"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="validation" value="Ajouter"></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
        }
    ?>
    
    <div class="liste">
        <table>
            <tr>
                <td>Matricule</td>
                <td>Nom</td>
                <td>Prénom</td>
                <td>Date de naissance</td>
                <td>Salaire</td>
                <td>Téléphone</td>
                <td>Email</td>
                <td>Actions</td>
            </tr>
            <?php 
                foreach($tableau as $ligne){
            ?>
            <tr class="valeurs">
                <?php
                    foreach ($ligne as $element) {
                        echo '<td>'.$element.'</td>';
                    }
                ?>
                <td>
                    <form method="POST">
                    <button name="editer" value="<?php echo "$ligne[0]"; ?>">Editer</button>
                    <button name="supprimer" value="<?php echo "$ligne[0]"; ?>">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php
                }
            ?>
            
        </table>
    </div>
</body>
</html>