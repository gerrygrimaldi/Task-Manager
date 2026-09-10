<?php $__env->startSection('title', 'Le mie task'); ?>

<?php $__env->startSection('content'); ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2 mb-0">Le mie task</h1>

        <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-primary"><span class="fw-bold">+</span> Nuova task</a>
    </div>

    
    <?php if($tasks->isEmpty()): ?>

        <div class="alert alert-info" role="alert">Non hai ancora creato nessuna task.</div>

    
    <?php else: ?>

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive"> 

                    <table class="table table-striped table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th scope="col">Titolo</th>
                                <th scope="col">Scadenza</th>
                                <th scope="col">Priorità</th>
                                <th scope="col">Stato</th>
                                <th scope="col" class="text-end">Azioni</th>
                            </tr>
                        </thead>

                        <tbody>

                            
                            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td class="fw-semibold"><?php echo e($task->title); ?></td>

                                    <td><?php echo e($task->due_date->format('d/m/Y')); ?></td>

                                    <td>
                                        <?php if($task->priority === 'low'): ?>
                                            <span class="badge text-bg-success">Bassa</span>
                                        <?php elseif($task->priority === 'medium'): ?>
                                            <span class="badge text-bg-warning">Media</span>
                                        <?php else: ?>
                                            <span class="badge text-bg-danger">Alta</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if($task->status === 'todo'): ?>
                                            <span class="badge text-bg-secondary">Da fare</span>
                                        <?php elseif($task->status === 'in_progress'): ?>
                                            <span class="badge text-bg-primary">In corso</span>
                                        <?php else: ?>
                                            <span class="badge text-bg-success">Completata</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-end">

                                        <a href="<?php echo e(route('tasks.edit', $task)); ?>" class="btn btn-sm btn-outline-primary">Modifica</a>

                                        <form method="POST" action="<?php echo e(route('tasks.destroy', $task)); ?>" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Sei sicuro di voler eliminare questa task?')">Elimina</button>
                                        </form>

                                    </td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>

                    </table>

                </div>

            </div>
        </div>

    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/tasks/index.blade.php ENDPATH**/ ?>