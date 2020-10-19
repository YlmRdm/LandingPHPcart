<?php
$sessionLength = 86400 * 30;
session_start();
include('class/Cart.php');
$cart = new Cart();
$product_array = $cart->getAllProduct();
if(!empty($_SESSION["cart_item"])){
	$count = count($_SESSION["cart_item"]);
} else {
    $count = 0;
    // echo "<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled tooltip">";
    // echo "<button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>"
    // echo "</button>"
    // echo "</span>";
}

$cookie_name = "randomUser";
if (!empty($_SESSION[$cookie_name])) {
	$user = $_SESSION[$cookie_name];
}
elseif (!empty($_COOKIE[$cookie_name])) {
	$_SESSION[$cookie_name] = json_decode($_COOKIE[$cookie_name], true);
	$user = $_SESSION[$cookie_name];
} else {
	$hostname="localhost";
	$username="root";
	$password="";
	$db = "db_wood";
	$dbh = new PDO("mysql:host=$hostname;dbname=$db", $username, $password);
	$user = $dbh->query('SELECT name, surname FROM users ORDER BY RAND() LIMIT 1')->fetch();
	$cookie_value = ['name' => $user['name'], 'surname' => $user['surname']];
	setcookie($cookie_name, json_encode($cookie_value), time() + $sessionLength, "/");
	$_SESSION[$cookie_name] = $cookie_value;
}

// PASTE THIS CODE BELOW TO CHECK COOKIE VALUE
// if(!isset($_COOKIE[$cookie_name])) {
//      echo "Cookie is not set!";
// } else {
//      echo "Cookie is set!<br>";
//      echo "Value is: " . $_COOKIE[$cookie_name];
// }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YlmRdm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/d7e2511aa0.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/style.css">

    <!-- FOR SLIDER  -->
    <link rel="stylesheet" href="./css/hero-slider.css">
    <link rel="stylesheet" href="./css/templatemo-main.css">
    <script src="./js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

</head>
<body>
    <div class="fixed-side-navbar">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="#home"><span>HOME</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#furniture"><span>FURNITURE</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#decor"><span>DECOR</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#stationery"><span>STATIONERY</span></a></li>
            <li class="nav-item"><a class="nav-link" href="#about"><span>ABOUT</span></a></li>
        </ul>
    </div>

    <!-- FIRST SECTION -->
    <section id="home-section">
        <div class="right-nav-items">
            <!-- Here is for checking cookie value. You can copy statement comment from above -->
            <div class="welcome-msg">
                <?php echo "Welcome, " . $user['name'] . " " . $user['surname'];  ?>
            </div>
            <a href="cart.php" class="info-ico">
					<i class="fas fa-shopping-cart fa-lg" aria-hidden="true" data-toggle="modal" data-target="#modal-fullscreen-xl"></i> 
						<span class="badge badge-light counter-bdg" id="cart-count">
							<?php print $count; ?>
						</span>
            </a>
            <ul class="language-switcher">
                <li><a href="#" class="current-lang">EN</a> <div class="triangle"></div>
                    <ul class="switcher-submenu">
                        <li><a href="#">TR</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand logo" href="#"><img src="./img/logo.png" alt="Wooder"></a>
                <div class="central-nav-items">
                    <ul class="navbar-nav mr-auto central-ul">
                        <li class="nav-item">
                        <a class="nav-link" href="#home">home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#furniture">furniture</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#decor">decor</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#stationery">stationery</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#about">about</a>
                        </li>
                    </ul>
                </div>
            </div> 
        </nav>
        <div class="alert-success" id="add-item-bag"></div>
        <!-- PARALLAX - 1 -->

        <div class="parallax-content baner-content" id="home">
            <div class="header-content">
                <div class="central-content-wrapper">
                    <div class="big-heading">wooder</div>
                    <div class="primary-button">
                        <button class="header-btn"><a href="#furniture">learn more</a> <img src="./img/btn-arrow.png" alt="arrow" class="btn-arrow"></button>
                    </div>
                    <div class="mouse-ico">
                        <a href="#furniture"><img src="./img/mouse-ico.png" alt="Scroll down"></a>
                    </div>
                    <div class="scroll-arrow"><img src="./img/arrow-ico.png" alt="Wooder scroll arow"></div>
                    <div class="scroll-sign-wrapper">
                        <div class="scroll-sign">scroll</p>
                    </div> 
                </div> 
            </div>
            <div class="share-icon">
            <a href="#"><img src="./img/share-ico.png" alt="Share"></a>
            </div>
        </div>
    </section>
    <!-- SECOND SECTION -->
    <?php
			if (!empty($product_array)) {
				foreach($product_array as $key=>$value){
    ?>
    <section id="features-section">
        <?php if($product_array[$key]["name"] == 'Furniture') : ?>  
                    <!-- PARALLAX - 2 -->
                    <div class="service-content" id="furniture">
                        <div class="section-wrapper">
                            <div class="feature-wrapper">
                                <div class="feature-content"> 
                                    <h4 class="feature-header product-title"><?php echo $product_array[$key]["name"]; ?></h4>
                                    <div class="p-content">
                                        <div class="p-line"></div>
                                        <p class="feature-paragraph product-price">Price: <?php echo "$".$product_array[$key]["price"]; ?></p>
                                    </div>
                                    <div class="btn-content">
                                        <span class="feature-qty">
                                            Quantity<input type="text" class="product-quantity" id="qty-<?php echo $product_array[$key]["id"]; ?>" name="quantity" value="1" size="2" />
                                        </span>
                                        <button type="button" class="feature-btn btnAddAction" data-itemid="<?php echo $product_array[$key]["id"]; ?>" id="product-<?php echo $product_array[$key]["id"]; ?>" data-action="action" data-sku="<?php echo $product_array[$key]["sku"]; ?>" data-proname="<?php echo $product_array[$key]["sku"]; ?>"> add to cart <img src="./img/brown-arrow.png" alt="" class="btn-arrow">
                                        </button>
                                        <div class="number">0<?php echo $product_array[$key]["id"]; ?><span>.</span></div>
                                        <div class="feature-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="img-and-sign product-image">
                                <img src="<?php echo $product_array[$key]["image"]; ?>" alt="Furniture" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <!-- PARALLAX - 3 -->
        <?php elseif($product_array[$key]["name"] == 'Decor') : ?>
                    <div class="parallax-content projects-content" id="decor">
                        <div class="section-wrapper s-wrapper-2">
                            <div class="img-and-sign">
                                <img src="<?php echo $product_array[$key]["image"]; ?>" alt="Decor" class="img-fluid">
                            </div>
                            <div class="feature-wrapper">
                                <div class="feature-content f-content-2">
                                    <h4 class="feature-header-2 product-title"><?php echo $product_array[$key]["name"]; ?></h4>
                                        <div class="p-content">
                                        <p class="feature-paragraph par-2 product-price">Price: <?php echo "$".$product_array[$key]["price"]; ?></p>
                                        <div class="line-2"></div>
                                    </div>
                                    <div class="btn-content btn-content-2">
                                        <span class="feature-qty-2">
                                            Quantity<input type="text" class="product-quantity" id="qty-<?php echo $product_array[$key]["id"]; ?>" name="quantity" value="1" size="2" />
                                        </span>
                                        <button type="button" class="feature-btn btnAddAction" data-itemid="<?php echo $product_array[$key]["id"]; ?>" id="product-<?php echo $product_array[$key]["id"]; ?>" data-action="action" data-sku="<?php echo $product_array[$key]["sku"]; ?>" data-proname="<?php echo $product_array[$key]["sku"]; ?>"> add to cart <img src="./img/brown-arrow-left.png" alt="" class="btn-arrow">
                                        </button>
                                        <div class="number number-2">0<?php echo $product_array[$key]["id"]; ?><span>.</span></div>
                                        <div class="feature-line feature-line-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php elseif($product_array[$key]["name"] == 'Stationery') : ?>
                    <!-- PARALLAX - 4 -->
                    <div class="tabs-content" id="stationery">
                        <div class="section-wrapper">
                            <div class="feature-wrapper">
                                <div class="feature-content">
                                    <h4 class="feature-header product-title"><?php echo $product_array[$key]["name"]; ?></h4>
                                    <div class="p-content">
                                        <div class="p-line"></div>
                                        <p class="feature-paragraph product-price">Price: <?php echo "$".$product_array[$key]["price"]; ?></p>
                                    </div>
                                    <div class="btn-content">
                                        <span class="feature-qty">
                                            Quantity<input type="text" class="product-quantity" id="qty-<?php echo $product_array[$key]["id"]; ?>" name="quantity" value="1" size="2" />
                                        </span>
                                        <button type="button" class="feature-btn btnAddAction" data-itemid="<?php echo $product_array[$key]["id"]; ?>" id="product-<?php echo $product_array[$key]["id"]; ?>" data-action="action" data-sku="<?php echo $product_array[$key]["sku"]; ?>" data-proname="<?php echo $product_array[$key]["sku"]; ?>"> add to cart <img src="./img/brown-arrow.png" alt="" class="btn-arrow">
                                        </button>
                                        <div class="number">0<?php echo $product_array[$key]["id"]; ?><span>.</span></div>
                                        <div class="feature-line"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="img-and-sign">
                                <img src="<?php echo $product_array[$key]["image"]; ?>" alt="Stationery" class="img-fluid">
                            </div>
                        </div>
                    </div>
        <?php else : ?>
                    <p>
                        Sorry to say that but There is no product here... 
                    </p>
        <?php endif; ?>
                
    </section>
    <?php
		}
	}
    ?>
    <!-- THIRD SECTION -->
    <section id="thrd-section">
        <div class="tabs-content" id="about">
            <div class="thrd-section-wrapper">
                <div class="heading-content">
                    <div class="line-before-heading"></div>
                    <h2 class='thrd-heading'>we Do the design of any complexity</h2>
                </div>
                <div class="p-content">
                    <div class="p-line"></div>
                    <p class="thrd-paragraph">
                    This is a team of professionals that make the furniture and wood décor high standard. Creating modern designs. Adhering to the global quality standards. And we are doing work with love.
                    </p>
                    <div class="side-border"></div>
                </div>
                <button class="thrd-btn"><img src="./img/player.png" alt="Play">watch video</button>
            </div>
            <div class="big-play">
                <img src="./img/big-player.png" alt="">
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="primary-button">
                            <a href="#home">Back To Top</a>
                        </div>
                        <p>Copyright &copy;2020 YlmRdm</p>
                    </div>
                </div>
            </div>
        </footer>
    </section>
        

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.4/umd/popper.min.js" integrity="sha512-eUQ9hGdLjBjY3F41CScH3UX+4JDSI9zXeroz7hJ+RteoCaY+GP/LDoM8AO+Pt+DRFw3nXqsjh9Zsts8hnYv8/A==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha512-M5KW3ztuIICmVIhjSqXe01oV2bpe248gOxqmlcYrEzAvws7Pw3z6BK0iGbrwvdrUQUhi3eXgtxp5I8PDo9YfjQ==" crossorigin="anonymous"></script>
    <script  src="./js/main.js"></script>

    <!-- FOR SLIDER -->
    <script  src="./js/script.js"></script>
    <script  src="./js/plugins.js"></script>

    <script type="text/javascript">
        jQuery(document).on('click', 'button.btnAddAction', function() {
            var item_id = jQuery(this).data('itemid');
            var qty = jQuery('#qty-'+item_id).val();
            var sku = jQuery(this).data('sku');
            var product_name = jQuery(this).data('proname');
            jQuery.ajax({
                type:'POST',
                url:'add.php',
                data:{product_id:item_id, quantity:qty, sku:sku},
                dataType:'json',    
                beforeSend: function () {
                    jQuery('button#product-'+item_id).button('loading');
                },
                complete: function () {
                    jQuery('button#product-'+item_id).button('reset');
                },                
                success: function (json) {
                    jQuery('#cart-count').html(json.count);
                    jQuery("#add-item-bag").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> You have added <strong>'+product_name+'</strong> to your shopping cart!</div>');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }        
            });
        });
    </script>
</body>
</html>