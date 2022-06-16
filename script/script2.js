var modal1 = document.getElementById('myModal1');

var btn = document.getElementById("myBtn3");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
  modal1.style.display = "flex";
}

span.onclick = function () {
  modal1.style.display = "none";
}

window.onclick = function (event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
}
