<?php $__env->startSection('page_title', 'La Sacra Bibbia - Abbreviazioni'); ?>

<?php $__env->startSection('content'); ?>
<h1>Abbreviazioni dei libri</h1>
<p>Per visualizzare i riferimenti, il sito usa sempre le stesse abbreviazioni per i libri della Bibbia. Per&ograve; quando un riferimento &egrave; digitato, il sito riesce a riconoscere molte altre abbreviazioni. Questa pagina elenca le abbreviazioni usate e quelle riconosciute dal sito.</p>
<p>Per le abbreviazioni riconosciute, qualsiasi abbreviazioni che inizia con una delle abbreviazioni qui elencate &egrave; riconosciuta. Per esempio, &quot;Gen&quot; &egrave; riconosciuta per Genesi, perch&eacute; inizia con &quot;Ge&quot;, un'abbreviazione elencata. Maiuscola/minuscola non importa quando digiti un riferimento, sono riconsciute tutte e due, quindi tutte le abbreviazioni sono in lettere minuscole qui.</p>

<table>
<tr><th>Libro</th><th>Abbreviazione<br />usata</th><th>Abbreviazioni<br />riconosciute</th></tr>
<tr><td>Genesi</td><td>Gen</td><td>ge, gn, gen, genesi, genesis</td></tr>
<tr><td>Esodo</td><td>Eso</td><td>es, eso, esodo, exodus</td></tr>
<tr><td>Levitico</td><td>Le</td><td>le, lev, levitico, leviticus</td></tr>
<!-- ... full dynamic list from DB will replace this sample in next step ... -->
</table>

<p><em>La tabella completa delle abbreviazioni sar&agrave; aggiunta quando collegheremo il database.</em></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mattia/LaParola-mattia/new-site/resources/views/abbrev.blade.php ENDPATH**/ ?>