$(function() {
    $('#exampledatatable').DataTable(); 
    $('#exampledatatable1').DataTable(); 
});

// checkbox js
document.getElementById('select-all').onclick = function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
  }