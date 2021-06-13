<?php include_once __DIR__ . '/services/formatDate.php'; ?>

<?php if (!empty($error)): ?>
    <div style="color: red;"><?= $error; ?></div>
<?php endif; ?>
<?php if (!empty($user)): ?>
    <!-- reply -->
    <div class="section-row">
        <div class="section-title">
            <h2>Комментировать</h2>
        </div>
        <form class="post-reply" action="/articles/<?= $article->getId(); ?>/comments" method="post">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="hidden" name="articleId" value="<?= $article->getId(); ?>">
                        <textarea class="input" name="text" placeholder="Message"></textarea>
                    </div>
                    <input type="submit" class="primary-button" value="Добавить">
                </div>
            </div>
        </form>
    </div>
    <!-- /reply -->
<?php else: ?>
    <p style="font-weight: bold; text-align: center;">Необходимо войти/зарегистрироваться для добавления
        комментария.</p>
<?php endif; ?>


<!-- comments -->
<div class="section-row">
    <div class="section-title">
		<?php if (!empty($comments)): ?>
            <h2>
				<?= count($comments) ?> Comments
            </h2>
		<?php else: ?>
            <h2>0 Comments</h2>
		<?php endif; ?>
    </div>

    <div class="post-comments">
        <!-- comment -->

		<?php if (!empty($comments)): ?>
			<?php foreach ($comments as $comment): ?>
                <div class="media">
                    <div class="media-left">
                        <img class="media-object" src="<?= $comment->getAuthor()->getPhoto() ?>" alt="">
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <h4><?= $comment->getAuthor()->getNickname(); ?></h4>
                            <span class="time">

                                <?= dateFormat($comment->getCreateAt()); ?>
                            </span>
                            <!--доделать
                            <a href="#" class="reply">Reply</a>
                            -->
                        </div>
                        <p id="comment<?= $comment->getId() ?>"><?= htmlspecialchars($comment->getText()) ?></p>

                    </div>
                </div>
			<?php endforeach; ?>
		<?php endif; ?>
        <!-- /comment -->
    </div>
</div>
<!-- /comments -->
