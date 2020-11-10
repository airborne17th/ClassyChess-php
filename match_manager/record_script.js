let checkBox = document.getElementById("draw");
function toggle() {
if (checkBox.checked == true){
    document.getElementById("winner_id").disabled = true;
  } else {
    document.getElementById("winner_id").disabled = false;
  }
}
