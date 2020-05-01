

<?php $__env->startSection('content'); ?>
    <div class="alert-danger">
        <?php if(count($errors)>0): ?>
        
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                <?php echo e($error); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    
    </div>
    <div class="card card-default">
        <div class="card-header">
            <?php echo e(isset($post) ? 'Update Post' : 'Create Post'); ?>

        </div>
        <div class="card-body">
            <form action="<?php echo e(isset($post) ? route('posts.update',$post->id) : route('posts.store')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($post)): ?>

                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>
                <div class="forn-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo e(isset($post) ? $post->title : ''); ?>">
                </div>
                <div class="forn-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control"><?php echo e(isset($post) ? $post->description : ''); ?></textarea>
                </div>
                <div class="forn-group">
                    <label for="content">Content</label>
                    <!-- <textarea name="content" id="content" cols="5" rows="5" class="form-control"><?php echo e(isset($post) ? $post->content : ''); ?></textarea> -->
                    <input id="content" type="hidden" name="content" value="<?php echo e(isset($post) ? $post->content : ''); ?>">
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="forn-group">
                    <label for="published-at">Published-at</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="<?php echo e(isset($post) ? $post->published_at : ''); ?>">
                </div>
                <br>
                <?php if(isset($post)): ?>
                    <div class="form-group">
                        <img src="<?php echo e(asset('storage/'.$post->image)); ?>" alt="" style="width:100%">
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"
                            <?php if(isset($post)): ?>
                                <?php if($category->id==$post->category_id): ?>
                                    selected
                                <?php endif; ?>
                            
                            <?php endif; ?>
                        >
                            <?php echo e($category->name); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    
                    </select>
                </div>
                <br>
                <div class="form-group">
                    
                    <?php if(count($tags)>0): ?>
                    <label for="tags">tags</label>
                        <select name="tags[]" id="tags" class="form-control" multiple>
                            <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tag->id); ?>"
                                    <?php if(isset($post)): ?>
                                        <?php if($post->hasTag($tag->id)): ?>
                                            selected
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                ><?php echo e($tag->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    <?php endif; ?>
                    
                </div>
                <br>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">
                        <?php echo e(isset($post) ? 'Update Post' : ' Add Post'); ?>

                       
                    </button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#published_at",{
            enableTime:true,
            enableSeconds:true
        })
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Blog\resources\views/posts/create.blade.php ENDPATH**/ ?>