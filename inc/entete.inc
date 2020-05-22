<?php
if (isset($_COOKIE['langue'])) {
    $langue = $_COOKIE['langue'];
} else {
    $langue = "fr";
    setcookie("langue", "fr", time() + (60 * 60 * 24 * 30 * 8));
}

if (isset($_GET['langue'])) {
    if ($_GET['langue'] == 'english') {
        $langue = "en";
        setcookie("langue", "en", time() + (60 * 60 * 24 * 30 * 8));
    } else if ($_GET['langue'] == 'francais') {
        $langue = "fr";
        setcookie("langue", "fr", time() + (60 * 60 * 24 * 30 * 8));
    }
}

/* Récupération du contenu du fichier .json */
$contenu_fichier_json = file_get_contents('lang/' . $langue . '.json');

/* Les données sont récupérées sous forme de tableau (true) */
$data = json_decode($contenu_fichier_json, true);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Maison des Jeunes</title>


    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- FG -->
    <link rel="stylesheet" href="css/mdj.css">
    <link rel="shortcut icon" href="img/mdj.ico">
    <script src="js/mdj.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
            integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
            crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
            integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
            crossorigin="anonymous"></script>

</head>
<body>
<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a class="nav" href="index.php"><h3 class="text-center">Maison des Jeunes</h3></a>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a class="nav" href="index.php"><?php echo($data['nav_accueil']) ?></a>
            </li>
            <li>
                <a class="nav" href="proposNous.php"><?php echo($data['nav_apropos']) ?></a>
            </li>
            <li>
                <a class="nav" href="rejoindre.php"><?php echo($data['nav_rejoindre']) ?></a>
            </li>
            <!-- Si la personne est admin, afficher les menus admin -->
            <?php if (isset($_SESSION['statut']) && $_SESSION['statut'] == 2) {
                echo("
            <li class='active'>
                <a href='#SousMenuActivite' aria-expanded='false' data-toggle='collapse' class='dropdown-toggle'>
                " . $data['nav_gestion_activites'] . "
                </a>
                <ul class='collapse list-unstyled' id='SousMenuActivite'>
                    <li>
                        <a href='ajouterActivite.php'>" . $data['nav_acti_ajouter_activites'] . "</a>
                    </li>
                    <li>
                        <a href='modifierActivite.php'>" . $data['nav_acti_modifier_activites'] . "</a>
                    </li>
                    <li>
                        <a href='supprimerActivite.php'>" . $data['nav_acti_supprimer_activites'] . "</a>
                    </li>
                </ul>
            </li>
            <li class='active'>
                <a href='#SousMenuHoraire' aria-expanded='false' data-toggle='collapse' class='dropdown-toggle'>
                " . $data['nav_gestion_horaire'] . "
                </a>
                <ul class='collapse list-unstyled' id='SousMenuHoraire'>
                    <li>
                        <a href='modifierHoraire.php'>
                        " . $data['nav_hora_modifier'] . "
                        </a>
                    </li>
                </ul>
            </li>
            <li class='active'>
                <a href='#SousMenuUsager' aria-expanded='false' data-toggle='collapse' class='dropdown-toggle'>
                " . $data['nav_gestion_usager'] . "
                </a>
                <ul class='collapse list-unstyled' id='SousMenuUsager'>
                    <li>
                        <a href='activerUsager.php'>" . $data['nav_user_activer'] . "</a>
                    </li>
                    <li>
                        <a href='modifierUsager.php'>" . $data['nav_user_modifier'] . "</a>
                    </li>
                    <li>
                        <a href='supprimerUsager.php'>" . $data['nav_user_supprimer'] . "</a>
                    </li>
                </ul>
            </li>
            ");
            } ?>

        </ul>
        <ul class="list-unstyled CTAs">
            <?php
            if (isset($_SESSION['connecte']) && $_SESSION['connecte']) {
                echo("        
            <li>
                <a href='index.php?action=deconnexion' class='nav download'>" . $data['nav_deconnexion'] . "</a>
            </li>    
            ");
            } else {
                echo("
            <li>
                <a href='inscription.php' class='nav download'>" . $data['nav_inscription'] . "</a>
            </li>
            <li>
                <a href='connexion.php' class='nav download'>" . $data['nav_connexion'] . "</a>
            </li>
            ");
            }
            ?>

        </ul>
    </nav>
    <!-- Page Content Holder -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="navbar-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo($data['nav_activites']) ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="horaire.php"><?php echo($data['nav_horaire']) ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?langue=francais">[FR</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?langue=english">EN]</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
