<label for="transaction_number">Booking reference</label>
<input id="transaction_number" name="transaction_number" value="<?php echo e(old('transaction_number', $transaction->transaction_number ?? '')); ?>" required>

<label for="customer_name">Guest name</label>
<input id="customer_name" name="customer_name" value="<?php echo e(old('customer_name', $transaction->customer_name ?? '')); ?>" required>

<label for="customer_email">Guest email</label>
<input id="customer_email" type="email" name="customer_email" value="<?php echo e(old('customer_email', $transaction->customer_email ?? '')); ?>" required>

<label for="amount">Estimated bill / deposit</label>
<input id="amount" type="number" name="amount" min="0" step="0.01" value="<?php echo e(old('amount', $transaction->amount ?? '')); ?>" required>

<label for="transaction_date">Transaction date</label>
<input id="transaction_date" type="date" name="transaction_date" value="<?php echo e(old('transaction_date', isset($transaction) ? $transaction->transaction_date->format('Y-m-d') : now()->format('Y-m-d'))); ?>" required>

<label for="reservation_time">Reservation time</label>
<input id="reservation_time" type="time" name="reservation_time" value="<?php echo e(old('reservation_time', isset($transaction) ? $transaction->reservation_time->format('H:i') : '')); ?>" required>

<label for="guest_count">Number of guests</label>
<input id="guest_count" type="number" name="guest_count" min="1" max="50" value="<?php echo e(old('guest_count', $transaction->guest_count ?? 2)); ?>" required>

<label for="table_type">Table preference</label>
<select id="table_type" name="table_type" required>
    <?php $__currentLoopData = ['Standard table', 'Window table', 'Private booth', 'Outdoor table']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tableType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($tableType); ?>" <?php if(old('table_type', $transaction->table_type ?? 'Standard table') === $tableType): echo 'selected'; endif; ?>><?php echo e($tableType); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<?php if(auth()->user()->isAdmin()): ?>
    <label for="status">Booking status</label>
    <select id="status" name="status" required>
        <?php $__currentLoopData = ['pending', 'completed', 'cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($status); ?>" <?php if(old('status', $transaction->status ?? 'pending') === $status): echo 'selected'; endif; ?>><?php echo e(ucfirst($status)); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php elseif(isset($transaction)): ?>
    <label for="status">Booking status</label>
    <?php if($transaction->status === 'completed'): ?>
        <input type="hidden" name="status" value="completed">
        <p class="badge">Completed by restaurant admin</p>
    <?php else: ?>
        <select id="status" name="status">
            <option value="pending" <?php if($transaction->status === 'pending'): echo 'selected'; endif; ?>>Pending</option>
            <option value="cancelled" <?php if($transaction->status === 'cancelled'): echo 'selected'; endif; ?>>Cancel booking</option>
        </select>
    <?php endif; ?>
<?php else: ?>
    <input type="hidden" name="status" value="pending">
    <p class="muted">New bookings are automatically submitted as Pending.</p>
<?php endif; ?>

<label for="notes">Notes</label>
<textarea id="notes" name="notes" rows="5"><?php echo e(old('notes', $transaction->notes ?? '')); ?></textarea>

<div class="form-actions"><button type="submit"><?php echo e($submitLabel); ?></button><a href="<?php echo e(route('transactions.index')); ?>">Cancel</a></div>
<?php /**PATH C:\xampp\htdocs\my-lv-app\resources\views/transactions/_form.blade.php ENDPATH**/ ?>