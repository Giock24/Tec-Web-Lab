
<section>
    <h2>Autori del Blog</h2>
        <table>
            <tr>
                <th id="autore">Autore</th><th id="email">Email</th><th id="argomenti">Argomenti</th>
            </tr>
            <?php foreach($templateParams["autori"] as $autore): ?>
                <tr>
                    <th id="1"><?php echo $autore["nome"]; ?></th>
                    <td headers="email 1"><?php echo $autore["username"];?></td>
                    <td headers="argomenti 1"><?php echo $autore["argomenti"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
</section>

