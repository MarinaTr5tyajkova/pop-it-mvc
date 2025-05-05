<?php if (isset($message)): ?>
    <div class="alert alert-danger">
        <?php foreach (json_decode($message, true) as $field => $errors): ?>
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h2>Регистрация нового пользователя</h2>
<pre><?= $message ?? ''; ?></pre>
<form method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label>Имя <input type="text" name="name"></label>
    <label>Логин <input type="text" name="login"></label>
    <label>Пароль <input type="password" name="password"></label>
    <button>Зарегистрироваться</button>
</form>


