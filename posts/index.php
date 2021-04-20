<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';
?>
<html>
    <?php
        $title = 'Posts - Lyyynch Blog';
        include '../partials/head.php';

        include_once '../load-posts.php';
    ?>

    <body>
        <div class="page-wrapper">
            <?php include '../partials/header.php'; ?>

            <div class="content-wrapper">
                <h1 class="page-title">
                    <span class="title-intro">Posts</span>
                    The Danger Zone
                </h1>

                <main class="main-content">
                    <?php if ($postsPageResults->num_rows == 0): ?>
                        <p class="no-results">Sorry, we've got no posts right now</p>
                    <?php else: ?>

                        <ul class="posts">
                            <?php foreach ($postsPageResults as $post): ?>
                            <li>
                                <div class="post">
                                    <h2><?= $post['title']; ?></h2>

                                    <div class="meta-data">
                                        Written by <span class="author"><?= $post['user_name']; ?></span> on
                                        <span class="date">
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

                    <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page - 1; ?>" class="previous page">Previous Page</a>
                        <?php endif; ?>
                        <?php if ($page < $lastPage): ?>
                            <a href="?page=<?= $page + 1; ?>" class="next page">Next Page</a>
                        <?php endif; ?>
                    </div>
                </main>
            </div>

            <?php include "../partials/footer.php"; ?>
        </div>
    </body>
</html>