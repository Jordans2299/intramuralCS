

function linkDropDown() {
    document.getElementById("linkDropContent").classList.toggle("show");
  }
function accountDropDown(){
    document.getElementById("accountDropContent").classList.toggle("show");
}
function logoutDropDown(){
    document.getElementById("logoutDropContent").classList.toggle("show");
}
function sortDropDown(){
    // console.log("kfienigniewnien");
    document.getElementById('sortDropContent').classList.toggle('show');
}

window.onclick = function(event) {
    if (!event.target.matches('.linkBtn')) {
      var dropdowns = document.getElementsByClassName("linkDropContent");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
    if (!event.target.matches('.accountBtn')) {
        var dropdowns = document.getElementsByClassName("accountDropContent");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
      if (!event.target.matches('.logoutBtn')) {
        var dropdowns = document.getElementsByClassName("logoutDropContent");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
      if (!event.target.matches('.sortLinkBtn')) {
        var dropdowns = document.getElementsByClassName("sortDropContent");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
      
  }
