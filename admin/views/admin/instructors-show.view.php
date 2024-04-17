<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instructors | TTT</title>
  <?php include "./views/partials/links.php" ?>
  <link rel="stylesheet" href="/src/admin/css/instructors-show.css">
</head>

<body>

<!-- Header Start -->
<?php include "./views/partials/admin-header.php" ?>
<!-- Header End -->

<!-- Main Start -->
<main>
<form action="" method="POST">
<!-- make DELETE Request -->

<div id="instructors">
  <div id="instructors-top">
    <h1 id="instructors-title">Instructors</h1>
    <a id="add-instructor-button" href="/admin/instructors/add"> <p>Add Instructor</p> </a>
  </div>

  <table>
    <thead>
      <tr id="table-titles">
        <th> <h4>#</h4> </th>
        <th> <h4>Instructor Name</h4> </th>
        <th> <h4>Instructor Title</h4> </th>
        <th> <h4>Instructor Email</h4> </th>
        <th> <h4>Years of exp.</h4> </th>
        <th> <h4></h4> </th>
        <th> <h4></h4> </th>
      </tr>
    </thead>
    <tbody>
      <?php if (count($instructors) > 0): ?>
        <?php foreach ($instructors as $key => $instructor): ?>
          <form action="" method="POST">
          <!-- make DELETE Request -->
            <tr class="table-row">
              <input type="number" name="instructor_id" value="<?=$key+1?>" hidden>
              <td> <p> <?=$instructor["instructor_id"]?>        </p> </td>
              <td> <p> <?=$instructor["instructor_full_name"]?> </p> </td>
              <td> <p> <?=$instructor["instructor_title"]?>     </p> </td>
              <td> <p> <?=$instructor["instructor_email"]?>     </p> </td>
              <td> <p> <?=$instructor["instructor_years_of_experience"]?> years </p> </td>
              <!-- <td style="align-items: center;"><button id="remove-button" name="remove" type="submit">Remove</button> </td> -->
              <td><a id="edit-button" href="/admin/instructors/<?=$instructor["instructor_id"]?>"><p>Edit</p></a> </td></tr>
          </form>
        <?php endforeach; ?> 
      <?php else: ?>
        <tr> <td colspan="6"> <h2>There are no Instructors</h2> </td> </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</form>
</main>

<!-- Javascript Start -->
<?php include "./views/partials/scripts.php" ?>
<!-- Javascript End -->

</body>
</html>