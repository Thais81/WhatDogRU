<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre devis Roofline</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./web/assets/css/style.css">
</head>

<body>
    <?php
    // Récupérer le paramètre 'page' depuis l'URL ou définir 'home' comme valeur par défaut
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    // Liste des pages autorisées
    $allowedPages = ['contact', 'goodBye', 'site', 'home'];

    // Validation de la page demandée
    if (!in_array($page, $allowedPages)) {
        // Page 404 en cas de page invalide
        $page = '404';
    }

    // Inclusion de l'en-tête
    include 'web/views/header.php';

    // Inclusion de la page demandée
    switch ($page) {
        case 'contact':
            include 'web/views/contact.php';
            break;
        case 'goodBye':
            include 'web/views/goodBye.php';
            break;
        case 'site':
            include 'web/views/home.php';
            break;
        case '404':
            include 'web/views/404.php';
            break;
        case 'home':
        default:
            include 'web/views/questionnaire.php';
            break;
    }

    // Inclusion du pied de page
    include 'web/views/footer.php';
    ?>
</body>

</html>