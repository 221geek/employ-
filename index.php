<?php

    $fichier = file('employé.bin');
    $nombreDeLigne = count($fichier);
    $derniereLigne = $fichier[$nombreDeLigne-1];
    $mat = explode(' ', $derniereLigne);
    $matricule = $mat[0];

    if ($matricule == '') {
        $matricule = "EM-".sprintf("%05d", 1);
    }
    else{
        $matricule++;
    }

    if (isset($_POST['validation'])) {
        if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['birthday']) AND !empty($_POST['salaire']) AND !empty($_POST['phone']) AND !empty($_POST['mail'])) {
            
            $prenom = trim(htmlspecialchars($_POST['prenom']));
            $nom = trim(htmlspecialchars($_POST['nom']));
            $birthday = trim(htmlspecialchars($_POST['birthday']));
            $salaire = trim(htmlspecialchars($_POST['salaire']));
            $phone = trim(htmlspecialchars($_POST['phone']));
            $mail = trim(htmlspecialchars($_POST['mail']));
            
            if (ctype_alpha($prenom) && ctype_alpha($nom)) {
                
                if (strptime($birthday, "%d/%m/%Y")) {
                    if ($salaire>=25000 && $salaire<=2000000) {
                        if (preg_match('#^7[7|6|0|8][0-9]{7}$#', $phone)) {
                            if (preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $mail)) {
                                $monfichier = fopen('employé.bin', 'a+');

                                $tab = "$matricule $prenom $nom $birthday $salaire $phone $mail";

                                fwrite($monfichier, $tab."\n");

                                fclose($monfichier);
                                
                                header("Location: liste.php");
                            } else {
                                $erreur = "Veillez saisir un adresse mail valide";
                            }
                        } else {
                            $erreur = "Veillez saisir un numero de telephone valide";
                        }
                    } else {
                        $erreur = "Le sailaire doit etre compris entre 25000 et 1000000";
                    }
                } else {
                    $erreur = "Veillez saisir une date sous le format Jour/Mois/Année";
                }
            }
            else{
                $erreur = "le nom et le prénom ne doivent comporter que de lettres";
            }
        }
        else{
            $erreur = "Tous les champs doivent etre remplis !";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enregistrer un employé</title>
    <link rel="stylesheet" href="main.css" class="rel">
</head>
<body>
<div class="fond2"></div>
    <div class="page">
        
        <form method="POST">
            <h1>Enregistrer un employé</h1>
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
        <?php
            if (isset($erreur)) {
        ?>
        <div class="erreur">
            <?php
                echo $erreur;
            ?>
        </div>
        <?php } ?>
    </div>
</body>
</html>