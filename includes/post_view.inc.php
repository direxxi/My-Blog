<?php
declare(strict_types=1);
require_once 'configsesh.inc.php';
require_once 'post_model.inc.php';
require_once 'comment_model.inc.php';




function errorExists(){
    if(isset($_SESSION['error_post'])){
        $error = $_SESSION['error_post'];

        echo "<div class='error-messages' style='color: red;'>";

        foreach($error as $err){
            echo "<p>$err</p>";
        }

        echo "</div>";
        unset($_SESSION['error_post']);
    }
    };
 
   function ViewPost($post) {
    if ($post && is_array($post)) { // Ensure $post exists and is an array
        $image = isset($post['images']) ? htmlspecialchars($post['images']) : 'default.jpg';
        $username = isset($post['username']) ? htmlspecialchars($post['username']) : 'Unknown User';
        $title = isset($post['title']) ? htmlspecialchars($post['title']) : 'Untitled';
        $content = isset($post['content']) ? nl2br(htmlspecialchars($post['content'])) : 'No content available.';
        $created_at = isset($post['created_at']) ? date("F j, Y", strtotime($post['created_at'])) : 'Unknown Date';
        echo '<section class="sec_one">
            <div class="img_1">
                <img class="image_1" src="includes/' . $image . '" alt="Post Image">
            </div>
            <div class="comment_likes">
                <div class="comment">
                    <div class="line_break"></div>
                    <a class="write_comments" href="#sec_four">
                        <button class="write_comment">Write a Comment</button>
                    </a>
                </div>
                <div class="content">
                    <h3 class="date_person">' . $created_at . ' <span>.</span> <span class="spans">' . $username . '</span></h3>
                    <h1 class="title">' . $title . '</h1>
                    <p class="content_p">' . $content . '</p>
                </div>
                <div class="likes">
                    <div class="line_break"></div>
                    <h3 class="like">Like<span class="material-symbols-outlined">favorite</span></h3>
                </div>
            </div>
            <div class="sec_break"></div>
        </section>';
    } else {
        echo "<p>No post found.</p>";
    }
}
function navBtn($getID, $post_id) {
    if ($getID && is_array($getID)) {
        echo '
        <form method="post">
            <input type="hidden" name="post_id" value="' . ($post_id) . '">

            <div class="pagination">';

        if ($post_id > $getID['first_post']) {
            echo '<button type="button" class="prev-btn" onclick="window.location.href=\'landing.php?post_id=' . ($post_id - 1) . '\'">
                    Previous Post
                  </button>';
        }

        if ($post_id < $getID['last_post']) {
            echo '<button type="button" class="next-btn" onclick="window.location.href=\'landing.php?post_id=' . ($post_id + 1) . '\'">
                    Next Post
                  </button>';
        }

        echo '
            </div>
        </form>';
    }
}


    
   
    


