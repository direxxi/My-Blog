<?php
require_once 'includes/configsesh.inc.php';
require_once 'includes/post_view.inc.php';
require_once 'includes/category_model.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="post.css">
    <title>Document</title>
</head>
<body>
    <section class="sec_one">
   <div class="card">
   <form action="includes/post.inc.php" method="post" enctype="multipart/form-data">
              <input type="text" name="title" placeholder="The title" required>
              <select name="category_name" id="Category" required>
    <option value="" disabled selected>Choose a category</option>
    <?php 
    $categories = getCategory($pdo);
    if (!empty($categories)) {
        foreach ($categories as $category): ?>
            <option value="<?= htmlspecialchars((string) $category['category_name']) ?>">
                <?= htmlspecialchars((string) $category['category_name']) ?>
            </option>
        <?php endforeach; 
    } else { ?>
        <option value="" disabled>No categories available</option>
    <?php } ?>

</select>

              <textarea type="text" name="content" id="content_box" placeholder="Say Something"></textarea>
             <input type="file" name="fileToUpload" placeholder="Upload your pictures here">
                <button class="post_btn" type="submit" name="post-btn">Post</button>
            </form>
            <?php
            errorExists();
            ?>
   </div>
    </section>
</body>
</html> 

