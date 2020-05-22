#########################################################################
# Création d'un usager
insert into usager (prenom, nom, motPasse, courriel, statut)
values ('nancy', 'Bluteau', '12345', 'nancy.bluteau@collegealma.ca', 2);
# Attention, le mot de passe n'est pas crypté!

#########################################################################
# Création activités
insert into activite (nom, nbParticipantMin, nbParticipantMax, endroit)
values ('Tournoi de Poker', 4, 12, 'Chacun chez soi');
insert into activite (nom, nbParticipantMin, nbParticipantMax, endroit)
values ('Clair de lune', 8, 60, 'Salle de Quilles - Le Dallo');

### Création des tables -FG
create table activite
(
    idActivite       int auto_increment
        primary key,
    nom              varchar(45)  not null,
    nbParticipantMin int          not null,
    nbParticipantMax int          not null,
    endroit          varchar(75)  not null,
    description      varchar(250) null,
    lien             varchar(100) null
);

create table groupe
(
    idGroupe      smallint auto_increment
        primary key,
    noParticipant int null,
    noHoraire     int null
);

create table horaire
(
    idHoraire     int         null,
    dateActivite  date        not null,
    noActivite    int         null,
    endroit       varchar(75) null,
    noResponsable int         null,
    etat          int         null
);

create table usager
(
    idUsager        int auto_increment
        primary key,
    prenom          varchar(25)                         not null,
    nom             varchar(25)                         not null,
    motPasse        varchar(250)                        not null,
    courriel        varchar(50)                         not null,
    telephone       varchar(12)                         null,
    dateNaissance   date                                null,
    dateInscription timestamp default CURRENT_TIMESTAMP not null,
    statut          int       default 0                 not null,
    constraint usager_courriel_uindex
        unique (courriel)
);



