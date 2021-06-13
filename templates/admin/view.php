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
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>Последнии статьи</h2>
                            </div>
                        </div>

						<?php foreach ($articles as $article): ?>
                            <!-- post -->
                            <div class="col-md-12">
                                <div class="post post-row">
                                    <a class="post-img" href="/articles/<?= $article->getId() ?>"><img
                                                src="<?php echo !empty($article->getPhoto())
													? $article->getPhoto() : '/img/post-4.jpg' ?>"
                                                alt=""></a>
                                    <div class="post-body">
                                        <div class="post-meta">


                                            <a class="post-category cat-2"
                                               href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a>
                                            <span class="post-date"><?= dateFormat($article->getCreatedAt()) ?></span>
                                        </div>
                                        <h3 class="post-title"><a
                                                    href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a>
                                        </h3>

                                        <!-- Вывод краткого текста статьи только 100 символов -->
										<?php
										$text = $article->getText();
										$lenghtTextIs100 = strlen($text);
										if ($lenghtTextIs100 < 100) {
											echo $text;
										} else {
											echo substr($text, 0, 100) . '...';
										}
										?>
                                        <!-- /Вывод краткого текста статьи только 100 символов -->

                                        <div class="post-meta">
                                            <!-- кнопка редактировать статью -->
                                            <p style="text-align: right;">
												<?php if ($user->isAdmin()): ?>
                                                    <a href="/articles/<?= $article->getId() ?>/edit">
                                                        <button class="primary-button">Редактировать статью
                                                        </button>
                                                    </a>
												<?php endif; ?>
                                            </p>
                                            <!-- /кнопка редактировать статью -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /post -->
						<?php endforeach; ?>

                        <!-- col-md-12 -->
                        <div class="col-md-12">
                            <div class="section-row text-align-to-center">

                                <!-- Пагинация страниц -->
								<?php if ($page > 1 && $page < $countPages && $countPages !== 1): ?>
                                    <a href="/../admin/view/<?= $page - 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Назад</button>
                                    </a>
                                    <a href="/../admin/view/<?= $page + 1; ?>">
                                        <button class="primary-button">Далее</button>
                                    </a>
								<?php endif; ?>
								<?php if ($page === $countPages && $countPages !== 1): ?>
                                    <a href="/../admin/view/<?= $page - 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Назад</button>
                                    </a>
								<?php endif; ?>
								<?php if ($page === 1 && $countPages === 1): ?>
                                    <a href="/../admin/view/<?= $page + 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Далее</button>
                                    </a>
								<?php endif; ?>
                                <!-- /Пагинация страниц -->

                            </div>
                        </div>
                        <!-- /col-md-12 -->
                    </div>
                    <!-- row -->
                </div>
                <!-- /col-md-8 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->


<?php include __DIR__ . '/../footer.php'; ?>