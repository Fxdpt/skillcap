var $type = $("#typeField");
var $categories = $("#categoryGroup");
$categories.hide();
// When type gets selected ...
$type.change(function() {
  $categories.show();
  // ... retrieve the corresponding form.
  var $form = $(this).closest("form");
  // Simulate form data, but only include the selected type value.
  var data = {};
  data[$type.attr("name")] = $type.val();
  // Submit data via AJAX to the form's action path.
  $.ajax({
    url: $form.attr("action"),
    type: $form.attr("method"),
    data: data,
    success: function(html) {
      // Replace current position field ...
      $("#categoryField").replaceWith(
        // ... with the returned one from the AJAX response.
        $(html).find("#categoryField")
      );
      // Position field now displays the appropriate positions.
    }
  });
});
