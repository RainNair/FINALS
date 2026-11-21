<?php $__env->startSection('content'); ?>
<div class="panel"><h1>Manage reservation</h1><form method="POST" action="<?php echo e(route('transactions.update', $transaction)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?> <?php echo $__env->make('transactions._form', ['submitLabel' => 'Save reservation'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></form></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\my-lv-app\resources\views/transactions/edit.blade.php ENDPATH**/ ?>