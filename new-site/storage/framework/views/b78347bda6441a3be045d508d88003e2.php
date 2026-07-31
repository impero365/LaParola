<?php $__env->startSection('page_title', 'La Sacra Bibbia - Le icone della barra di strumenti si vedono male'); ?>

<?php $__env->startSection('content'); ?>
<h1>Le icone della barra di strumenti si vedono male</h1>
<p class="primalettera">Questo è un'incompatibilità conosciuta tra l'ambiente di programmazione usato per il programma, certe versioni di Windows e alcune schede video. Ci sono alcuni modi per risolvere il problema:</p>
<ul>
<li>aggiornare il driver della scheda video;</li>
<li>installare una nuova versione del file di Windows comctl32.dll - il modo più facile è di installare Internet Explorer 5 o una versione successiva;</li>
<li>ridurre l'accelerazione hardware - in Windows XP è in Panello di Controllo, Schermo, scheda Impostazioni, Avanzate, scheda Risoluzione problemi; oppure</li>
<li>cambiare il numero di colori e la risoluzione dello schermo.</li>
</ul>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mattia/LaParola-mattia/new-site/resources/views/faq/icone.blade.php ENDPATH**/ ?>