<?php include __DIR__ . '/../header.php';?>

<!-- Page Header -->
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<ul class="page-header-breadcrumb">
					<li><a href="/">Главная</a></li>
					<li>О сайте</li>
				</ul>
				<h1>О сайте</h1>
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
			<div class="col-md-8">
				<div class="section-row">
					<p>Сайт посвящен web разработке, современным технологиям.
						Заходите почаще, впереди много интересных статей.</p>
				</div>
			</div>

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
			</div>
			<!-- /aside -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php include  __DIR__ . '/../footer.php'?>
