USE laparola_testo;

DROP TABLE IF EXISTS Quiz;
CREATE TABLE Quiz (id_d MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, id_t MEDIUMINT UNSIGNED NOT NULL, domanda VARCHAR(255) NOT NULL, risposta1 VARCHAR(255) NOT NULL, risposta2 VARCHAR(255) NOT NULL, risposta3 VARCHAR(255) NOT NULL, risposta4 VARCHAR(255) NOT NULL, risposta TINYINT UNSIGNED NOT NULL, spiegazione VARCHAR(5000) NOT NULL, giuste INT UNSIGNED NOT NULL DEFAULT 0, sbagliate INT UNSIGNED NOT NULL DEFAULT 0);

DROP TABLE IF EXISTS QuizTemi;
CREATE TABLE QuizTemi (id_t MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, tema VARCHAR(255) NOT NULL);

LOAD DATA LOCAL INFILE "quiz.txt" INTO TABLE Quiz FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '"' (id_t,domanda,risposta1,risposta2,risposta3,risposta4,risposta,spiegazione);

-- Support both Unix (LF) and Windows (CRLF) line endings:
-- always split on '\n'; if the file uses CRLF, strip the leftover '\r' from tema.
-- (Do NOT use LINES TERMINATED BY '\r\n' alone: with LF-only files MySQL loads one giant row.)
LOAD DATA LOCAL INFILE "quiztemi.txt"
  INTO TABLE QuizTemi
  LINES TERMINATED BY '\n'
  (tema)
  SET tema = TRIM(TRAILING '\r' FROM tema);
