<?php
// Start the session
session_start();
?>

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
    <form method="post" action="ConfRes.php">
        <div id="coordonnees">
            <fieldset>
                <legend>Validation des reservations</legend>
                <?php
                    $_SESSION['Age'] = $_POST['Age'];
                    $_SESSION['Nom'] = $_POST['Nom'];
                ?>
                <p>
                    Destionation : <?php echo $_SESSION['Destination']; ?> <br />
                    Nombre de place : <?php echo $_SESSION['NbPlace']; ?> <br /><br />
                    <?php
                    for($i = 0; $i < $_SESSION['NbPlace']; $i++) {
                        echo '
                        <p>
                        Nom : <?php echo $_SESSION["Nom"][i]; ?> <br />
                        Age : <?php echo $_SESSION["Age"][i]; ?> <br />
                        </p>';
                        }
                    ?>
                    Assurance : <?php echo $_SESSION['Assurance']; ?>
                </p>
            </fieldset>
        </div>
        <input type="submit" value="Confirmer" />
        <button onclick="goBack()">Retour à la page précédente</button>
        <input type="reset" value="Annuler la réservation">
    </form>
</section>
</body>
</html>
