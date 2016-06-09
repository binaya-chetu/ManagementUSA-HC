<?php $__env->startSection('content'); ?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2> All Product Categories </h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>List Categories</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">

        <div class="col-md-12">
            
             <?php foreach($categories AS $cat): ?>
             <li><a  href="<?php echo e(url('/categories/categoryDetails/'.base64_encode($cat->id))); ?>"><?php echo e($cat->cat_name); ?></a></li>
             <?php endforeach; ?>
        </div>
            </div>
        </section>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>