<?php $__env->startSection('content'); ?>
<div class="panel"><h1>Reserve a table</h1><p class="muted">Tell us when you are dining and we will prepare your table.</p><form method="POST" action="<?php echo e(route('transactions.store')); ?>"><?php echo csrf_field(); ?> <?php echo $__env->make('transactions._form', ['submitLabel' => 'Create reservation'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></form></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\my-lv-app\resources\views/transactions/create.blade.php ENDPATH**/ ?>