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

                        <form class="post-reply" action="/comment/<?= $comment->getId() ?>/edit" method="post"
                              method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label for="text">Комментарий</label>
                                        <textarea class="input" name="text" placeholder="Текст статьи"><?= $_POST['text'] ?? $comment->getText() ?></textarea>
                                    </div>

                                    <input type="submit" class="primary-button" value="Обновить">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- Post content -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- section -->

<?php include __DIR__ . '/../footer.php'; ?>