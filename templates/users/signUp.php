<?php include __DIR__ . '/../header.php'; ?>
<?php if (!empty($user)): ?>
	<?php header('Location: /'); ?>
	<?php exit() ?>
<?php endif; ?>

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Post content -->
                <div class="col-md-8">
                    <!-- reply -->
                    <div class="section-row">
                        <div class="section-title">
                            <h2>Регистрация</h2>
							<?php if (!empty($error)): ?>
                                <div class="error"><?= $error ?></div>
							<?php endif; ?>
                        </div>
                        <form class="post-reply" action="/users/register" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nickname">nickname</label>
                                        <input class="input" type="text" name="nickname" id="nickname"
                                               placeholder="nickname"
                                               value="<?= htmlspecialchars($_POST['nickname']) ?? '' ?>">
                                        <br><br>
                                        <label for="email">email</label>
                                        <input class="input" type="email" name="email" id="email" placeholder="email"
                                               value="<?= htmlspecialchars($_POST['email']) ?? '' ?>">
                                        <br><br>
                                        <label for="password">password</label>
                                        <input class="input" type="password" name="password" class="password"
                                               placeholder="password" value="<?= htmlspecialchars($_POST['password']) ?? '' ?>">
                                        <br><br>
                                        <label for="password2">Повторите password</label>
                                        <input class="input" type="password" name="password2" id="password2"
                                               placeholder="password" value="<?= htmlspecialchars($_POST['password2']) ?? '' ?>">
                                    </div>
                                    <input type="submit" class="primary-button" value="Зарегистрироваться">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /reply -->
                </div>
                <!-- Post content -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- section -->
<?php include __DIR__ . '/../footer.php'; ?>