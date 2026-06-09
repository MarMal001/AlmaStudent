#!/bin/bash

mariadb -u root almastudent_er << EOF
UPDATE studente_in_corso
SET Esame_Superato = true
WHERE Utente = "$1"
AND Codice_Corso = "$2"
EOF
