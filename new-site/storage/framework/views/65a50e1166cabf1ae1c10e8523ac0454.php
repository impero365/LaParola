<?php $__env->startSection('page_title', 'La Sacra Bibbia in italiano in Internet'); ?>

<?php $__env->startSection('body_onload', "document.getElementById('visform').riferimento.focus()"); ?>

<?php $__env->startSection('content'); ?>
<!--la Sacra Bibbia,la bibbia,Nuovo Testamento,Vangelo,vangeli,Antico Testamento,Vecchio Testamento,salmo,salmi,dio,preghiera,preghiere-->

<h1>La Sacra Bibbia in italiano in Internet</h1>
<p id="introParagrafo">Su questo sito ci sono molti strumenti gratuiti per lo studio della <strong>Sacra Bibbia</strong> online. &Egrave; possibile visualizzare e ricercare diverse versioni della Bibbia in italiano usando le caselle qui sotto, o utilizzare le altre risorse nel menu qui sopra.</p>

 <div class="moduli">
 <div class="modulo moduloVis">
        <form action="testo.php" method="post" id="visform" onsubmit="if (riferimento.value.length==0) {alert('Digitare il riferimento di un brano')}; return riferimento.value.length!=0;">
    <fieldset>
    <legend><strong>Visualizzare un brano della Bibbia</strong></legend>
<!--        <p style="text-align:left"><label for="riferimento">Brano da visualizzare:</label><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="text" name="riferimento" id="riferimento" title="Digita qui il riferimento di un brano" /></p>-->
<div>
<!--<div class="ui-widget">-->
	<p style="text-align:left">
	<label for="libri">Brano da visualizzare:</label><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input class="text" type="text" name="riferimento" id="libri" title="Digita qui il riferimento di un brano" placeholder="Es: Gv 3:16" />
	</p>
</div>
        <p style="text-align:left"><label for="versioni">Testo/i da visualizzare:</label><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id="tabellaVisualizza"></span>
<script type="text/javascript">
<!--
var s = "<select multiple=\"multiple\" name=\"versioni[]\" id=\"versioni\" size=\"25\">";
var nvers = getCookie("nVisVers");
var i, versNR=0, versCEI=0,versND=0,versR2=0,versNR94=0,versBG=0,versLuz=0,versRicc=0,versTint=0,versMar=0,versDio=0,versnome;
var versComm=0,versCommNT=0,versCommGill=0,versCommPulpito=0,versCommIllustratore=0,versRif=0,versCommHenry=0,versCommBarnes=0,versCommMeyer=0,versCommTesoro=0,versCommCalvino=0,versCommGinevra=0;

for (i=0; i<nvers; i++) {
  versnome=getCookie("VisVers"+i);
  if (versnome=="NuovaRiveduta")
    versNR=1;
  if (versnome=="C.E.I.")
    versCEI=1;
  if (versnome=="NuovaDiodati")
    versND=1;
  if (versnome=="Riveduta2020")
    versR2=1;
  if (versnome=="NuovaRiveduta1994")
    versNR94=1;
  if (versnome=="BibbiadellaGioia")
    versBG=1;
  if (versnome=="Riveduta")
    versLuz=1;
  if (versnome=="Ricciotti")
    versRicc=1;
  if (versnome=="Tintori")
    versTint=1;
  if (versnome=="Martini")
    versMar=1;
  if (versnome=="Diodati")
    versDio=1;
  if (versnome=="CommentarioHenry")
    versCommHenry=1;
  if (versnome=="CommentarioNT")
    versCommNT=1;
  if (versnome=="CommentarioCalvino")
    versCommCalvino=1;
  if (versnome=="Commentario")
    versComm=1;
  if (versnome=="CommentarioBarnes")
    versCommBarnes=1;
  if (versnome=="CommentarioGinevra")
    versCommGinevra=1;
  if (versnome=="CommentarioGill")
    versCommGill=1;
  if (versnome=="CommentarioPulpito")
    versCommPulpito=1;
  if (versnome=="CommentarioIllustratore")
    versCommIllustratore=1;
  if (versnome=="CommentarioMeyer")
    versCommMeyer=1;
  if (versnome=="CommentarioTesoro")
    versCommTesoro=1;
  if (versnome=="Riferimentiincrociati")
    versRif=1;
}
s=s+"<optgroup label=\"Versioni della Bibbia\">";
s=s+"<option "+(!nvers||nvers==0||versNR==1?"selected=\"selected\" ":"")+"value=\"Nuova Riveduta\">Nuova Riveduta</option>";
s=s+"<option "+(versCEI==1?"selected=\"selected\" ":"")+"value=\"C.E.I.\">C.E.I. (1974)</option>";
s=s+"<option "+(versND==1?"selected=\"selected\" ":"")+"value=\"Nuova Diodati\">Nuova Diodati</option>";
s=s+"<option "+(versR2==1?"selected=\"selected\" ":"")+"value=\"Riveduta 2020\">Riveduta 2020</option>";
s=s+"<option "+(versNR94==1?"selected=\"selected\" ":"")+"value=\"Nuova Riveduta 1994\">Nuova Riveduta (1994)</option>";
s=s+"<option "+(versBG==1?"selected=\"selected\" ":"")+"value=\"Bibbia della Gioia\">La Parola &egrave; Vita</option>";
s=s+"<option "+(versLuz==1?"selected=\"selected\" ":"")+"value=\"Riveduta\">Luzzi/Riveduta</option>";
s=s+"<option "+(versRicc==1?"selected=\"selected\" ":"")+"value=\"Ricciotti\">Ricciotti</option>";
s=s+"<option "+(versTint==1?"selected=\"selected\" ":"")+"value=\"Tintori\">Tintori</option>";
s=s+"<option "+(versMar==1?"selected=\"selected\" ":"")+"value=\"Martini\">Martini</option>";
s=s+"<option "+(versDio==1?"selected=\"selected\" ":"")+"value=\"Diodati\">Diodati</option>";
s=s+"</optgroup>";
s=s+"<optgroup label=\"Commentari\">";
s=s+"<option "+(versCommHenry==1?"selected=\"selected\" ":"")+"value=\"CommentarioHenry\">Commentario completo di Matthew Henry</option>";
s=s+"<option "+(versCommNT==1?"selected=\"selected\" ":"")+"value=\"CommentarioNT\">Commentario Nuovo Testamento</option>";
s=s+"<option "+(versCommCalvino==1?"selected=\"selected\" ":"")+"value=\"CommentarioCalvino\">Commentario di Giovanni Calvino (Gen,Mt-1G)</option>";
s=s+"<option "+(versComm==1?"selected=\"selected\" ":"")+"value=\"Commentario\">Commentario abbreviato</option>";
s=s+"<option "+(versCommBarnes==1?"selected=\"selected\" ":"")+"value=\"CommentarioBarnes\">Note di Albert Barnes</option>";
s=s+"<option "+(versCommGinevra==1?"selected=\"selected\" ":"")+"value=\"CommentarioGinevra\">Note della Bibbia di Ginevra</option>";
s=s+"<option "+(versCommGill==1?"selected=\"selected\" ":"")+"value=\"CommentarioGill\">Esposizione della Bibbia di Gill</option>";
s=s+"<option "+(versCommPulpito==1?"selected=\"selected\" ":"")+"value=\"CommentarioPulpito\">Commentario del Pulpito</option>";
s=s+"<option "+(versCommIllustratore==1?"selected=\"selected\" ":"")+"value=\"CommentarioIllustratore\">Illustratore biblico</option>";
s=s+"<option "+(versCommMeyer==1?"selected=\"selected\" ":"")+"value=\"CommentarioMeyer\">Commento di Frederick Brotherton Meyer</option>";
s=s+"<option "+(versCommTesoro==1?"selected=\"selected\" ":"")+"value=\"CommentarioTesoro\">Tesoro di Davide</option>";
s=s+"<option "+(versRif==1?"selected=\"selected\" ":"")+"value=\"Riferimenti incrociati\">Riferimenti incrociati</option>";
s=s+"</optgroup>";
s=s+"</select><br /><br />";
s=s+"<div style=\"display:flex;justify-content:center;position:relative;align-items:flex-start\">";
s=s+"<input class=\"grandezzatesto\" type=\"button\" name=\"Seleziona tutti\" tabindex=\"3\" value=\"Seleziona tutti\" onclick=\"var selObj = document.getElementById('versioni');for (i=0; i<selObj.options.length; i++) {selObj.options[i].selected=true;}\" />";
s=s+"<div style='position:relative'><input class='grandezzatesto' type='button' onclick=\"const menu = document.getElementById('dropdownMenu');menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';\" value='&dtri;' /><div id='dropdownMenu'><a href='javascript:void(0)' onclick=\"var selObj = document.getElementById('versioni');for (i=0; i<selObj.options.length; i++) {selObj.options[i].selected=(i<11);};document.getElementById('dropdownMenu').style.display = 'none';\">Tutte le Bibbie</a><a href='javascript:void(0)' onclick=\"var selObj = document.getElementById('versioni');for (i=0; i<selObj.options.length; i++) {selObj.options[i].selected=(i>=11);};document.getElementById('dropdownMenu').style.display = 'none';\">Tutti i commentari</a></div></div></div><br />";      
const myElement = document.getElementById("tabellaVisualizza");
myElement.innerHTML = s;
//-->
</script>
<noscript>
        <select multiple="multiple" name="versioni[]" size="23" tabindex="2">
        <optgroup label="Versioni della Bibbia">
        <option selected="selected" value="Nuova Riveduta">Nuova Riveduta</option>
        <option value="C.E.I.">C.E.I. (1974)</option>
        <option value="Nuova Diodati">Nuova Diodati</option>
        <option value="Riveduta 2020">Riveduta 2020</option>
        <option value="Nuova Riveduta 1994">Nuova Riveduta (1994)</option>
        <option value="Bibbia della Gioia">La Parola &egrave; Vita</option>
        <option value="Riveduta">Luzzi/Riveduta</option>
        <option value="Ricciotti">Ricciotti</option>
        <option value="Tintori">Tintori</option>
        <option value="Martini">Martini</option>
        <option value="Diodati">Diodati</option>
        </optgroup>
        <optgroup label="Commentari">
        <option value="CommentarioHenry">Commentario completo di Matthew Henry</option>
        <option value="CommentarioNT">Commentario Nuovo Testamento</option>
        <option value="CommentarioCalvino">Commentario di Giovanni Calvino (Gen,Mt-1G)</option>
        <option value="Commentario">Commentario abbreviato</option>
        <option value="CommentarioBarnes">Note di Albert Barnes</option>
        <option value="CommentarioGinevra">Note della Bibbia di Ginevra</option>
        <option value="CommentarioGill">Esposizione della Bibbia di Gill</option>
        <option value="CommentarioPulpito">Commentario del Pulpito</option>
        <option value="CommentarioIllustratore">Illustratore biblico</option>
        <option value="CommentarioMeyer">Commento di Frederick Brotherton Meyer</option>
        <option value="CommentarioTesoro">Tesoro di Davide</option>
        <option value="Riferimenti incrociati">Riferimenti incrociati</option>
        </optgroup>
        </select>
</noscript>
</p>
        <input class="submit tabella" type="submit" name="Submit" value="Visualizza testo" />
        <!--input class="reset" type="reset" name="Reset" value="Annulla" /-->
        <p style="text-align:center"><a href="aiutovis.php" title="Come digitare un riferimento e mostrare un brano"><img src="/immagini/qmark.png" width="20" height="20" alt="Aiuto" /> Aiuto per visualizzare la Bibbia</a></p>
    </fieldset>
    <input type="hidden" id="homepage" name="homepage" value="s" />
        </form>

</div>
<div class="modulo moduloRic">

        <form action="ricerca.php" method="post" onsubmit="if (frase.value.length==0) {alert('Digitare una parola o espressione da ricercare')}; return frase.value.length!=0;">
    <fieldset>
    <legend><strong>Ricercare nella Bibbia</strong></legend>
	<div>
    <!--<div class="ui-widget">-->
        <p style="text-align:left"><label for="frase">Parola o frase da ricercare:</label><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="text" name="frase" id="frase" title="Digita qui una o pi&ugrave; parole" placeholder="Es: Ges&ugrave;"/></p>
    </div>
        <p style="text-align:left"><label for="versione">Versione da ricercare:</label><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span id="tabellaRicerca"></span>
<script type="text/javascript">
<!--
var s="<select name=\"versione\" id=\"versione\" size=\"11\">";
var vers = getCookie("RicVers");
if (!vers || (vers!="C.E.I." && vers!="NuovaDiodati" && vers!="Riveduta2020" && vers!="NuovaRiveduta1994" && vers!="BibbiadellaGioia" && vers!="Riveduta" && vers!="Ricciotti" && vers!="Tintori" && vers!="Martini" && vers!="Diodati"))
        s=s+"<option selected=\"selected\" value=\"Nuova Riveduta\">Nuova Riveduta</option>";
else
        s=s+"<option value=\"Nuova Riveduta\">Nuova Riveduta</option>";
if (vers=="C.E.I.")
        s=s+"<option selected=\"selected\" value=\"C.E.I.\">C.E.I. (1974)</option>";
else
        s=s+"<option value=\"C.E.I.\">C.E.I. (1974)</option>";
if (vers=="NuovaDiodati")
        s=s+"<option selected=\"selected\" value=\"Nuova Diodati\">Nuova Diodati</option>";
else
        s=s+"<option value=\"Nuova Diodati</option>";
if (vers=="Riveduta2020")
        s=s+"<option selected=\"selected\" value=\"Riveduta 2020\">Riveduta 2020</option>";
else
        s=s+"<option value=\"Riveduta 2020\">Riveduta 2020</option>";
if (vers=="NuovaRiveduta1994")
        s=s+"<option selected=\"selected\" value=\"Nuova Riveduta 1994\">Nuova Riveduta (1994)</option>";
else
        s=s+"<option value=\"Nuova Riveduta 1994\">Nuova Riveduta (1994)</option>";
if (vers=="BibbiadellaGioia")
        s=s+"<option selected=\"selected\" value=\"Bibbia della Gioia\">La Parola &egrave; Vita</option>";
else
        s=s+"<option value=\"Bibbia della Gioia\">La Parola &egrave; Vita</option>";
if (vers=="Riveduta")
        s=s+"<option selected=\"selected\" value=\"Riveduta\">Luzzi/Riveduta</option>";
else
        s=s+"<option value=\"Riveduta\">Luzzi/Riveduta</option>";
if (vers=="Ricciotti")
        s=s+"<option selected=\"selected\" value=\"Ricciotti\">Ricciotti</option>";
else
        s=s+"<option value=\"Ricciotti\">Ricciotti</option>";
if (vers=="Tintori")
        s=s+"<option selected=\"selected\" value=\"Tintori\">Tintori</option>";
else
        s=s+"<option value=\"Tintori\">Tintori</option>";
if (vers=="Martini")
        s=s+"<option selected=\"selected\" value=\"Martini\">Martini</option>";
else
        s=s+"<option value=\"Martini\">Martini</option>";
if (vers=="Diodati")
        s=s+"<option selected=\"selected\" value=\"Diodati\">Diodati</option>";
else
        s=s+"<option value=\"Diodati\">Diodati</option>";
s=s+"</select>";
const myElement2 = document.getElementById("tabellaRicerca");
myElement2.innerHTML = s;
//-->
</script>
<noscript>
        <select name="versione" id="versione" size="11">
        <option selected="selected" value="Nuova Riveduta">Nuova Riveduta</option>
        <option value="C.E.I.">C.E.I. (1974)</option>
        <option value="Nuova Diodati">Nuova Diodati</option>
        <option value="Riveduta 2020">Riveduta 2020</option>
        <option value="Nuova Riveduta 1994">Nuova Riveduta (1994)</option>
        <option value="Bibbia della Gioia">La Parola &egrave; Vita</option>
        <option value="Riveduta">Luzzi/Riveduta</option>
        <option value="Ricciotti">Ricciotti</option>
        <option value="Tintori">Tintori</option>
        <option value="Martini">Martini</option>
        <option value="Diodati">Diodati</option>
        </select>
</noscript>
</p>
		<!--<div class="ui-widget">-->
        <div>
        <p style="text-align:left"><label for="brano">Brano in cui ricercare:</label><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="text" type="text" name="brano" id="brano" title="Digita qui un riferimento (facoltativo)" placeholder="Es: Gen"/></p>
        </div>
        <p style="text-align:center"><a href="ricerca_avanzata.php">Ricerca avanzata</a></p>
        <input class="submit tabella" type="submit" name="Submit" value="Ricerca" />
        <!--input class="reset" type="reset" name="Reset" value="Annulla" /-->
        <p style="text-align:center"><a href="aiutoric.php" title="I codici da usare per ricerche complicate"><img src="/immagini/qmark.png" width="20" height="20" alt="Aiuto" /> Aiuto per ricercare la Bibbia</a></p>
    </fieldset>
    <input type="hidden" id="homepage" name="homepage" value="s" />
        </form>

</div>
</div>

        <p style="text-align:center"><a href="/bibbia/" title="Leggi e studi la Bibbia suddivisa per capitoli">La Bibbia per capitoli, con un indice delle risorse per studiare ogni capitolo</a></p>
        <p style="text-align:center"><a href="versioni.php" title="Una descrizione delle versioni della Bibbia e dei commentari usati">Informazioni sulle versioni della Bibbia e sui commentari</a></p>

<p>Per essere informato delle novit&agrave; del sito e dei programmi:</p>
<table><tr valign="top"><td>
<p>Iscriviti alla <a href="/mailing_list.php" title="Come essere informato delle novit&agrave; del sito della Bibbia">mailing list</a> del sito.</p>
</td><td>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
<td>
<td>
<p>Oppure utilizza il <a type="application/rss+xml" href="/feed.xml">feed RSS del sito. <img src="/immagini/feed.png" width="12" height="12" alt="Feed RSS in formato XML" /></a><br />(Per una spiegazione, vedi la pagina delle <a href="/novita.php">novit&agrave;</a>.)</p>
</td>
</tr></table>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
$(function() {
var autoLibri = [
"1Corinzi",
"1Cronache",
"1Giovanni",
"1Maccabei",
"1Pietro",
"1Re",
"1Samuele",
"1Tessalonicesi",
"1Timoteo",
"2Corinzi",
"2Cronache",
"2Giovanni",
"2Maccabei",
"2Pietro",
"2Re",
"2Samuele",
"2Tessalonicesi",
"2Timoteo",
"3Giovanni",
"Abacuc",
"Abdia",
"Aggeo",
"Amos",
"Apocalisse",
"Atti",
"Baruc",
"Cantico",
"Colossesi",
"Daniele",
"Deuteronomio",
"Ebrei",
"Ecclesiaste",
"Efesini",
"Esdra",
"Esodo",
"Ester",
"Ezechiele",
"Filemone",
"Filippesi",
"Galati",
"Genesi",
"Geremia",
"Giacomo",
"Giobbe",
"Giovanni",
"Gioele",
"Giona",
"Giosu ",
"Giuda",
"Giudici",
"Giuditta",
"Isaia",
"Lamentazioni",
"Levitico",
"Luca",
"Malachia",
"Marco",
"Matteo",
"Michea",
"Naum",
"Neemia",
"Numeri",
"Osea",
"Proverbi",
"Qoelet",
"Romani",
"Rut",
"Salmi",
"Sapienza",
"Siracide",
"Sofonia",
"Tito",
"Tobia",
"Zaccaria"
];
$("#libri").autocomplete({
source: autoLibri
});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mattia/LaParola-mattia/new-site/resources/views/home.blade.php ENDPATH**/ ?>