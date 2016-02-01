<form action="<?php echo DIR;?>ajouter" method="POST" enctype="multipart/form-data">
    <label>Nom :</label><input type="text" name="nom" /><br />
    <label>Style :</label><input type="text" name="style" /><br />
    <label>Fichier :</label><input type="file" name="fichier"/><br />
    <input type="submit" value="Ajouter" />
</form>