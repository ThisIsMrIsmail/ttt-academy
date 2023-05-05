
let course_name = document.getElementById("course-name");
course_name.focus();


function add_level() {
  // selecting array of levels
  let levels = document.querySelectorAll(".level")
  // creating new level container
  let new_level = document.createElement("div")
  // adding class level -> styled in css
  new_level.classList.add(`level`)
  // HTML code of the new level container
  new_level.innerHTML = `
    <!-- level id for submmition -->
    <div class="level-title"> <h3>Level</h3> </div>
    <div class="level-container">
      <div class="level-input" id="level-name">
        <label for="level-name">Level Name</label>
        <input type="text" name="levels[${levels.length}][level_name]" placeholder="ex: Programming Fundamentals" required>
      </div>
      <div class="level-input" id="level-duration">
        <label for="level-duration">Level Duration (hours)</label>
        <input type="number" name="levels[${levels.length}][level_duration]" placeholder="ex: 10 Hours" required>
      </div>
      <div class="remove-level">
          <button name="remove_level_button" type="button" onclick='remove_level("l${levels.length}")'>Remove Level</button>
      </div>
    </div>
    <div id="level-description">
      <label for="level-description">Description</label>
      <textarea name="levels[${levels.length}][level_description]" placeholder="Level Description" required></textarea>
    </div>
  `
  /*
    1- Checking levels array length.
      - True (some levels exist) -> Insert new level after last level.
      - False (no level exists) -> Insert new level after div 
      with id="levels-container".
    2- Adding ID to the new level container so we can select it, when
      we want to remove it from the page.
    3- Focusing on level name input.
  */

  if (levels.length) {
    new_level.id = `l${levels.length}`
    last_level = levels.length - 1
    levels[last_level].insertAdjacentElement("afterend", new_level);
  } else {
    new_level.id = `l0`
    let levels_container = document.getElementById("levels-container")
    levels_container.insertAdjacentElement("afterend", new_level);
  }

  let level_name = new_level.querySelector(".level-input input")
  level_name.focus()
}


function remove_level(level_index) {
  // Getting level div to remove by predefined level index.
  level = document.getElementById(level_index)
  level.remove()
}


// Displaying message when submitting the form
let form = document.getElementById("course-form")
form.addEventListener("submit", () => {
  createAlertMessage("Course Data Saved successfully.", "success")
})
