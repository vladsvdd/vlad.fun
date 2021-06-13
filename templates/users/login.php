<?php require __DIR__ . '/../header.php'; ?>
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
                            <h2>Вход</h2>
							<?php if (!empty($error)): ?>
                                <div class="error"><?= $error ?></div>
							<?php endif; ?>
                        </div>
                        <form class="post-reply" action="login" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">email</label>
                                        <input class="input" type="email" name="email" id="email" placeholder="email"
                                               value="<?= htmlspecialchars($_POST['email']) ?? '' ?>">
                                        <br><br>
                                        <label for="password">password</label>
                                        <input class="input" type="password" name="password" class="password"
                                               placeholder="password" value="<?= htmlspecialchars($_POST['password']) ?? '' ?>">
                                    </div>
                                    <input type="submit" class="primary-button" value="Войти">
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

<?php require __DIR__ . '/../footer.php';