<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Réservation</title>
</head>
<body>


<section>
    <form method="POST" action="controller/Controller.php">
        <div id="coordonnees">
            <fieldset>
                <legend>Reservation</legend>
                <p>
                    Le prix de la place est de 10€ jusqu'à 12 ans et ensuite de 15€.<br /><br />
                    Le prix de l'assurance annulation est de 20€ quel que soit le nombre de voyageurs.
                </p>
                <?php
                if ($error)
                {
                  echo "<div class='error'>Veuillez indiquer le nombre de voyageurs.</div>";
                }
                ?>
                <p><label for="Destination">Destination</label>:
                <select name="Destination" size=1 id="Destination">;

                <?php
                  $destinations = array('Amsterdam','Berlin','Bruxelles','Londres','Paris');
                      foreach($destinations as $destine)
                      {
                        echo '<option>' . $destine . '</option><br/>';
                      }
                ?>
                </select>
                <p>
                    <label>Nombre de place :</label> <br />
                    <?php
                      //To set the value for the checkbox entry
                      $insur_check = ($Reservation->getAssurance()) ? 'checked' : "" ;

                      echo "<input type='number' value='" . $Reservation->getNbPerson()
                          . "' name='NbPlace' size='5' min='1' id='place''>

                          <p><label for='insurance'>Assurance annulation</label>
                          <input type='checkbox' name='Assurance' id='insur'" . $insur_check . ">";
                    ?>
                </p>
            </fieldset>
        </div>
        <input type="submit" name="ReservSent" value="Etape suivante" />
        <input type="reset" value="Annuler la réservation" />
    </form>
</section>
</body>
</html>
