<php session_start() ?>
<!Doctype html>
<html>
    <head>
<title>Traitement de l'Inscription des Elèves</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8" />
 </head>
 <body>
  

 <form action="Traitement_affichageBillets.php" method="POST">
     <fieldset>
         <legend>BILLETS</legend>
         <label for="titre">Titre du billet : </label>
         <input type="text" name="titre" placeholder="Titre du Billet"><br><br>
         <label for="contenu">Contenu : </label>
         <textarea name="contenu" placeholder="Saisir le contenu du billet"></textarea><br><br>
         <label for="date">Date de création : </label>
         <input type="date" name="date_create" placeholder="Ex : 12/12/2020"><br><br>
         
</fielset><br><br><br>
<fielset>
    <legend>Commentaires</legend>
    <label for="billet_associé">Billet associé</label>
        <input type="number" name="id_billet" placeholder="billet associé"><br><br>
        <label for="auteur">Billet associé</label>
        <input type="text" name="auteur" placeholder="nom_Auteur"><br><br>
        <label for="date">Date de commentaire : </label>
         <input type="date" name="date_comment" placeholder="Ex : 21/08/2021"><br><br>
    <label for="comment">Les commentaires sur le billets : </label>
     <textarea name="comment" placeholder="Comentaires"></textarea><br><br>
</fieldset><br><br>
<input type="submit" value="Envoyer"> 
<input type="reset" value="Annuler">
</form>
 
</body>
</html>