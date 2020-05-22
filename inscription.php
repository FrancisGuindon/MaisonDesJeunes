<?php
const STATUT_INACTIF = 0;
session_start();
include "lib/fonctions.lib";
connexionPOO($bd);

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'inscription') {
        $telephone = $_POST['telephone'];
        $dateNaissance = $_POST['dateNaissance'];
        normalizeNEFields($telephone, $dateNaissance);

        $usager = new Usager($_POST['prenom'], $_POST['nom'], $_POST['motPasse'], $_POST['courriel'], $telephone, $dateNaissance, STATUT_INACTIF);

        try {
            $usager->ajouterUsager($bd);
            // Normalement si l'usager tape un e-mail déja entré il se dirige dans le catch ici
            $posFeedback = "Votre inscription a été établie avec succès. Vous devez attendre l'approbation d'un administrateur du site pour pouvoir être actif sur le site.";
        } catch (PDOException $e) {
            // Duplicate entry
            if ($e->errorInfo[1] == 1062) {
                $negFeedback = "Un compte existe déja avec cette adresse courriel. Entrez une autre adresse courriel ou <a class='btn btn-info' href='connexion.php'>connectez-vous.</a>";
            } else {
                $negFeedback = "Une erreur est survenue au niveau du site. Veuillez contacter un administrateur.";
            }
        }
    }
}

include "inc/entete.inc"
?>

<h2>Inscription</h2>
<p>Tu es un jeune, agé entre 12 et 17 ans, et tu veux avoir accès aux différentes activités de la maison des jeunes?
    Alors, inscris-toi!</p>

<form name="formInscription" method="POST" action="inscription.php?action=inscription">

    <div id="feedback">
        <?php if (isset($posFeedback)) {
            echo "<div id='posFeedback' class='alert alert-success text-center'>" . $posFeedback . "</div>";
        } ?>

        <?php if (isset($negFeedback)) {
            echo "<div id='negFeedback' class='alert alert-danger text-center' >" . $negFeedback . "</div>";
        } ?>
    </div>

    <div class="form-group">
        <label for="prenom">Prénom<span name="etoile">*</span></label>
        <input class="form-control" name="prenom" type="text" required maxlength="25">
    </div>

    <div class="form-group">
        <label for="nom">Nom<span name="etoile">*</span></label>
        <input class="form-control" name="nom" type="text" required maxlength="25">
    </div>

    <div class="form-group">
        <label for="courriel">Courriel<span name="etoile">*</span></label>
        <input class="form-control" name="courriel" type="email" required maxlength="50">
    </div>

    <div class="form-group">
        <label for="motPasse">Mot de passe<span name="etoile">*</span></label>
        <input class="form-control" name="motPasse" type="password" required>
    </div>

    <div class="form-group">
        <label for="dateNaissance">Date de naissance</label>
        <input class="form-control" name="dateNaissance" type="date">
    </div>

    <div class="form-group">
        <label for="telephone">Téléphone</label>
        <input class="form-control" name="telephone" type="tel" placeholder="111-222-3333" maxlength="12">
    </div>

    <p>Les informations avec une étoile (<span name="etoile">*</span>) sont obligatoires.</p>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
        <label class="form-check-label" for="exampleCheck1">J'ai lu et j'accepte les règles de vie de la maison des
            jeunes.<span name="etoile">*</span></label>
    </div>

    <button type="submit" class="btn btn-primary">S'inscrire</button>
    <button type="reset" class="btn btn-light">Annuler</button>

</form>


<?php
include "inc/piedPage.inc"
?>
