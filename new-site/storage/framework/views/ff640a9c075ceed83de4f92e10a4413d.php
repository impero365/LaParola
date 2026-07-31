<?php $__env->startSection('page_title', 'La Sacra Bibbia - Aiuto per la ricerca'); ?>

<?php $__env->startSection('content'); ?>
<h1>Come ricercare un'espressione nella Bibbia</h1>
<p>1. Digita l'espressione da ricercare. 
L'espressione da ricerca pi&ugrave; semplice &egrave; una parola. &Egrave; anche possibile digitare diverse parole, e tutti i versetti che contengono tutte le parole saranno mostrate. Per creare ricerche pi&ugrave; complicate ancora, bisogna inserire dei simboli fra le parole.</p>
<table border="1">
<tr><th align="left">Simbolo</th><th align="left">Significato</th></tr>
<tr><td>spazio</td><td>e</td></tr>
<tr><td>|, !</td><td>o</td></tr>
<tr><td>1, ..., 9</td><td>e entro: la seconda parola deve apparire entro questo numero di versetti e nello stesso capitolo</td></tr>
</table>
<p>Una difficolt&agrave; con le ricerche in italiano &egrave; che molte parole hanno diverse forme - per esempio pregare, preghiera, preg&ograve;, pregasse, eccetera. Per poter trovare tutte le parole simili, il motore di ricerca usa il concetto di radici, la forma da cui tutte le altre parole si derivano. La radice &egrave; l'infinito del verbo, se esiste. Per esempio, una ricerca per /pregare trova tutti i versetti che contengono qualsiasi forma della parola pregare. I seguenti simboli prima di una parola modificano la parola o le parole ricercate:</p>
<table border="1">
<tr><th align="left">Simbolo</th><th align="left">Significato</th></tr>
<tr><td>*</td><td>Qualsiasi parola che comincia con le seguenti lettere</td></tr>
<tr><td>#</td><td>Qualsiasi parola che contiene le seguenti lettere</td></tr>
<tr><td>/</td><td>Qualsiasi parola che ha questa radice</td></tr>
<tr><td>&bsol;</td><td>Qualsiasi parola che ha la stessa radice della seguente parola</td></tr>
<tr><td>^, ~</td><td>non la seguente parola<br />&nbsp;&nbsp;(o parole se seguito da *, #, / o &bsol;; deve seguire uno spazio o un numero cio&egrave; <em>e</em> o <em>e entro</em>)</td></tr>
</table>
<p>Per raggruppare delle parole, &egrave; possibile mettere parentesi intorno alle espressioni.
</p>
<p>2. Scegli quale versione della Bibbia vuoi visualizzare - &egrave; possibile scegliere solo una versione.</p>
<p>3. Digita il riferimento del brano in cui vuoi ricercare la frase. Questo &egrave; facoltativo - se non &egrave; digitato nessun riferimento, l'\''espressione &egrave; cercata in tutta la Bibbia. &Egrave; anche possibile digitare <em>nt</em> per tutto il Nuovo Testamento, o <em>vt</em> per tutto il Vecchio Testamento.<br />Per un riferimento, si pu&ograve; usare il formato Giovanni&nbsp;3:16-17,19, oppure Giovanni&nbsp;3,16-17.19. &Egrave; anche possibile includere diversi brani, separandoli con una virgola o punto e virgola; per esempio Giovanni&nbsp;3:16-17,19;&nbsp;4:5,&nbsp;Atti 2:14. Non &egrave; necessario digitare l'\''intero nome del libro, perch&eacute; il sito riconosce quasi tutte le abbreviazioni comunemente usate per i libri. Per un elenco completo, fa'\'' clic <a href="abbrev.php">qui</a>. Spazi e lettere maiuscole sono facoltativi; il sito riconosce quasi qualsiasi tipo di riferimento possibile.</p>
<p>4. Di solito il sito visualizza solo i primi 50 versetti che contengono la frase. Dopo aver eseguito la ricerca, dalla pagina che mostra i versetti, &egrave; possibile mostrare i prossimi versetti che contengono la frase, oppure mostrare pi&ugrave; versetti ogni volta, oppure tutti i versetti.</p>
<p>5. Nella <a href="/ricerca_avanzata.php">ricerca avanzata</a> &egrave; possibile cambiare quanti brani sono visualizzati su ogni pagina, oppure mettere 0 per visualizzare tutti. &Egrave; anche possibile decidere il formato da usare per visualizzare i riferimenti. Se il formato non &egrave; scelto, il sito cerca di decidere il formato da usare in base alla versione da visualizzare.</p>
<h2>Esempi di ricerche</h2>
<table border="1">
        <tr>
                <th>Espressione:</th>
                <th>Trova i versetti con:</th>
        </tr>
        <tr>
                <td>perdona</td>
                <td>"perdona"</td>
        </tr>
        <tr>
                <td>perdona peccatore</td>
                <td>"perdona" e "peccatore"</td>
        </tr>
        <tr>
                <td>perdona | peccatore</td>
                <td>"perdona" o "peccatore"</td>
        </tr>
        <tr>
                <td>/perdonare /peccare</td>
                <td>una parola con radice "perdonare" e una parola con radice "peccare"</td>
        </tr>
        <tr>
                <td>&bsol;perdona &bsol;peccatore</td>
                <td>uguale all'esempio precedente</td>
        </tr>
        <tr>
                <td>/pentire&nbsp;(/perdonare|/peccare)</td>
                <td>"/pentire" e o "/perdonare" o "/peccare"</td>
        </tr>
        <tr>
                <td>/pentire&nbsp;/perdonare&nbsp;|&nbsp;/peccare</td>
                <td>o "/pentire" e "/perdonare", o "/peccare" (non &egrave; uguale all'esempio precedente)</td>
        </tr>
        <tr>
                <td>/perdonare 1 /peccare</td>
                <td>"/perdonare" e nello stesso versetto o in quello primo o in quello dopo "/peccare"</td>
        </tr>
        <tr>
                <td>/peccare 1 /perdonare</td>
                <td>"/peccare" e nello stesso versetto o in quello primo o in quello dopo "/perdonare" (i versetti saranno diversi da quelli elencati nell'esempio precedente, ma si riferiranno alle stesse paia di versetti)</td>
        </tr>
        <tr>
                <td>/perdonare ^ /peccare</td>
                <td>"/perdonare" ma non "/peccare"</td>
        </tr>
        <tr>
                <td>/peccare7#pen</td>
                <td>"/peccare" e entro 7 versetti una parola che contiene "pen" (ce ne sono molti, ma nota soprattutto Rom 2:12 con 2:5)</td>
        </tr>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mattia/LaParola-mattia/new-site/resources/views/aiutoric.blade.php ENDPATH**/ ?>