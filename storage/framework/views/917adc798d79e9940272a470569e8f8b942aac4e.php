<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
</head>
<body>
<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($errors->all() as $error): ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="/cek" method="post">
<?php echo e(csrf_field()); ?>

    <input type="text" name="text">
    <input type="submit" value="Send">
</form>
</body>
</html>