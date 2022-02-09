CREATE DATABASE Billet_Commentaires;

CREATE TABLE IF NOT EXISTS BILLETS(
    id_bil int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titre VARCHAR(255),
    contenu text,
    date_creation datetime);
CREATE TABLE IF NOT EXISTS COMMENTAIRES(
    id_com int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_billet int,
    auteur VARCHAR(255),
    commentaire text,
    date_commentaire datetime,
     FOREIGN KEY (id_billet) REFERENCES BILLETS(id_bil));
