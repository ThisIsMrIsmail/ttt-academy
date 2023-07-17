<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include "./views/partials/links.php"; ?>
  <link rel="stylesheet" href="/src/user/css/cart.css">
  <title>Cart | TTT</title>
</head>
<body>
  <?php include "./views/partials/header.php"; ?>

<main>

<div id="cart">
  <div id="title"> <h1>Shopping Cart</h1> </div>
  <div id="cart-courses-count"> <p> <?=count($courses)?> Courses in Cart</p> </div>
  <div id="cart-container">
    <?php if ( $courses ): ?>
    <div id="cart-courses">

    <?php foreach ($courses as $key => $course) { ?>
    <form action="" method="POST">
      <input type="text" name="course_id" value="<?=$course['course_id']?>" hidden>
      <a class="course" href="/all-courses/<?=$course['course_id']?>">
        <div class="course-content-info">
          <div class="course-img">
            <?php 
              $id = $course['course_id'];
              if ( file_exists("uploads/courses/$id") ) {
                $img = glob("uploads/courses/$id/thumbnail_$id.*")[0];
            ?>
              <img src="/<?=$img?>" alt="">
            <?php } ?>
          </div>
          <div class="course-content">
            <div class="course-title"> <h1> <?=$course["course_name"]?> </h1> </div>
            <div class="course-description">
              <p> <?=$course["course_description"]?> </p>
            </div>
          </div>
        </div>
        <div class="course-price-info">
          <div class="course-price"> <p> <?=$course["course_price"]?> $</p> </div>
          <div class="remove-button">
            <button name="remove_course_button" type="submit">Remove</button>
          </div>
        </div>
      </a>
    </form>
    <?php } ?>

    </div>

    <div id="cart-summary">
      <div id="cart-total">
        <h2>Total:</h2>
        <p> <?=$total_amount?> $</p>
      </div>
      <div id="checkout-button"> <a name="checkout_button" href="/checkout"> <p>Checkout</p> </a></div>
    </div>
    <?php else: ?>
      <div id="cart-courses"> <h1>You didn't add Courses to Cart</h1> </div>
    <?php endif; ?>
  </div>

</div>

</main>

  
<?php include "./views/partials/footer.php"; ?>
<?php include "./views/partials/scripts.php"; ?>


</body>
</html>