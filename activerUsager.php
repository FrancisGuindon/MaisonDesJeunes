<?php
session_start();
include "lib/fonctions.lib";
verifAdmin();
connexionPOO($bd);
$inactiveUsers = selectInactiveUsers($bd);

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'activer') {
        $feedback = activerUser($bd, $inactiveUsers);
    }
}

include "inc/entete.inc";
?>

<h2>Gestion des usagers - Activation</h2>

<p>Pour activer un compte, cocher la case dans la colonne Actif et appuyez sur Activer.</p>

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

<form action="activerUsager.php?action=activer" method="post">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Actif</th>
            <th scope="col">Prénom</th>
            <th scope="col">Nom</th>
            <th scope="col">Courriel</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Date de naissance</th>
            <th scope="col">Date d'inscription (UTC)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        showUsersActivate($inactiveUsers);
        ?>
        </tbody>
    </table>

    <button class="btn btn-success" type="submit">Activer</button>
    <button class="btn btn-light" type="reset">Annuler</button>

</form>

<?php
include "inc/piedPage.inc";
?>
