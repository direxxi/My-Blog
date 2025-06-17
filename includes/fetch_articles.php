<?php
require_once 'configsesh.inc.php';
require_once 'dbh.inc.php';
require_once 'index_model.inc.php';

if (isset($_POST['page'])) {
    $page = $_POST['page'];
    $postperpage = 5;
    $offset = ($page - 1) * $postperpage; 

    $query = 'SELECT posts.id AS postId, posts.title, posts.content, posts.images, posts.created_at, users.username FROM posts
              JOIN users ON posts.users_id = users.id
              ORDER BY created_at DESC LIMIT :limit OFFSET :offset;';

    $prpd_stmt = $pdo->prepare($query);
    $prpd_stmt->bindValue(':limit', $postperpage, PDO::PARAM_INT);
    $prpd_stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $prpd_stmt->execute();
    $articles = $prpd_stmt->fetchAll();

    if (empty($articles)) {
        echo "no_more_articles";
    } else {
        foreach ($articles as $article) {
            $image = isset($article['images']) ? htmlspecialchars($article['images']) : 'default.jpg';
            $content = isset($article['content']) ? nl2br(htmlspecialchars($article['content'])) : 'No content available.';
            $short_content = substr($content, 0, 45); // Show only first 45 characters
            
            echo '<section class="sec_one">
            <div class="images_1">
                <img class="big_img" src="includes/' . $image . '" alt="big_img">
                <div class="img_info">
                    <img class="small_img" src="pictures/andrew-s-ouo1hbizWwo-unsplash.jpg" alt="small_img">
                    <div class="info">
                        <h2 class="info_name">' . htmlspecialchars($article['username']) . '</h2>
                    </div>
                </div>
            </div>
            <div class="contents">
                <div class="content_sub">
                    <h3 class="date_username">' . htmlspecialchars($article['created_at']) . ' . 
                        <span class="spans">' . htmlspecialchars($article['username']) . '</span>
                    </h3>
                    <h2 class="title">' . htmlspecialchars($article['title']) . '</h2>
                </div>
              
                <p class="content_p">' . htmlspecialchars($short_content) . '</p>
            </div>
            <div class="btn_comment">
                <button class="continue_reading" onclick="window.location.href=\'landing.php?post_id=' . $article['postId'] . '\'">
                    Continue Reading
                </button>
                <h3>
                    <span class="spans"> 56</span> Comments
                </h3>
            </div>
            <div class="line_br"></div>
        </section>';
        }
    }
}
?>
