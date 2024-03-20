<?php include __DIR__ . '/../header.php'; ?>
<?php include_once __DIR__ . '/../comments/services/formatDate.php'; ?>

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col-md-8 -->
                <div class="col-md-8">

                    <!-- comments -->
                    <div class="section-row">
                        <div class="section-title">
                            <h2><?= $countAllComments ?> Comments</h2>
                        </div>

                        <div class="post-comments">
                            <!-- comment -->
							<?php if (!empty($comments)): ?>
							<?php foreach ($comments as $comment): ?>
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object"
                                         src="<?php echo !empty($comment->getAuthor()->getPhoto())
	                                    ? $comment->getAuthor()->getPhoto() : '/img/author.png' ?>"
                                         alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h4><?= $comment->getAuthor()->getNickname(); ?></h4>
                                        <span class="time"><?= dateFormat($comment->getCreatedAt()); ?></span>
                                        <a href="#" class="reply">Reply</a>
                                    </div>
                                    <p id="comment<?= $comment->getId() ?>">

                                        <!-- Вывод краткого текста статьи только 100 символов -->
										<?php
										$text = $comment->getText();
										$lenghtTextIs100 = strlen($text);
										if ($lenghtTextIs100 < 100) {
											echo htmlspecialchars($text);
										} else {
											echo htmlspecialchars(substr($text, 0, 100) . '...');
										}
										?>
                                        <!-- /Вывод краткого текста статьи только 100 символов -->
                                    </p>

                                    <div class="post-meta">
                                        <!-- кнопка редактировать коммант -->
                                        <p style="text-align: right;">
											<?php if ($user->isAdmin()): ?>
                                                <a href="/comment/<?= $comment->getId() ?>/edit">
                                                    <button class="primary-button"><?= $i; ?>Редактировать комментарий
                                                    </button>
                                                </a>
											<?php endif; ?>
                                        </p>
                                        <!-- /кнопка редактировать коммант -->
                                    </div>
                                </div>
								<?php endforeach; ?>
								<?php endif; ?>
                                <!-- /comment -->
                            </div>
                        </div>
                        <!-- /comments -->

                        <!-- col-md-12 -->
                        <div class="col-md-12 media">
                            <div class="section-row text-align-to-center">

                                <!-- Пагинация страниц -->
	                            <?php if ($page > 1 && $page < $countPages && $countPages !== 1): ?>
                                    <a href="/../admin/comments/<?= $page - 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Назад</button>
                                    </a>
                                    <a href="/../admin/comments/<?= $page + 1; ?>">
                                        <button class="primary-button">Далее</button>
                                    </a>
	                            <?php endif; ?>
	                            <?php if ($page === $countPages && $countPages !== 1): ?>
                                    <a href="/../admin/comments/<?= $page - 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Назад</button>
                                    </a>
	                            <?php endif; ?>
	                            <?php if ($page === 1 && $countPages === 1): ?>
                                    <a href="/../admin/comments/<?= $page + 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Далее</button>
                                    </a>
	                            <?php endif; ?>
                                <!-- /Пагинация страниц -->

                            </div>
                        </div>
                        <!-- /col-md-12 -->

                    </div>
                    <!-- /comments -->

                </div>
                <!-- /col-md-8 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->


<?php include __DIR__ . '/../footer.php'; ?>