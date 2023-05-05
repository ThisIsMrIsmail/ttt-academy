<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Courses | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/admin/css/courses-show.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/admin-header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>
  
<div id="courses">
  <div id="courses-top">
    <h1 id="courses-title">Courses</h1>
    <a id="add-course-button" href="/admin/courses/add"> <p>Add Course</p> </a>
  </div>

  <table>
    <thead>
      <tr id="table-titles">
        <th> <h4>#</h4> </th>
        <th> <h4>Course Title</h4> </th>
        <th> <h4>Course Description</h4> </th>
        <th> <h4>Course Price</h4> </th>
        <th> <h4></h4> </th>
        <th> <h4></h4> </th>
      </tr>
    </thead>
    <tbody>
    <?php if (count($courses) > 0): ?>
        <?php foreach ($courses as $key => $course): ?>
          <form action="" method="POST">
          <!-- make DELETE Request -->
            <tr class="table-row">
              <input type="number" name="remove_course_id" value="<?=$course["course_id"]?>" hidden>
              <td> <p> <?=$course["course_id"]?> </p> </td>
              <td> <p> <?=$course["course_name"]?> </p> </td>
              <td> <p> <?=$course["course_description"]?> </p> </td>
              <td> <p style="min-width: 100px;"> <?=$course["course_price"]?> $</p> </td>
              <td style="align-items: center;"> <button id="remove-button" name="remove" type="submit">Remove</button> </td>
              <td> <a id="edit-button" href="/admin/courses/<?=$course["course_id"]?>"><p>Edit</p></a> </td>
            </tr>
          </form>
        <?php endforeach; ?> 
      <?php else: ?>
        <tr> <td colspan="6"> <h2>There are no Courses.</h2> </td> </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

</body>
</html>