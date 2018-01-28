<?php global $lang ?>
<form action="<?php echo $path ?>" method="post">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="EMAIL" aria-describedby="emailHelp"
               placeholder="<?php echo $lang['TYPE_EMAIL'] ?>">
    </div>
    <div class="form-group">
        <label for="username"><?php echo $lang['USERNAME'] ?></label>
        <input type="text" class="form-control" name="USERNAME"
               placeholder="<?php echo $lang['TYPE_USERNAME'] ?>">
    </div>
    <div class="form-group">
        <label for="password"><?php echo $lang['PASSWORD'] ?></label>
        <input type="password" name="PASSWORD" class="form-control" placeholder="<?php echo $lang['PASSWORD'] ?>">
    </div>
    <div class="form-group">
        <label for="repeatPassword"><?php echo $lang['REPEAT_PASSWORD'] ?></label>
        <input type="password" name="confirmPassword" class="form-control"
               placeholder="<?php echo $lang['REPEAT_PASSWORD'] ?>">
    </div>
    <button type="submit" class="btn btn-primary"><?php echo $lang['SIGNIN'] ?></button>
</form>