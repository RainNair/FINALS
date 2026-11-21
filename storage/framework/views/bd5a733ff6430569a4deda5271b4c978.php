<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Savoria Restaurant Reservations'); ?></title>
    <style>
        :root { font-family: Inter, Arial, sans-serif; color:#33251f; background:#fbf7f2; }
        * { box-sizing:border-box; } body { margin:0; } nav { background:#3b2119; padding:18px 8%; display:flex; gap:22px; align-items:center; }
        nav strong, nav a { color:#fffaf4; text-decoration:none; } nav strong { margin-right:auto; font-family:Georgia,serif; font-size:22px; } nav a:hover { color:#f3c892; }
        main { max-width:1150px; margin:38px auto; padding:0 20px; } .panel, .auth-card { background:#fff; padding:28px; border-radius:14px; box-shadow:0 8px 28px #5a2b1714; border:1px solid #f0e1d2; } .auth-card { max-width:480px; margin:0 auto; }
        .hero { background:linear-gradient(135deg,#6f3020,#a95732); color:#fffaf4; padding:30px; border-radius:14px; margin-bottom:22px; } .hero h1 { color:#fffaf4; } .hero p { color:#fbe7d0; }
        .toolbar { display:flex; justify-content:space-between; align-items:center; gap:15px; } h1 { margin-top:0; font-family:Georgia,serif; color:#5a2b1d; } h2 { font-family:Georgia,serif; color:#6f3020; }
        a.button, button { background:#b86b32; color:white; border:0; border-radius:7px; padding:10px 14px; text-decoration:none; cursor:pointer; font-size:14px; } a.button:hover, button:hover { background:#8e4727; }
        table { width:100%; border-collapse:collapse; margin-top:20px; } th,td { text-align:left; padding:13px 10px; border-bottom:1px solid #f0e1d2; vertical-align:middle; } th { background:#fff4e7; color:#6f3020; }
        label { display:block; font-weight:bold; margin-top:15px; color:#5a2b1d; } input, select, textarea { width:100%; padding:11px; margin-top:6px; border:1px solid #ddc7b3; border-radius:7px; background:#fffdfa; } .form-actions { margin-top:24px; display:flex; gap:10px; align-items:center; } .muted { color:#8e7568; }
        .success { background:#e7f5e8; color:#236b36; padding:12px; border-radius:7px; margin-bottom:18px; } .errors { background:#fff0ed; color:#9b3023; padding:12px 30px; border-radius:7px; margin-bottom:18px; } .badge { display:inline-block; padding:5px 9px; border-radius:20px; background:#fff0dc; color:#8e4727; font-size:12px; font-weight:bold; }
        .stats { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; margin:18px 0; } .stat { background:#fff4e7; border-radius:10px; padding:16px; } .stat strong { display:block; font-size:24px; color:#6f3020; }
    </style>
</head>
<body>
<nav><strong>Savoria</strong><?php if(auth()->guard()->check()): ?><a href="<?php echo e(route('transactions.index')); ?>">Reservations</a><a href="<?php echo e(route('transactions.create')); ?>">Book a Table</a><?php if(auth()->user()->isAdmin()): ?><span class="badge">Admin</span><?php endif; ?><span style="color:#f3c892"><?php echo e(auth()->user()->name); ?></span><form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline"><?php echo csrf_field(); ?><button type="submit">Log out</button></form><?php else: ?><a href="<?php echo e(route('login')); ?>">Log in</a><a href="<?php echo e(route('register')); ?>">Create account</a><?php endif; ?></nav>
<main>
    <?php if(session('success')): ?> <div class="success"><?php echo e(session('success')); ?></div> <?php endif; ?>
    <?php if($errors->any()): ?> <div class="errors"><strong>Please correct the following:</strong><ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div> <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</main>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\my-lv-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>