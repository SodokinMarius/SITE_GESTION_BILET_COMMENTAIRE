<php session_start() ?>
<!Doctype html>
<html>
    <head>
<title>Traitement de l'Inscription des Elèves</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8" />
<style>
    body{
        background-color: lightgreen;
    }
    .Billet,.Commentaire{
        width:50%;
        height: auto;
        background-color:grey;
        border: 2px groove yellow;
    box-shadow:5px red solid;
    margin-left:20%;
    margin-right:20%;
        
    }
   p{
        width:auto;
        height:20%;
        color: white;
        font-weight:bold;
    }
    h3{
        border:2px solid dashed;
        font-size:25px;
        font-weight:bold;
        text-transform:uppercase;
        font-family:arial;
    }
    </style>
 </head>
 <body>
     <?php
     try{
        $connexion=new PDO("mysql:host=localhost;dbname=billet_commentaires",'root','');
        $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $connexion->exec("SET NAMES UTF8");
        echo '<strong>Tout s\'est bien passé</strong>';
     }
     catch(PDOException $e){
         die('Erreur de connexion !'.$e->getMessage());
     }
     //Cote billet
     if(isset($_POST['titre']) AND isset($_POST['contenu']) AND isset($_POST['date_create'])
        AND (!empty($_POST['titre']) AND $_POST['contenu'] AND $_POST['date_create'])){

            if(isset($_POST['id_billet']) AND isset($_POST['auteur']) 
            AND isset($_POST['date_comment']) AND isset($_POST['comment']) 
            AND !empty($_POST['auteur']) AND !empty($_POST['comment'])){

             $request1=$connexion->prepare("INSERT INTO Billets(titre,contenu,date_creation)
                VALUES(?,?,?)");
        $insertion1=$request1->execute(array($_POST['titre'],$_POST['contenu'],$_POST['date_create']));

        $request2=$connexion->prepare("INSERT INTO commentaires(id_billet,auteur,commentaire,date_commentaire)
            VALUES(?,?,?,?)");

            $insertion2=$request2->execute(array($_POST['id_billet'],$_POST['auteur'],$_POST['comment'],$_POST['date_comment']));
            }
                
            //Demande des cinq derniers billets
            $dernierBillets=$connexion->query('SELECT  id_bil,titre,contenu,
            DATE_FORMAT(date_creation,\'%d/%m/%Y à %Hh:%imin : %ss\') AS date_creation
             FROM billets ORDER BY date_creation ASC LIMIT 0,20');

            echo '<br><strong>Affichage des cinq derniers billets</strong><br><br>';
            echo '<table border="2">';
            echo '<tr><th>Numero du Billet</th><th>Titre</th><th>Contenu</th><th>Date_creation</ht></tr>';
            while($temp=$dernierBillets->fetch()){
              ?>
              <p>
                <tr><td><?php echo htmlspecialchars($temp['id_bil'])?>
                </td><td><?php echo htmlspecialchars($temp['titre'])?>
                </td><td>
                <?php echo  htmlspecialchars($temp['contenu']) ?>
                </td><td><?php echo  htmlspecialchars($temp['date_creation'])?>
            </p>
                <!------Passage de l'ID du billet par l'URL-------->
                <a href="commentaires.php?billet=<?php echo htmlentities($temp['id_bil']); ?>"><br>ouvrir le commentaire</a></td></tr>
                <?php  }
            echo'</table>';
            $dernierBillets->CloseCursor();
            }
        else{
            header("Location:Formulaire_d'enregistrement.php");
        }    ?>
     
     <p><a href= "Affcihage_commentaires.php">>>></p>
</body>
</html>