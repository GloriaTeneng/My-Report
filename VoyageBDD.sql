/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  2/27/2026 1:04:37 AM                     */
/*==============================================================*/



/*==============================================================*/
/* Table : AGENCE                                               */
/*==============================================================*/
create table AGENCE
(
   MATRICULE_AGENCE     varchar(15) not null,
   ID_VOYAGE            varchar(10) not null,
   NOM_AGENCE           varchar(30),
   VILLE_AGENCE         varchar(17),
   QUARTIER_AGENCE      varchar(23),
   TELEPHONE_AGENCE     INT
);

alter table AGENCE
   add primary key (MATRICULE_AGENCE, ID_VOYAGE);

/*==============================================================*/
/* Table : BAGAGE                                               */
/*==============================================================*/
create table BAGAGE
(
   NUMIDENTIFICATION_BAGAGE bigint not null,
   POIDS_BAGAGE         varchar(23),
   STATUT_BAGAGE        text
);

alter table BAGAGE
   add primary key (NUMIDENTIFICATION_BAGAGE);

/*==============================================================*/
/* Table : BUS                                                  */
/*==============================================================*/
create table BUS
(
   MATRICULE_BUS        INT not null,
   ID_VOYAGE            varchar(10) not null,
   NUMERO_BUS           char(1),
   TYPE_BUS             varchar(16),
   CAPACITE_BUS         varchar(15),
   STATUT_BUS           varchar(40)
);

alter table BUS
   add primary key (MATRICULE_BUS);

/*==============================================================*/
/* Table : CHARGEUR                                             */
/*==============================================================*/
create table CHARGEUR
(
   NUMCNI               bigint not null,
   NOM_CHARGEUR         varchar(15),
   ZONNE_SERVICE        time
);

alter table CHARGEUR
   add primary key (NUMCNI);

/*==============================================================*/
/* Table : CHAUFFEUR                                            */
/*==============================================================*/
create table CHAUFFEUR
(
   NUMCNI_CHAUFFEUR     INT not null,
   PERMIS_CHAUFFEUR     varchar(25),
   TYPE_PERMIS          varchar(23),
   EXPERIENCE_CHAUFFEUR varchar(34)
);

alter table CHAUFFEUR
   add primary key (NUMCNI_CHAUFFEUR);

/*==============================================================*/
/* Table : CLIENT                                               */
/*==============================================================*/
create table CLIENT
(
   NUMCNI_CLIENT        INT1 not null,
   NOM_CLIENT           text,
   PRENOM_CLIENT        text,
   EMAIL_CLIENT         varchar(40)
);

alter table CLIENT
   add primary key (NUMCNI_CLIENT);

/*==============================================================*/
/* Table : CONTENIR                                             */
/*==============================================================*/
create table CONTENIR
(
   ID_RESERVATION       varchar(50) not null,
   ID_VOYAGE            varchar(10) not null,
   NUMIDENTIFICATION_BAGAGE bigint not null
);

alter table CONTENIR
   add primary key (ID_RESERVATION, ID_VOYAGE, NUMIDENTIFICATION_BAGAGE);

/*==============================================================*/
/* Table : CONTROLE                                             */
/*==============================================================*/
create table CONTROLE
(
   ID_RESERVATION       varchar(40) not null,
   NUMCNI_CONT          INT not null
);

alter table CONTROLE
   add primary key (ID_RESERVATION, NUMCNI_CONT);

/*==============================================================*/
/* Table : CONTROLLEUR                                          */
/*==============================================================*/
create table CONTROLLEUR
(
   NUMCNI_CONT          INT not null,
   NOM_CONT             text,
   MATRICULE_CONT       varchar(20)
);

alter table CONTROLLEUR
   add primary key (NUMCNI_CONT);

/*==============================================================*/
/* Table : ENREGISTRE                                           */
/*==============================================================*/
create table ENREGISTRE
(
   NUMIDENTIFICATION_BAGAGE bigint not null,
   NUMCNI               bigint not null
);

alter table ENREGISTRE
   add primary key (NUMIDENTIFICATION_BAGAGE, NUMCNI);

/*==============================================================*/
/* Table : EST_EFFECTUE_A                                       */
/*==============================================================*/
create table EST_EFFECTUE_A
(
   ID_VOYAGE            varchar(10) not null,
   NUMIDENTIFICATION_BAGAGE bigint not null
);

alter table EST_EFFECTUE_A
   add primary key (ID_VOYAGE, NUMIDENTIFICATION_BAGAGE);

/*==============================================================*/
/* Table : FAIRE                                                */
/*==============================================================*/
create table FAIRE
(
   ID_RESERVATION       varchar(10) not null,
   NUMEROCNI_UTILISATEUR bigint not null
);

alter table FAIRE
   add primary key (ID_RESERVATION, NUMEROCNI_UTILISATEUR);

/*==============================================================*/
/* Table : PAIEMENT                                             */
/*==============================================================*/
create table PAIEMENT
(
   REFERENCE_PAIEMENT   INT not null,
   RES_ID_RESERVATION   varchar(50) not null,
   ID_VOYAGE            varchar(10) not null,
   MOYEN_PAIEMENT       varchar(35),
   DATE_PAIEMEMT        date,
   MONTANT_PAIEMENT     bigint
);

alter table PAIEMENT
   add primary key (REFERENCE_PAIEMENT);

/*==============================================================*/
/* Table : POSSEDE                                              */
/*==============================================================*/
create table POSSEDE
(
   NUMCNI_CLIENT        bigint not null,
   NUMIDENTIFICATION_BAGAGE bigint not null
);

alter table POSSEDE
   add primary key (NUMCNI_CLIENT, NUMIDENTIFICATION_BAGAGE);

/*==============================================================*/
/* Table : RESERVATION                                          */
/*==============================================================*/
create table RESERVATION
(
   ID_RESERVATION       varchar(50) not null,
   ID_VOYAGE            varchar(10) not null,
   NUMCNI_CLIENT        INT not null,
   DATE_RESREVATION     date,
   SIEGES_RESERVATION   int,
   MONTANT_TOTAL        bigint,
   STATUT_RESREVATION   varchar(46),
   QR_RESREVATION       decimal(8,0)
);

alter table RESERVATION
   add primary key (ID_RESERVATION, ID_VOYAGE);

/*==============================================================*/
/* Table : TRAJETS                                              */
/*==============================================================*/
create table TRAJETS
(
   ID_TRAJET            varchar(74) not null,
   VILLE_DEPART         varchar(56),
   VILLE_ARRIVE         varchar(34),
   DISTANCE_TRAJET      varchar(10),
   DUREE_ESTIMEE        time
);

alter table TRAJETS
   add primary key (ID_TRAJET);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   NUMEROCNI_UTILISATEUR bigint not null,
   NOM_UTILISATEUR      varchar(25),
   PRENOM_UTILISATEUR   varchar(25),
   EMAIL_UTILISATEUR    varchar(40),
   TELEPHONE_UTILISATEUR INT,
   MOTDEPASSE_UTILISATEUR varchar(50)
);

alter table UTILISATEUR
   add primary key (NUMEROCNI_UTILISATEUR);

/*==============================================================*/
/* Table : VOYAGES                                              */
/*==============================================================*/
create table VOYAGES
(
   ID_VOYAGE            varchar(10) not null,
   ID_TRAJET            varchar(74) not null,
   NUMCNI_CHAUFFEUR     INT not null,
   DATEDEPART           date,
   HEUREDEPART          time,
   PRIX_VIP             float(8,2),
   PRIX_CLASSIQUE       float(8,2),
   STATUT_VOYAGE        varchar(44)
);

alter table VOYAGES
   add primary key (ID_VOYAGE);

alter table AGENCE add constraint FK_ESR_GERE foreign key (ID_VOYAGE)
      references VOYAGES (ID_VOYAGE) on delete restrict on update restrict;

alter table BUS add constraint FK_UTILISE foreign key (ID_VOYAGE)
      references VOYAGES (ID_VOYAGE) on delete restrict on update restrict;

alter table CONTENIR add constraint FK_CONTENIR2 foreign key (ID_RESERVATION, ID_VOYAGE)
      references RESERVATION (ID_RESERVATION, ID_VOYAGE) on delete restrict on update restrict;

alter table CONTROLE add constraint FK_CONTROLE foreign key (NUMCNI_CONT)
      references CONTROLLEUR (NUMCNI_CONT) on delete restrict on update restrict;

alter table ENREGISTRE add constraint FK_ENREGISTRE2 foreign key (NUMIDENTIFICATION_BAGAGE)
      references BAGAGE (NUMIDENTIFICATION_BAGAGE) on delete restrict on update restrict;

alter table EST_EFFECTUE_A add constraint FK_EST_EFFECTUE_A2 foreign key (ID_VOYAGE)
      references VOYAGES (ID_VOYAGE) on delete restrict on update restrict;

alter table FAIRE add constraint FK_FAIRE foreign key (NUMEROCNI_UTILISATEUR)
      references UTILISATEUR (NUMEROCNI_UTILISATEUR) on delete restrict on update restrict;

alter table PAIEMENT add constraint FK_PAIEMENT_APPARTIEN_RESERVAT2 foreign key (RES_ID_RESERVATION, ID_VOYAGE)
      references RESERVATION (ID_RESERVATION, ID_VOYAGE) on delete restrict on update restrict;

alter table POSSEDE add constraint FK_POSSEDE foreign key (NUMIDENTIFICATION_BAGAGE)
      references BAGAGE (NUMIDENTIFICATION_BAGAGE) on delete restrict on update restrict;

alter table RESERVATION add constraint FK_CONCERNE foreign key (ID_VOYAGE)
      references VOYAGES (ID_VOYAGE) on delete restrict on update restrict;

alter table RESERVATION add constraint FK_EFFECTUE foreign key (NUMCNI_CLIENT)
      references CLIENT (NUMCNI_CLIENT) on delete restrict on update restrict;

alter table VOYAGES add constraint FK_CONDUIT foreign key (NUMCNI_CHAUFFEUR)
      references CHAUFFEUR (NUMCNI_CHAUFFEUR) on delete restrict on update restrict;

alter table VOYAGES add constraint FK_SUIT foreign key (ID_TRAJET)
      references TRAJETS (ID_TRAJET) on delete restrict on update restrict;

