<?php
declare(strict_types=1);

require_once 'dbh.inc.php';
require_once 'configsesh.inc.php';
require_once 'style_model.inc.php';

function viewStyles(array $display_view) {
    foreach ($display_view as $displays) {
        $image = isset($displays['images']) ? htmlspecialchars($displays['images']) : 'default.jpg';
        $content = isset($displays['content']) ? nl2br(htmlspecialchars($displays['content'])) : 'No content available.';
        $short_content = substr($content, 0, 45); // Show only first 100 characters
        echo '<section class="sec_one">
        <div class="images_1">
            <img class="big_img" src="includes/' .$image . '" alt="big_img">
            <div class="img_info">
                <img class="small_img" src="pictures/andrew-s-ouo1hbizWwo-unsplash.jpg" alt="small_img">
                <div class="info">
                    <h2 class="info_name">' . htmlspecialchars($displays['username']) . '</h2>
                </div>
            </div>
        </div>
        <div class="contents">
            <div class="content_sub">
                <h3 class="date_username">' . htmlspecialchars($displays['created_at']) . ' . 
                    <span class="spans">' . htmlspecialchars($displays['username']) . '</span>
                </h3>
                <h2 class="title">' . htmlspecialchars($displays['title']) . '</h2>
            </div>
          
            <p class="content_p">' . htmlspecialchars($short_content) . '</p>
        </div>
        <div class="btn_comment">
     <button class="continue_reading" onclick="window.location.href=\'landing.php?post_id=' . $displays['id'] . '\'">
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

