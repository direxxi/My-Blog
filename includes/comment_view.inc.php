<?php
declare(strict_types=1);
require_once 'configsesh.inc.php';
require_once 'comment_model.inc.php';

function errorExist() {
    if(isset($_SESSION['error_comment'])) {
        $errors = $_SESSION['error_comment'];

        echo "<div class='error-messages' style='color: red;'>";
        foreach($errors as $err) {
            echo "<p>" . htmlspecialchars($err) . "</p>";
        }
        echo "</div>";

        unset($_SESSION['error_comment']);
    }
}

function viewComment($post_comments) {
    if (!empty($post_comments)) {
        echo '<div class="comments">';

        foreach ($post_comments as $comment) {
            echo '<div class="each_comment">
                    <h3 class="user_says">' . htmlspecialchars($comment['username']) . ' says....</h3>
                    <p class="comment_text">' . htmlspecialchars($comment['comment_text']) . '</p>
                    <h3 class="timestamp">
                        <span class="spans">' . date("F d, Y h:i A", strtotime($comment['created_at'])) . '</span>
                    </h3>
                  </div>
                  <div class="break"></div>';
        }

        echo '</div>';
    } else {
        echo '<div class="no-comments">
                <p>No comments yet. Be the first to comment!</p>
              </div>';
    }
}

function getPostCommentCount(object $pdo, int $post_id): int {
    $query = 'SELECT COUNT(*) AS comment_count FROM comments WHERE post_id = :post_id';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return (int) $result['comment_count'];
}