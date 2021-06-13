<?php require __DIR__ . '/../header.php'; ?>

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
                        <h2>Создание статьи</h2>
						<?php if (!empty($error)): ?>
                            <div style="color: red;"><?= $error; ?></div>
						<?php endif; ?>
                    </div>
                    <form class="post-reply" action="add" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Главное фото статьи</label>
                                    <input class="input" type="file" name="photo">
                                    <label for="name">Название статьи</label>
                                    <input class="input" type="text" name="name" id="name" placeholder="Название статьи" value="<?= $_POST['name'] ?? '' ?>">
                                    <br><br>
                                    <label for="theme">Тема статьи</label>
                                    <select name="theme" class="input">
                                        <option value="Жизнь">Жизнь</option>
                                        <option value="PHP">PHP</option>
                                        <option value="PhpStorm">PhpStorm</option>
                                    </select>
                                    <br><br>
                                    <label for="name">Текст статьи</label>
                                    <textarea class="input" name="text"
                                              placeholder="Текст статьи"><?= $_POST['text'] ?? '' ?></textarea>
                                </div>
                                <input type="submit" class="primary-button" value="Создать">
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

<?php require __DIR__ . '/../footer.php'; ?>
