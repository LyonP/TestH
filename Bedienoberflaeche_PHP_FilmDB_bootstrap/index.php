<!-- Severin Scharinger -->
<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Teil 3 - PHP</title>
</head>
<body>
<nav>
    <?php
    include 'nav.php';
    ?>
</nav>
<div class="container">
    <main>
        <?php
        if(isset($_GET['seite']))
        {
            switch ($_GET['seite'])
            {
                case 'Startseite':
                    include 'Startseite.php';
                    break;
                case 'Filmsuche':
                    include 'Filmsuche.php';
                    break;
                case 'Schauspielersuche':
                    include 'Schauspielersuche.php';
                    break;
                default:
                    include 'Startseite.php';
            }
        }
        else
        {
            include 'Startseite.php';
        }
        ?>
    </main>
</div>
</body>
</html>