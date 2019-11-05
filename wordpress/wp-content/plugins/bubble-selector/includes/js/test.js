document.addEventListener('DOMContentLoaded', init, false);
alert("test");

function demoFunction() {
  console.log(php_vars);
  alert("demo");
}

function init() {
  document.getElementById("demoButton").addEventListener("click", demoFunction);

  var nodes = [{ "id": 'f1' }, { "id": 'f2' }, { "id": 'f99' }];
  var links = [{ source: 'f1', target: 'f2' }];


  var width = 340,
    height = 340;

  var svg = d3.select("#bubbleGraph")
    .append("svg")
    .attr("width", width)
    .attr("height", height);

//define and stop the simulation
var simulation = d3.forceSimulation()
              .force("center", d3.forceCenter(width/2, height/2))                  
              .force("charge", d3.forceManyBody())
              .force("link", d3.forceLink().id( d => d.id))
simulation.stop()

  //define links group
  var my_group = svg.selectAll(".link_group")
    .data(links)
  //exit, remove
  my_group.exit().remove()
  //enter
  var enter = my_group.enter()
    .append("g").attr("class", "link_group")
  //append
  enter.append("line").attr("class", "link_line")
  //merge
  my_group = my_group.merge(enter)
  my_group.select("link_line")
    .attr("stroke", "orange")

  //define nodes group
  var my_group = svg.selectAll(".node_group")
    .data(nodes)
  //exit, remove
  my_group.exit().remove()
  //enter
  var enter = my_group.enter()
    .append("g").attr("class", "node_group")
  //append 
  enter.append("circle").attr("class", "node_circle")
  //merge
  my_group = my_group.merge(enter)
  my_group.select("node_circle")
    .attr("fill", "orange")
    .attr("r", 10)

  simulation.nodes(nodes)
  simulation.force("link").links(links)


  simulation.on("tick", function (d) {
    //position links
    d3.selectAll(".link_line")
      .attr("x1", d => d.source.x)
      .attr("x2", d => d.target.x)
      .attr("y1", d => d.source.y)
      .attr("y2", d => d.target.y)

    //position nodes
    d3.selectAll(".node_circle")
      .attr("x", d => d.x)
      .attr("y", d => d.y)
  })
  simulation.alpha(1).restart()
}
