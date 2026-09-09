

<?php $__env->startSection('title', 'Nuova task'); ?>

<?php $__env->startSection('content'); ?>

    <h1>Nuova task</h1>

    <form method="POST" action="<?php echo e(route('tasks.store')); ?>">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="title">Titolo</label>

            <input
                type="text"
                id="title"
                name="title"
                value="<?php echo e(old('title')); ?>"
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
            ><?php echo e(old('description')); ?></textarea>

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
                value="<?php echo e(old('due_date')); ?>"
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

                <option value="low" <?php if(old('priority') === 'low'): echo 'selected'; endif; ?>>
                    Bassa
                </option>

                <option value="medium" <?php if(old('priority') === 'medium'): echo 'selected'; endif; ?>>
                    Media
                </option>

                <option value="high" <?php if(old('priority') === 'high'): echo 'selected'; endif; ?>>
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

                <option value="todo" <?php if(old('status') === 'todo'): echo 'selected'; endif; ?>>
                    Da fare
                </option>

                <option value="in_progress" <?php if(old('status') === 'in_progress'): echo 'selected'; endif; ?>>
                    In corso
                </option>

                <option value="completed" <?php if(old('status') === 'completed'): echo 'selected'; endif; ?>>
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
            Crea task
        </button>

        <a href="<?php echo e(route('tasks.index')); ?>">
            Annulla
        </a>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/tasks/create.blade.php ENDPATH**/ ?>