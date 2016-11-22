<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>RESERVATION</title>
</head>
<body>
<section>
    <form method="POST">
        <div id="coordonnees">
            <fieldset>
                <legend>Reservation</legend>
                <p>
                    Le prix de la place est de 10€ jusqu'à 12 ans et ensuite de 15€.<br /><br />
                    Le prix de l'assurance annulation est de 20€ quel que soit le nombre de voyageurs.
                </p>
                <p>
                    <label>Destination :</label> <br />
                    <input type="text" name="Destination" id="Destination" size="30" required />
                </p>
                <p>
                    <label>Nombre de place :</label> <br />
                    <input type="number" name="NbPlace" id="NbPlace" size="30" min="1" required />
                </p>
                <p>
                    Assurance annulation :
                    <input type="checkbox" name="Assurance" value="AssTaken" id="Assurance" />
                </p>
            </fieldset>
        </div>
        <input type="submit" value="Etape suivante" />
        <input type="reset" value="Annuler la réservation">
    </form>
</section>
</body>
</html>
