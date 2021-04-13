<html>
    <?php
        $title = 'Home - Lyyynch Blog';
        include 'partials/head.php';

        include_once 'load-posts.php';
   ?>

    <body>
        <div class="page-wrapper">
            <?php include 'partials/header.php'; ?>

            <div class="content-wrapper">
                <h1 class="page-title">
                    <span class="title-intro">Welcome to</span>
                    The Danger Zone
                </h1>

                <main class="main-content">
                    <?php if ($homePageResults->num_rows == 0): ?>
                        <p class="no-results">No posts were found</p>
                    <?php else: ?>
                        <ul class="posts">
                            <?php foreach ($homePageResults as $post): ?>
                            <li>
                                <div class="post">
                                    <h2><?= $post['title']; ?></h2>

                                    <div class="meta-data">
                                        Written by <span class="author"><?= $post['user_name']; ?></span> on
                                        <span class="post-date">
                                            <?php
                                                $date = new DateTime($post['created_at']);
                                                echo $date->format('d/m/Y') . " at " . $date->format('H:i');
                                            ?>
                                        </span>
                                    </div>

                                    <p class="snippet"><?= $post['content']; ?></p>

                                    <a href="/post.php?slug=<?= $post['url_slug']; ?>" class="read-more">Continue reading</a>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </main>
            </div>

            <?php include 'partials/footer.php'; ?>
        </div>
    </body>
</html>