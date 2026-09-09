

<?php $__env->startSection('title', 'Modifica task'); ?>

<?php $__env->startSection('content'); ?>

    <h1>Modifica task</h1>

    <form method="POST" action="<?php echo e(route('tasks.update', $task)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="title">Titolo</label>

            <input
                type="text"
                id="title"
                name="title"
                value="<?php echo e(old('title', $task->title)); ?>"
                required
            >

            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>

            <textarea
                id="description"
                name="description"
            ><?php echo e(old('description', $task->description)); ?></textarea>

            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="due_date">Data di scadenza</label>

            <input
                type="date"
                id="due_date"
                name="due_date"
                value="<?php echo e(old('due_date', $task->due_date->format('Y-m-d'))); ?>"
                required
            >

            <?php $__errorArgs = ['due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="priority">Priorità</label>

            <select id="priority" name="priority" required>
                <option value="">Seleziona una priorità</option>

                <option value="low"
                    <?php if(old('priority', $task->priority) === 'low'): echo 'selected'; endif; ?>>
                    Bassa
                </option>

                <option value="medium"
                    <?php if(old('priority', $task->priority) === 'medium'): echo 'selected'; endif; ?>>
                    Media
                </option>

                <option value="high"
                    <?php if(old('priority', $task->priority) === 'high'): echo 'selected'; endif; ?>>
                    Alta
                </option>
            </select>

            <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="status">Stato</label>

            <select id="status" name="status" required>
                <option value="">Seleziona uno stato</option>

                <option value="todo"
                    <?php if(old('status', $task->status) === 'todo'): echo 'selected'; endif; ?>>
                    Da fare
                </option>

                <option value="in_progress"
                    <?php if(old('status', $task->status) === 'in_progress'): echo 'selected'; endif; ?>>
                    In corso
                </option>

                <option value="completed"
                    <?php if(old('status', $task->status) === 'completed'): echo 'selected'; endif; ?>>
                    Completata
                </option>
            </select>

            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <button type="submit">
            Salva modifiche
        </button>

        <a href="<?php echo e(route('tasks.index')); ?>">
            Annulla
        </a>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/tasks/edit.blade.php ENDPATH**/ ?>