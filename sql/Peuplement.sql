set schema 'Alizon';

--
-- Peuplement de la table _Client
--
insert into Alizon._Client(nom,prenom,mail,mot_de_passe,tel,date_naissance) values ('Doe','John','DoeJohn@gmail.com','123456','0123456789','1990-01-01');
insert into Alizon._Client(nom,prenom,mail,mot_de_passe,tel,date_naissance) values ('Doe','Jane','DoeJane@gmail.com','123456','0123456788','1990-02-01');
insert into Alizon._Client(nom,prenom,mail,mot_de_passe,tel,date_naissance) values ('Doe','Jack','DoeJack@gmail.com','123456','0123456787','1990-03-01');
INSERT INTO Alizon._client (nom, prenom, mail, tel, date_naissance, mot_de_passe) VALUES ('$nom', '$prenom', '$ema', '$telephone', '2003-06-02', '$mdp');

insert into Alizon._vendeur(nom,hash) VALUES ('Cobrec','b1802cee3f64d16df4fba4f28a4b5fdb');
insert into Alizon._vendeur(nom,hash) Values ('Autre Vendeur','a43e190ee2adeebd832e1ef82dcf0c2a');

--
-- Peuplement de la table _Categorie
--
insert into Alizon._Categorie(libelle) values ('Nourriture');
insert into Alizon._Categorie(libelle) values ('Boisson');

--
-- Peuplement de la table _Taxe
--
insert into Alizon._Taxe(code_taxe,taux) values ('T20',20.0);
insert into Alizon._Taxe(code_taxe,taux) values ('T10',10.0);
insert into Alizon._Taxe(code_taxe,taux) values ('T5',5.0);

--
-- Peuplement de la table _Produit
--
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Petit Beurre','Le petit beurre est l''un des gâteaux le plus connu des français, notamment des bretons. Il est principalement fait de beurre et de lait. Il mesure 65 mm de long, 54 mm de large et 6,5 mm d''épaisseur pour un poids unitaire de 8,33 g. Vendu par paquet de 16',true,10.0,'T10',10,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Kouign Amann','Le Kouign-amann, pur produit du Finistère, a été créée a la boulangerie des Crozon à Douarnenez, il est fait a base de sucre, beure et de pate a pain. Malgrés ses nombreuses déclinaisons, a la pistache, chocolat, aux amandes ? son gout nature reste un incontournable de nottre belle région et saura vous contenter dans votre quête de gras.',false,20.0,'T5',20,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Crêpes','Les crépes bretonnes font entiérement partie de l''histoire de la bretagne, a déguster salé ou sucré, elles restent incontournable. Elles sont faite a base de farine, oeuf, sucre et beure, et conféctionné dans un bilig.',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Glaces à la Fraise','Sorbet glacé goût fraise, parfait pour se rafraichir en été. Fabriqué à partir de fraises directement issues des fraiseraies de Plougastel. Convient aux adultes comme aux enfants, mais attention à ne pas se bruler. Contient une Barquette de 900ML de Sorbet Fraise.',true,30.0,'T20',30,false,2);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (2,'Cidre','Boisson alcolisée titrant entre 2% vol. et 8% vol. d''alcool, obtenue à partir de la fermentation de jus de pomme. Ce délicieux Cidre est frabriqué en Bretagne directement issu de la Distillerie Warenghem. Contient une Bouteille de 1L. <br> <br> ?Interdiction de vente de boissons alcooliques aux mineurs de moins de 18 ans - Code de la santé publique, Art. L.3342-1 et L.3353-3. L''abus d''alcool est dangereux pour la santé. A consommer avec modération.?',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Moule','Moules de Bouchot directement issues de la baie de Saint-Brieuc, prêtes pour la cuisson. Peuvent se déguster de plusieurs façons, comme à la Bretonne, au Curry ou encore Marinières. Contient environ 1KG de moules.',true,30.0,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Pomme','Un sac de pomme venant tout droit du Verger du Menez, nos pommes sont BIO et produites dans le respect de la nature et de l''environnement.',true,5,'T20',30,false,1);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (1,'Haribo','Avec leurs textures tendres, leurs couleurs vives et leur goûts uniques, les adorables bonbons ours HARIBO sont une valeur sûre. Faites-vous plaisir et partager ces savoureux bonbons avec vos proches.',true,1.5,'T20',30,false,2);
insert into Alizon._Produit(ID_Categorie,libelle,descr,sponsorise,prix_HT,code_taxe,quantite_stock,masquer,id_vendeur) values (2,'Breizh Cola','La recette originale, créée en 2002. Son secret ? Un dosage parfait des ingrédients, lui donnant de fines bulles. Un gout plébiscité par les consommateurs depuis 20 ans !',true,30.0,'T20',30,false,1);


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
