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
	("mario.rossi@unibo.it", "41e5653fc7aeb894026d6bb7b2db7f65902b454945fa8fd65a6327047b5277fb", "Mario", "Rossi", "ADMIN"), #PASSWORD: admin12345
	("luigia.verdi@unibo.it", "53d6316bd7b9044e6bb5deaa87fe8316c2fde3938b78f8448875b08e551ccc95", "Luigia", "Verdi", "ADMIN"), #PASSWORD: admin0000
    # PROFESSORI
    # Ingegneria e scienze informatiche
	("eleonora.cinti5@unibo.it", "bdfc14da21c3f8167aff1fbe6fc452e06b20c0fb5c76bca3efa946a89e417cce", "Eleonora", "Cinti", "DOCENTE"), #PASSWORD: matematica!
	("luciano.margara@unibo.it", "bd15d66d9a4b1144e0cca4496357ce0def376a1e9c94e759f4400ad8d3f2e7ad", "Luciano", "Margara", "DOCENTE"), #PASSWORD: #hash256
	("davide.maltoni@unibo.it", "eef5826ed59baa4ea8feaf89a0c114e332029bc9369964bf7275ec4f5f1c4ed5", "Davide", "Maltoni", "DOCENTE"), #PASSWORD: vivalAI!
	("vittorio.ghini@unibo.it", "f1746eb5d07c352c30e62aff064bf84590aa7894f57176da68636358af0de9e0", "Vittorio", "Ghini", "DOCENTE"), #PASSWORD: madonnadiPompei!
	("stefano.ferretti@unibo.it", "7561f6ec42fb44f78175b466a6ca254d3031c581bdba404d1f5c562ad27ae9cd", "Stefano", "Ferretti", "DOCENTE"), #PASSWORD: soloCodice@
    ("mirko.viroli@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Mirko", "Viroli", "DOCENTE"), #PASSWORD: ciao
	("damiana.lazzaro@unibo.it", "02190283faa0780252de7760365afbaf4b7f69a934098f97768b5df0c9e6715f", "Damiana", "Lazzaro", "DOCENTE"), #PASSWORD: vivalAI@
	("franco.callegati@unibo.it", "ccc9a68ab2466a84ef651ba19a5eb05f459f92382f8448cb9055a1fd4ecdf18e", "Franco", "Callegati", "DOCENTE"), #PASSWORD: #imolaFibra
    # Ingegneria elettronica
	("massimo.cicognani@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Massimo", "Cicognani", "DOCENTE"), #PASSWORD: #ciao
	("paolo.bonifazi3@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Paolo", "Bonifazi", "DOCENTE"), #PASSWORD: #ciao
	("f.bellini@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Francesca", "Bellini", "DOCENTE"), #PASSWORD: #ciao
	("giovannieugenio.comi@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Giovanni Eugenio", "Comi", "DOCENTE"), #PASSWORD: #ciao
	("claudio.fiegna@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Claudio", "Fiegna", "DOCENTE"), #PASSWORD: #ciao
	("arturo.popoli@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Arturo", "Popoli", "DOCENTE"), #PASSWORD: #ciao
	("luca.roffia@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Luca", "Roffia", "DOCENTE"), #PASSWORD: #ciao
	("paolo.castaldi@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Paolo", "Castaldi", "DOCENTE"), #PASSWORD: #ciao
	("v.degliesposti@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Vittorio", "Degli Esposti", "DOCENTE"), #PASSWORD: #ciao
	("walter.cerroni@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Walter", "Cerroni", "DOCENTE"), #PASSWORD: #ciao
	("aldo.romani@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Aldo", "Romani", "DOCENTE"), #PASSWORD: #ciao
	("marco.tartagni@unibo.it", "b133a0c0e9bee3be20163d2ad31d6248db292aa6dcb1ee087a2aa50e0fc75ae2", "Marco", "Tartagni", "DOCENTE"), #PASSWORD: #ciao

    #STUDENTI
	("carla.anselmi3@studio.unibo.it", "ada6b0cd6eb25185b58c096aec96f6e70fc7fc4e25be9558f8b2ad091077aed3", "Carla", "Anselmi", "STUDENTE"), #PASSWORD: PolloAlladivola8@
	("alessandro.giacomini2@studio.unibo.it", "942953f8a9ea3d36966569fc81871530a96e9fe3de49740a67b8ac2f0a3d1bd5", "Alessandro", "Giacomini", "STUDENTE"); #PASSWORD: FrierenBestWaifu4ever!

### ADMIN ###
insert into ADMIN values
	("mario.rossi@unibo.it"),
	("luigia.verdi@unibo.it");

### DOCENTE ###
insert into DOCENTE values
    # Ingegneria e scienze informatiche
	("eleonora.cinti5@unibo.it", "Dipartimento di Matematica. Settore scientifico disciplinare: MATH-03/A Analisi matematica", "Bologna", "Giovedì dalle 11 alle 13 presso il Dipartimento di Matematica - Ufficio L8. Per i corsi nel Campus di Cesena il ricevimento è su appuntamento (da prendersi via e-mail).", "default.png"),
	("luciano.margara@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: INFO-01/A Informatica", "Cesena", "Lunedì alle 11. Ufficio 4129, via dell'Università 50. N.B.: consigliabile concordare incontro via email", "default.png"),
	("davide.maltoni@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: IINF-05/A Sistemi di elaborazione delle informazioni", "Cesena", "Mercoledì dalle 9:30 alle 11", "default.png"),
	("vittorio.ghini@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: INFO-01/A Informatica", "Cesena", "Il ricevimento può essere effettuato in modalità online, mediate una call con l'applicativo Teams. E' comunque possibile effettuare il ricevimento in presenza, presso la sede del Campus di Cesena, via dell'Università 50, stanza 4022b.", "vic25.png"),
	("stefano.ferretti@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: INFO-01/A Informatica", "Cesena", "Mercoledì 13:00 - 14:00 (orientativo, necessaria richiesta e conferma via e-mail) ", "default.png"),
	("mirko.viroli@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: IINF-05/A Sistemi di elaborazione delle informazioni", "Cesena", "Il docente riceverà nel suo studio il lunedì e martedì dalle 12 alle 13. E' utile se possibile ricevere una mail per anticipare l'argomento dell'incontro.", "default.png"),
	("damiana.lazzaro@unibo.it", "Dipartimento di Matematica. Settore scientifico disciplinare: MATH-05/A Analisi numerica", "Cesena", "Il ricevimento verrà effettuato, nella sede del Nuovo Campus Universitario di Cesena, Via dell'Università 50, studio n. 4141, nei giorni di Mercoledì ore 11-13, Giovedì ore 9-11 (si prega comunque di fissare l’appuntamento via email ed attendere  conferma). E' possibile anche fissare un appuntamento telematico tramite applicativo teams in giorno ed ora da	concordare con il docente.", "default.png"),
	("franco.callegati@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: INFO-01/A Informatica", "Cesena", "Durante il periodo delle lezioni il Prof. Callegati può ricevere gli studenti su richiesta al termine delle lezioni oppure il mercoledì pomeriggio dalle 14.30 alle 16.30. Per eventuali ricevimenti a Bologna gli studenti sono pregati di contattare il Prof. Callegati utilizzando la loro e-mail @unibo.it per concordare un appuntamento presso la Facolta' di Ingegneria", "default.png"),
    # Ingegneria elettronica
    ("massimo.cicognani@unibo.it", "Dipartimento di Matematica. Settore scientifico disciplinare: MATH-03/A Analisi matematica", "Bologna", "Mandare richiesta per e-mail all'indirizzo massimo.cicognani@unibo.it specificando nome cognome e corso di laurea.  Utilizzare il proprio indirizzo nome.cognome@studio.unibo.it fornito all'atto dell'iscrizione. La  risposta con conferma dell'appuntamento da parte del docente verrà rispedita nel più breve tempo possibile.", "default.png"),
    ("paolo.bonifazi3@unibo.it", 'Dipartimento di Fisica e Astronomia "Augusto Righi". Settore scientifico disciplinare: PHYS-06/A Fisica per le scienze della vita, l’ambiente e i beni culturali', "Bologna", "", "default.png"),
    ("f.bellini@unibo.it", 'Dipartimento di Fisica e Astronomia "Augusto Righi". Settore scientifico disciplinare: PHYS-01/A Fisica sperimentale delle interazioni fondamentali e applicazioni', "Bologna", "La docente riceve su appuntamento: - a Bologna, il lunedì dalle 16:30 alle 17:30 presso lo studio in DIFA, Via Irnerio 46 - primo piano, stanza 72, - a Cesena, il martedì dalle 11:00 alle 12:00 presso l'edificio in via dell'Università. Si prega di contattare la docente via email per fissare un appuntamento in giorni e orari diversi, oppure per un colloquio virtuale tramite piattaforma Teams.", "default.png"),
    ("giovannieugenio.comi@unibo.it", "Dipartimento di Matematica. Settore scientifico disciplinare: MATH-03/A Analisi matematica", "Cesena", "Per Analisi Matematica B: dal 29/04/2026 al 04/06/2026 ogni giovedì dalle 12:00 alle 13:00 in Aula 2.9 Piano terra Ex-Zuccherificio – Edificio 1 (Campus di Cesena). Altrimenti, su appuntamento via email. Il mio ufficio a Bologna si trova in Viale Filopanti 5 (primo piano - ufficio 4).", "default.png"),
    ("claudio.fiegna@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-01/A Elettronica', "Cesena", "Ricevimento su appuntamento (claudio.fiegna@unibo.it)", "default.png"),
    ("arturo.popoli@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IIET-01/A Elettrotecnica', "Bologna", "Ricevimento in presenza o su Microsoft Teams su appuntamento contatto via e-mail istituzionale.", "default.png"),
    ("luca.roffia@unibo.it", 'Dipartimento di Informatica - Scienza e Ingegneria. Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi"', "Bologna", "Su appuntamento inviando una richiesta all'indirizzo luca.roffia@unibo.it", "default.png"),
    ("paolo.castaldi@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-04/A Automatica', "Cesena", "Thursday 16-19 c/o DEI, studio 4005, Campus Ingegneria Via Dell'università 50, Cesena (or by appointment: email paolo.castaldi@unibo.it)", "default.png"),
    ("v.degliesposti@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-02/A Campi elettromagnetici', "Cesena", "Il Mercoledì  ore 10-11:00 nello studio del Campus di Cesena, Dipartimento DEI, ultimo piano, oppure online su TEAMS. Si consiglia comunque di avvertire via email preventivamente prima di venire a ricevimento. Per disponibilità in altri orari o luoghi prego di contattarmi via email", "default.png"),
    ("walter.cerroni@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-03/A Telecomunicazioni', "Cesena", "Bologna: mercoledì 10:30-12:00 e su appuntamento Cesena: su appuntamento", "default.png"),
    ("aldo.romani@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-01/A Elettronica', "Cesena", "Martedì dalle ore 11.00 alle ore 12.00 o su appuntamento. Eventuali variazioni o integrazioni saranno comunicate tempestivamente su Avvisi Web.", "default.png"),
    ("marco.tartagni@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-01/A Elettronica', "Cesena", "Il ricevimento sara' disponibile tutte le settimane nelle giornate del giovedi' alle 15:15-16:00. Si consiglia sempre di inviare email per conferma. Grazie", "default.png");

### STUDENTE ###
insert into STUDENTE values
	("carla.anselmi3@studio.unibo.it", null, 0),
	("alessandro.giacomini2@studio.unibo.it", "2026-06-02", 3);

### FACOLTA ###
insert into FACOLTA values
	("6673", "Ingegneria e scienze informatiche", "DISI", 3, "Cesena"),
	("6670", "Ingegneria elettronica", "DEI", 3, "Cesena"),
    ("6668", "Ingegneria informatica", "DISI", 3, "Bologna");

### CORSO ###
insert into CORSO values
    # Ingegneria e scienze informatiche
	("00013", "Analisi matematica", 1, 1, 6673, "", "", ""),
	("11929", "Algoritmi e strutture dati", 1, 2, 6673, "", "", ""),
	("69731", "Architetture degli elaboratori", 1, 2, 6673, "", "", ""),
	("08574", "Sistemi Operativi", 2, 1, 6673, "", "", ""),
	("70219", "Programmazione ad oggetti", 2, 1, 6673, "", "", ""),
	("B2561", "Metodi numerici per l'intelligenza artificiale", 2, 2, 6673, "", "", ""),
	("70226", "Programmazione di reti", 2, 2, 6673, "", "", ""),
	("70218", "Reti di telecomunicazione", 3, 1, 6673, "", "", ""),
	("70090", "Computer graphics", 3, 1, 6673, "", "", ""),
	("14015", "Crittografia", 3, 2, 6673, "", "", ""),
	("96642", "Virtualizzazione e Integrazione di Sistemi", 3, 2, 6673, "", "", ""),
    # Ingegneria elettronica
    ("15300", "Analisi matematica A", 1, 1, 6670, "", "", ""),
    ("16726", "Fisica generale A", 1, 1, 6670, "", "", ""),
    ("16314", "Analisi matematica B", 1, 2, 6670, "", "", ""),
    ("19704", "Fisica generale B", 1, 2, 6670, "", "", ""),
    ("00269", "Elettronica", 2, 1, 6670, "", "", ""),
    ("B5603", "Sistemi e circuiti elettrici lineari", 2, 1, 6670, "", "", ""),
    ("03716", "Calcolatori elettronici", 2, 2, 6670, "", "", ""),
    ("00196", "Controlli automatici", 2, 2, 6670, "", "", ""),
    ("07941", "Campi elettromagnetici", 3, 1, 6670, "", "", ""),
    ("69774", "Comunicazione digitali e internet", 3, 1, 6670, "", "", ""),
    ("10907", "Elettronica dei sistemi digitali", 3, 2, 6670, "", "", ""),
    ("69773", "Progetto di circuiti elettronici", 3, 2, 6670, "", "", "");
    # Ingegneria informatica

### Tenere ###
insert into Tenere values
    # Ingegneria e scienze informatiche
	("eleonora.cinti5@unibo.it", "00013"),
	("luciano.margara@unibo.it", "11929"),
	("davide.maltoni@unibo.it", "69731"),
	("vittorio.ghini@unibo.it", "08574"),
	("stefano.ferretti@unibo.it", "08574"),
    ("mirko.viroli@unibo.it", "70219"),
    ("damiana.lazzaro@unibo.it", "B2561"),
	("franco.callegati@unibo.it", "70226"),
	("franco.callegati@unibo.it", "70218"),
    ("damiana.lazzaro@unibo.it", "70090"),
    ("luciano.margara@unibo.it", "14015"),
	("vittorio.ghini@unibo.it", "96642"),
    # Ingegneria elettronica
	("massimo.cicognani@unibo.it", "15300"),
	("paolo.bonifazi3@unibo.it", "16726"),
	("f.bellini@unibo.it", "19704"),
	("giovannieugenio.comi@unibo.it", "16314"),
	("claudio.fiegna@unibo.it", "00269"),
	("arturo.popoli@unibo.it", "B5603"),
	("luca.roffia@unibo.it", "03716"),
	("paolo.castaldi@unibo.it", "00196"),
	("v.degliesposti@unibo.it", "07941"),
	("walter.cerroni@unibo.it", "69774"),
	("aldo.romani@unibo.it", "10907"),
	("marco.tartagni@unibo.it", "69773");

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
--
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

