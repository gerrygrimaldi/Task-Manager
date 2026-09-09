<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', 'Task Manager'); ?></title>
</head>

<body>

    <nav>
        <div>
            <a href="<?php echo e(route('tasks.index')); ?>">Task Manager</a>

            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('tasks.index')); ?>">Le mie task</a>
                <a href="<?php echo e(route('tasks.create')); ?>">Nuova task</a>
            <?php endif; ?>
        </div>

        <div>
            <?php if(auth()->guard()->check()): ?>
                <span><?php echo e(auth()->user()->name); ?></span>

                <form method="POST"
                      action="<?php echo e(route('logout')); ?>"
                      style="display: inline;">
                    <?php echo csrf_field(); ?>

                    <button type="submit">
                        Logout
                    </button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>">Login</a>
                <a href="<?php echo e(route('register')); ?>">Registrati</a>
            <?php endif; ?>
        </div>
    </nav>

    <?php if(session('success')): ?>
        <div class="success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

</body>
</html><?php /**PATH /var/www/html/resources/views/app.blade.php ENDPATH**/ ?>