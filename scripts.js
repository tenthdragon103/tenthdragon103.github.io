function getUsrInfo() {
    //whoami
    //create thingy that goes down and says:
    //Your Information
    //email
    //user ID
    //ip
    //logout
    document.getElementById("userdropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.usrNameButton')) {
  var myDropdown = document.getElementById("userdropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
