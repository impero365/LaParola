USE laparola_testo;

DROP TABLE IF EXISTS Brani;
CREATE TABLE Brani (
  id_b MEDIUMINT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  Libro1 SMALLINT UNSIGNED NOT NULL,
  Capitolo1 SMALLINT UNSIGNED NOT NULL,
  Versetto1 SMALLINT UNSIGNED NOT NULL,
  Libro2 SMALLINT UNSIGNED NOT NULL,
  Capitolo2 SMALLINT UNSIGNED NOT NULL,
  Versetto2 SMALLINT UNSIGNED NOT NULL,
  Domanda TEXT,
  Risposta TEXT
);

-- Data file is mounted in the db container at /var/lib/mysql-files/brani (see docker-compose.yml).
-- import-tool.sh runs mysql from /var/lib/mysql-files/data with --local-infile=1, so the
-- client can read this path via LOAD DATA LOCAL INFILE.
LOAD DATA LOCAL INFILE "/var/lib/mysql-files/brani/brani.sql"
  INTO TABLE Brani
  FIELDS TERMINATED BY '|'
  (Libro1, Capitolo1, Versetto1, Libro2, Capitolo2, Versetto2, Domanda, Risposta);
