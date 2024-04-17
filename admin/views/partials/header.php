
<?php
  if ( isset($_SESSION["user_id"]) ) {
    require_once "db.php";
    $user_id = $_SESSION["user_id"];
    $query = 
    " SELECT COUNT(cart_id) AS courses_no
      FROM carts WHERE user_id = $user_id
    ";
    $no_courses_in_cart = select($query)[0]["courses_no"];
  }

?>

<header>
  <div id="navbar">
    <div id="img-container">
      <a href="/"> <p class="platform-logo" title="Trible T academy">Triple T</p> </a>
    </div>
    <div id="nav-links">
      <!-- <a class="nav-link" href="/all-instructors">All Instructors</a> -->
      <!-- <a class="nav-link" href="/all-courses">All Courses</a> -->
      <?php if ( isset($_SESSION["username"]) ) { ?>
        <!-- <a class="nav-link" href="/learnings">My Learning</a> -->
        <!-- <a class="nav-link" href="/cart">My Cart -->
          <?php if ( $no_courses_in_cart > 0 ) { ?>
            <!-- <div id="header-cart-courses-count"> <?=$no_courses_in_cart?> </div> -->
          <?php } ?>
        <!-- </a> -->
        <!-- <a class="nav-link" href="/payments">My Payments</a> -->
      <?php } ?>
    </div>
    <div class="buttons">
      <?php if ( ! isset($_SESSION["username"]) and ! isset($_SESSION["user_password"]) ): ?>
        <a id="log-in" href="/login">Log in</a>
        <!-- <a id="sign-up" href="/signup">Sign up</a> -->
      <?php else: ?>
        <div id="user-dropdown">
          <button id="user-dropdown-button" type="button">
            <div  id="user-img-container">
              <?php
                $id = $user_id;
                if ( file_exists("uploads/users/$id") )
                  if ( glob("uploads/users/$id/image_$id.*")[0] )
                    $img = glob("uploads/users/$id/image_$id.*")[0];
                  else
                    $img = "src/partials/user-img/user-img-0.jpg";
                else
                  $img = "src/partials/user-img/user-img-0.jpg";
              ?>
              <img id="user-img" src="/<?=$img?>" alt="">
              <p> <?=$_SESSION["username"]?> </p>
              <svg id="user-dropdown-svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
              </svg>
            </div>
          </button>
          <div id="user-dropdown-info">
            <a href="/profile/profile-info">
              <div id="user-info">
                <?php
                  $id = $user_id;
                  if ( file_exists("uploads/users/$id") )
                    if ( glob("uploads/users/$id/image_$id.*")[0] )
                      $img = glob("uploads/users/$id/image_$id.*")[0];
                    else
                      $img = "src/partials/user-img/user-img-0.jpg";
                  else
                    $img = "src/partials/user-img/user-img-0.jpg";
                ?>
                <img src="/<?=$img?>" alt="">
                <div id="user-name-email">
                  <h4> <?=$_SESSION["username"]?> </h4>
                  <p> <?=$_SESSION["user_email"]?> </p>
                </div>
              </div>
            </a>
            <div class="dropdown-info">
              <div><a href="/learnings"> <p>My Learning</p> </a></div>
              <div>
                <a href="/cart"> <p>My Cart</p>
                <?php if ( $no_courses_in_cart > 0 ) { ?>
                  <div id="user-cart-courses-count"> <?=$no_courses_in_cart?> </div>
                <?php } ?>
                </a>
              </div>
              <div> <a href="/payments"> <p>My Payments</p> </a> </div>
              <div><a href="/all-courses"> <p>All Courses</p> </a></div>
            </div>
            <div class="dropdown-info">
              <div><a href="/profile/account-security"> <p>Account Settings</p> </a></div>
              <div><a href="/profile/profile-info"> <p>Edit Profile</p> </a></div>
            </div>
            <div class="dropdown-info">
              <div><a href="/logout"> <p>Log out</p> </a></div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>


<script>



</script>