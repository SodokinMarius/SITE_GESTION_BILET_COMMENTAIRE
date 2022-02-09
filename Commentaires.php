<?php session_start()?>
<!Doctype html>
<html>
    <head>
<title>Commentaires</title>
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
    box-shadow:10px red solid;
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
     ?>
     

     <!---Recuperation du billet--->
     <?php

      $Billet=$connexion->prepare("SELECT id_bil,titre,contenu,
      DATE_FORMAT(date_creation,'%d/%m/%Y à %Hh h %imin : %ss') AS date_create
     FROM billets WHERE id_bil=?" );

     $envoi1=$Billet->execute(array (htmlentities($_GET['billet'])));
     

     $Commentaire=$connexion->prepare("SELECT id_com,id_billet,auteur,commentaire,
     DATE_FORMAT(date_commentaire,'%d/%m/%Y à %Hh h %imin : %ss') AS date_comment
     FROM commentaires WHERE id_billet = ?");
    
    $envoi2=$Commentaire->execute(array( htmlentities($_GET['billet'])));
    $donnes=$Billet->fetch();
     ?>
       
     <!--Affichage des Résultats---->
     <div class="Billet">
      <?php if (empty($donnes)){
          echo 'Ce billet n\'existe pas ! Merci de choisir autre';
      } else {?>
         
        <h3><?php echo htmlspecialchars($donnes['titre']).'     à '. htmlspecialchars($donnes['date_create']) ;?></h3><br>
         <p><?php echo nl2br(htmlspecialchars($donnes['contenu']));
         } ?><br></p>
      
    </div><br><br><br>
    <div class="Commentaire">
       
    <?php while($temp=$Commentaire->fetch()){ ?>
        <?php if (empty($temp)){
          echo 'Le Billet n\existe pas ! Donc Pas de contenu';
      } else {?>
    <h3><?php echo htmlspecialchars($temp['auteur']).'     à '. htmlspecialchars($temp['date_comment']) ;?></h3><br>
         <p><?php echo nl2br(htmlspecialchars($temp['commentaire']));
          }}?><br></p>

    </div>

           <?php $Commentaire->CloseCursor();
           /*Alogorithmes de hashage et fonctions
           echo '<pre>';
        echo print_r(hash_algos());
           echo '</pre>';*/?>
        
        
     
     <p><a href= "Traitement_affichageBillets.php">>>></p>
</body>
</html>