

<?php $__env->startSection('title', 'Le mie task'); ?>

<?php $__env->startSection('content'); ?>

    <h1>Le mie task</h1>

    <a href="<?php echo e(route('tasks.create')); ?>">
        + Nuova task
    </a>

    <?php if($tasks->isEmpty()): ?>
        <p>Non hai ancora creato nessuna task.</p>
    <?php else: ?>

        <table>
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Scadenza</th>
                    <th>Priorità</th>
                    <th>Stato</th>
                    <th>Azioni</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($task->title); ?>

                        </td>

                        <td>
                            <?php echo e($task->due_date->format('d/m/Y')); ?>

                        </td>

                        <td>
                            <?php echo e($task->priority); ?>

                        </td>

                        <td>
                            <?php echo e($task->status); ?>

                        </td>

                        <td>
                            <a href="<?php echo e(route('tasks.edit', $task)); ?>">
                                Modifica
                            </a>

                            <form
                                method="POST"
                                action="<?php echo e(route('tasks.destroy', $task)); ?>"
                                style="display: inline;"
                            >
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button
                                    type="submit"
                                    onclick="return confirm('Sei sicuro di voler eliminare questa task?')"
                                >
                                    Elimina
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/tasks/index.blade.php ENDPATH**/ ?>