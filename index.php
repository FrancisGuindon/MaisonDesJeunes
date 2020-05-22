<?php
session_start();

if (isset($_GET['action'])) {
    // Déconnexion
    if ($_GET['action'] == 'deconnexion') {
        session_unset();
    }
}
include "inc/entete.inc"

?>

    <h2>Maison des jeunes</h2>
    <p>Le Regroupement des maisons des jeunes du Québec est un organisme à but non lucratif qui représente 190 maisons
        des
        jeunes membres représentant près de
        250 milieux de vie à travers l’ensemble des régions du Québec. En plus de promouvoir le Projet maison des
        jeunes,
        qui vise à aider les jeunes à devenir des citoyennes et des citoyens critiques, actifs et responsables, il
        travaille
        quotidiennement à défendre les intérêts des ado et à faire connaître et reconnaître le travail accompli dans ses
        maisons des jeunes membres.</p>

    <div class="line"></div>

    <h2>C'est pour toi !</h2>
    <p> Les maisons des jeunes sont ouvertes à tous les jeunes âgés de 12 à 17 ans.</p>

<?php
include "inc/piedPage.inc";
?>