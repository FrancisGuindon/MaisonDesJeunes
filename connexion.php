<?php
session_start();
include "lib/fonctions.lib";
connexionPOO($bd);


if (isset($_GET['action'])) {
    // Si l'action est de connecter l'utilisateur
    if ($_GET['action'] == 'connexion') {
        $user = new Usager($_POST['courriel'], $_POST['motPasse']);
        // Si l'username et le mot de passe concorde
        if (validerUsagerPOO($bd, $user->getCourriel(), $user->getMotPasse())) {
            $_SESSION['connecte'] = true;
            $_SESSION['statut'] = $user->getStatutFromBD($bd);
            header('Location: horaire.php');
        } else {
            $messageErreur = "Courriel ou mot de passe invalide.";
        }
    }
}

include "inc/entete.inc";
?>

    <h2>Connexion</h2>

    <div class="text-danger text-center" id="messageErreur">
        <?php if (isset($messageErreur)) {
            echo $messageErreur;
        } ?>
    </div>

    <form name="formInscription" method="POST" action="connexion.php?action=connexion">

        <div class="form-group">
            <label for="courriel">Courriel</label>
            <input class="form-control" name="courriel" type="email" required>
        </div>

        <div class="form-group">
            <label for="motPasse">Mot de passe</label>
            <input class="form-control" name="motPasse" type="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Se connecter</button>
        <button type="reset" class="btn btn-light">Annuler</button>

    </form>

<?php
include "inc/piedPage.inc";
?>