<?php require __DIR__ . '/../header.php'; ?>
<?php if (empty($user)): ?>
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
                            <h3>Изменить пароль</h3>
							<?php if (!empty($error)): ?>
                                <div class="error"><?= $error ?></div>
							<?php endif; ?>
							<?php if ($successChangePassword === true): ?>
                                <label><?= 'Пароль успешно изменен!' ?></label>
                                <?php $_POST = []; ?>
							<?php endif; ?>
                        </div>

                        <form class="post-reply" action="profile" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Старый password</label>
                                        <input class="input" type="password" name="passwordOld" class="password"
                                               placeholder="password" value="<?= $_POST['passwordOld'] ?? '' ?>">
                                        <br><br>
                                        <label for="password">Новый password</label>
                                        <input class="input" type="password" name="passwordNew1" class="password"
                                               placeholder="password" value="<?= $_POST['passwordNew1'] ?? '' ?>">
                                        <br><br>
                                        <label for="password">Повторите новый password</label>
                                        <input class="input" type="password" name="passwordNew2" class="password"
                                               placeholder="password" value="<?= $_POST['passwordNew2'] ?? '' ?>">
                                    </div>
                                    <input type="submit" name="changePassword" class="primary-button" value="Изменить">
                                    <br><br>
                                </div>
                            </div>
                        </form>

                        <hr>
                        <div class="section-title">
                            <h3>Изменить Фото</h3>
                            <div class="post-comments">
                                <div class="media">
                                    <div class="media-left">
                                        <img class="media-object" src="<?= $photo ?? $user->getPhoto() ?>" alt="">
                                    </div>
                                </div>
                            </div>
							<?php if ($successPhoto === true): ?>
                                <label><?= 'Фотография изменена.' ?></label>

							<?php endif; ?>
                        </div>

                        <form class="post-reply" action="profile" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="input" type="file" name="photo">
                                    </div>
                                    <input type="submit" name="changePhoto" class="primary-button" value="Изменить">
                                    <br><br>
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