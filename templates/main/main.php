<?php require_once __DIR__ . '/../header.php'; ?>
<?php include_once __DIR__ . '/../comments/services/formatDate.php'; ?>

    <!-- section -->
    <div class="section section-grey">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2>Популярные статьи</h2>
                    </div>
                </div>

				<?php $i = 0; ?>
				<?php foreach ($popularArticles as $popularArticle): ?>
					<?php if ($i < 3): ?>
                        <!-- post x3 -->
                        <div class="col-md-4">
                            <div class="post">
                                <a class="post-img" href="/articles/<?= $popularArticle->getId() ?>"><img
                                            src="<?php echo !empty($popularArticle->getPhoto())
                                                ? $popularArticle->getPhoto() : '/img/post-4.jpg' ?>"
                                            alt=""></a>
                                <div class="post-body">
                                    <div class="post-meta">
                                        <a class="post-category cat-2"
                                           href="/articles/<?= $popularArticle->getId() ?>"><?= $popularArticle->getTheme() ?></a>
                                        <span class="post-date"><?= dateFormat($popularArticle->getCreatedAt()) ?></span>
                                    </div>
                                    <h1 class="post-title"><a
                                                href="/articles/<?= $popularArticle->getId() ?>"><?= $popularArticle->getName() ?></a>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <!-- /post -->
						<?php $i++; ?>
					<?php endif; ?>
				<?php endforeach; ?>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>Новые статьи</h2>
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
                                               href="/articles/<?= $article->getId() ?>"><?= $article->getTheme() ?></a>
                                            <span class="post-date"><?= dateFormat($article->getCreatedAt()) ?></span>
                                        </div>
                                        <h1 class="post-title"><a
                                                    href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a>
                                        </h1>

                                        <!-- Вывод краткого текста статьи только 100 символов -->
										<?php
										$text = $article->getText();
										$lenghtTextIs100 = strlen($text);
										if ($lenghtTextIs100 < 200) {
											echo $text;
										} else {
											echo substr($text, 0, 550) . '...';
										}
										?>
                                        <!-- /Вывод краткого текста статьи только 100 символов -->

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
                                    <a href="/../main/<?= $page - 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Назад</button>
                                    </a>
                                    <a href="/../main/<?= $page + 1; ?>">
                                        <button class="primary-button">Далее</button>
                                    </a>
								<?php endif; ?>
								<?php if ($page === $countPages && $countPages !== 1): ?>
                                    <a href="/../main/<?= $page - 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Назад</button>
                                    </a>
								<?php endif; ?>
								<?php if ($page === 1 && $countPages === 1): ?>
                                    <a href="/../main/<?= $page + 1; ?>">
                                        <button class="primary-button primary-button-highlighted">Далее</button>
                                    </a>
								<?php endif; ?>
                                <!-- /Пагинация страниц -->

                            </div>
                        </div>
                        <!-- /col-md-12 -->

                    </div>
                </div>

                <div class="col-md-4">

					<?php include __DIR__ . '/../general/categoryAndTags.php'; ?>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->

<?php include __DIR__ . '/../footer.php'; ?>