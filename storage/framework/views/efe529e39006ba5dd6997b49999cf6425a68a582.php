<?php if(Session::has('message')): ?>
<div class="callout callout-<?php echo e(Session::get('type')); ?>">
    <h4>Info</h4>
    <p><?php echo e(Session::get('message')); ?></p>
</div>
<?php endif; ?>