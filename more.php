<?php
    require_once 'includes/dbh.inc.php';
    require_once 'includes/configsesh.inc.php';
    require_once 'includes/more_model.inc.php';
    require_once 'includes/more_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@400..700&family=Caveat:wght@400..700&family=DynaPuff:wght@400..700&family=Faustina:ital,wght@0,300..800;1,300..800&family=Frijole&family=Fuzzy+Bubbles:wght@400;700&family=Indie+Flower&family=Rock+Salt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=favorite" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
    <link rel="stylesheet" href="landing2.css">
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
            <li class="navi"><a href="more.php">More</a></li>
            <li class="navi"><a href="posts.php">Post</a></li>
            <li><a href="#search-box" class="search-icon">🔍</a></li>
            </ul>
           
            </nav>
</header>
    <section class="sec_oneb4" id="sec_oneb4">
    <div id="search-box" class="search-container">
    <form>
        <input type="text" placeholder="Search...">
        <button class="search_btn" type="submit">Go</button>
    </form>
    <a href="#" class="close-btn">✖</a>
</div>
    </section>

    <?php
    $display = getMore($pdo);
    viewMore($display);
    ?>
    <section class="sec_five">
        <div class="most_commented">
            <h2 class="title_commented">
                MOST COMMENTED
            </h2>
            <div class="line_break"></div>
            <div class="all_incommented">
                <div class="mostcomment">
                    <h2 class="categoryy">
                        FOOD
                    </h2>
                    <h3 class="comment_content">
                        My 10 Favourite Trader Joe's Products
                    </h3>
                </div>
               <div class="line_breaker"></div>
                <div class="mostcomment">
                <h2 class="categoryy">
                        STYLE
                    </h2>
                    <h3 class="comment_content">
                        What Do You Love About The Way You Look?
                    </h3>
                </div>
               <div class="line_breaker"></div>
                <div class="mostcomment">
                <h2 class="categoryy">
                        FOOD
                    </h2>
                    <h3 class="comment_content">
                        What Do You Love About The Way You Look?
                    </h3>
                </div>
               <div class="line_breaker"></div>
               <div class="mostcomment">
                <h2 class="categoryy">
                        FOOD
                    </h2>
                    <h3 class="comment_content">
                        What Do You Love About The Way You Look?
                    </h3>
                </div>
               <div class="line_breaker"></div>
               <div class="mostcomment">
                <h2 class="categoryy">
                        FOOD
                    </h2>
                    <h3 class="comment_content">
                        What Do You Love About The Way You Look?
                    </h3>
                </div>
            </div>
        </div>
    </section>
    <section class="sec_sixb4">
        <h1 class="logos">
            SHADES <span class="spans">OF</span> TEMMY
        </h1>
    </section>
    <section class="sec_six">
        <div class="editor_picks">
            <div class="picks">
            <h2 class="title_commented">
                Editor Picks
            </h2>
            <div class="all_picks">
                <div class="each_pick">
                    <img class="picker" src="pictures/hakon-sataoen-qyfco1nfMtg-unsplash.jpg" alt="img" >
                    <h3 class="picker_text">
                        Nice Car
                    </h3>
                </div>
            
                <div class="each_pick">
                    <img class="picker" src="pictures/hakon-sataoen-qyfco1nfMtg-unsplash.jpg" alt="img" >
                    <h3 class="picker_text">
                    Nice Car
                    </h3>
                </div>
        
                <div class="each_pick">
                    <img class="picker" src="pictures/hakon-sataoen-qyfco1nfMtg-unsplash.jpg" alt="img">
                    <h3 class="picker_text">
                    Nice Car
                    </h3>
                </div>
      
                <div class="each_pick">
                    <img class="picker" src="pictures/hakon-sataoen-qyfco1nfMtg-unsplash.jpg" alt="img">
                    <h3 class="picker_text">
                    Nice Car
                    </h3>
                </div>
         
                <div class="each_pick">
                    <img class="picker" src="pictures/hakon-sataoen-qyfco1nfMtg-unsplash.jpg" alt="img">
                    <h3 class="picker_text">
                    Nice Car
                    </h3>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>
</html>