<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Confirmation</title>
</head>
<body>
<section>
    <form method="POST" action="controller.php">
        <div id="coordonnees">
            <fieldset>
                <legend > Veuillez confirmer </legend >
                  <?php
                    echo 'Destination:  ' . $Reservation->getDestination() . '</br>
                          Nombre de personne(s): ' . $Reservation->getNbPerson() . '</br>';
                    for($i=0; $i<$Reservation->getNbPerson(); $i++)
                    {
                      echo $array_people[$i]->getName() . '  ' . $array_people[$i]->getAge() . '</br>';
                    }
                    echo 'Assurance réservation: ' . $Assurance . '</br>';
                  ?>
            </fieldset>
        </div>
        <input type="submit" name="ValidationSent" value="Etape suivante" />
        <input type="submit" name="DetailsBack" value="Retour à le page de détails" />
        <input type="submit" name="cancel" value="Annuler la réservation" />
    </form>
</section>
</body>
</html>
