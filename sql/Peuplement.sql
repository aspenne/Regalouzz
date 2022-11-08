set schema 'Alizon';

--
-- Peuplement de la table _Client
--
insert into Alizon._Client(nom,prenom,mail,mot_de_passe,tel,date_naissance) values ('Doe','John','DoeJohn@gmail.com','123456','0123456789','1990-01-01');
insert into Alizon._Client(nom,prenom,mail,mot_de_passe,tel,date_naissance) values ('Doe','Jane','DoeJane@gmail.com','123456','0123456788','1990-02-01');
insert into Alizon._Client(nom,prenom,mail,mot_de_passe,tel,date_naissance) values ('Doe','Jack','DoeJack@gmail.com','123456','0123456787','1990-03-01');
INSERT INTO Alizon._client (nom, prenom, mail, tel, date_naissance, mot_de_passe) VALUES ('$nom', '$prenom', '$ema', '$telephone', '2003-06-02', '$mdp');

insert into Alizon._vendeur(nom,hash) VALUES ('Cobrec','b1802cee3f64d16df4fba4f28a4b5fdb');

--
-- Peuplement de la table _Categorie
--
insert into Alizon._Categorie(libelle) values ('Categorie 1');
insert into Alizon._Categorie(libelle) values ('Categorie 2');
insert into Alizon._Categorie(libelle) values ('Categorie 3');

--
-- Peuplement de la table _Taxe
--
insert into Alizon._Taxe(code_taxe,taux) values ('T20',20.0);
insert into Alizon._Taxe(code_taxe,taux) values ('T10',10.0);
insert into Alizon._Taxe(code_taxe,taux) values ('T5',5.0);

--
-- Peuplement de la table _Produit
--
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 1','Description du produit 1',true,10.0,'T10',10,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 2','Description du produit 2',false,20.0,'T5',20,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 3','Description du produit 3',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 4','Description du produit 4',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 5','Description du produit 5',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 6','Description du produit 6',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 7','Description du produit 7',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 8','Description du produit 8',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Produit 9','Description du produit 9',true,30.0,'T20',30,false,1);


--
-- Peuplement de la table _Historique_Prix
--
insert into Alizon._Historique_Prix(ID_Produit,date_prix,prix_HT,code_taxe) values (1,'2018-01-01',10.0,'T10');
insert into Alizon._Historique_Prix(ID_Produit,date_prix,prix_HT,code_taxe) values (1,'2018-02-01',20.0,'T10');
insert into Alizon._Historique_Prix(ID_Produit,date_prix,prix_HT,code_taxe) values (1,'2018-03-01',30.0,'T10');

--
-- Peuplement de la table _Adresse
--
insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (1,'rue 1','ville 1','12345','pays 1',1);
insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (1,'rue 2','ville 2','12345','pays 2',2);
insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (1,'rue 3','ville 3','12345','pays 3',3);
insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (1,'rue 4','ville 4','12345','pays 4',1);

--Peuplement de la table _ListeDeSouhait
insert into Alizon._ListeDeSouhait(ID_Client,ID_Produit) values (1,1);
insert into Alizon._ListeDeSouhait(ID_Client,ID_Produit) values (1,2);
insert into Alizon._ListeDeSouhait(ID_Client,ID_Produit) values (1,3);
insert into Alizon._ListeDeSouhait(ID_Client,ID_Produit) values (2,1);
insert into Alizon._ListeDeSouhait(ID_Client,ID_Produit) values (2,3);
insert into Alizon._ListeDeSouhait(ID_Client,ID_Produit) values (3,2);

--Peuplement de la table _Panier
insert into Alizon._Panier(ID_Client,ID_Produit,quantite) values (1,1,1);
insert into Alizon._Panier(ID_Client,ID_Produit,quantite) values (1,2,2);
insert into Alizon._Panier(ID_Client,ID_Produit,quantite) values (1,3,3);
insert into Alizon._Panier(ID_Client,ID_Produit,quantite) values (2,1,1);
insert into Alizon._Panier(ID_Client,ID_Produit,quantite) values (3,3,3);
