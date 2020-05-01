

<?php $__env->startSection('content'); ?>

    <div class="d-flex justify-content-end">
        <a href="<?php echo e(url('posts/create')); ?>" class="btn btn-success float-right mb-2">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Posts
        </div>
        <div class="card-body">
            <?php if(count($posts)>0): ?>
                <table class="table">
                    <thead>
                        <th>
                            Image
                        </th>
                        <th>
                            Title
                        </th>
                        <th>Category</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <img width="60px" height="60px" src="<?php echo e(url('storage/'.$post->image)); ?>" alt="">
                            </td>
                            <td>
                                <?php echo e($post->title); ?>

                            </td>
                            <td><?php echo e($post->category->name); ?></td>
                            <?php if($post->trashed()): ?>
                                <td>
                                    <form action="<?php echo e(url('restoretrashed/'.$post->id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <button type="submit"  class="btn btn-info btn-sm">Restore</button>
                                    </form>
                                    
                                    
                                </td>
                            <?php else: ?>
                                <td>
                                    <a href="<?php echo e(route('posts.edit',$post->id)); ?>" class="btn btn-info btn-sm">Edit</a>
                                    
                                </td>

                            <?php endif; ?>
                            <td>
                                <form action="<?php echo e(route('posts.destroy',$post->id)); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <?php echo e($post->trashed() ? 'Delete' : 'Trash'); ?>

                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr></tr>
                    </tbody>
                </table>

            <?php else: ?>

                <h3 class="text-center">No Posts Yet</h3>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/posts/index.blade.php ENDPATH**/ ?>