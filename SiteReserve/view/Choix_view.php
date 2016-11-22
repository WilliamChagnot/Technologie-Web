<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Detail</title>
</head>
<script>
    function goBack() {
        window.history.back()
    }
</script>
<body>
<section>
    <form method="post" action="ValRes.php">
        <div id="coordonnees">
            <fieldset>
                <legend > Detail des reservations </legend >
                <?php
                    $_SESSION['Destination'] = $_POST['Destination'];
                    $_SESSION['NbPlace'] = $_POST['NbPlace'];
                    if ($_POST['Assurance'] == TRUE) {
                        $_SESSION['Assurance'] = 'Oui';
                    } else {
                        $_SESSION['Assurance'] = 'Non';
                    }
                    for($i = 0; $i < $_SESSION['NbPlace']; $i++) {
                        echo '
                            <p >
                                <label for="Nom" > Nom :</label > <br />
                                <input type = "text" name = "Nom[]" id = "Nom" size = "30" required />
                            </p >
                            <p >
                                <label for="Age" > Age :</label > <br />
                                <input type = "number" name = "Age[]" id = "Age" size = "30" min = "1" required />
                            </p >';
                    }
                ?>
            </fieldset>
        </div>
        <input type="submit" value="Etape suivante" />
        <button onclick="goBack()">Retour à la page précédente</button>
        <input type="reset" value="Annuler la réservation">
    </form>
</section>
</body>
</html>
