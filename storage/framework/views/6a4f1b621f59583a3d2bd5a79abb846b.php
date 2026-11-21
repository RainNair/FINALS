<?php $__env->startSection('content'); ?>
<div class="panel">
    <div class="hero"><h1>Restaurant reservations</h1><p>Welcome to Savoria. Manage your dining plans and reservation details in one place.</p></div>
    <div class="toolbar"><div><h2><?php echo e(auth()->user()->isAdmin() ? 'All reservations' : 'My reservations'); ?></h2><p class="muted">Complete reservation and transaction processing.</p></div><a class="button" href="<?php echo e(route('transactions.create')); ?>">Book a table</a></div>
    <table><thead><tr><th>Booking</th><th>Guest</th><th>Guests</th><th>Date & time</th><th>Status</th><th>Actions</th></tr></thead><tbody>
    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr><td><a href="<?php echo e(route('transactions.show', $transaction)); ?>"><?php echo e($transaction->transaction_number); ?></a></td><td><?php echo e($transaction->customer_name); ?></td><td><?php echo e($transaction->guest_count); ?></td><td><?php echo e($transaction->transaction_date->format('M j, Y')); ?><br><span class="muted"><?php echo e($transaction->reservation_time->format('H:i')); ?></span></td><td><span class="badge"><?php echo e(ucfirst($transaction->status)); ?></span></td><td><a href="<?php echo e(route('transactions.edit', $transaction)); ?>">Edit</a> <form method="POST" action="<?php echo e(route('transactions.destroy', $transaction)); ?>" style="display:inline"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" onclick="return confirm('Delete this reservation?')">Delete</button></form></td></tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6">No reservations have been recorded.</td></tr>
    <?php endif; ?>
    </tbody></table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\my-lv-app\resources\views/transactions/index.blade.php ENDPATH**/ ?>