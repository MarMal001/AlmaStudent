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
     Descrizione_Breve varchar(2000) not null,
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
     Ora time not null,
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
	("eleonora.cinti5@unibo.it", "Dipartimento di Matematica. Settore scientifico disciplinare: MATH-03/A Analisi matematica", "Bologna", "Giovedì dalle 11 alle 13 presso il Dipartimento di Matematica - Ufficio L8. Per i corsi nel Campus di Cesena il ricevimento è su appuntamento (da prendersi via e-mail).", "default.jpg"),
	("luciano.margara@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: INFO-01/A Informatica", "Cesena", "Lunedì alle 11. Ufficio 4129, via dell'Università 50. N.B.: consigliabile concordare incontro via email", "default.jpg"),
	("davide.maltoni@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: IINF-05/A Sistemi di elaborazione delle informazioni", "Cesena", "Mercoledì dalle 9:30 alle 11", "default.jpg"),
	("vittorio.ghini@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: INFO-01/A Informatica", "Cesena", "Il ricevimento può essere effettuato in modalità online, mediate una call con l'applicativo Teams. E' comunque possibile effettuare il ricevimento in presenza, presso la sede del Campus di Cesena, via dell'Università 50, stanza 4022b.", "default.jpg"),
	("stefano.ferretti@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: INFO-01/A Informatica", "Cesena", "Mercoledì 13:00 - 14:00 (orientativo, necessaria richiesta e conferma via e-mail) ", "default.jpg"),
	("mirko.viroli@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: IINF-05/A Sistemi di elaborazione delle informazioni", "Cesena", "Il docente riceverà nel suo studio il lunedì e martedì dalle 12 alle 13. E' utile se possibile ricevere una mail per anticipare l'argomento dell'incontro.", "default.jpg"),
	("damiana.lazzaro@unibo.it", "Dipartimento di Matematica. Settore scientifico disciplinare: MATH-05/A Analisi numerica", "Cesena", "Il ricevimento verrà effettuato, nella sede del Nuovo Campus Universitario di Cesena, Via dell'Università 50, studio n. 4141, nei giorni di Mercoledì ore 11-13, Giovedì ore 9-11 (si prega comunque di fissare l’appuntamento via email ed attendere  conferma). E' possibile anche fissare un appuntamento telematico tramite applicativo teams in giorno ed ora da	concordare con il docente.", "default.jpg"),
	("franco.callegati@unibo.it", "Dipartimento di Informatica - Scienza e Ingegneria. Settore scientifico disciplinare: INFO-01/A Informatica", "Cesena", "Durante il periodo delle lezioni il Prof. Callegati può ricevere gli studenti su richiesta al termine delle lezioni oppure il mercoledì pomeriggio dalle 14.30 alle 16.30. Per eventuali ricevimenti a Bologna gli studenti sono pregati di contattare il Prof. Callegati utilizzando la loro e-mail @unibo.it per concordare un appuntamento presso la Facolta' di Ingegneria", "default.jpg"),
    # Ingegneria elettronica
    ("massimo.cicognani@unibo.it", "Dipartimento di Matematica. Settore scientifico disciplinare: MATH-03/A Analisi matematica", "Bologna", "Mandare richiesta per e-mail all'indirizzo massimo.cicognani@unibo.it specificando nome cognome e corso di laurea.  Utilizzare il proprio indirizzo nome.cognome@studio.unibo.it fornito all'atto dell'iscrizione. La  risposta con conferma dell'appuntamento da parte del docente verrà rispedita nel più breve tempo possibile.", "default.jpg"),
    ("paolo.bonifazi3@unibo.it", 'Dipartimento di Fisica e Astronomia "Augusto Righi". Settore scientifico disciplinare: PHYS-06/A Fisica per le scienze della vita, l’ambiente e i beni culturali', "Bologna", "", "default.jpg"),
    ("f.bellini@unibo.it", 'Dipartimento di Fisica e Astronomia "Augusto Righi". Settore scientifico disciplinare: PHYS-01/A Fisica sperimentale delle interazioni fondamentali e applicazioni', "Bologna", "La docente riceve su appuntamento: - a Bologna, il lunedì dalle 16:30 alle 17:30 presso lo studio in DIFA, Via Irnerio 46 - primo piano, stanza 72, - a Cesena, il martedì dalle 11:00 alle 12:00 presso l'edificio in via dell'Università. Si prega di contattare la docente via email per fissare un appuntamento in giorni e orari diversi, oppure per un colloquio virtuale tramite piattaforma Teams.", "default.jpg"),
    ("giovannieugenio.comi@unibo.it", "Dipartimento di Matematica. Settore scientifico disciplinare: MATH-03/A Analisi matematica", "Cesena", "Per Analisi Matematica B: dal 29/04/2026 al 04/06/2026 ogni giovedì dalle 12:00 alle 13:00 in Aula 2.9 Piano terra Ex-Zuccherificio – Edificio 1 (Campus di Cesena). Altrimenti, su appuntamento via email. Il mio ufficio a Bologna si trova in Viale Filopanti 5 (primo piano - ufficio 4).", "default.jpg"),
    ("claudio.fiegna@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-01/A Elettronica', "Cesena", "Ricevimento su appuntamento (claudio.fiegna@unibo.it)", "default.jpg"),
    ("arturo.popoli@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IIET-01/A Elettrotecnica', "Bologna", "Ricevimento in presenza o su Microsoft Teams su appuntamento contatto via e-mail istituzionale.", "default.jpg"),
    ("luca.roffia@unibo.it", 'Dipartimento di Informatica - Scienza e Ingegneria. Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi"', "Bologna", "Su appuntamento inviando una richiesta all'indirizzo luca.roffia@unibo.it", "default.jpg"),
    ("paolo.castaldi@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-04/A Automatica', "Cesena", "Thursday 16-19 c/o DEI, studio 4005, Campus Ingegneria Via Dell'università 50, Cesena (or by appointment: email paolo.castaldi@unibo.it)", "default.jpg"),
    ("v.degliesposti@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-02/A Campi elettromagnetici', "Cesena", "Il Mercoledì  ore 10-11:00 nello studio del Campus di Cesena, Dipartimento DEI, ultimo piano, oppure online su TEAMS. Si consiglia comunque di avvertire via email preventivamente prima di venire a ricevimento. Per disponibilità in altri orari o luoghi prego di contattarmi via email", "default.jpg"),
    ("walter.cerroni@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-03/A Telecomunicazioni', "Cesena", "Bologna: mercoledì 10:30-12:00 e su appuntamento Cesena: su appuntamento", "default.jpg"),
    ("aldo.romani@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-01/A Elettronica', "Cesena", "Martedì dalle ore 11.00 alle ore 12.00 o su appuntamento. Eventuali variazioni o integrazioni saranno comunicate tempestivamente su Avvisi Web.", "default.jpg"),
    ("marco.tartagni@unibo.it", 'Dipartimento di Ingegneria dell''Energia Elettrica e dell''Informazione "Guglielmo Marconi". Settore scientifico disciplinare: IINF-01/A Elettronica', "Cesena", "Il ricevimento sara' disponibile tutte le settimane nelle giornate del giovedi' alle 15:15-16:00. Si consiglia sempre di inviare email per conferma. Grazie", "default.jpg");

### STUDENTE ###
insert into STUDENTE values
	("carla.anselmi3@studio.unibo.it", null, 0),
	("alessandro.giacomini2@studio.unibo.it", "2026-06-02", 3);

### FACOLTA ###
insert into FACOLTA values
	("6673", "Ingegneria e scienze informatiche", "DISI", 3, "Cesena"),
	("6670", "Ingegneria elettronica", "DEI", 3, "Cesena");

### CORSO ###
insert into CORSO values
    # Ingegneria e scienze informatiche
	("00013", "Analisi matematica", 1, 1, 6673, "Lo studente deve sviluppare tre tipi di abilità/conoscenze: 1) eseguire calcoli su funzioni di una o più variabili (limiti, derivate, integrali) e saper risolvere alcuni tipi di problemi che utilizzano gli strumenti dell’analisi matematica (calcolo della lunghezza di una curva, di un volume o risoluzione di alcune classi di equazioni differenziali ordinarie); 2) capire e saper usare le definizioni di base dell’analisi matematica; 3) conoscere le funzioni elementari.
		Il corso prevede lo svolgimento di lezioni di carattere teorico, affiancate da esercitazioni che hanno lo scopo di aiutare lo studente ad acquisire familiarità e padronanza con gli strumenti e metodi matematici introdotti durante le lezioni. Il docente proporrà inoltre esercizi da svolgere a casa, simili a quelli svolti durante le ore di esercitazione, in modo che lo studente possa verificare il proprio livello di apprendimento della materia.
		L'esame consiste di una prova scritta, della durata di 2,5 ore. La prova scritta sarà suddivisa in una parte con esercizi (aperti) e una parte con domande di teoria sui vari argomenti trattati nel corso. Il voto massimo ottenibile con la sola prova scritta è 24. Chi ha intenzione di migliorare il voto dello scritto potrà sostenere una prova orale (che quindi è facoltativa). In entrambe le prove non è consentito l'uso di calcolatrici, testi e appunti.", "Lo studente deve sviluppare tre tipi di abilità/conoscenze: 1) eseguire calcoli su funzioni di una o più variabili (limiti, derivate, integrali) e saper risolvere alcuni tipi di problemi che utilizzano gli strumenti dell’analisi matematica (calcolo della lunghezza di una curva, di un volume o risoluzione di alcune classi di equazioni differenziali ordinarie); 2) capire e saper usare le definizioni di base dell’analisi matematica; 3) conoscere le funzioni elementari.", "M.Bramanti, C.Pagani, S.Salsa, Matematica. Calcolo infinitesimale e algebra lineare,
		Zanichelli Editore
		M. Bertsch, R. Dal Passo, L. Giacomelli - Analisi Matematica, ed. McGraw Hill. (seconda edizione)
		G.C. Barozzi, G. Dore, E. Obrecht: Elementi di Analisi Matematica, vol. 1, ed. Zanichelli.
		Marcellini-Sbordone: Elementi di analisi matematica uno (versione semplificata per i nuovi corsi di laurea), Liguori Editore, Napoli 2002.
		Sul sito web del docente e sulla pagina Virtuale, sono reperibili le note del corso, esercizi e testi di esami passati."),
	("11929", "Algoritmi e strutture dati", 1, 2, 6673, "Al termine del corso, lo studente conosce: - gli algoritmi per risolvere problemi computazionali di base su strutture dati elementari; - le tecniche di base per calcolare il costo computazionale degli algoritmi; - le classi di complessità computazionale P, NP e NP-hard. In particolare, lo studente è in grado di: - progettare algoritmi efficienti per risolvere semplici problemi computazionali; - stimare in ordine di grandezza il costo computazionale degli algoritmi; - analizzare la complessità computazionale di problemi computazionali di base; - dare una valutazione circa l'efficienza e la correttezza di un algoritmo; - elaborare e presentare un progetto per la risoluzione di problemi computazionali di base. 
		Lezioni ed esercitazioni frontali. Prova scritta obbligatoria e prova orale facoltativa. Lo studente o la studentessa possono sempre scegliere di sostenere la prova orale facoltativa e il docente può richiedere il sostenimento della prova orale quando lo ritenga opportuno per una accurata verifica dell’apprendimento.
		Per accedere alla prova scritta è obbligatorio lo svolgimento ed il superamento (senza attribuzione di un punteggio) di una prova pratica di laboratorio assegnata durante il corso e da svolgere a casa. Su Virtuale è possibile trovare i dettagli relativi alla esecuzione e consegna delle prove pratiche.
		La frequenza delle lezioni non influenza il voto finale e non è obbligatoria per sostenere le prove di verifica.
		La prova scritta consiste nella risoluzione di un numero di esercizi che va da 2 a 4. Il voto finale sarà la somma dei voti ottenuti nei singoli esercizi. Per ogni esercizio sarà esplicitamente indicato il punteggio massimo ottenibile. Se il voto finale risulterà maggiore di 30 si otterrà la lode. La durata della prova varia a seconda della difficoltà di risoluzione degli esercizi da 2 a 3 ore. Durante la prova scritta è ammesso l’utilizzo di qualunque materiale cartaceo (libri, dispense, appunti). Non è ammesso accedere al web con dispositivi elettronici. Per svolgere la prova scritta è necessario iscriversi entro i termini indicati su almaesami.
		Lo scopo della prova pratica, dello scritto e dell’eventuale prova orale è verificare la capacità dello studente o della studentessa di progettare algoritmi efficienti per risolvere semplici problemi computazionali, di stimare in ordine di grandezza il costo computazionale degli algoritmi, di analizzare la complessità computazionale di problemi computazionali di base e di dare una valutazione circa l'efficienza e la correttezza di un algoritmo. La gradazione del voto sarà proporzionale alle capacità dimostrate dallo studente durante le prove di verifica e potrà variare da 0 a 30 e lode. Lo studente che ottiene un voto inferiore al 18 non avrà superato la prova e lo studente che ottiene un voto superiore a 17 ha comunque la possibilità di rifiutarlo e di ripresentarsi all’appello di esame successivo.", 
		"Al termine del corso, lo studente conosce: - gli algoritmi per risolvere problemi computazionali di base su strutture dati elementari; - le tecniche di base per calcolare il costo computazionale degli algoritmi; - le classi di complessità computazionale P, NP e NP-hard. In particolare, lo studente è in grado di: - progettare algoritmi efficienti per risolvere semplici problemi computazionali; - stimare in ordine di grandezza il costo computazionale degli algoritmi; - analizzare la complessità computazionale di problemi computazionali di base; - dare una valutazione circa l'efficienza e la correttezza di un algoritmo; - elaborare e presentare un progetto per la risoluzione di problemi computazionali di base.", 
        "Introduzione agli Algoritmi e Strutture Dati. Terza Edizione T. H. Cormen, C. E. Leiserson, R. L. Rivest, C. Stein McGraw-Hill"),
	("69731", "Architetture degli elaboratori", 1, 2, 6673, "Al termine del corso, lo studente acquisisce le nozioni necessarie alla comprensione delle architetture, del funzionamento degli elaboratori e della programmazione assembly. 
		Sono previste lezioni frontali, esercitazioni e laboratorio assistito. Nota: in considerazione della tipologia di attività e dei metodi didattici adottati, la frequenza di questa attività formativa richiede la preventiva partecipazione di tutti gli studenti ai moduli 1 e 2 di formazione sulla sicurezza nei luoghi di studio, in modalità e-learning (link). 
        Per poter sostenere l’esame, è necessario iscriversi su AlmaEsami (entro la chiusura delle iscrizioni) e consegnare con successo tutti gli elaborati almeno una settimana prima dell’appello di esame che si intende sostenere. Gli elaborati permettono di sostenere l’esame (si tratta di una idoneità) ma la loro valutazione non concorre al voto finale.
		L’esame si compone di: una prova scritta di natura pratica, con esercizi da risolvere simili a quelli svolti durante le esercitazioni in aula e per i quali sono presenti sulla piattaforma Virtuale numerosi esempi, con relativa soluzione;
		una prova scritta di natura teorica, con domande aperte su tutto il programma del corso.
		La frequentazione delle lezioni (incluse quelle di laboratorio) non è obbligatoria e non concorre al voto finale.
		Alla prima prova viene assegnato un punteggio fra 0 e 30. Se tale punteggio è inferiore a 18, la seconda prova non viene corretta e l’esame non è superato. Altrimenti il voto finale è calcolato come somma di tale punteggio con il risultato ottenuto nella seconda prova, che può variare da -4 a +4, e che può quindi diminuire o aumentare il punteggio della prima prova. Tuttavia, qualora la seconda prova ottenesse una valutazione gravemente insufficiente (ad esempio con la maggior parte delle risposte lasciate in bianco o completamente errate), l’esame non è superato, indipendentemente dal punteggio risultante.
		Se il punteggio complessivo è superiore a 30, si assegna 30 e lode.
		Aquisizione crediti parziali (per passaggio da altra carriera)-->
		Fino a tre crediti: è sufficiente consegnare gli elaborati per confermare il voto precedente.
		Fino a sei crediti: è sufficiente consegnare gli elaborati e sostenere la prima prova. Il voto sarà calcolato come la media del voto precedente e quello della prima prova.
		Contattare il docente di laboratorio per maggiori dettagli operativi.", 
		"Al termine del corso, lo studente acquisisce le nozioni necessarie alla comprensione delle architetture, del funzionamento degli elaboratori e della programmazione assembly.", 
        "ARCHITETTURA DEI CALCOLATORI di Andrew Tanenbaum e Todd Austin Sesta Edizione (2013) Pearson Italia"),
	("08574", "Sistemi Operativi", 2, 1, 6673, "Al termine del corso, lo studente acquisisce le problematiche teoriche e pratiche inerenti al progetto di moderni sistemi operativi, approfondendone la struttura, l'implementazione e il funzionamento.
		 Al termine del corso, lo studente acquisisce le problematiche teoriche e pratiche inerenti al progetto di moderni sistemi operativi, approfondendone la struttura, l'implementazione e il funzionamento.
		  La prova d’esame mira a verificare il raggiungimento dei seguenti obiettivi didattici:
		- conoscenza approfondita degli aspetti teorici, dei requisiti, degli algoritmi e delle scelte progettuali che determinano la realizzazione dei sistemi operativi.
		· conoscenza approfondita e capacità di utilizzo degli strumenti, tecniche ed algoritmi che il sistema operativo offre all'utente e all'amministrazione di sistema per realizzare funzionalità di alto livello in contesti diversi.
		L'esame consiste di una verifica delle abilità pratiche conseguite dallo studente mediante una prova pratica in laboratorio, seguita da una successiva prova scritta per verificare la conoscenza degli aspetti teorici della disciplina. L'ammissione alla seconda prova teorica è condizionata al superamento con voto sufficiente della prima prova pratica. Il voto finale è dato dalla media dei due voti ottenuti nella prova pratica e nella prova teorica, che devono essere entrambi almeno sufficienti.
		La prova pratica dura 1 ora e mezzo ed è svolta nello stesso ambiente di laboratorio e con gli stessi strumenti software che gli studenti utilizzano durante le esercitazioni di laboratorio svolte all'interno del corso. La prova propone una serie di problemi da risolvere mediante l'implementazione di semplici applicazioni e scripts.
		La prova teorica consiste di una prova scritta che dura 1 ora e prevede risposte aperte ad una serie di domande. La prova scritta spazia tra tutti gli argomenti presentati durante il corso, con una particolare attenzione a quelli svolte durante le lezioni frontali in classe.", 
		"Al termine del corso, lo studente acquisisce le problematiche teoriche e pratiche inerenti al progetto di moderni sistemi operativi, approfondendone la struttura, l'implementazione e il funzionamento.", 
        "Silberschatz, P.B. Galvin, G. Gagne, Sistemi operativi. Concetti ed esempi, dalla nona edizione in avanti, Pearson Education Italia (2014)"),
	("70219", "Programmazione ad oggetti", 2, 1, 6673, "Al termine del corso, lo studente possiede le conoscenze di base del paradigma object-oriented per la costruzione del software, dei suoi principali pattern di progettazione, della sua incarnazione nel linguaggio di programmazione Java e relativo framework, includendo aspetti avanzati quali la gestione delle interfacce grafiche, del multi-threading, e degli eventi. 
		Verranno svolte 9 ore di lezione alla settimana, di norma 6 in aula e 3 in laboratorio. In aula vengono illustrate le tecniche di programmazione ad oggetti, i dettagli del linguaggio di programmazione Java, e vengono svolti esercizi stimolando la discussione critica con gli studenti. In laboratorio, vengono illustrati i vari tool di sviluppo, e vengono assegnati task di sviluppo per esercitare le capacità pratiche degli studenti. 
        La verifica avviene in due fasi, non necessariamente ordinate: 1) Prova pratica su programmazione Java in laboratorio. Attraverso 2 esercizi di programmazione Java, che includono test automatizzati o riguardano la produzione di semplici interfacce grafiche, si verifica la capacità dello studente di concludere in tempi brevi e con competenza un semplice task di programmazione/progettazione in Java. 2) Colloquio orale con presentazione di un progetto. A gruppi di 3 persone circa, gli studenti realizzano un progretto di sviluppo software in Java, producendo una relazione che evidenzia requisiti, progrettazione e implementazione. La valutazione di tale relazione include il controllo di qualità della soluzione, e la discussione delle scelte progettuali. Ogni prova porta ad un punteggio compreso fra 0 e 33, e il voto finale è una media ponderata 60% (migliore dei due voti) - 40% (peggiore dei due voti).", 
		"Al termine del corso, lo studente possiede le conoscenze di base del paradigma object-oriented per la costruzione del software, dei suoi principali pattern di progettazione, della sua incarnazione nel linguaggio di programmazione Java e relativo framework, includendo aspetti avanzati quali la gestione delle interfacce grafiche, del multi-threading, e degli eventi.", 
        "Testo di riferimento per il corso: Bruce Eckel. Thinking in Java -- Fourth Edition. Testi aggiuntivi: Joshua Block. Effective Java -- Second Edition Erich Gamma, Richard Elm, Ralph Johnson, John Vlissides. Design Patterns. Il corso si avvarrà anche di tutorial e documentazione tecnica disponibile in rete"),
	("B2561", "Metodi numerici per l'intelligenza artificiale", 2, 2, 6673, "Lo scopo di questo corso è affrontare il background matematico e numerico alla base dell’Intelligenza Artificiale e del Machine Learning, con particolare attenzione alle applicazioni in Scienza e Ingegneria e sostenere l'analisi teorica con l’utilizzo di attività laboratoriali. 
		Il corso è strutturato in lezioni frontali ed esercitazioni in laboratorio. Più precisamente, alle lezioni frontali in aula in cui vengono presentati i metodi numerici di base per risolvere problemi classici della matematica mediante l'uso di un calcolatore, fanno seguito esercitazioni in laboratorio che mirano all'implementazione di tali metodi in Python e allo sviluppo di un'adeguata sensibilità e consapevolezza del loro utilizzo. 
		La prova d'esame mira a verificare il raggiungimento dei seguenti obiettivi didattici: la conoscenza degli elementi fondamentali del calcolo numerico, illustrati durante le lezioni frontali e la capacità di impiegare i metodi numerici di base per risolvere problemi reali mediante calcolatore. L'esame di fine corso (la cui valutazione è in trentesimi) si svolgerà in un'unica prova che comprende, sia la realizzazione al calcolatore di codici Python per la risoluzione di problemi numerici, che la risposta scritta a domande teoriche sugli argomenti trattati nelle lezioni frontali.", 
		"Lo scopo di questo corso è affrontare il background matematico e numerico alla base dell’Intelligenza Artificiale e del Machine Learning, con particolare attenzione alle applicazioni in Scienza e Ingegneria e sostenere l'analisi teorica con l’utilizzo di attività laboratoriali.", 
        "Fondamentale sarà l’utilizzo degli appunti presi a lezione e del materiale informatico reso disponibile su Virtuale. Per ulteriori approfondimenti si consigliano: R. Johansson: Numerical Python - Scientific Computing and Data Science Applications with Numpy, SciPy and Matplotlib (2nd edition), Apress, 2019; J. Kiusalaas: Numerical Methods in Engineering with Python 3, Cambridge University Press, 2013; A. Quarteroni, R. Sacco, F. Saleri, P. Gervasio: Matematica Numerica (4a edizione), Springer Verlag, 2014; R. Bevilacqua, D. Bini, M. Capovani, O. Menchi: Metodi Numerici, Zanichelli, Bologna, 1992; D. Bini, M. Capovani, O. Menchi: Metodi numerici per l'algebra lineare, Zanichelli, Bologna, 1996"),
	("70226", "Programmazione di reti", 2, 2, 6673, "Al termine del corso, lo studente acquisisce le nozioni essenziali sulle architetture di rete e sulle problematiche di progettazione e implementazione di protocolli di comunicazione. 
		Il primo modulo dell'insegnamento si compone esclusivamente di lezioni frontali (40 ore), le lezioni di laboratorio sono demandate al secondo modulo (16 ore). 
		Le modalità di svolgimento della prova d'esame sono spiegate nella pagina del corso sulla piattaforma Virtuale.", 
		"Al termine del corso, lo studente acquisisce le nozioni essenziali sulle architetture di rete e sulle problematiche di progettazione e implementazione di protocolli di comunicazione.", 
        "Achille Pattavina, 'Internet e reti. Fondamenti.' Pearson; 3° edizione (9 febbraio 2022), 576 pagine, ISBN 8891930911"),
	("70218", "Reti di telecomunicazione", 3, 1, 6673, "Al termine del corso, lo studente acquisisce le nozioni essenziali sulle architetture delle moderne reti di telecomunicazioni, con particolare riferimento ad Internet, e sulle problematiche di progettazione e implementazione dei relativi protocolli di comunicazione. 
		Lezioni di didattica frontale in aula. Esercitazioni pratiche in aula: analisi di flussi di pacchetti tramite analizzatore di protocollo (Wireshark); configurazione di una rete IP; analisi pratica di routing e forwarding. L'esame viene svolto in laboratorio al calcolatore utilizzando la piattaforma Esami on Line. L'esame richiede la soluzione di un test con domande a risposta chiusa, domande a risposta aperta ed esercizi.
		Nel caso di risposta aperta si richiede di rispondere con parole proprie ad una o più quesiti inerenti il programma. I quesiti sono normalmente strutturati per punti, per cui le risposte dovrebbero essere organizzate seguendo i punti della domanda. Nel caso di esercizi, simili a quelli già proposti a lezione, viene chiesto di risolvere numericamente uno o più quesiti, oppure di svolgere una o più operazioni legate al funzionamento dei protocolli o alla configurazione degli apparati.
		Nel caso a risposta chiusa si richiede di rispondere ad una serie di domande con risposte pre-compilate che possono avere svariati formati, grafici o testuali. Le domande in formato testuale presentano una domanda o affermazione seguita da tre risposte/affermazioni e possono essere di due tipi:
		risposte multiple non mutuamente esclusive, in cui tipicamente viene chiesto allo studente di scegliere quali delle tre affermazioni siano vere, nell'ipotesi che possano essere anche tutte vere (sempre una almeno è vera);
		risposte multiple mutuamente esclusive, in cui tipicamente viene chiesto allo studente di scegliere quale sia l'unica vera fra le 3 affermazioni proposte (determinata la vera le altre risposte saranno false di conseguenza)", 
		"Al termine del corso, lo studente acquisisce le nozioni essenziali sulle architetture delle moderne reti di telecomunicazioni, con particolare riferimento ad Internet, e sulle problematiche di progettazione e implementazione dei relativi protocolli di comunicazione.", 
		"Achille Pattavina, 'Internet e reti. Fondamenti.' Pearson; 3° edizione (9 febbraio 2022), 576 pagine, ISBN 8891930911"),
	("70090", "Computer graphics", 3, 1, 6673, "Al termine del corso lo studente possiede gli elementi di base della grafica al calcolatore, allo scopo sia di utilizzare con competenza i principali software commerciali che di realizzare interfacce grafiche mediante l'utilizzo delle librerie OpenGL per la modellazione di curve e superfici a forma libera, la realizzazione di tools interattivi per la manipolazione e il rendering di oggetti 3D. 
		Lezioni in aula, esercitazioni in aula, laboratorio guidato. In considerazione della tipologia di attività e dei metodi didattici adottati, la frequenza di questa attività formativa richiede la preventiva partecipazione di tutti gli studenti ai Moduli 1 e 2 di formazione sulla sicurezza nei luoghi di studio, in modalità e-learning. 
		Prova orale alla consegna di un progetto individuale.", 
		"Al termine del corso lo studente possiede gli elementi di base della grafica al calcolatore, allo scopo sia di utilizzare con competenza i principali software commerciali che di realizzare interfacce grafiche mediante l'utilizzo delle librerie OpenGL per la modellazione di curve e superfici a forma libera, la realizzazione di tools interattivi per la manipolazione e il rendering di oggetti 3D.", 
        "J. Hoschek – D. Lasser,Computer Aided Geometric Design, A.K. Peters Wellesley Massachussets 1993; G. Farin, Curves and Surfaces for CADG V Edition,Morgan Kaufmann Publishers; L. Piegel W.Tiller, The NURBS Book – II Edition,Springer Verlag 1997; J. Foley, A. van Dam, S. Feiner, J. Hughes, Computer Graphics Principles and Practice, Addison-Wesley, 1997."),
	("14015", "Crittografia", 3, 2, 6673, "Al termine del corso, lo studente: - conosce i risultati e le tecniche di base della matematica discreta che stanno alla base degli algoritmi crittografici; - conosce gli algoritmi crittografici di base a chiave pubblica e a chiave segreta; - conosce le principali problematiche di sicurezza informatica; - conosce i principali protocolli crittografici moderni; - è capace di comprendere le principali problematiche inerenti la sicurezza di un sistema informatico; -conosce i risultati di base della teoria dell’informazione e della compressione dati; - è in grado di comprendere i collegamenti tra crittografia e teoria dell’informazione. 
		Lezioni frontali ed esercitazioni in aula. I fondamenti teorici concernenti i sistemi crittografici e le loro principali applicazioni, e le principali problematiche di sicurezza dei sistemi informatici sono esposti durante le lezioni frontali. Numerosi esercizi sono svolti in aula, in preparazione alla prova d'esame. Estensioni degli esercizi sono regolarmente suggeriti, e le soluzioni pubblicate sul web, allo scopo di promuovere e favorire lo studio individuale. 
		Scrittura di una relazione di approfondimento di almeno 30 pagine su un argomento svolto a lezione o scelto autonomamente dallo studente in ambito crittografico. Lo studente o la studentessa possono sempre scegliere di sostenere una prova orale aggiuntiva e il docente può richiedere il sostenimento della prova orale quando lo ritenga opportuno per una accurata verifica dell’apprendimento. La consegna delle relazioni deve avvenire per posta elettronica in un qualunque ultimo giorno del mese (12 appelli totali). La frequenza delle lezioni non influenza il voto finale e non è obbligatoria per sostenere le prove di verifica. Per consegnare la relazione non è prevista l’iscrizione su almaesami.
		La modalità di verifica ha lo scopo di accertare le conoscenze, le competenze e la maturità scientifica acquisite dallo studente o dalla studentessa durante il corso. Attraverso l’elaborazione scritta lo studente dimostra la padronanza dei concetti teorici e dei metodi fondamentali della crittografia, la capacità di analizzare criticamente un argomento specifico e di collegarlo ai contenuti del corso o alla letteratura scientifica di riferimento. La relazione consente di valutare la capacità di approfondimento personale, l’autonomia di giudizio e la chiarezza nella presentazione dei contenuti, elementi che riflettono la maturità e la consapevolezza scientifica raggiunte. La prova intende anche verificare la capacità di comunicare in modo rigoroso, ordinato e preciso concetti complessi, utilizzando un linguaggio tecnico appropriato e una struttura argomentativa coerente. Essa stimola inoltre la curiosità intellettuale, la propensione alla ricerca e la capacità di integrare conoscenze teoriche e applicative in un quadro unitario e coerente. La possibilità di sostenere una prova orale aggiuntiva consente una valutazione diretta della comprensione e della chiarezza espositiva, garantendo un giudizio equilibrato sull’apprendimento complessivo.
		Saranno valutati la qualità complessiva della relazione scritta e il livello di padronanza dei concetti teorici, metodologici e comunicativi. Nella fascia di eccellenza, corrispondente ai voti tra 30 e 30 e lode, la relazione si distingue per originalità, rigore, chiarezza e profondità di analisi, dimostrando piena autonomia e curiosità scientifica. Nella fascia buona, tra 27 e 29, l’elaborato risulta solido, ben strutturato e corretto, con conoscenze approfondite e una comunicazione efficace, pur senza caratteri di eccezionalità. Nella fascia sufficiente, tra 18 e 26, il lavoro è adeguato ma limitato nella profondità o nella precisione, con esposizione chiara ma a tratti schematica e linguaggio tecnico solo parzialmente appropriato. Nella fascia insufficiente, fino al voto di 17, la relazione presenta carenze teoriche e metodologiche rilevanti, scarsa coerenza argomentativa e limitata capacità di analisi, non raggiungendo gli obiettivi minimi di apprendimento richiesti.", 
		"Al termine del corso, lo studente: - conosce i risultati e le tecniche di base della matematica discreta che stanno alla base degli algoritmi crittografici; - conosce gli algoritmi crittografici di base a chiave pubblica e a chiave segreta; - conosce le principali problematiche di sicurezza informatica; - conosce i principali protocolli crittografici moderni; - è capace di comprendere le principali problematiche inerenti la sicurezza di un sistema informatico; -conosce i risultati di base della teoria dell’informazione e della compressione dati; - è in grado di comprendere i collegamenti tra crittografia e teoria dell’informazione.", 
        "Handbook of Applied Cryptography, by A. Menezes, P. van Oorschot, and S. Vanstone, CRC Press, 1996; Computer Security: Principles and Practice (4th Edition), Stallings and Brown, Pearson, 2018; Computer Security: Art and Science (2nd Edition), Matt Bishop, Addison-Wesley, 2018."),
	("96642", "Virtualizzazione e Integrazione di Sistemi", 3, 2, 6673, "Al termine del corso lo studente: conosce i principi fondamentali della virtualizzazione, dei sistemi di gestione dell'identità, dei sistemi di protezione delle reti (firewall in particolare); conosce i principali fattori che ostacolano il dispiegamento di servizi e applicazioni distribuiti, in contesti eterogenei in termini di utenti, servizi e sistemi operativi; conosce i principali metodi e strumenti utilizzabili per progettare e dispiegare applicazioni distribuite; conosce i principali protocolli, sistemi e strumenti per consentire l'interazione tra servizi di base offerti da sistemi operativi diversi; conosce le principali piattaforme di gestione di cloud on premise; conosce i principali protocolli, strumenti e piattaforme per configurare, dispiegare, manutenere e monitorare, in modo centralizzato e automatizzato, sistemi, servizi e applicazioni distribuiti. 
		Lezioni Frontali e Esercitazioni in aula e in laboratorio informatico. I fondamenti teorici sono esposti durante le lezioni frontali. Numerosi esercizi pratici sono svolti in aula ad anticipare gli esercizi che gli studenti dovranno successivamente svolgere nelle esercitazioni guidate in laboratorio, con la supervisione del docente. Estensioni delle esercitazioni sono regolarmente suggerite, e le soluzioni pubblicate sul web, allo scopo di promuovere e favorire lo studio individuale e le attività di laboratorio autonome. Alcune esercitazioni in aula e in laboratorio sono dedicate a simulare lo svolgimento della prova teorico/pratica che costituisce la prova d'esame. 
        L'esame consiste di una verifica teorico/pratica delle conoscenza degli aspetti teorici e pratici della disciplina, effettuata mediante una prova scritta.La prova teorico/pratica consiste di una prova scritta che viene svolta al computer nei laboratori della sede, che dura 1 ora e prevede risposte aperte ad una serie di domande ed alcuni semplici esercizi. La prova teorico/pratica scritta spazia tra tutti gli argomenti presentati durante il corso. Se la prova teorico/pratica viene superata, il voto viene verbalizzato dopo 1 settimana. Lo studente ha perciò una settimana di tempo per rifiutare il voto.", 
		"Al termine del corso lo studente: conosce i principi fondamentali della virtualizzazione, dei sistemi di gestione dell'identità, dei sistemi di protezione delle reti (firewall in particolare); conosce i principali fattori che ostacolano il dispiegamento di servizi e applicazioni distribuiti, in contesti eterogenei in termini di utenti, servizi e sistemi operativi; conosce i principali metodi e strumenti utilizzabili per progettare e dispiegare applicazioni distribuite; conosce i principali protocolli, sistemi e strumenti per consentire l'interazione tra servizi di base offerti da sistemi operativi diversi; conosce le principali piattaforme di gestione di cloud on premise; conosce i principali protocolli, strumenti e piattaforme per configurare, dispiegare, manutenere e monitorare, in modo centralizzato e automatizzato, sistemi, servizi e applicazioni distribuiti.", 
        "Dispense del docente pubblicate sul sito personale a partire dall'inizio delle lezioni."),
    # Ingegneria elettronica
    ("15300", "Analisi matematica A", 1, 1, 6670, "Al termine del corso lo studente è in grado di trattare modelli dipendenti da una variabile reale attraverso gli strumenti di base del calcolo differenziale ed integrale. In particolare, sa operare con numeri reali e numeri complessi, sa studiare localmente e globalmente funzioni di una variabile reale, conosce ed applica l'integrale secondo Riemann in una dimensione, ha acquisito e sa applicare i principali risultati su serie numeriche reali e serie di potenze, conosce i principali risultati e metodi risolutivi di equazioni differenziali ordinarie essendo consapevole da quali modelli fisici esse provengono. 
		Lezioni frontali in aula integrate con esempi e controesempi ed esercizi svolti. Prova scritta con esercizi riguardanti gli argomenti del corso seguita da prova orale di verifica sulla comprensione dei principi matematici alla base dell'ingegneria. Solo chi avrà superato la prova scritta sarà ammesso alla succesiva prova orale. Nel periodo gennaio-febbraio la prova orale potrà essere sostenuta anche nell'appello successivo a quello in cui è stato superato lo scritto, negli altri periodi la prova orale va sostenuta nello stesso appello.", 
		"Al termine del corso lo studente è in grado di trattare modelli dipendenti da una variabile reale attraverso gli strumenti di base del calcolo differenziale ed integrale. In particolare, sa operare con numeri reali e numeri complessi, sa studiare localmente e globalmente funzioni di una variabile reale, conosce ed applica l'integrale secondo Riemann in una dimensione, ha acquisito e sa applicare i principali risultati su serie numeriche reali e serie di potenze, conosce i principali risultati e metodi risolutivi di equazioni differenziali ordinarie essendo consapevole da quali modelli fisici esse provengono.", 
        "P. Marcellini, C. Sbordone. Elementi di Analisi Matematica Uno. Liguori Ed."),
    ("16726", "Fisica generale A", 1, 1, 6670, "Al termine del corso lo studente possiede le conoscenze di base sul metodo scientifico-sperimentale. In particolare lo studente: - conosce il significato dei concetti fisici fondamentali che derivano dai Principi della Meccanica, - conosce i principi di conservazione della Meccanica Classica, - è in grado di applicare tali conoscenze per trovare la soluzione di semplici problemi fisici. 
		Lezioni frontali ed esercitazioni (combinazione di diapositive disponibili in anticipo su Virtuale e dimostrazioni/risoluzioni esercizi svolte alla lavagna) con lo scopo di mettere tutti gli studenti in condizione di utilizzare la metodologia indispensabile nella comprensione della Fisica. Sono previste 2-3 esercitazioni da svolgere in aula, in modo da stimolare l'interazione in piccoli gruppi. E' prevista attività di tutorato con lo svolgimento di esercitazioni riassuntive su macro-argomenti quali ad esempio: dinamica traslazionale, moto rotazionale. 
		L'esame finale mira a verificare il raggiungimento degli obiettivi didattici, ovvero la comprensione dei fondamenti della fisica generale e l'acquisizione della metodologia scientifico-tecnica necessaria per affrontare in termini quantitativi i problemi di fisica.", 
		"Al termine del corso lo studente possiede le conoscenze di base sul metodo scientifico-sperimentale. In particolare lo studente: - conosce il significato dei concetti fisici fondamentali che derivano dai Principi della Meccanica, - conosce i principi di conservazione della Meccanica Classica, - è in grado di applicare tali conoscenze per trovare la soluzione di semplici problemi fisici.", 
        "Libro di testo consigliato: Hugh D. Young, Roger A. Freedman, A. Lewis Ford 'PRINCIPI DI FISICA, vol 1. Meccanica, Onde e Termodinamica', Pearson.
		 Gli argomenti del corso sono presenti in tutti i testi di Fisica Generale che contengano gli argomenti di Meccanica (testi di livello universitario che facciano uso del calcolo differenziale e integrale). Ad esempio D.Halliday & R.Resnick 'Fisica 1' , R.Serway 'Principi di Fisica', Douglas C. Giancoli Fisica 1', e molti altri.
		 Per ulteriori esercitazioni si suggerisce la versione elettronica eText del libro sopracitato, che contiene esercizi di sommario dei vari capitoli.
		 Prove scritte degli anni precedenti e loro risoluzione sono disponibili sul sito Virtuale del corso.
"),
    ("16314", "Analisi matematica B", 1, 2, 6670, "Al termine del corso lo studente conosce ed applica strumenti del calcolo differenziale ed integrale di più variabili reali, dell'analisi complessa e dell'analisi armonica. In particolare, sa studiare localmente e globalmente funzioni di più variabili reali, conosce ed applica l'integrale multi-dimensionale secondo Riemann, conosce la definizione di integrale secondo Lebesgue ed è consapevole della necessità di introdurlo per la completezza di importanti spazi funzionali. Ha acquisito e sa applicare i principali risultati su funzioni olomorfe e meromorfe di una variabile complessa, conosce ed usa la serie e la trasformata di Fourier. 
		Lezioni frontali in aula integrate con esempi, controesempi ed esercizi svolti. L'esame consiste in una prova scritta e una prova orale.
		Esame scritto:
		6 esercizi riguardanti gli argomenti del corso simili a quelli forniti durante il corso stesso, da risolvere entro 3 ore di tempo. Il punteggio totale è di 30 punti + 3 punti extra (legati a una o due domande aggiuntive più difficili), e il punteggio per la sufficienza è 15/30.
		NON è consentito portare all'esame libri o appunti, ma è permesso usare righelli e calcolatrici, TRANNE quelle grafiche (ovvero, quelle che permettono di visualizzare grafici di funzioni).
		L'insufficienza ad uno scritto non pregiudica la partecipazione agli scritti successivi.
		Esame orale:
		Prova orale di verifica sulla comprensione dei concetti fondamentali e sulla conoscenza delle definizioni e degli enunciati dei principali risultati. Potrà essere richiesta la dimostrazione di alcuni risultati, se illustrata in aula durante il corso.
		Chi non abbia preso un voto sufficiente a uno scritto non può sostenere la prova orale successiva a tale scritto.
		Si può sostenere l'esame orale SOLO all'interno della stessa sessione dello scritto, anche in un appello differente da quello in cui si è superato lo scritto.
		Un voto insufficiente a un orale non pregiudica la partecipazione agli orali successivi, purché all'interno della stessa sessione. Una volta terminata la sessione, è necessario passare un nuovo scritto per essere ammessi all'orale della sessione successiva.
		L'esame orale consiste in 3 domande alle quali rispondere per iscritto entro 1 ora di tempo, e poi in un breve colloquio di valutazione delle risposte. Il punteggio totale è di 15 punti + 1,5 punti extra (legati a una domande aggiuntiva più difficile), e il punteggio per la sufficienza è 7,5/15.
		Prima dell'inizio dell'esame orale sarà consentito di visionare la correzione del proprio scritto, e di fare domande qualora qualcosa non sia chiaro.
		Voto finale: 
		Il voto finale è dato dalla seguente formula: 2/3 (voto scritto + voto orale).
		L’esame è passato se si è passato sia lo scritto che l’orale e il voto è maggiore o uguale a 18. La lode si ottiene se il voto finale è maggiore o uguale a 31.
		Numero di esami:
		4 appelli nella sessione estiva (3 tra giugno e luglio, 1 a settembre) e 2 appelli nella sessione invernale (tra gennaio e febbraio).
		Iscrizione agli esami:
		È necessario iscriversi sia all'esame scritto che all'esame orale attraverso il sito di Alma Esami.
		Chi non si iscrive non può sostenere l'esame scritto od orale.", 
		"Al termine del corso lo studente conosce ed applica strumenti del calcolo differenziale ed integrale di più variabili reali, dell'analisi complessa e dell'analisi armonica. In particolare, sa studiare localmente e globalmente funzioni di più variabili reali, conosce ed applica l'integrale multi-dimensionale secondo Riemann, conosce la definizione di integrale secondo Lebesgue ed è consapevole della necessità di introdurlo per la completezza di importanti spazi funzionali. Ha acquisito e sa applicare i principali risultati su funzioni olomorfe e meromorfe di una variabile complessa, conosce ed usa la serie e la trasformata di Fourier.", 
        "N. Fusco, P. Marcellini e C. Sbordone, Elementi di Analisi Matematica Due, Liguori Editore; 
		G. C. Barozzi, Matematica per l'Ingegneria dell'Informazione, Ed. Zanichelli (Bologna)."),
    ("19704", "Fisica generale B", 1, 2, 6670, "Al termine del corso lo studente possiede i concetti basilari della Fisica Generale. In particolare lo studente: - conosce le leggi dell'Elettromagnetismo nel vuoto ed i Principi della Termodinamica Classica; - è in grado di trattare questi concetti col linguaggio dell'analisi matematica, del calcolo vettoriale e integrale; - conosce i limiti di validità della Fisica Classica; - possiede la metodologia scientifico - tecnica necessaria per affrontare in termini quantitativi i problemi di Fisica Classica. 
		Le lezioni frontali sono principalmente svolte alla lavagna o alla tavoletta grafica e consistono in spiegazioni teoriche accompagnate da applicazioni ed esercizi pratici. Gli esercizi e le dimostrazioni potranno essere svolte interamente alla lavagna.
		Questi sono finalizzati alla comprensione della teoria e all'acquisizione della metodologia necessaria ad affrontare in maniera quantitativa i problemi di fisica.
		Un tutor sarà a disposizione degli studenti per integrare le lezioni frontali con sessioni di esercitazioni e per supportare gli studenti nell'apprendimento. Le sessioni di tutorato verteranno su esercitazioni riassuntive degli argomenti principali, ad esempio campo Elettrico, campo Magnetico e Termodinamica. 
		L'esame finale mira a verificare il raggiungimento degli obiettivi didattici, ovvero la comprensione dei fondamenti della fisica generale e l'acquisizione della metodologia scientifico-tecnica necessaria per affrontare in termini quantitativi i problemi di fisica.
		La verifica dell'apprendimento è effettuata tramite una prova scritta obbligatoria ed una prova orale facoltativa.", 
		"Al termine del corso lo studente possiede i concetti basilari della Fisica Generale. In particolare lo studente: - conosce le leggi dell'Elettromagnetismo nel vuoto ed i Principi della Termodinamica Classica; - è in grado di trattare questi concetti col linguaggio dell'analisi matematica, del calcolo vettoriale e integrale; - conosce i limiti di validità della Fisica Classica; - possiede la metodologia scientifico - tecnica necessaria per affrontare in termini quantitativi i problemi di Fisica Classica.", 
		"Si consiglia l'adozione di almeno un testo di riferimento, ad integrazione degli appunti presi a lezione. Testo consigliato per la parte di elettromagnetismo: D.C. Giancoli, FISICA 2, Elettromagnetismo - Ottica, Casa Editrice Ambrosiana, Terza edizione o successive. L'opera contiene raccolta di esercizi per ogni capitolo, raccolte di quesiti di teoria a disposizione dello studente risorse online 
		Per la parte di termodinamica, si può adottare il testo adottato per FISICA Generale A. Per ulteriori esercitazioni si suggerisce la versione elettronica dei libri sopracitati, che contengono esercizi di sommario dei vari capitoli. Una serie di esercizi integrativi saranno messi a disposizione dalla docente sul sito Virtuale del corso."),
    ("00269", "Elettronica", 2, 1, 6670, "Al termine del corso lo studente possiede le competenze di base sulle tecniche di analisi di circuiti elettronici lineari e non lineari per applicazioni analogiche e digitali. Conosce ed è in grado di progettare i circuiti di base per l'amplificazione ed il trattamento del segnale in forma analogica e digitale.
		 Lezioni teoriche in aula integrate da esercitazioni relative all'analisi ed al progetto di semplici circuiti analogici.
		Nell'ambito del modulo 1 vengono proposti esercizi, somministrati in itinere durante lo svolgimento del corso, sulla piattaforma 'virtuale'. Lo svolgimento di tali esercizi permette una graduale crescita delle conoscenze e delle conoscenze e facilita la preparazione dell'esame finale.
		Registrazione di lezioni relative a specifici argomenti che richiedano la ripetizione del processo di presentazione da parte del docente in ragione di particolari difficoltà di apprendimento e di contenuti di significativa rilevanza concettuale.
		La verifica dell'apprendimento è articolata in prove parziali scritte e orali, e consiste in una serie di domande volte ad accertare la conoscenza degli aspetti tecnologici e progettuali presentati a lezione e la soluzione a problemi pratici sul tipo di quelli affrontati durante le ore di esercitazione e/o laboratorio che affiancano il corso.
		In particolare, l'esame è suddiviso in due prove parziali relative ai due moduli di cui si compone il corso; ogni prova è ulteriormente articolata in due fasi:
		1) quesiti di carattere teorico-concettuale per la verifica della comprensione dei principali concetti forniti dal corso (scritto o orale);
		2) esercizi di analisi circuitale (scritto).
		Il raggiungimento da parte dello studente di una visione organica dei temi affrontati a lezione congiunta alla loro utilizzazione critica, la dimostrazione del possesso di una padronanza espressiva e di linguaggio specifico saranno valutati con voti di eccellenza. La conoscenza per lo più meccanica e/o mnemonica della materia, capacità di sintesi e di analisi non articolate e/o un linguaggio corretto ma non sempre appropriato porteranno a valutazioni discrete; lacune formative e/o linguaggio inappropriato – seppur in un contesto di conoscenze minimali del materiale d'esame - condurranno a voti che non supereranno la sufficienza. Lacune formative, linguaggio inappropriato, mancanza di orientamento all'interno dei materiali bibliografici offerti durante il corso non potranno che essere valutati negativamente.
		Ognuna delle due prove parziali viene valutata mediante un punteggio in trentesimi; il voto finale viene determinato dalla commissione d'esame e di norma coincide con la media aritmetica dei due voti parziali.", "Al termine del corso lo studente possiede le competenze di base sulle tecniche di analisi di circuiti elettronici lineari e non lineari per applicazioni analogiche e digitali. Conosce ed è in grado di progettare i circuiti di base per l'amplificazione ed il trattamento del segnale in forma analogica e digitale.",
		" Richard C. Jaeger, T. N. Blalock: Microelettronica, McGraw-Hill; David Esseni, Fondamenti di Circuiti Digitali Integrati
		SGEditoriali Padova ISBN 88-89884-01-0; J. Rabaey, A. Chandrakasan, B. Nikolic
		Digital Integrated Circuits, A design Perspective
		Prentice Hall disponibile anche in versione italiana: Circuiti integrati digitali. L'ottica del progettista, Pearson Prentice Hall; 
		Il libro è corredato da un sito web molto ricco di materiale didattico, inclusi i file dei lucidi relativi a molti capitoli del libro."),
    ("B5603", "Sistemi e circuiti elettrici lineari", 2, 1, 6670, "L’analisi dei sistemi lineari è uno strumento fondamentale per la formazione di un ingegnere. È una disciplina che permette di legare le conoscenze di base di matematica, algebra e geometria alle discipline caratterizzanti dell’elettronica e delle telecomunicazioni. Al termine del corso, lo studente acquisisce le competenze per l’analisi dei sistemi lineari, con particolare riferimento alle reti elettriche lineari in regime dinamico. 
		Il corso prevede 60 ore di didattica frontale, suddivise in 40 dedicate alla teoria e 20 ore per lo svolgimento di esercizi. 
		L'esame è costituito da una prova scritta suddivisa in due parti, una dedicata agli esercizi ed una dedicata alla teoria. Per accedere alla parte teorica è necessario conseguire la sufficienza nella parte di esercizi. Due esercizi sul programma svolto a lezione. La prova ha una durata di due ore. Materiale necessario: calcolatrice. Materiale opzionale: formulario manoscritto formato A4 fronte-retro.
		La parte teorica è costituita da due domande aperte sugli argomenti teorici sviluppati durante le lezioni. La prova ha una durata di un'ora. Materiale necessario: calcolatrice.
		Il voto complessivo è dato dalla media tra le due prove. Maggiori dettagli sulle modalità di esame sono disponibili sulla pagina Virtuale del corso.", 
		"L’analisi dei sistemi lineari è uno strumento fondamentale per la formazione di un ingegnere. È una disciplina che permette di legare le conoscenze di base di matematica, algebra e geometria alle discipline caratterizzanti dell’elettronica e delle telecomunicazioni. Al termine del corso, lo studente acquisisce le competenze per l’analisi dei sistemi lineari, con particolare riferimento alle reti elettriche lineari in regime dinamico.", 
        "Si segnalano i seguenti testi di riferimento: C. Alexander, M. Sadiku, 'Circuiti Elettrici', McGraw-Hill e R. Perfetti, 'Circuiti elettrici', Zanichelli"),
    ("03716", "Calcolatori elettronici", 2, 2, 6670, "Al termine del corso, lo studente dispone del metodo e degli strumenti con cui affrontare con consapevolezza il progetto di semplici sistemi a microprocessore. Lo studente impara ad analizzare e fare la sintesi di reti logiche combinatorie e sequenziali (sincrone e asincrone). Queste conoscenze costituiscono la base per lo studio delle architetture dei moderni calcolatori elettronici, delle quali lo studente ne apprende i principi generali di funzionamento, l'impatto sulle prestazioni, il progetto dell'unità di elaborazione e la mutua relazione esistente tra hardware e software. Al di là dei contenuti specifici, lo studente acquisisce una delle principali abilità che l'industria chiede oggi a un ingegnere dell'informazione, e cioè la capacità di gestire la complessità di un progetto, abituandolo alla pratica dell'astrazione, intesa come attività volta a rappresentare in modo efficace e gerarchico l'essenza del sistema di elaborazione.
		Verranno inizialmente introdotti i principi di funzionamento di un calcolatore. Si seguirà in un primo momento un approccio 'top-down' volto ad evidenziare le parti fondamentali che costituiscono l'hardware di un calcolatore. Verranno quindi studiate le reti logiche come parti fondamentali dell'hardware del calcolatore, dalle quali seguendo un approccio 'bottom-up', si giungerà a delineare la struttura interna di una CPU. Infine, si mostrerà come la CPU possa interagire con gli altri elementi fondamentali del calcolatore (memoria e dispositivi di I/O) e come il suo funzionamento sia strettamente legato all'architettura del set di istruzioni da essa supportato.
		Prova scritta svolta interamente su EOL.",
		"Al termine del corso, lo studente dispone del metodo e degli strumenti con cui affrontare con consapevolezza il progetto di semplici sistemi a microprocessore. Lo studente impara ad analizzare e fare la sintesi di reti logiche combinatorie e sequenziali (sincrone e asincrone). Queste conoscenze costituiscono la base per lo studio delle architetture dei moderni calcolatori elettronici, delle quali lo studente ne apprende i principi generali di funzionamento, l'impatto sulle prestazioni, il progetto dell'unità di elaborazione e la mutua relazione esistente tra hardware e software. Al di là dei contenuti specifici, lo studente acquisisce una delle principali abilità che l'industria chiede oggi a un ingegnere dell'informazione, e cioè la capacità di gestire la complessità di un progetto, abituandolo alla pratica dell'astrazione, intesa come attività volta a rappresentare in modo efficace e gerarchico l'essenza del sistema di elaborazione.", 
		"R. Laschi, M. Prandini: 'Appunti di Reti Logiche', Esculapio 2007; Hennessy Patterson: 'Computer architecture: a quantitative approach' - Morgan Kaufmann pub. Inc., second edition; Giacomo Bucci: Architetture dei calcolatori elettroniciî McGraw-Hill"),
    ("00196", "Controlli automatici", 2, 2, 6670, "Al termine del corso lo studente è in grado di utilizzare gli strumenti operativi per l'analisi e la sintesi dei sistemi di controllo. In particolare lo studente è in grado di: - determinare la funzione di trasferimento di un sistema dinamico e tracciarne i relativi diagrammi di Bode - calcolare la risposta nel dominio dei tempi di un sistema dinamico - analizzare le proprietà di stabilità di un sistema di controllo in retroazione - analizzare le proprietà di robustezza di un sistema di controllo in retroazione rispetto all'azione di disturbi e/o variazioni dei parametri - analizzare il funzionamento di sistemi di controllo basati su regolatori (PID e reti correttrici) di largo utilizzo nei sistemi di controllo industriali.
		Il corso è affiancato da esercitazioni in aula e su PC. Le esercitazioni sono parte integrante del corso e comprendono aspetti elementari di modellistica e l'applicazione delle metodologie fondamentali di analisi e di progetto dei sistemi di controllo, in modo da mettere gli studenti in grado di risolvere i più semplici problemi tecnici che si possono presentare nell'attività professionale. 
		Prova scritta COMPLETA: esercizi e domande di teoria.
		La prova scritta viene completata da una prova orale facoltativa
		a richiesta dello studente", "Al termine del corso lo studente è in grado di utilizzare gli strumenti operativi per l'analisi e la sintesi dei sistemi di controllo. In particolare lo studente è in grado di: - determinare la funzione di trasferimento di un sistema dinamico e tracciarne i relativi diagrammi di Bode - calcolare la risposta nel dominio dei tempi di un sistema dinamico - analizzare le proprietà di stabilità di un sistema di controllo in retroazione - analizzare le proprietà di robustezza di un sistema di controllo in retroazione rispetto all'azione di disturbi e/o variazioni dei parametri - analizzare il funzionamento di sistemi di controllo basati su regolatori (PID e reti correttrici) di largo utilizzo nei sistemi di controllo industriali.", "Appunti di teoria, esercitazioni e compiti svolti, redatte dal docente e dal tutor, sono scaricabili in formato pdf o zip presso il portale di Facoltà
		G. Marro. Controlli Automatici. Zanichelli Ed. Bologna
		R.C. Dorf, R.H. Bishop. Modern Control Systems. Ninth Edition. Addison-Wesley Publ. 2001.
		P.Bolzern, R.Scattolini, N.Schiavoni. 'Fondamenti di Controlli Automatici', McGraw Hill 2004.
		M.E. Penati, G. Bertoni. Automazione e Sistemi di Controllo. Volume I e II. Progetto Leonardo. Bologna"),
    ("07941", "Campi elettromagnetici", 3, 1, 6670, "Il corso ha lo scopo di fornire gli strumenti fondamentali per capire i meccanismi di propagazione libera e guidata del campo elettromagnetico. In particolare, al termine del corso lo studente conosce: - i fondamenti dell'elettromagnetismo macroscopico, la formulazione di Maxwell e le corrispondenti equazioni da cui si ricava la propagazione di onde (equazioni delle onde, equazioni di Helmoltz); - tecniche generali per la risoluzione del problema di Maxwell in presenza o meno di sorgenti del campo elettromagnetico - le più importanti grandezze caratteristiche di una antenna (direttività e guadagno, efficienza, superficie e diagramma di radiazione) ed il loro significato -come dimensionare un semplice radio collegamento con antenne ottimizzate in polarizzazione tramite l'equazione di Friis - il comportamento dei principali mezzi trasmissivi, come le guide d'onda e le linee di trasmissione, orientato al loro impiego nei moderni sistemi e circuiti a radio-frequenza. Lezioni frontali ed esercitazioni in aula. Il corso e' basato prevalentemente su un metodo induttivo, si cerca cioe' di indurre gli studenti a passare da concetti intuitivi alla formalizzazione matematica necessaria per una trattazione rigorosa. In tal modo si tenta di mantenere alto il livello di attenzione.
		Si effettuano verifiche dell'apprendimento con discussioni interattive. l'esame consiste in una prova scritta e un orale su tutto il programma del corso. Il voto finale risulta dalla valutazione contestuale dei punti di scritto e orale. E' possibile visionare ed eventualmente discutere la prova scritta solo all'orale. Candidati la cui prova scritta e' insufficiente dovranno sostenere nuovamente scritto ed orale in un appello successivo. La validità dello scritto è limitata all'appello corrente.
		Per sostenere l'esame è obbligatoria l'iscrizione in Almaesami. NOTA: Per gli iscritti fino all'AA 2020-21 che abbiano già sostenuto l'esame per il solo modulo I con le vecchie modalità, sarà data la possibilità di sostenere l'esame per il solo modulo II entro un limite massimo di 18 mesi dalla data dell'esame del modulo I.", 
		"Il corso ha lo scopo di fornire gli strumenti fondamentali per capire i meccanismi di propagazione libera e guidata del campo elettromagnetico. In particolare, al termine del corso lo studente conosce: - i fondamenti dell'elettromagnetismo macroscopico, la formulazione di Maxwell e le corrispondenti equazioni da cui si ricava la propagazione di onde (equazioni delle onde, equazioni di Helmoltz); - tecniche generali per la risoluzione del problema di Maxwell in presenza o meno di sorgenti del campo elettromagnetico - le più importanti grandezze caratteristiche di una antenna (direttività e guadagno, efficienza, superficie e diagramma di radiazione) ed il loro significato -come dimensionare un semplice radio collegamento con antenne ottimizzate in polarizzazione tramite l'equazione di Friis - il comportamento dei principali mezzi trasmissivi, come le guide d'onda e le linee di trasmissione, orientato al loro impiego nei moderni sistemi e circuiti a radio-frequenza.", 
		"Dispense del corso; F. T. Ulaby, U. Ravaioli - Fondamenti di campi Elettromagnetici, Pearson Italia, 2021. Per ulteriori approfondimenti: V. Rizzoli, Lezioni di Campi Elettromagnetici, Propagazione libera e antenne, Ed. Progetto Leonardo, Bologna; V. Rizzoli, A. Lipparini, Propagazione elettromagnetica guidata, Esculapio, Bologna, 1998; S. J. Orfanidis, Electromagnetic waves and antennas, Online book"),
    ("69774", "Comunicazione digitali e internet", 3, 1, 6670, "Al termine del corso lo studente possiede le conoscenze di base sulle tecnologie dei sistemi e delle reti di telecomunicazione, unitamente ai principali criteri di progetto. In particolare lo studente sarà in grado di: - Comprendere le tecniche di modulazione analogica e numerica. - Comprendere i fenomeni aleatori ed i problemi legati al rumore negli apparati. - Dimensionare sistemi di trasmissione numerica, sia in banda base che in banda passante. - Comprendere l'architettura dei sistemi di trasmissione su cavo, su fibra ottica e wireless. - Comprendere l'architettura di Internet ed i principi di funzionamento dei principali protocolli. - Progettare e configurare reti locali di piccole dimensioni a partire dallo strato fisico (cablaggio) fino allo strato di rete (numerazione e subnetting IP). - Mettere a confronto le principali tecnologie di reti locali (LAN) identificando le più idonee ad un certo scenario operativo. - Valutare l'efficienza di protocolli di linea (HDLC, PPP,...) con riferimento alle caratteristiche del canale. 
		MODULO 1 - INTERNET E RETI DI TELECOMUNICAZIONI (Laurea in Ingegneria Elettronica)
		RETI DI TELECOMUNICAZIONE (Laurea in Ingegneria Biomedica) --> Lezioni di didattica frontale in aula. Esercitazioni pratiche e dimostrazioni in aula su: analisi di flussi di pacchetti tramite analizzatore di protocollo (Wireshark); virtualizzazione di rete e tecnologie cloud; principi di programmazione di applicazioni di rete; configurazione di reti IP e verifica del corretto funzionamento. MODULO 2 - COMUNICAZIONI DIGITALI (Laurea in Ingegneria Elettronica) --> Lezioni di didattica frontale in aula. Esercitazioni di laboratorio su: elaborazione di segnali al calcolatore; analisi di segnali modulati con l'uso di strumenti di misura quali oscilloscopio, generatore di funzioni, analizzatore di spettro. 
        Sono previste due prove finali, una per ciascun modulo didattico, che intendono valutare la capacità dello studente di comprendere i principi di funzionamento e le tecniche di progetto di base dei sistemi e delle reti di telecomunicazioni.
		MODULO 1 - INTERNET E RETI DI TELECOMUNICAZIONI (Laurea in Ingegneria Elettronica) e RETI DI TELECOMUNICAZIONE (Laurea in Ingegneria Biomedica) --> La verifica dell'apprendimento avviene tramite somministrazione di un test al calcolatore seguito da un colloquio orale. Il test consiste in 12 domande a risposta multipla su tutti gli argomenti del corso e un esercizio scritto. Delle 12 domande, 6 contengono risposte mutuamente esclusive e 6 non mutuamente esclusive. Ogni domanda con risposte mutuamente esclusive vale 1 punto, ogni domanda con risposte non mutuamente esclusive vale 2 punti, per un totale di massimo 18 punti. A questi vanno aggiunti fino a 8 punti per l'esercizio scritto e fino a 8 punti per il colloquio orale, in base alla difficoltà.
		MODULO 2 - COMUNICAZIONI DIGITALI (Laurea in Ingegneria Elettronica) --> La verifica dell'apprendimento avviene tramite somministrazione di un esame scritto, seguito da un colloquio orale.
		Alle Studentesse e agli Studenti con DSA o disabilità temporanee o permanenti si raccomanda di contattare per tempo l’ufficio di Ateneo responsabile. Sarà cura dell'ufficio proporre eventuali adattamenti, che dovranno comunque essere sottoposti, con un anticipo di 15 giorni, all’approvazione del/la docente, che ne valuterà l'opportunità anche in relazione agli obiettivi formativi dell'insegnamento.", 
		"Al termine del corso lo studente possiede le conoscenze di base sulle tecnologie dei sistemi e delle reti di telecomunicazione, unitamente ai principali criteri di progetto. In particolare lo studente sarà in grado di: - Comprendere le tecniche di modulazione analogica e numerica. - Comprendere i fenomeni aleatori ed i problemi legati al rumore negli apparati. - Dimensionare sistemi di trasmissione numerica, sia in banda base che in banda passante. - Comprendere l'architettura dei sistemi di trasmissione su cavo, su fibra ottica e wireless. - Comprendere l'architettura di Internet ed i principi di funzionamento dei principali protocolli. - Progettare e configurare reti locali di piccole dimensioni a partire dallo strato fisico (cablaggio) fino allo strato di rete (numerazione e subnetting IP). - Mettere a confronto le principali tecnologie di reti locali (LAN) identificando le più idonee ad un certo scenario operativo. - Valutare l'efficienza di protocolli di linea (HDLC, PPP,...) con riferimento alle caratteristiche del canale.", 
        "MODULO 1 - INTERNET E RETI DI TELECOMUNICAZIONI (Laurea in Ingegneria Elettronica) e RETI DI TELECOMUNICAZIONE (Laurea in Ingegneria Biomedica) --> A. Pattavina, 'Internet e Reti: Fondamenti', 3a edizione, Pearson, 2022, ISBN: 9788891930910 e A. S. Tanenbaum, N. Feamster, D. Wetherall, 'Reti di Calcolatori', 6a edizione, Pearson, 2023, ISBN: 9788891915313. MODULO 2 - COMUNICAZIONI DIGITALI (Laurea in Ingegneria Elettronica) --> M. Chiani, Trasmissione dell’informazione, Amazon, 2023 e L. Calandrino, M. Chiani, Lezioni di comunicazioni elettriche, Pitagora Editrice, Bologna."),
    ("10907", "Elettronica dei sistemi digitali", 3, 2, 6670, "Al termine del corso lo studente: - possiede le conoscenze per effettuare valutazioni critiche e scelte di progetto sulle principali architetture digitali di calcolo, elaborazione, comunicazione, memorizzazione dati - possiede competenze di base nella progettazione di sistemi digitali assistita da calcolatore e nei linguaggi di descrizione dell'hardware - è in grado di progettare semplici sistemi digitali basati su logiche programmabili e dispositivi a microcontrollore.
		Durante l'attività didattica, una parte rilevante delle ore di lezione sarà dedicata a lezioni ed esercitazioni pratiche da svolgersi presso il laboratorio di elettronica al fine di apprendere l'uso dei linguaggi di descrizione hardware e degli strumenti software di progettazione di sistemi digitali assistita da calcolatore. Saranno previste esercitazioni a carattere pratico-progettuale su sistemi FPGA e a microcontrollore utilizzando software e hardware disponibile presso i laboratori.
		In considerazione della tipologia di attività e dei metodi didattici adottati, la frequenza alle attività di laboratorio di questa attività formativa richiede la preventiva partecipazione di tutti gli studenti ai Moduli 1 e 2 di formazione sulla sicurezza nei luoghi di studio, in modalità e-learning.
		L'esame sarà composto da due prove di accertamento. Il punteggio finale sarà calcolato effettuando la media dei punteggi ottenuti nelle due prove, che dovranno essere necessariamente sopra la soglia della sufficienza.
		La prima prova è a carattere pratico e verrà svolta presso il laboratorio di elettronica con l'ausilio del calcolatore: consiste nella progettazione, simulazione e sintesi di una rete digitale utilizzando il linguaggio di descrizione hardware VHDL e gli strumenti di sviluppo presentati nel corso. Le specifiche del problema da risolvere saranno illustrate nel testo consegnato all'inizio della prova. Ai fini della valutazione saranno considerati rilevanti la correttezza dell'impostazione del progetto logico, la correttezza dell'implementazione VHDL del progetto, la capacità di validare il funzionamento della rete digitale progettata mediante l'applicazione di opportuni segnali esterni in simulazioni digitali.
		La seconda prova ha carattere orale e dovrà accertare la conoscenza teorica e critica da parte dello studente dei contenuti presentati in aula a lezione: consiste nella discussione di quesiti sulle relative parti di programma del corso. Ai fini della valutazione saranno considerati rilevanti la comprensione dei contenuti del corso e la capacità di ragionamento sugli stessi, oltre ad un utilizzo corretto del linguaggio tecnico della disciplina.
		In ogni appello vi sarà la possibilità di svolgere entrambe le prove. Per sostenere la seconda prova sarà comunque necessario avere ottenuto una valutazione positiva nella prima prova. La seconda prova potrà essere svolta sia nel medesimo appello in cui è stata superata la prima prova che in appelli diversi.", 
		"Al termine del corso lo studente: - possiede le conoscenze per effettuare valutazioni critiche e scelte di progetto sulle principali architetture digitali di calcolo, elaborazione, comunicazione, memorizzazione dati - possiede competenze di base nella progettazione di sistemi digitali assistita da calcolatore e nei linguaggi di descrizione dell'hardware - è in grado di progettare semplici sistemi digitali basati su logiche programmabili e dispositivi a microcontrollore.", 
		"Dispense del corso disponibili online su Virtuale. Per approfondimenti, è possibile consultare: R. Jasinski, 'Effective Coding with VHDL. Principles and practice', MIT Press, 2016; D. Perry, 'VHDL. Programming by examples', McGraw-Hill Professional; 4th edition, 2002; F. Zappa, 'Microcontrollers. Hardware and Firmware for 8-bit and 32-bit devices', 1st edition, 2017, Esculapio
		; J. Rose, A. El-Gamal, A. Sangiovanni-Vincentelli, 'Architecture of Field-Programmable Gate Arrays', Proc. IEEE, vol. 81, n. 7, July 1993, pp.1013-1029"),
    ("69773", "Progetto di circuiti elettronici", 3, 2, 6670, "Al termine del corso, lo studente è in grado di analizzare i limiti imposti dalla realizzazione tecnologica, a componenti discreti o integrati, sulle funzionalità del sistema. In particolare, lo studente è in grado: 1 - di analizzare circuiti elettronici operanti in regime di retroazione e progettare oscillatori elettronici 2 - di valutare i limiti critici fondamentali della comunicazione dei segnali nei sistemi elettronici implementati su scheda o su circuito integrato; 3 - di progettare i circuiti elettronici sapendo individuare le scelte architetturali sulla base della implementazione tecnologica. Verranno fatte lezioni frontali.
		L’esame di fine corso mira a valutare il raggiungimento dell'obiettivo didattico: Saper progettare circuiti elettronici in regime di retoazione e linee di trasmissione adeguate al regime dei segnali
		L'esame consiste in due valutazioni che avvengono durante un colloquio orale individuale, dalla durata di 45-60m. La prima valutazione avviene sul programma mediante due o tre domande specifiche sugli argomenti. La seconda valutazione avviene sul progetto vero e proprio che potra' essere esposto direttamente su un computer portatile oppure mediante stampa di una relazione. Il progetto consiste nel verificare mediante il simulatore SPICE alcune relazioni teoriche spiegate a lezione, a scelta dello studente.", 
		"Al termine del corso, lo studente è in grado di analizzare i limiti imposti dalla realizzazione tecnologica, a componenti discreti o integrati, sulle funzionalità del sistema. In particolare, lo studente è in grado: 1 - di analizzare circuiti elettronici operanti in regime di retroazione e progettare oscillatori elettronici 2 - di valutare i limiti critici fondamentali della comunicazione dei segnali nei sistemi elettronici implementati su scheda o su circuito integrato; 3 - di progettare i circuiti elettronici sapendo individuare le scelte architetturali sulla base della implementazione tecnologica.", 
		"H.B. BAKOGLU CIRCUITS INTERCONNECTIONS AND PACKAGING FOR VLSI ADDISON-WESLEY 1990; S. HALL G. HALL J. MCCALL HIGH-SPEED DIGITAL SYSTEM DESIGN WILEY 2000; Digital Integrated Circuits, by Jan M. Rabaey, Anantha Chandrakasan, and Borivoje Nikolic, Prentice Hall; D. Johns, K. Martin, Analog Integrated Circuit Design, Wiley, 1997; A. SEDRA, K. SMITH, 'Microelectronic Circuits' 4-th edition , Oxford Press, 1998.");
    
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

