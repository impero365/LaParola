Fork of https://github.com/LPN6/LaParola

Modificato per permettere l'esecuzione dal locale tramite containers docker:

- Cambiate le estensioni di alcuni file del database di modo da riflettere il loro contenuto (txt -> sql o viceversa)
- Aggiunto container docker per avvio da locale
- Creato tool per facilitare l'import del database
- Cambiata la configurazione di conn.php per permettergli di usare i parametri contenuti nel file .env

**Esecuzione**
- Assicurati che docker sia stato installato
- Dalla cartella "Sito" esegui "docker compose up"
- Dalla cartella "Sito/Database" esegui "import-tool.sh" e seleziona l'opzione "A"
- Accedi all'interfaccia su http://localhost:8080


----------------------

LaParola ha lo scopo di distribuire la Bibbia elettronicamente affinché italiani possano leggerla, studiarla, e insegnarla meglio. Ci sono due modi principali per la distribuzione: tramite il sito https://www.laparola.net/ e attraverso delle app per computer, cellulari e tablet.



Ho voluto mettere qui tutto quello che ho prodotto e che viene distribuito, affinché mi possa sopravvivere quando non potrò più gestire il sito e le app, e che il contenuto possa continuare a servire la chiesa italiana. Sicuramente nel futuro il sito e le app non funzioneranno più, e ci saranno dei nuovi modi per ottenere informazioni. Forse qualcuno potrà diffondere questo contenuto tramite questi nuovi modi.



Ci sono alcune sezioni qui. Ogni sezione ha un file README con ulteriori informazioni sul contenuto della sezione.

1. Testi: Tutto il contenuto delle risorse che vengono distribuite nelle app: versioni della Bibbia, commentari, dizionari, ed altri libri.
2. Codice sorgente: Il codice delle app.
3. Sito: I file che compongono il sito, e il database che produce il contenuto del sito.
