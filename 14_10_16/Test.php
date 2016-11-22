<?php
if(isset($_POST['Destination']) AND isset($_POST['NbPlace'])) // Si les variables existent :
{
    if($_POST['Destination']!=NULL AND $_POST['NbPlace']!=NULL)
    {
        $Destination = stripslashes($_POST['Destination']);
        $NbPlace = stripslashes($_POST['NbPlace']);

        // Affichage e-mail envoyé :
        echo "Votre message a bien été envoyé!";
    }
    else
    {
        echo "Votre message n'a pas été envoyé!";
    }
}
?>