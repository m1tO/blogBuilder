<html>
        <head>
                <title>LogOut</title>
        <?php
                        /* Connessione al Server */
                        include ("../config.php");
                ?>
        </head>
    <body>
    <!-- Inizio Controllo Login -->
                <?php
                        session_start();
                        session_regenerate_id(TRUE);

                        session_destroy();
                        ?><meta http-equiv="refresh" content="1; url=../index.php"><?php
                ?>
    </body>
</html>
