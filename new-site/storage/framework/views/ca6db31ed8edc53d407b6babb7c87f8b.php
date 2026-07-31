<?php $__env->startSection('page_title', 'La Sacra Bibbia - Non riesco a visualizzare il testo greco (o ebraico)'); ?>

<?php $__env->startSection('content'); ?>
<h1>Non riesco a visualizzare il testo greco (o ebraico) nel programma</h1>
<p class="primalettera">
Sotto il menu <i>Strumenti</i>, vai alle <i>Opzioni</i> del programma. Nella scheda <i>Caratteri</i>, controlla che</p>
<p>* in Windows: il font greco sia Palatino Linotype e il font ebraico Times New Roman;<br />
* in Linux: tutti e due i font siano Times New Roman.</p>
<p>Ci sono anche altri font che funzionano, ma so che questi due font sono disponibili e che contengono i caratteri greci e ebraici. Se non sono i font, clicca sul pulsante <i>Modifica</i> per impostare i font a quelli giusti.
</p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/mattia/LaParola-mattia/new-site/resources/views/faq/greco_ebraico.blade.php ENDPATH**/ ?>