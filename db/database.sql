-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Wed Apr  8 18:39:41 2026 
-- * LUN file: C:\Users\S512FJEJ021T\Desktop\AlmaStudent - Aggiornato.lun 
-- * Schema: AlmaStudent_ER/LOGICO_FINALE 
-- ********************************************* 


-- Database Section
-- ________________ 

drop database AlmaStudent_ER;
create database AlmaStudent_ER;
use AlmaStudent_ER;


-- Tables Section
-- _____________ 

create table ADMIN (
     Utente varchar(100) not null,
     constraint FKPER_ADM_ID primary key (Utente));

create table Cambio_docente (
     Docente varchar(100) not null,
     Anno year not null,
	 Codice_Corso varchar(5) not null,
     constraint ID_Cambio_docente_ID primary key (Anno, Docente, Codice_Corso));

create table CHAT (
     Codice int not null auto_increment,
     Matricola_Studente varchar(10) not null,
     Docente varchar(100) not null,
     constraint SID_CHAT_ID unique (Matricola_Studente, Docente),
     constraint ID_CHAT_ID primary key (Codice));

create table CORSO (
     Codice varchar(5) not null ,
     Nome varchar(100) not null,
     Anno int not null,
     Semestre int not null,
     Codice_Facolta varchar(10) not null,
     Descrizione varchar(5000) not null,
     Descrizione_Breve varchar(1000) not null,
     constraint ID_CORSO_ID primary key (Codice));

create table DOCENTE (
     Utente varchar(100) not null,
     constraint FKPER_DOC_ID primary key (Utente));

create table FACOLTA (
     Codice varchar(4) not null,
     Nome varchar(100) not null,
     Dipartimento varchar(30) not null,
     Numero_Anni int not null,
     Campus varchar(100) not null,
     constraint ID_FACOLTA_ID primary key (Codice));

create table MATERIALE (
     Percorso varchar(250) not null,
     Matricola_Studente varchar(10) not null,
     Codice_Corso varchar(5) not null,
     constraint ID_MATERIALE_ID primary key (Percorso));

create table MESSAGGIO_CHAT (
     Codice int not null,
     Codice_Chat int not null,
     Mittente varchar(100) not null,
     Testo varchar(500) not null,
     Allegato varchar(1),
     constraint ID_MESSAGGIO_CHAT_ID primary key (Codice_Chat, Codice));

create table PERSONA (
     Utente varchar(100) not null,
     Password varchar(256) not null,
     Nome varchar(100) not null,
     Cognome varchar(100) not null,
     Ruolo varchar(10) not null,
     constraint ID_PERSONA_ID primary key (Utente));

create table Prenotazione (
     Codice_Ricevimento int not null,
     Matricola_Studente varchar(10) not null,
     Modalita_Scelta varchar(20) not null,
     constraint FKPre_RIC_ID primary key (Codice_Ricevimento));

create table RATING (
     Codice int not null auto_increment,
     Tipo varchar(10) not null,
     constraint ID_RATING_ID primary key (Codice));

create table RATING_CORSO (
     Codice int not null,
     Rating_Lezioni int not null,
     Rating_Materiale int not null,
     Rating_Esame int not null,
     constraint FKRAT_RAT_ID primary key (Codice));

create table RATING_DOCENTE (
     Codice int not null,
     Rating_Disponibilita int not null,
     Rating_Comprensibilita_Lezioni int not null,
     Rating_Interesse_Suscitato int not null,
     constraint FKRAT_RAT_1_ID primary key (Codice));

create table RATING_GENERALE (
     Codice_Corso varchar(5) not null,
     Anno year not null,
     Rating_Lezioni decimal(2,1) not null,
     Rating_Materiale decimal(2,1) not null,
     Rating_Esame decimal(2,1) not null,
     Rating_Disponibilita_Docenti decimal(2,1) not null,
     constraint IDRATING_GENERALE primary key (Codice_Corso, Anno));

create table REVIEW (
     Codice_Rating int not null,
     Testo varchar(1000) not null,
     Segnalazione tinyint not null,
     constraint FKPresenza_ID primary key (Codice_Rating));

create table RICEVIMENTO (
     Codice int not null auto_increment,
     Data date not null,
     Ora_inizio time not null,
     Ora_fine time not null,
     Modalita varchar(250) not null,
     Docente varchar(100) not null,
     constraint ID_RICEVIMENTO_ID primary key (Codice));

create table STUDENTE (
     Matricola varchar(10) not null,
     Utente varchar(100) not null,
     Segnalato tinyint not null,
     Data_Ban date,
     Numero_Segnalazioni int not null,
     constraint ID_STUDENTE primary key (Matricola),
     constraint FKPER_STU_ID unique (Utente));

create table STUDENTE_IN_CORSO (
     Matricola varchar(10) not null,
     Codice_Corso varchar(5) not null,
     Codice_Rating_Docenti int not null,
     Codice_Rating_Corso int not null,
     Iscritto tinyint not null,
     constraint ID_STUDENTE_IN_CORSO_ID primary key (Matricola, Codice_Corso),
     constraint FKRecensione_Docente_ID unique (Codice_Rating_Docenti),
     constraint FKRecensione_Corso_ID unique (Codice_Rating_Corso));

create table Tenere (
     Docente varchar(100) not null,
     Codice_Corso varchar(5) not null,
     constraint ID_Tenere_ID primary key (Codice_Corso, Docente));

-- Insertions Section
-- __________________

### PERSONA ###
insert into PERSONA values
	("mario.rossi@unibo.it", "admin12345", "Mario", "Rossi", "ADMIN"),
	("luigia.verdi@unibo.it", "admin0000", "Luigia", "Verdi", "ADMIN"),
    # PROFESSORI
	("eleonora.cinti5@unibo.it", "matematica!", "Eleonora", "Cinti", "DOCENTE"),
	("luciano.margara@unibo.it", "#massaggiInchiaroAmante", "Luciano", "Margara", "DOCENTE"),
	("a.melis@unibo.it", "ciao1234", "Andrea", "Melis", "DOCENTE"),
	("davide.maltoni@unibo.it", "vivalAI!", "Davide", "Maltoni", "DOCENTE"),
	("matteo.ferrara@unibo.it", "sonotriste", "Matteo", "Ferrara", "DOCENTE"),
	("vittorio.ghini@unibo.it", "madonnadiPompei!", "Vittorio", "Ghini", "DOCENTE"),
	("stefano.ferretti@unibo.it", "soloCodice@", "Stefano", "Ferretti", "DOCENTE"),
	("luigi.guiducci3@unibo.it", "testacoil@", "Luigi", "Guiducci", "DOCENTE"),
	("damiana.lazzaro@unibo.it", "vivalAI@", "Damiana", "Lazzaro", "DOCENTE"),
	("l.pellegrini@unibo.it", "vivalAI@", "Lorenzo", "Pellegrini", "DOCENTE"),
	("franco.callegati@unibo.it", "mercredÃ¬5#", "Franco", "Callegati", "DOCENTE"),
	("andrea.piroddi@unibo.it", "gns3!", "Andrea", "Piroddi", "DOCENTE"),
	("a.ricci@unibo.it", "iot!", "Alessandro", "Ricci", "DOCENTE"),
    #STUDENTI
	("carla.anselmi3@studio.unibo.it", "PolloAlladivola8@", "Carla", "Anselmi", "STUDENTE"),
	("alessandro.giacomini2@studio.unibo.it", "FrierenBestWaifu4ever!", "Alessandro", "Giacomini", "STUDENTE");

### ADMIN ###
insert into ADMIN values
	("mario.rossi@unibo.it"),
	("luigia.verdi@unibo.it");

### DOCENTE ###
insert into DOCENTE values
	("eleonora.cinti5@unibo.it"),
	("luciano.margara@unibo.it"),
	("a.melis@unibo.it"),
	("davide.maltoni@unibo.it"),
	("matteo.ferrara@unibo.it"),
	("vittorio.ghini@unibo.it"),
	("stefano.ferretti@unibo.it"),
	("luigi.guiducci3@unibo.it"),
	("damiana.lazzaro@unibo.it"),
	("l.pellegrini@unibo.it"),
	("franco.callegati@unibo.it"),
	("andrea.piroddi@unibo.it"),
	("a.ricci@unibo.it");

### STUDENTE ###
insert into STUDENTE values
	("0000000001", "carla.anselmi3@studio.unibo.it", false, null, 0),
	("0000000002", "alessandro.giacomini2@studio.unibo.it", true, "2026-01-15", 1);

### FACOLTA ###
insert into FACOLTA values
	("6673", "Ingegneria e scienze informatiche", "DISI", 3, "Cesena"),
	("6670", "Ingegneria elettronica", "DEI", 3, "Cesena"),
    ("6733", "Medicina e chirurgia", "DIMEC", 6, "Bologna"),
    ("6668", "Ingegneria informatica", "DISI", 3, "Bologna");

### CORSO ###
insert into CORSO values
	# PRIMO ANNO
	("00013", "Analisi matematica", 1, 1, 6673, "", "Lorem"),
	("11929", "Algoritmi e strutture dati", 1, 2, 6673, "", ""),
	("69731", "Architetture degli elaboratori", 1, 2, 6673, "", ""),
    # SECONDO ANNO
	("08574", "Sistemi Operativi", 2, 1, 6673, "", ""),
	("00405", "Fisica", 2, 2, 6673, "", ""),
	("B2561", "Metodi numerici per l'intelligenza artificiale", 2, 2, 6673, "", ""),
	("70226", "Programmazione di reti", 2, 2, 6673, "", ""),
    # TERZO ANNO
	("70218", "Reti di telecomunicazione", 3, 1, 6673, "", ""),
	("70090", "Computer graphics", 3, 1, 6673, "", ""),
	("77780", "Sistemi embedded e internet-of-things", 3, 1, 6673, "", ""),
	("14015", "Crittografia", 3, 2, 6673, "", ""),
	("96642", "Virtualizzazione e Integrazione di Sistemi", 3, 2, 6673, "", "");

### Tenere ###
insert into Tenere values
	("eleonora.cinti5@unibo.it", "00013"),
	("luciano.margara@unibo.it", "11929"),
	("a.melis@unibo.it", "11929"),
	("davide.maltoni@unibo.it", "69731"),
	("matteo.ferrara@unibo.it", "69731"),
	("vittorio.ghini@unibo.it", "08574"),
	("stefano.ferretti@unibo.it", "08574"),
    ("luigi.guiducci3@unibo.it", "00405"),
    ("damiana.lazzaro@unibo.it", "B2561"),
    ("l.pellegrini@unibo.it", "B2561"),
	("franco.callegati@unibo.it", "70226"),
	("andrea.piroddi@unibo.it", "70226"),
	("franco.callegati@unibo.it", "70218"),
	("andrea.piroddi@unibo.it", "70218"),
    ("damiana.lazzaro@unibo.it", "70090"),
    ("a.ricci@unibo.it", "77780"),
    ("luciano.margara@unibo.it", "14015"),
	("vittorio.ghini@unibo.it", "96642");

### REVIEW ###
insert into REVIEW values
	(1, "Eww", true);

### RATING ###
insert into RATING values
	(null, "DOCENTE"),
	(null, "CORSO"),
	(null, "DOCENTE"),
	(null, "CORSO");

### RATING_CORSO ###
insert into RATING_CORSO values
	(2, 4, 5, 4),
	(4, 3, 2, 4);

### RATING_DOCENTE ###
insert into RATING_DOCENTE values
	(1, 2, 3, 5),
	(3, 5, 3, 1);

### STUDENTE_IN_CORSO ###
insert into STUDENTE_IN_CORSO values
	("0000000001", "70226", 1, 2, true),
	("0000000002", "70226", 3, 4, true);

### RATING_GENERALE ###
insert into RATING_GENERALE values
	("08574", "2025", 4.3, 3.3, 3.0, 4.1),
    ("08574", "2026", 4.3, 3.3, 3.0, 4.1),
	("70226", "2026", 3.3, 5.0, 4.2, 1.7);

### Cambio_docente ###
insert into Cambio_docente values
	("vittorio.ghini@unibo.it", "2026", "08574");

### MESSAGGIO_CHAT ###
insert into MESSAGGIO_CHAT values
	(1, 1, "carla.anselmi3@studio.unibo.it", "Buongiorno prof.", null),
	(2, 1, "vittorio.ghini@unibo.it", "Buongiorno.", null),
	(3, 1, "carla.anselmi3@studio.unibo.it", "Come va?", null),
	(1, 2, "vittorio.ghini@unibo.it", "Buongiorno.", null),
	(2, 3, "alessandro.giacomini2@studio.unibo.it", "Buongiorno.", null);

### CHAT ###
insert into CHAT values
	(null, "0000000001", "vittorio.ghini@unibo.it"),
	(null, "0000000002", "vittorio.ghini@unibo.it"),
	(null, "0000000002", "franco.callegati@unibo.it");

### RICEVIMENTO ###
insert into RICEVIMENTO values
	(null, "2026-04-12", "9:00:00", "9:15:00", "Online e in presenza", "vittorio.ghini@unibo.it"),
	(null, "2026-04-12", "9:15:00", "9:30:00", "Online e in presenza", "vittorio.ghini@unibo.it"),
	(null, "2026-04-12", "9:30:00", "9:45:00", "Online e in presenza", "vittorio.ghini@unibo.it"),
	(null, "2026-04-12", "9:45:00", "10:00:00", "Online e in presenza", "vittorio.ghini@unibo.it"),
	(null, "2026-04-12", "10:15:00", "10:30:00", "Online e in presenza", "vittorio.ghini@unibo.it"),
	(null, "2026-04-12", "15:15:00", "15:30:00", "Online", "vittorio.ghini@unibo.it"),
	(null, "2026-04-12", "15:30:00", "15:45:00", "Online", "vittorio.ghini@unibo.it"),
	(null, "2026-04-12", "15:45:00", "16:00:00", "Online", "vittorio.ghini@unibo.it"),
	(null, "2026-04-12", "9:00:00", "9:15:00", "Online e in presenza", "franco.callegati@unibo.it"),
	(null, "2026-04-12", "9:15:00", "9:30:00", "Online e in presenza", "franco.callegati@unibo.it"),
	(null, "2026-04-12", "9:30:00", "9:45:00", "Online e in presenza", "franco.callegati@unibo.it"),
	(null, "2026-04-12", "9:45:00", "10:00:00", "Online e in presenza", "franco.callegati@unibo.it");
    
    ### PRENOTAZIONE ###
insert into Prenotazione values
    (1, "0000000002", "Presenza"),
    (8, "0000000001", "Online"),
    (12, "0000000001", "Presenza");
    
    
-- Constraints Section
-- ___________________ 

alter table ADMIN add constraint FKPER_ADM_FK
     foreign key (Utente)
     references PERSONA (Utente);

alter table Cambio_docente add constraint FKCam_DOC_FK
     foreign key (Docente)
     references DOCENTE (Utente);
     
alter table Cambio_docente add constraint FKCam_RAT_FK
	foreign key (Codice_Corso, Anno)
    references RATING_GENERALE (Codice_Corso, Anno);

alter table CHAT add constraint FKUtilizzo
     foreign key (Matricola_Studente)
     references STUDENTE (Matricola);

alter table CHAT add constraint FKPartecipazione_FK
     foreign key (Docente)
     references DOCENTE (Utente);

-- Not implemented
-- alter table CORSO add constraint ID_CORSO_CHK
--     check(exists(select * from Tenere
--                  where Tenere.Codice_Corso = Codice)); 

alter table CORSO add constraint FKComposizione_FK
     foreign key (Codice_Facolta)
     references FACOLTA (Codice);

alter table DOCENTE add constraint FKPER_DOC_FK
     foreign key (Utente)
     references PERSONA (Utente);

-- Not implemented
-- alter table FACOLTA add constraint ID_FACOLTA_CHK
--     check(exists(select * from CORSO
--                  where CORSO.Codice_Facolta = Codice)); 

alter table MATERIALE add constraint FKCaricamento_FK
     foreign key (Matricola_Studente, Codice_Corso)
     references STUDENTE_IN_CORSO (Matricola, Codice_Corso);

alter table MESSAGGIO_CHAT add constraint FKComprensione_FK
     foreign key (Codice_Chat)
     references CHAT (Codice);

alter table Prenotazione add constraint FKPre_STU_FK
     foreign key (Matricola_Studente)
     references STUDENTE (Matricola);

alter table Prenotazione add constraint FKPre_RIC_FK
     foreign key (Codice_Ricevimento)
     references RICEVIMENTO (Codice);

-- Not implemented
-- alter table RATING_CORSO add constraint FKRAT_RAT_CHK
--     check(exists(select * from STUDENTE_IN_CORSO
--                  where STUDENTE_IN_CORSO.Codice_Rating_Corso = Codice)); 

alter table RATING_CORSO add constraint FKRAT_RAT_FK
     foreign key (Codice)
     references RATING (Codice);

-- Not implemented
-- alter table RATING_DOCENTE add constraint FKRAT_RAT_1_CHK
--     check(exists(select * from STUDENTE_IN_CORSO
--                  where STUDENTE_IN_CORSO.Codice_Rating_Docenti = Codice)); 

alter table RATING_DOCENTE add constraint FKRAT_RAT_1_FK
     foreign key (Codice)
     references RATING (Codice);

alter table RATING_GENERALE add constraint FKValutazione_FK
     foreign key (Codice_Corso)
     references CORSO (Codice);

alter table REVIEW add constraint FKPresenza_FK
     foreign key (Codice_Rating)
     references RATING (Codice);

-- Not implemented
-- alter table RICEVIMENTO add constraint ID_RICEVIMENTO_CHK
--     check(exists(select * from Prenotazione
--                  where Prenotazione.Codice_Ricevimento = Codice)); 

alter table RICEVIMENTO add constraint FKDisponibilita_FK
     foreign key (Docente)
     references DOCENTE (Utente);

alter table STUDENTE add constraint FKPER_STU_FK
     foreign key (Utente)
     references PERSONA (Utente);

alter table STUDENTE_IN_CORSO add constraint FKIscrizione_FK
     foreign key (Codice_Corso)
     references CORSO (Codice);

alter table STUDENTE_IN_CORSO add constraint FKEssere
     foreign key (Matricola)
     references STUDENTE (Matricola);

alter table STUDENTE_IN_CORSO add constraint FKRecensione_Docente_FK
     foreign key (Codice_Rating_Docenti)
     references RATING_DOCENTE (Codice);

alter table STUDENTE_IN_CORSO add constraint FKRecensione_Corso_FK
     foreign key (Codice_Rating_Corso)
     references RATING_CORSO (Codice);

alter table Tenere add constraint FKTen_COR
     foreign key (Codice_Corso)
     references CORSO (Codice);

alter table Tenere add constraint FKTen_DOC_FK
     foreign key (Docente)
     references DOCENTE (Utente);


-- Index Section
-- _____________ 

create unique index FKPER_ADM_IND
     on ADMIN (Utente);

create unique index ID_Cambio_docente_IND
     on Cambio_docente (Anno, Docente);

create index FKCam_DOC_IND
     on Cambio_docente (Docente);

create unique index SID_CHAT_IND
     on CHAT (Matricola_Studente, Docente);

create unique index ID_CHAT_IND
     on CHAT (Codice);

create index FKPartecipazione_IND
     on CHAT (Docente);

create unique index ID_CORSO_IND
     on CORSO (Codice);

create index FKComposizione_IND
     on CORSO (Codice_Facolta);

create unique index FKPER_DOC_IND
     on DOCENTE (Utente);

create unique index ID_FACOLTA_IND
     on FACOLTA (Codice);

create unique index ID_MATERIALE_IND
     on MATERIALE (Percorso);

create index FKCaricamento_IND
     on MATERIALE (Matricola_Studente, Codice_Corso);

create unique index ID_MESSAGGIO_CHAT_IND
     on MESSAGGIO_CHAT (Codice_Chat, Codice);

create index FKComprensione_IND
     on MESSAGGIO_CHAT (Codice_Chat);

create unique index ID_PERSONA_IND
     on PERSONA (Utente);

create index FKPre_STU_IND
     on Prenotazione (Matricola_Studente);

create unique index FKPre_RIC_IND
     on Prenotazione (Codice_Ricevimento);

create unique index ID_RATING_IND
     on RATING (Codice);

create unique index FKRAT_RAT_IND
     on RATING_CORSO (Codice);

create unique index FKRAT_RAT_1_IND
     on RATING_DOCENTE (Codice);

create index FKValutazione_IND
     on RATING_GENERALE (Codice_Corso);

create unique index FKPresenza_IND
     on REVIEW (Codice_Rating);

create unique index ID_RICEVIMENTO_IND
     on RICEVIMENTO (Codice);

create index FKDisponibilita_IND
     on RICEVIMENTO (Docente);

create unique index FKPER_STU_IND
     on STUDENTE (Utente);

create unique index ID_STUDENTE_IN_CORSO_IND
     on STUDENTE_IN_CORSO (Matricola, Codice_Corso);

create index FKIscrizione_IND
     on STUDENTE_IN_CORSO (Codice_Corso);

create unique index FKRecensione_Docente_IND
     on STUDENTE_IN_CORSO (Codice_Rating_Docenti);

create unique index FKRecensione_Corso_IND
     on STUDENTE_IN_CORSO (Codice_Rating_Corso);

create unique index ID_Tenere_IND
     on Tenere (Codice_Corso, Docente);

create index FKTen_DOC_IND
     on Tenere (Docente);

