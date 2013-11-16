<!DOCTYPE HTML>
<html lang="NL-be">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('styles/main.css'); ?>" type="text/css" media="screen"/>
        <title>Taken</title>
    </head>
    <body>
        <?php include('templates/header.php'); ?>
        <section>
            <h1>Behaalde Punten</h1>
            <table style="width: 90%; text-align: left; margin:auto; padding:1%;">
                <tr>
                    <th>Naam</th>
                    <th>Omschrijving</th>
                    <th>Behaald</th>
                    <th>Maximum</th>
                </tr>
                
                <?php foreach($tasks as $row) {?>
                    <tr>
                        <td><?php echo $row['naam']; ?></td>
                        <td><?php echo $row['omschrijving']; ?></td>
                        <td><?php echo $row['puntbehaald']; ?></td>
                        <td><?php echo $row['puntmogelijk']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </section>
    <?php include('templates/footer.php'); ?>
    </body>
</html>