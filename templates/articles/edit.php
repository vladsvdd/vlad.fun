<?php include __DIR__ . '/../header.php'; ?>


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
                            <h2>Редактирование</h2>
							<?php if (!empty($error)): ?>
                                <div style="color: red;"><?= $error; ?></div>
							<?php endif; ?>
                        </div>
                        <form class="post-reply" action="/articles/<?= $article->getId() ?>/edit" method="post"
                              enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Главное фото статьи</label>
                                        <input class="input" type="file" name="photo">
                                        <label for="name">Название статьи</label>
                                        <input class="input" type="text" name="name" id="name"
                                               placeholder="Название статьи"
                                               value="<?= $_POST['name'] ?? $article->getName() ?>">
                                        <br><br>
                                        <label for="theme">Тема статьи</label>
                                        <select name="theme" class="input">
											<?php for ($i = 0; $i < 3; $i++): ?>
												<?php $arrayThemes = ['Жизнь', 'PHP', 'PhpStorm'];
												if ($article->getName() === $arrayThemes[$i]): ?>
                                                    <option selected
                                                            value="<?= $_POST['theme'] ?? $article->getTheme() ?>"><?= $_POST['theme'] ?? $article->getTheme() ?></option>
												<?php else: ?>
                                                    <option value="<?= $arrayThemes[$i] ?>"><?= $arrayThemes[$i] ?></option>
												<?php endif; ?>
											<?php endfor; ?>
                                        </select>
                                        <br><br>
                                        <label for="name">Текст статьи</label>
                                        <textarea id="textarea-admin" class="input" name="text"
                                                  placeholder="Текст статьи"><?= $_POST['text'] ?? $article->getText() ?></textarea>
                                    </div>
                                    <input type="submit" class="primary-button" value="Обновить">
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