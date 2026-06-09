UPDATE studente_in_corso AS s
SET s.Esame_Superato = true
WHERE s.Utente = "f.r@studio.unibo.it"
AND s.Codice_Corso = "70226"