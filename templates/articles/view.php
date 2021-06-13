<?php include __DIR__ . '/../header.php'; ?>
<?php include_once __DIR__ . '/../comments/services/formatDate.php'; ?>

    <!-- Page Header -->
    <div id="post-header" class="page-header">
        <div class="background-img" style="background-image: url('<?= $article->getPhoto() ?>');"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="post-meta">
                        <a class="post-category cat-2" href="/category.html"><?= $article->getTheme() ?></a>
                        <span class="post-date"><?= dateFormat($article->getCreatedAt()) ?></span>
                    </div>
                    <h1><?= $article->getName() ?></h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Post content -->
                <div class="col-md-8">
                    <div class="section-row"><!-- добавить  sticky-container когда сделаю кнопки соц сетей-->
                        <div class="main-post">
                            <div class="post-meta">
                                <!-- кнопка редактировать статью -->
                                <p style="text-align: right;">
									<?php if (!empty($user)): ?>
										<?php if ($user->isAdmin()): ?>
                                            <a href="/articles/<?= $article->getId() ?>/edit">
                                                <button class="primary-button">Редактировать статью
                                                </button>
                                            </a>
										<?php endif; ?>
									<?php endif; ?>
                                </p>
                                <!-- /кнопка редактировать статью -->
                            </div>

                            <figure class="figure-img">
                                <img class="img-responsive" src="<?php echo !empty($article->getPhoto())
									? $article->getPhoto() : '/img/post-4.jpg' ?>"
                                     alt="">
                                <!--<figcaption>So Lorem Ipsum is bad (not necessarily)</figcaption>-->
                            </figure>

                            <h3 class="text-center"><?= $article->getName() ?></h3>
                            <div><?= $article->getText() ?></div>


                            <!-- для кода или комментариев
                            <blockquote class="blockquote">
                                I’ve heard the argument that “lorem ipsum” is effective in wireframing or design because it helps people focus on the actual layout, or color scheme, or whatever. What kills me here is that we’re talking about creating a user experience that will (whether we like it or not) be DRIVEN by words. The entire structure of the page or app flow is FOR THE WORDS.
                            </blockquote>
                            -->
                        </div>

                        <!--
                        <div class="post-shares sticky-shares">
                            <a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
                            <a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-envelope"></i></a>
                        </div>
                        -->
                    </div>

                    <!-- author -->
                    <div class="section-row">
                        <div class="post-author">
                            <div class="media">
                                <div class="media-left">
                                    <img class="media-object" src="<?= $article->getAuthor()->getPhoto() ?>" alt="">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h3><?= $article->getAuthor()->getNickname(); ?></h3>
                                    </div>
                                    <p><?= $article->getAuthor()->getEmail(); ?></p>
                                    <!--доделать
                                    <ul class="author-social">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    </ul>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /author -->

					<?php include __DIR__ . '/../comments/comments.php'; ?>

                </div>
                <!-- /Post content -->

                <!-- aside -->
                <div class="col-md-4">
                    <!-- post widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Последнии статьи</h2>
                        </div>
						<?php $i = 0; ?>
						<?php foreach ($articlesNew as $article): ?>
							<?php if ($i < 4): ?>
                                <div class="post post-widget">
                                    <a class="post-img" href="<?= $article->getId() ?>">
                                        <img src="<?php echo !empty($article->getPhoto())
											? $article->getPhoto() : '/img/post-4.jpg' ?>"
                                             alt=""></a>
                                    <div class="post-body">
                                        <h3 class="post-title"><a
                                                    href="<?= $article->getId() ?>"><?= $article->getName() ?></a></h3>
                                    </div>
                                </div>
								<?php $i++; ?>
							<?php endif; ?>
						<?php endforeach; ?>
                    </div>
                    <!-- /post widget -->

                    <!-- post widget -->
                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Популярные статьи</h2>
                        </div>
						<?php $i = 0; ?>
						<?php foreach ($popularArticles as $popularArticle): ?>
							<?php if ($i < 2): ?>
                                <div class="post post-thumb">
                                    <a class="post-img" href="<?= $popularArticle->getId() ?>"><img
                                                src="<?php echo !empty($popularArticle->getPhoto())
				                                    ? $popularArticle->getPhoto() : '/img/post-4.jpg' ?>"
                                                alt=""></a>
                                    <div class="post-body">
                                        <div class="post-meta">
                                            <a class="post-category cat-3"
                                               href="<?= $popularArticle->getId() ?>"><?= $popularArticle->getTheme() ?></a>
                                            <span class="post-date"><?= dateFormat($popularArticle->getCreatedAt()) ?></span>
                                        </div>
                                        <h3 class="post-title"><a
                                                    href="<?= $popularArticle->getId() ?>"><?= $popularArticle->getName() ?></a>
                                        </h3>
                                    </div>
                                </div>
								<?php $i++ ?>
							<?php endif; ?>
						<?php endforeach; ?>
                    </div>
                    <!-- /post widget -->

                    <!--доделать
					<?php //include __DIR__ . '/../general/categoryAndTags.php'; ?>


                    <div class="aside-widget">
                        <div class="section-title">
                            <h2>Архив</h2>
                        </div>
                        <div class="archive-widget">
                            <ul>
                                <li><a href="#">Октябрь 2020</a></li>
                                <li><a href="#">Ноябрь 2020</a></li>
                                <li><a href="#">Декабрь 2020</a></li>
                            </ul>
                        </div>
                    </div>
                    -->
                </div>
                <!-- /aside -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->

<?php include __DIR__ . '/../footer.php'; ?>