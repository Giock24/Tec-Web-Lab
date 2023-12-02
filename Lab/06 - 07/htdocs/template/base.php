<!DOCTYPE html>
<html lang="it">
<head>
    <!--per mettere html e php insieme, basta mettere tra i tag html ?php CODICE PHP ?>-->
    <title><?php echo $templateParams["titolo"]; ?></title>
    <meta charset="UTF-8"/>
    <!--rel è un attributo che stabilisce la relazione che c'è tra
        questo file il file css-->
    <!--type serve per specificare il tipo di file con cui stiamo
        lavorando-->    
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <header>
        <h1>Blog di Tecnologie Web</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li><li><a href="archivio.html">Archivio</a></li><li><a href="contatti.php">Contatti</a></li><li><a href="login.html">Login</a></li>
        </ul>
    </nav>
    <main>
        <?php 
            require($templateParams["nome"]);
        ?>
    </main><aside>
        <section>
            <h2>Post Casuali</h2>
            <ul>
                <?php foreach($templateParams["articolicasuali"] as $articolocasuale): ?>
                <li>
                    <img src="<?php echo UPLOAD_DIR.$articolocasuale["imgarticolo"]; ?>" alt="" />
                    <a href="#"><?php echo $articolocasuale["titoloarticolo"]; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <section>
            <h2>Categorie</h2>
            <ul>
                <?php foreach($templateParams["categorie"] as $categoria): ?>
                    <li><a href="#"><?php echo $categoria["nomecategoria"]; ?></a></li>
                <?php endforeach; ?> 
            </ul>
        </section>
    </aside>
    <footer>
        <p>Tecnologie Web - A.A. 2021/2022</p>
    </footer>
</body>
</html>