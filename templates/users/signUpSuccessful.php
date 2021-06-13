<?php include __DIR__ . '/../header.php'; ?>

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Post content -->
                <div class="col-md-12">
                    <!-- reply -->
                    <div class="section-row">
                        <div class="section-title text-align-to-center">
							<?php if (!empty($result['error'])): ?>
                                <h2><?= $result['error']; ?></h2>
							<?php else: ?>
                                <h2>Регистрация прошла успешно!</h2>
                                <p>Ссылка для активации вашей учетной записи отправлена вам на email.</p>
							<?php endif; ?>
                        </div>
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