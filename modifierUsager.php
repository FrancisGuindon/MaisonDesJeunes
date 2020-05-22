<?php
session_start();
include "lib/fonctions.lib";
verifAdmin();
connexionPOO($bd);
// Select tous les users pour les afficher plus tard
$allUsers = selectAllUsers($bd);

if (isset($_GET['action'])) {
    // Après que le formulaire de moficiation soit envoyé, action = confirmModifier
    if ($_GET['action'] == 'confirmModifier') {
        normalizeNEFields($_POST['telephone'], $_POST['dateNaissance']);
        $usager = new Usager($_POST['prenom'], $_POST['nom'], $_POST['courriel'], $_POST['telephone'], $_POST['dateNaissance'], $_POST['statut']);
        $usager->setIdUsager($_GET['id']);
        try {
            $usager->updateUser($bd);
            // L'administrateur plante ici parce qu'il exerce une erreur MySQL
            $feedback = array(
                'positif' => true,
                'msg' => "L'utilisateur a été mis à jour avec succès."
            );
        } catch (PDOException $e) {
            // Duplicate entry
            if ($e->errorInfo[1] == 1062) {
                $feedback = array(
                    'positif' => false,
                    'msg' => "Vous avez tenté d'entrer une adresse courriel qui est déja prise par un autre utilisateur. L'adresse courriel doit être unique pour chaque utilisateur. <b> Les changements n'ont pas été sauvegardés. </b>"
                );
            }
        }
    }
}
include "inc/entete.inc";
?>

<h2>Gestion des usagers - Modification</h2>

<div id="feedback">
    <?php if (isset($feedback)) {
        if ($feedback['positif']) {
            echo "<div id='posFeedback' class='alert alert-success text-center'>" . $feedback['msg'] . "</div>";
        } else {
            echo "<div id='negFeedback' class='alert alert-danger text-center' >" . $feedback['msg'] . "</div>";
        }
    }
    ?>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'modifier') {
        modifyOneUser($bd, $_GET['id']);
    } else {
        // Afficher tous les utilisateurs avec bouton modifier
        showUsersModify($allUsers);
    }
} else {
    showUsersModify($allUsers);
} ?>



<?php
include "inc/piedPage.inc";
?>
