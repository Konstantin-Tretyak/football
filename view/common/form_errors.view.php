<?php if($errors): ?>
    <div class="alert alert-danger">
        <ul class="list-unstyled">
            <?php foreach ($errors as $field => $error): ?>
                <li><?php echo $field.':'.$error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>
