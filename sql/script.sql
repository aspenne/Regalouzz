set schema 'Alizon';

SELECT count(*)  FROM alizon._panier WHERE id_client = 6;

SELECT num, rue, ville, code_postal, pays FROM alizon._adresse WHERE id_client = 6;

insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (10,'rue de la paix','Lannion','22700','France',6);
insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (15,'rue de metz','Metz','59000','France',6);
insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (1,'Quartier','Jean-Mac�','94000','France',6);

insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (10,'rue de la paix','Lannion','22700','France',7);
insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values (15,'rue de metz','Metz','59000','France',7);

insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (1, 6, 5, 5, '2018-01-01', 50, 6);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (2, 6, 3, 3, '2018-02-01', 55, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (3, 6, 3, 1, '2018-03-01', 55, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (4, 6, 5, 5, '2019-02-01', 55, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (5, 6, 2, 2, '2020-02-01', 55, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (5, 6, 2, 2, '2020-02-01', 55, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (6, 6, 2, 2, '2020-02-01', 58, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (7, 6, 2, 2, '2020-02-01', 40, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (8, 6, 2, 2, '2020-02-01', 25, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (9, 6, 2, 2, '2020-02-01', 21, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (10, 6, 2, 2,'2020-02-01', 14, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (11, 6, 2, 2, '2020-02-01', 47, 2);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (12, 6, 2, 2, '2020-02-01', 100, 1);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (13, 6, 2, 2, '2020-02-01', 2, 80);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (14, 6, 7, 8, '2020-02-01', 55, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (15, 6, 8, 7, '2000-02-01', 55, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (16, 6, 8, 7, '2020-11-30', 55, 8);
insert into Alizon._commande(id_commande, id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) values (18, 6, 8, 7, '2022-12-30', 55, 8);


delete from Alizon._commande where id_adresse = 5; 

select * --adresselivr 
from Alizon._commande natural join Alizon._adresse 
where id_client = 6
order by date_commande DESC;

SELECT num, rue, ville, code_postal, pays FROM alizon._adresse WHERE id_client = 6; 

SELECT num, rue, ville, code_postal, pays FROM alizon._adresse WHERE id_adresse = 5;

SELECT id_adresse, num, rue, ville, code_postal, pays FROM alizon._adresse WHERE id_client = 6 order by id_adresse ASC
FETCH FIRST 1 ROWS ONLY;

SELECT num, rue, ville, code_postal, pays FROM alizon._adresse WHERE id_adresse = $idclient;

delete from alizon._adresse where id_client = 6;

delete from alizon._commande where id_client = 5;


delete from alizon._commande;

SELECT adressefact from Alizon._commande natural join Alizon._adresse where id_client = 6;

SELECT libelle,prix_ttc,prix_ht,quantite_stock,id_client,id_produit FROM alizon.produit 
NATURAL JOIN alizon._listedesouhait 
NATURAL JOIN alizon._taxe 
NATURAL JOIN alizon._produit 
WHERE id_client = 6;

