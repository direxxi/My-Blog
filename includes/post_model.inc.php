<?php

declare(strict_types=1);

require_once 'dbh.inc.php';
require_once 'upload.inc.php';
require_once 'configsesh.inc.php';

// function createPost(object $pdo, string $title, string $category, string $content, string $fileDestination, int $user_id) {
//     $query = 'INSERT INTO posts(title, category, content, images, users_id) 
//               VALUES(:title, :category, :content, :images, :users_id);';

//     $prpd_stmt = $pdo->prepare($query);
//     $prpd_stmt->bindParam(':title', $title);
//     $prpd_stmt->bindParam(':category', $category);
//     $prpd_stmt->bindParam(':content', $content);
//     $prpd_stmt->bindParam(':images', $fileDestination);
//     $prpd_stmt->bindParam(':users_id', $user_id); // Fixed the placeholder name

//     $prpd_stmt->execute();
// }

function getCategoryId(object $pdo, string $category_name): ?int {
    $category_name = trim($category_name);
    $query = 'SELECT category_id FROM categories WHERE BINARY category_name = :category_name';
    $prpd_stmt = $pdo->prepare($query);
    $prpd_stmt->bindParam(':category_name',$category_name);
    $prpd_stmt->execute();
    $category = $prpd_stmt->fetch(PDO::FETCH_ASSOC);

    return $category ? (int)$category['category_id'] : null;
}


function createPost(object $pdo, string $title, string $category_name, string $content, string $fileDestination, int $user_id) {
    // Get category ID
    $category_id = getCategoryId($pdo, $category_name);
    
    if (!$category_id) {
        // die("Error: Category not found! Please select a valid category.");
    }

    // Insert into posts table
    $query = 'INSERT INTO posts (title, content, images, users_id, category_id) VALUES (:title, :content, :images, :users_id, :category_id)';
    
    $prpd_stmt = $pdo->prepare($query);
    $prpd_stmt->bindParam(':title', $title);
    $prpd_stmt->bindParam(':content', $content);
    $prpd_stmt->bindParam(':images', $fileDestination);
    $prpd_stmt->bindParam(':users_id', $user_id);
    $prpd_stmt->bindParam(':category_id', $category_id);

    if ($prpd_stmt->execute()) {
        echo "Post created successfully!";
    } else {
        echo "Error: Unable to create post.";
    }
}



// function viewAllPosts(object $pdo) {
//     $query = 'SELECT posts.title, posts.content, posts.images, posts.created_at, users.username 
//               FROM posts 
//               JOIN users ON posts.users_id = users.id;';
   
//     $prpd_stmt = $pdo->prepare($query);
//     $prpd_stmt->execute();
//     $posts = $prpd_stmt->fetchAll(PDO::FETCH_ASSOC);
//     // $numRows = count($posts);
//     // echo 'no of rows: ' . $numRows;

//     // foreach($posts as $row){
//     //    $_SESSION['image'] = $row['images'];

//     // }
    
//     if (empty($posts)) {
//         echo "No posts found!";
//         return []; // Return empty array instead of null
//     } else {
//         return $posts;
//     }
// }

$totalQuery = "SELECT COUNT(*) FROM posts";
$totalStmt = $pdo->query($totalQuery);
$totalPosts = $totalStmt->fetchColumn();


// $postsperpage = 1;
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
// $page = max(1,min($page, $totalPosts));
// $offset = ($page - 1);


if (!isset($_SESSION['page'])) {
    $_SESSION['page'] = 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['page'])) {
    $newPage = (int) $_POST['page'];

    if ($newPage >= 1 && $newPage <= $totalPosts) {
        $_SESSION['page'] = $newPage;
        $post = viewPostById($pdo, $newPage - 1); // Adjust offset

        if ($post) {
            $_SESSION['current_post_id'] = $post['id'];
        }
    }
}
$page = $_SESSION['page'] ?? 1; // Default to page 1 if not set
$offset = ($page - 1); // Ensure $offset is always an integer

// Use the updated post ID
$post_id = $_SESSION['current_post_id'] ?? null;




function getFirstnLastId($pdo){
    $query = 'SELECT MIN(id) AS first_post, MAX(id) AS last_post FROM posts;';
    $prpd_stmt = $pdo -> prepare($query);
    $prpd_stmt -> execute();
    
    $getID = $prpd_stmt -> fetch(PDO::FETCH_ASSOC);
    return $getID;
}


function viewPostById(object $pdo, int $post_id) {
    $query = 'SELECT posts.id, posts.title, posts.content, posts.images, posts.created_at,users.username, categories.category_name 
              FROM posts
              JOIN users ON posts.users_id = users.id
              JOIN categories ON posts.category_id = categories.category_id
              WHERE posts.id =:postId
              ORDER BY posts.id DESC;';

    $prpd_stmt = $pdo->prepare($query);
    $prpd_stmt -> bindParam('postId',$post_id);
    $prpd_stmt->execute();
    $post = $prpd_stmt->fetch(PDO::FETCH_ASSOC);

    return $post ?: null;
}
