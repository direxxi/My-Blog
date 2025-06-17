<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 

require_once 'includes/dbh.inc.php';
require_once 'includes/configsesh.inc.php';
require_once 'includes/post_view.inc.php';
require_once 'includes/comment_view.inc.php';

// Get current post ID from the URL or session
if (isset($_GET['post_id'])) {
    $post_id = (int) $_GET['post_id'];
    
    $_SESSION['current_post_id'] = $post_id;
} elseif (isset($_SESSION['current_post_id'])) {
    $post_id = $_SESSION['current_post_id'];
} else {
    // Get the first post if no post ID is specified
    $user_id = $_SESSION['user_id'] ?? 0; // Default to 0 if not set
    $post_id = getPost($pdo, $user_id) ?? 0; // Fetch first post or set default
    $_SESSION['current_post_id'] = $post_id;
}


// Now you can use $post_id to fetch the post details and comments
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400..700&family=DynaPuff:wght@400..700&family=Faustina:ital,wght@0,300..800;1,300..800&family=Frijole&family=Fuzzy+Bubbles:wght@400;700&family=Indie+Flower&family=Rock+Salt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="landin.css">
    <title>Document</title>
</head>
<body>
<header>
       <nav>
           <ul class="left_ul">
           <li class="navi"><a href="index.php">Home</a></li>
            <li class="navi"><a href="style.php">Style</a></li>
            <li class="navi"><a href="design.php">Design</a></li>
            <li class="navi"><a href="food.php">Food</a></li>
            <li class="navi"><a href="relationships.php">Relationships</a></li>
            </ul>
           
            <h2 class="logo">SHADES <span class="spans">OF</span> TEMMY</h2>

            <ul class="right_ul">
            <li class="navi"><a href="travel.php">Travel</a></li>
            <li class="navi"><a href="posts.php">Post</a></li>
            <li><a href="#search-box" class="search-icon">🔍</a></li>
            <img class="profile_pic" src="pictures/andrew-s-ouo1hbizWwo-unsplash.jpg" 
     alt="p_pic" onclick="window.location.href='profile.php'">

            </ul>
            </nav>
</header>

<?php
$post = viewPostById($pdo, $post_id);
//var_dump($post);
ViewPost($post);
?>

<?php
$getID = getFirstnLastId($pdo);
navBtn($getID,$post_id);
?>



   
<section class="sec_two">
    <div class="title_suggest">
    <h3 class="suggest">May We Suggest</h3>
    </div>
    <div class="pic_suggest">
    <div>
        <img class="suggest_pic" src="pictures/andrew-s-ouo1hbizWwo-unsplash.jpg" alt="pic">
        <h3 class="pic_title">Have a Relaxing Weekend</h3>
        <h4 class="pic_comments">65 Comments</h4>

    </div>
    <div>
        <img class="suggest_pic" src="pictures/lily-banse--YHSwy6uqvk-unsplash.jpg" alt="pic">
        <h3 class="pic_title">Have a Filled Weekend</h3>
        <h4 class="pic_comments">65 Comments</h4>

    </div>
    <div>
        <img class="suggest_pic" src="pictures/hakon-sataoen-qyfco1nfMtg-unsplash.jpg" alt="pic">
        <h3 class="pic_title">Have a Cozy Weekend</h3>
        <h4 class="pic_comments">65 Comments</h4>

    </div>
    </div>
</section>
<section class="sec_three">
    <div class="comment_header">
        <h2 class="header_comment_title">
        <span class="spans"><?php echo getCommentCount($pdo,$post_id); ?></span> Comments
        </h2>
        <div class="sec_break"></div>
    </div>
   <?php
     $post_comments = viewAllComments($pdo, $post_id); 
     viewComment($post_comments);
   ?>
</section> 
<section class="sec_four" id="sec_four">
    <div class="writing_comments">
        <h3 class="form_title">
            Write a Comment
        </h3>
        <form action="includes/comment.inc.php" method="post">
    <textarea name="comment" id="comment_box"></textarea>
    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post_id); ?>">
    <button type="submit">Post</button>
</form>

        <div class="break"></div>
    </div>
</section>
<section class="sec_five">
<div class="title_suggest">
    <h3 class="suggest_p">More to Love</h3>
    </div>
    <div class="pic_suggest">
    <div>
        <img class="suggest_pic" src="pictures/andrew-s-ouo1hbizWwo-unsplash.jpg" alt="pic">
        <h3 class="pic_title_p">Have a Relaxing Weekend</h3>
        <h4 class="pic_comments_p">65 Comments</h4>

    </div>
    <div>
        <img class="suggest_pic" src="pictures/lily-banse--YHSwy6uqvk-unsplash.jpg" alt="pic">
        <h3 class="pic_title_p">Have a Filled Weekend</h3>
        <h4 class="pic_comments_p">65 Comments</h4>

    </div>
    <div>
        <img class="suggest_pic" src="pictures/hakon-sataoen-qyfco1nfMtg-unsplash.jpg" alt="pic">
        <h3 class="pic_title_p">Have a Cozy Weekend</h3>
        <h4 class="pic_comments_p">65 Comments</h4>

    </div>
    </div>
</section>

</body>
</html>