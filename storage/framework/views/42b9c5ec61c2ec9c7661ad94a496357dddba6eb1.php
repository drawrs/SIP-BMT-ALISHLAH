<?php if(count($errors) > 0): ?>
<div class="row">
    <div class="col-md-8">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
            <ul>
                <?php foreach($errors->all() as $error): ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>