<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Détails</title>
</head>
<body>
<section>
    <form method="POST" action="controller.php">
        <div id="coordonnees">
            <fieldset>
                <legend > Detail des reservations </legend >
                  <?php
                    if($error)
                    {
                      echo "<div class='error'>Veuillez compléter tous les champs avec des données valides.</div></br>";
                    }

                    for ($i=0; $i<$Reservation->getNbPerson(); $i++)
                    {
                      $name = (count($array_people) == 0) ? "" : $array_people[$i]->getName();
                      $age = (count($array_people) == 0) ? "" : $array_people[$i]->getAge();

                      echo "<label for='name'>Nom</label>:
                            <input type='text' name='name[]' value='" . $name .
                            "' maxlength='20' id='name'><br/>
                            <label for='age'>Age</label>:
                            <input type='text' name='age[]' value='" . $age .
                            "' size='3' maxlength='2' id='age'><br/><br/>";
                     }
                   ?>
            </fieldset>
        </div>
        <input type="submit" name="DetailsSent" value="Etape suivante" />
        <button onclick="goBack()"> Revenir sur la réservation </button>
        <input type="submit" name="cancel" value="Annuler la réservation" />
    </form>
</section>
</body>
</html>
