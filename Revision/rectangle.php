<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rectangle</title>
</head>
<body>
    <center>
        <h1>Exercice Rectangle</h1>
        <form method="post">
            Longueur : <br/>
            <input type="tet" name="lg"><br/>
            Largeur : <br/>
            <input type="tet" name="lr"><br/>
            <input type="submit" name="Calculer" value="Calculer">
        </form>
        <?php
        if (isset($_POST['Calculer'])) {
            $lg = $_POST['lg'];
            $lr = $_POST['lr'];
            $p = 2*($lg + $lr);
            $s = $lg * $lr;
            printf("La surfacce : %f <br/>", $s);
            printf( "Le perimetre : %f",$p);
        }
        ?>
    </center>
</body>
</html>