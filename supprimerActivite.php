<?php
session_start();
include "lib/fonctions.lib";
verifAdmin();
connexionPOO($bd);

// Pour trier les informations
if (isset($_GET['trier'])) {
    $orderby = $_GET['trier'];
    // Select avec un filtre
    $tousActivite = selectActiviteBD($bd, $orderby);
} else {
    // Select sans filtre
    $tousActivite = selectActiviteBD($bd);
}

if (isset($_GET['action'])) {
    // Suprimer un user
    if ($_GET['action'] == 'supprimer') {
        supprimerActiviteBD($bd, $tousActivite);
    }
}

include "inc/entete.inc"
?>

    <h2>Gestion des activités - Supprimer</h2>
    <p>Voici une liste évolutive des activités et ateliers qui sont offert dans tout le réseau des maisons des
        jeunes.</p>

    <form action="supprimerActivite.php?action=supprimer" method="post"
          onsubmit="return confirm('Voulez-vous vraiment supprimer ces activitiés?');">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th rowspan="2">&nbsp;</th>
                <th rowspan="2"><a href="supprimerActivite.php?trier=nom">Activité</a></th>
                <th colspan="2">Nombre de participants</th>
                <th rowspan="2"><a href="supprimerActivite.php?trier=lien">Lien</a></th>
                <th rowspan="2">Description</th>
                <th rowspan="2"><a href="supprimerActivite.php?trier=endroit">Endroit</a></th>
                <th rowspan="2">Condition</th>
            </tr>
            <tr>
                <th><a href="supprimerActivite.php?trier=nbParticipantMin">Minimum</a></th>
                <th><a href="supprimerActivite.php?trier=nbParticipantMax">Maximum</a></th>
            </tr>
            </thead>

            <tbody>
            <!-- Montrer les activités avec une coche à caser pour les supprimer -->
            <?php showActivitesDelete($tousActivite); ?>
            </tbody>
        </table>
        <br>
        <input class="btn btn-danger" type="submit" value="SUPPRIMER">
        <input class="btn btn-light" type="reset" value="ANNULER">
    </form>

<?php
include "inc/piedPage.inc";
?>