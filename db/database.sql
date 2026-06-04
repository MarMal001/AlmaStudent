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
     Studente varchar(100) not null,
     Docente varchar(100) not null,
     constraint SID_CHAT_ID unique (Studente, Docente),
     constraint ID_CHAT_ID primary key (Codice));

create table CORSO (
     Codice varchar(5) not null ,
     Nome varchar(100) not null,
     Anno int not null,
     Semestre int not null,
     Codice_Facolta varchar(10) not null,
     Descrizione varchar(5000) not null,
     Descrizione_Breve varchar(1000) not null,
     Materiale varchar(1000) not null,
     constraint ID_CORSO_ID primary key (Codice));

create table DOCENTE (
     Utente varchar(100) not null,
     Dipartimento varchar(300) not null,
     Sede varchar(100) not null,
     Info_Ricevimento varchar(500) not null,
     Foto_Profilo varchar(250) not null,
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
     Studente varchar(100) not null,
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
     Docente varchar(100) not null,
     Data date not null,
     Ora_inizio time not null,
     Studente varchar(100) not null,
     Modalita_Scelta varchar(20) not null,
     constraint FKPre_RIC_ID primary key (Docente, Data, Ora_Inizio));

create table RATING (
     Codice int not null auto_increment,
     Tipo varchar(10) not null,
     Data date not null,
     constraint ID_RATING_ID primary key (Codice));

create table RATING_CORSO (
     Codice int not null,
     Studente varchar(100) not null,
     Corso varchar(5) not null,
     Rating_Lezioni int not null,
     Rating_Materiale int not null,
     Rating_Esame int not null,
     constraint FKRAT_RAT_ID primary key (Codice),
     constraint FKStudente_in_Corso unique (Studente, Corso));

create table RATING_DOCENTE (
     Codice int not null,
     Docente varchar(100) not null,
     Studente varchar(100) not null,
     Corso varchar(5) not null,
     Rating_Disponibilita int not null,
     Rating_Comprensibilita_Lezioni int not null,
     Rating_Interesse_Suscitato int not null,
     constraint FKRAT_RAT_1_ID primary key (Codice),
     constraint FKDocente_Studente_in_Corso unique (Docente, Studente, Corso));

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
     Docente varchar(100) not null,
     Data date not null,
     Ora_inizio time not null,
     Ora_fine time not null,
     Modalita varchar(250) not null,
     constraint ID_RICEVIMENTO_ID primary key (Docente, Data, Ora_Inizio));

create table STUDENTE (
     Utente varchar(100) not null,
     Data_Ban date,
     Numero_Segnalazioni int not null,
     constraint FKPER_STU_ID unique (Utente));

create table STUDENTE_IN_CORSO (
     Utente varchar(100) not null,
     Codice_Corso varchar(5) not null,
     Iscritto tinyint not null,
     Esame_Superato tinyint not null,
     constraint ID_STUDENTE_IN_CORSO_ID primary key (Utente, Codice_Corso));

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
	("eleonora.cinti5@unibo.it", "", "", "", "default.png"),
	("luciano.margara@unibo.it", "", "", "", "default.png"),
	("a.melis@unibo.it", "", "", "", "default.png"),
	("davide.maltoni@unibo.it", "", "", "", "default.png"),
	("matteo.ferrara@unibo.it", "", "", "", "default.png"),
	("vittorio.ghini@unibo.it", "", "", "", "vic25.png"),
	("stefano.ferretti@unibo.it", "", "", "", "default.png"),
	("luigi.guiducci3@unibo.it", "", "", "", "default.png"),
	("damiana.lazzaro@unibo.it", "", "", "", "default.png"),
	("l.pellegrini@unibo.it", "", "", "", "default.png"),
	("franco.callegati@unibo.it", "", "", "", "default.png"),
	("andrea.piroddi@unibo.it", "", "", "", "default.png"),
	("a.ricci@unibo.it", "", "", "", "default.png");

### STUDENTE ###
insert into STUDENTE values
	("carla.anselmi3@studio.unibo.it", null, 0),
	("alessandro.giacomini2@studio.unibo.it", "2026-06-02", 3);

### FACOLTA ###
insert into FACOLTA values
	("6673", "Ingegneria e scienze informatiche", "DISI", 3, "Cesena"),
	("6670", "Ingegneria elettronica", "DEI", 3, "Cesena"),
    ("6733", "Medicina e chirurgia", "DIMEC", 6, "Bologna"),
    ("6668", "Ingegneria informatica", "DISI", 3, "Bologna");

### CORSO ###
insert into CORSO values
	# PRIMO ANNO
	("00013", "Analisi matematica", 1, 1, 6673, "", "Lorem", ""),
	("11929", "Algoritmi e strutture dati", 1, 2, 6673, "", "", ""),
	("69731", "Architetture degli elaboratori", 1, 2, 6673, "", "", ""),
    # SECONDO ANNO
	("08574", "Sistemi Operativi", 2, 1, 6673, "", "", ""),
	("00405", "Fisica", 2, 2, 6673, "", "", ""),
	("B2561", "Metodi numerici per l'intelligenza artificiale", 2, 2, 6673, "", "", ""),
	("70226", "Programmazione di reti", 2, 2, 6673, "", "", ""),
    # TERZO ANNO
	("70218", "Reti di telecomunicazione", 3, 1, 6673, "", "", ""),
	("70090", "Computer graphics", 3, 1, 6673, "", "", ""),
	("77780", "Sistemi embedded e internet-of-things", 3, 1, 6673, "", "", ""),
	("14015", "Crittografia", 3, 2, 6673, "", "", ""),
	("96642", "Virtualizzazione e Integrazione di Sistemi", 3, 2, 6673, "", "", "");

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
#insert into REVIEW values
#	(1, "Eww", true),
#   (2, "Il corso è molto bello ed estremamente ben fatto. I docenti sono disponibili e le loro spiegazioni molto comprensibili. Unica pecca è che sarebbe bello avere più materiali di riferimento per lo studio individuale", true);

### RATING ###
#insert into RATING values
#	(null, "DOCENTE", "2025-03-12"),
#	(null, "CORSO", "2025-05-12"),
#	(null, "DOCENTE", "2025-07-12"),
#	(null, "CORSO", "2025-08-12");
    #(null, "DOCENTE", "2025-12-12");

### RATING_CORSO ###
#insert into RATING_CORSO values
	#(2, "carla.anselmi3@studio.unibo.it", "70226", 4, 5, 4), #id studente corso valore valore valore
	#(4, "alessandro.giacomini2@studio.unibo.it", "70226", 3, 2, 4);

### RATING_DOCENTE ###
#insert into RATING_DOCENTE values
	#(1, "stefano.ferretti@unibo.it", "carla.anselmi3@studio.unibo.it", "08574", 2, 3, 5), #id docente studente corso valore valore valore
	#(3, "franco.callegati@unibo.it", "alessandro.giacomini2@studio.unibo.it","70226", 5, 3, 3),
    #(5, "vittorio.ghini@unibo.it", "carla.anselmi3@studio.unibo.it", "08574", 5, 5, 5);

### STUDENTE_IN_CORSO ###
insert into STUDENTE_IN_CORSO values
	("carla.anselmi3@studio.unibo.it", "70226", true,true), #1
    ("carla.anselmi3@studio.unibo.it", "08574", true, true),
	("alessandro.giacomini2@studio.unibo.it", "70226", true, true), #3
    ("alessandro.giacomini2@studio.unibo.it", "08574", true, true);

### RATING_GENERALE ###
-- insert into RATING_GENERALE values
--     ("08574", "2025", 4.0, 4.0, 4.0, 4.0),
--     ("08574", "2026", 4.3, 3.3, 3.0, 4.1),
--     ("00013", "2026", 4.3, 5.0, 3.2, 4.7),
--     ("11929", "2026", 3.3, 4.0, 4.2, 4.7),
--     ("69731", "2026", 4.3, 5.0, 4.2, 4.7),
--     ("00405", "2026", 1.3, 5.0, 1.2, 2.5),
--     ("B2561", "2026", 4.3, 3.0, 4.2, 4.7),
--     ("70226", "2026", 4.3, 5.0, 4.2, 4.5),
--     ("70218", "2026", 4.3, 4.0, 4.2, 1.7),
--     ("70090", "2026", 4.3, 5.0, 4.2, 4.7),
--     ("77780", "2026", 3.2, 4.6, 4.2, 4.7),
--     ("14015", "2026", 4.3, 5.0, 4.2, 2.7),
--     ("96642", "2026", 5.0, 5.0, 5.0, 5.0);

### MESSAGGIO_CHAT ###
insert into MESSAGGIO_CHAT values
	(1, 1, "carla.anselmi3@studio.unibo.it", "Buongiorno prof.", null),
	(2, 1, "vittorio.ghini@unibo.it", "Buongiorno.", null),
	(3, 1, "carla.anselmi3@studio.unibo.it", "Come va?", null),
	(1, 2, "vittorio.ghini@unibo.it", "Buongiorno.", null),
	(2, 3, "alessandro.giacomini2@studio.unibo.it", "Buongiorno.", null);

### CHAT ###
insert into CHAT values
	(null, "carla.anselmi3@studio.unibo.it", "vittorio.ghini@unibo.it"),
	(null, "alessandro.giacomini2@studio.unibo.it", "vittorio.ghini@unibo.it"),
	(null, "alessandro.giacomini2@studio.unibo.it", "franco.callegati@unibo.it");

### RICEVIMENTO ###
insert into RICEVIMENTO values
	("vittorio.ghini@unibo.it", "2026-06-12", "9:00:00", "9:15:00", "Online e in presenza"),
	("vittorio.ghini@unibo.it", "2026-06-12", "9:15:00", "9:30:00", "Online e in presenza"),
	("vittorio.ghini@unibo.it", "2026-06-12", "9:30:00", "9:45:00", "Online e in presenza"),
	("vittorio.ghini@unibo.it", "2026-06-12", "9:45:00", "10:00:00", "Online e in presenza"),
	("vittorio.ghini@unibo.it", "2026-06-12", "10:15:00", "10:30:00", "Online e in presenza"),
	("vittorio.ghini@unibo.it", "2026-06-12", "15:15:00", "15:30:00", "Online"),
	("vittorio.ghini@unibo.it", "2026-06-12", "15:30:00", "15:45:00", "Online"),
	("vittorio.ghini@unibo.it", "2026-06-12", "15:45:00", "16:00:00", "Online"),
	("franco.callegati@unibo.it", "2026-06-12", "9:00:00", "9:15:00", "Online e in presenza"),
	("franco.callegati@unibo.it", "2026-06-12", "9:15:00", "9:30:00", "Online e in presenza"),
	("franco.callegati@unibo.it", "2026-06-12", "9:30:00", "9:45:00", "Online e in presenza"),
	("franco.callegati@unibo.it", "2026-06-12", "9:45:00", "10:00:00", "Online e in presenza");
    
    ### PRENOTAZIONE ###
insert into Prenotazione values
    ("vittorio.ghini@unibo.it", "2026-06-12", "9:00:00", "alessandro.giacomini2@studio.unibo.it", "Presenza"),
    ("vittorio.ghini@unibo.it", "2026-06-12", "10:15:00", "carla.anselmi3@studio.unibo.it", "Online"),
    ("franco.callegati@unibo.it", "2026-06-12", "9:00:00", "carla.anselmi3@studio.unibo.it", "Presenza");
    
    
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
     foreign key (Studente)
     references STUDENTE (Utente);

alter table CHAT add constraint FKPartecipazione_FK
     foreign key (Docente)
     references DOCENTE (Utente);

-- Not implemented
-- alter table CORSO add constraint ID_CORSO_CHK
--     check(exists(select * from Tenere
--                  where Tenere.Codice_Corso = Codice)); 

alter table CORSO add constraint FKComposizione_FK
     foreign key (Codice_Facolta)
     references FACOLTA (Codice) on delete cascade;

alter table DOCENTE add constraint FKPER_DOC_FK
     foreign key (Utente)
     references PERSONA (Utente);

-- Not implemented
-- alter table FACOLTA add constraint ID_FACOLTA_CHK
--     check(exists(select * from CORSO
--                  where CORSO.Codice_Facolta = Codice)); 

alter table MATERIALE add constraint FKCaricamento_FK
     foreign key (Studente, Codice_Corso)
     references STUDENTE_IN_CORSO (Utente, Codice_Corso);

alter table MESSAGGIO_CHAT add constraint FKComprensione_FK
     foreign key (Codice_Chat)
     references CHAT (Codice);

alter table Prenotazione add constraint FKPre_STU_FK
     foreign key (Studente)
     references STUDENTE (Utente);

alter table Prenotazione add constraint FKPre_RIC_FK
     foreign key (Docente, Data, Ora_Inizio)
     references RICEVIMENTO (Docente, Data, Ora_Inizio);

-- Not implemented
-- alter table RATING_CORSO add constraint FKRAT_RAT_CHK
--     check(exists(select * from STUDENTE_IN_CORSO
--                  where STUDENTE_IN_CORSO.Codice_Rating_Corso = Codice)); 

alter table RATING_CORSO add constraint FKRAT_RAT_FK
     foreign key (Codice)
     references RATING (Codice) on delete cascade;
     
 alter table RATING_CORSO add constraint FKStudente_in_Corso
     foreign key (Studente, Corso)
     references STUDENTE_IN_CORSO (Utente, Codice_Corso) on delete cascade;    

-- Not implemented
-- alter table RATING_DOCENTE add constraint FKRAT_RAT_1_CHK
--     check(exists(select * from STUDENTE_IN_CORSO
--                  where STUDENTE_IN_CORSO.Codice_Rating_Docenti = Codice)); 

alter table RATING_DOCENTE add constraint FKRAT_RAT_1_FK
     foreign key (Codice)
     references RATING (Codice) on delete cascade;
     
alter table RATING_DOCENTE add constraint FKStud_Corso_FK
     foreign key (Studente, Corso)
     references STUDENTE_IN_CORSO (Utente, Codice_Corso) on delete cascade;

alter table RATING_GENERALE add constraint FKValutazione_FK
     foreign key (Codice_Corso)
     references CORSO (Codice) on delete cascade;

alter table REVIEW add constraint FKPresenza_FK
     foreign key (Codice_Rating)
     references RATING (Codice) on delete cascade;

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
     references CORSO (Codice) on delete cascade;

alter table STUDENTE_IN_CORSO add constraint FKEssere
     foreign key (Utente)
     references STUDENTE (Utente);

alter table Tenere add constraint FKTen_COR
     foreign key (Codice_Corso)
     references CORSO (Codice) on delete cascade;

alter table Tenere add constraint FKTen_DOC_FK
     foreign key (Docente)
     references DOCENTE (Utente) on delete cascade;


-- Index Section
-- _____________ 

create unique index FKPER_ADM_IND
     on ADMIN (Utente);

create unique index ID_Cambio_docente_IND
     on Cambio_docente (Anno, Docente);

create index FKCam_DOC_IND
     on Cambio_docente (Docente);

create unique index SID_CHAT_IND
     on CHAT (Studente, Docente);

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
     on MATERIALE (Studente, Codice_Corso);

create unique index ID_MESSAGGIO_CHAT_IND
     on MESSAGGIO_CHAT (Codice_Chat, Codice);

create index FKComprensione_IND
     on MESSAGGIO_CHAT (Codice_Chat);

create unique index ID_PERSONA_IND
     on PERSONA (Utente);

create index FKPre_STU_IND
     on Prenotazione (Studente);

create unique index FKPre_RIC_IND
     on Prenotazione (Docente, Data, Ora_Inizio);

create unique index ID_RATING_IND
     on RATING (Codice);

create unique index FKRAT_RAT_IND
     on RATING_CORSO (Codice);
     
create unique index FKStudente_in_Corso_IND
     on RATING_CORSO (Studente, Corso);     

create unique index FKRAT_RAT_1_IND
     on RATING_DOCENTE (Codice);
     
create unique index FKDocente_Studente_in_Corso_IND
     on RATING_DOCENTE (Docente, Studente, Corso);

create index FKValutazione_IND
     on RATING_GENERALE (Codice_Corso);

create unique index FKPresenza_IND
     on REVIEW (Codice_Rating);

create unique index ID_RICEVIMENTO_IND
     on RICEVIMENTO (Docente, Data, Ora_Inizio);

create index FKDisponibilita_IND
     on RICEVIMENTO (Docente);

create unique index FKPER_STU_IND
     on STUDENTE (Utente);

create unique index ID_STUDENTE_IN_CORSO_IND
     on STUDENTE_IN_CORSO (Utente, Codice_Corso);

create index FKIscrizione_IND
     on STUDENTE_IN_CORSO (Codice_Corso);

create unique index ID_Tenere_IND
     on Tenere (Codice_Corso, Docente);

create index FKTen_DOC_IND
     on Tenere (Docente);

