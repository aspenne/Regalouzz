drop schema if exists Alizon cascade;
create schema Alizon;
set schema 'Alizon';


create table Alizon._Client(
  ID_Client       serial        constraint client_pk primary key,
  mot_de_passe    varchar(32)   not null,
  nom             varchar(20)   not null,
  prenom          varchar(20)   not null,
  mail            varchar(320)  not null unique,
  tel             varchar(10)   not null,
  date_naissance  date          not null
);

create table Alizon._Produit(
  ID_Produit      serial          constraint produit_pk primary key,
  ID_Categorie    int             not null,
  libelle         varchar(100)    not null,
  descr           varchar(1000)   not null,
  sponsorise      boolean         not null,
  prix_HT         float           not null,
  code_taxe       varchar(3)      not null,
  quantite_stock  int             not null,
  masquer         boolean         not null
);

CREATE TABLE Alizon._Taxe(
  code_taxe varchar(3)  constraint taxe_pk primary key,
  taux      float       not null
);

CREATE TABLE Alizon._Historique_Prix(
  ID_Produit  int   not null,
  date_prix   date  not null,
  prix_HT     float not null,
  code_taxe   varchar(3) not null,
  constraint historique_prix_pk primary key (ID_Produit, date_prix)
);

CREATE TABLE Alizon._Adresse(
  ID_Adresse  serial        constraint adresse_pk primary key,
  num         varchar(5)  not null,
  rue         varchar(100)  not null,
  ville       varchar(100)  not null,
  code_postal varchar(5)    not null,
  pays        varchar(100)  not null,
  ID_Client   int           not null
);

CREATE TABLE Alizon._Panier(
  ID_Client   int not null,
  ID_Produit  int not null,
  quantite    int not null,
  constraint panier_pk primary key (ID_Client, ID_Produit)
);

CREATE TABLE Alizon._ListeDeSouhait(
  ID_Client   int not null,
  ID_Produit  int not null,
  constraint liste_desouhait_pk primary key (ID_Client, ID_Produit)
);

CREATE TABLE Alizon._Avis(
  ID_Avis     serial  constraint avis_pk primary key,
  ID_Client   int     not null,
  ID_Produit  int     not null,
  note        int     not null,
  commentaire varchar(1000) not null
);

CREATE TABLE Alizon._Categorie(
  ID_Categorie  serial        constraint categorie_pk primary key,
  libelle       varchar(100)  not null
);

CREATE TABLE Alizon._Commande(
  ID_Commande   serial  constraint commande_pk primary key,
  ID_Client     int     not null,
  AdresseFact   int     not null,
  AdresseLivr   int     not null,
  date_commande date    not null,
  prix_total    float   not null,
  frais_port    float   not null
);

CREATE TABLE Alizon._DetailCommande(
  ID_Commande int     not null,
  ID_Produit  int     not null,
  quantite    int     not null,
  prix_TTC     float   not null,
  constraint detail_commande_pk primary key (ID_Commande, ID_Produit)
);

-- Contraintes Avis
  ALTER TABLE Alizon._Avis 
    ADD CONSTRAINT Avis_fk_Client
    FOREIGN KEY (ID_Client) 
    REFERENCES Alizon._Client(ID_Client);

  ALTER TABLE Alizon._Avis 
    ADD CONSTRAINT Avis_fk_Produit
    FOREIGN KEY (ID_Produit) 
    REFERENCES Alizon._Produit(ID_Produit);

-- Contraintes ListeDeSouhait
  ALTER TABLE Alizon._ListeDeSouhait 
    ADD CONSTRAINT ListeDeSouhait_fk_Client
    FOREIGN KEY (ID_Client) 
    REFERENCES Alizon._Client(ID_Client);

  ALTER TABLE Alizon._ListeDeSouhait 
    ADD CONSTRAINT ListeDeSouhait_fk_Produit
    FOREIGN KEY (ID_Produit) 
    REFERENCES Alizon._Produit(ID_Produit);

-- Contraintes Panier
  ALTER TABLE Alizon._Panier 
    ADD CONSTRAINT Panier_fk_Client
    FOREIGN KEY (ID_Client) 
    REFERENCES Alizon._Client(ID_Client);

  ALTER TABLE Alizon._Panier 
    ADD CONSTRAINT Panier_fk_Produit
    FOREIGN KEY (ID_Produit) 
    REFERENCES Alizon._Produit(ID_Produit);

-- Contraintes Adresse
  ALTER TABLE Alizon._Adresse 
    ADD CONSTRAINT Adresse_fk_Client
    FOREIGN KEY (ID_Client) 
    REFERENCES Alizon._Client(ID_Client);

-- Contraintes Historique_Prix
  ALTER TABLE Alizon._Historique_Prix 
    ADD CONSTRAINT Historique_Prix_fk_Produit
    FOREIGN KEY (ID_Produit) 
    REFERENCES Alizon._Produit(ID_Produit);
  
  ALTER TABLE Alizon._Historique_Prix
    ADD CONSTRAINT Historique_Prix_fk_Taxe
    FOREIGN KEY (code_taxe)
    REFERENCES Alizon._Taxe(code_taxe);

-- Contraintes Produit
  ALTER TABLE Alizon._Produit 
    ADD CONSTRAINT Produit_fk_Categorie
    FOREIGN KEY (ID_Categorie) 
    REFERENCES Alizon._Categorie(ID_Categorie);

  ALTER TABLE Alizon._Produit 
    ADD CONSTRAINT Produit_fk_Taxe
    FOREIGN KEY (code_taxe) 
    REFERENCES Alizon._Taxe(code_taxe);

-- Contraintes Commande
 ALTER TABLE Alizon._Commande 
    ADD CONSTRAINT Commande_fk_Client
    FOREIGN KEY (ID_Client) 
    REFERENCES Alizon._Client(ID_Client);

  ALTER TABLE Alizon._Commande 
    ADD CONSTRAINT Commande_fk_AdresseFact
    FOREIGN KEY (AdresseFact) 
    REFERENCES Alizon._Adresse(ID_Adresse);

  ALTER TABLE Alizon._Commande 
    ADD CONSTRAINT Commande_fk_AdresseLivr
    FOREIGN KEY (AdresseLivr) 
    REFERENCES Alizon._Adresse(ID_Adresse);

-- Contraintes DetailCommande
  ALTER TABLE Alizon._DetailCommande 
    ADD CONSTRAINT DetailCommande_fk_Commande
    FOREIGN KEY (ID_Commande) 
    REFERENCES Alizon._Commande(ID_Commande);

  ALTER TABLE Alizon._DetailCommande 
    ADD CONSTRAINT DetailCommande_fk_Produit
    FOREIGN KEY (ID_Produit) 
    REFERENCES Alizon._Produit(ID_Produit);

--Creation des vues

CREATE OR REPLACE VIEW Alizon.Produit AS
  Select id_produit,id_categorie,libelle,descr,sponsorise,masquer,quantite_stock,prix_ht,prix_ht+prix_ht*taux/100 as prix_ttc from (Alizon._Produit as P natural join Alizon._taxe as T);
