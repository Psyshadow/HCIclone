document.addEventListener('DOMContentLoaded', init, false);
alert("test");

function demoFunction() {
  alert("demo");
}

function init() {
  document.getElementById("demoButton").addEventListener("click", demoFunction);

  d3.select("body").style("background-color", "black");

}
