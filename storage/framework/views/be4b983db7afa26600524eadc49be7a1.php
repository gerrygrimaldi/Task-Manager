
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', 'Task Manager'); ?></title> 

    
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg viewBox='0 0 16 16' xmlns='http://www.w3.org/2000/svg' fill='%23000000'%3E%3Cpath fill='%23000000' fill-rule='evenodd' d='M4,4 L9,4 C9.55228,4 10,3.55228 10,3 C10,2.44772 9.55228,2 9,2 L4,2 C2.89543,2 2,2.89543 2,4 L2,12 C2,13.1046 2.89543,14 4,14 L12,14 C13.1046,14 14,13.1046 14,12 L14,10 C14,9.44771 13.5523,9 13,9 C12.4477,9 12,9.44771 12,10 L12,12 L4,12 L4,4 Z M15.2071,2.29289 C14.8166,1.90237 14.1834,1.90237 13.7929,2.29289 L8.5,7.58579 L7.70711,6.79289 C7.31658,6.40237 6.68342,6.40237 6.29289,6.79289 C5.90237,7.18342 5.90237,7.81658 6.29289,8.20711 L7.79289,9.70711 C7.98043,9.89464 8.23478,10 8.5,10 C8.76522,10 9.01957,9.89464 9.20711,9.70711 L15.2071,3.70711 C15.5976,3.31658 15.5976,2.68342 15.2071,2.29289 Z'%3E%3C/path%3E%3C/svg%3E">

    <!-- Bootstrap CSS tramite CDN -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light"> 

    
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
        <div class="container">

            <a class="navbar-brand fw-bold" href="<?php echo e(route('welcome')); ?>">Task Manager</a>

            
            <div class="d-flex align-items-center gap-3">

                
                <?php if(auth()->guard()->check()): ?>
                    
                    <a class="text-decoration-none" href="<?php echo e(route('tasks.index')); ?>">Le mie task</a>

                    <a class="text-decoration-none" href="<?php echo e(route('tasks.create')); ?>">Nuova task</a>

                    <span class="text-secondary"><?php echo e(auth()->user()->name); ?></span> 

                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>

                        
                        <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>

                <?php else: ?>

                    <a class="text-decoration-none" href="<?php echo e(route('login')); ?>">Accedi</a>

                    
                    <a class="btn btn-primary btn-sm" href="<?php echo e(route('register')); ?>">Registrati</a>

                <?php endif; ?>

            </div>
        </div>
    </nav>

    
    <main class="container pb-5">

        
        <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?> 

    </main>

</body>
</html><?php /**PATH /var/www/html/resources/views/app.blade.php ENDPATH**/ ?>