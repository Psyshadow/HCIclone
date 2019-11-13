document.addEventListener('DOMContentLoaded', init, false);
init();
// console.log(php_vars.pluginsUrl);

function init() {
  var width = window.innerWidth, 
      height = window.innerHeight,
      sizeDivisor = 100, // Divides the gdp by 100 to get the size
      nodePadding = 2.5;

  var svg = d3.select("#bubbleGraph")
    .append("svg")
    .attr("width", width)
    .attr("height", height);

  var simulation = d3.forceSimulation()
    .force("forceX", d3.forceX().strength(.1).x(width * .5))
    .force("forceY", d3.forceY().strength(.1).y(height * .5))
    .force("center", d3.forceCenter().x(width * .5).y(height * .5))
    .force("charge", d3.forceManyBody().strength(-15));

  d3.csv("/wordpress/wp-content/plugins/bubble-selector/includes/js/data.csv", types, function (error, graph) {
    if (error) throw error;

    // sort the nodes so that the bigger ones are at the back
    graph = graph.sort(function (a, b) { return b.size - a.size; });

    //update the simulation based on the data
    simulation
      .nodes(graph)
      .force("collide", d3.forceCollide().strength(.5).radius(function (d) { return d.radius + nodePadding; }).iterations(1))
      .on("tick", function (d) {
        node
          .attr("cx", function (d) { return d.x; })
          .attr("cy", function (d) { return d.y; })
      });

    var node = svg.append("g")
      .attr("class", "node")
      .selectAll("circle")
      .data(graph)
      .enter().append("circle")
      .attr("r", function (d) { return d.radius; })
      .attr("fill", function (d) { return "#1e2931"; })
      .attr("cx", function (d) { return d.x; })
      .attr("cy", function (d) { return d.y; })
      .call(d3.drag()
        .on("start", dragstarted)
        .on("drag", dragged)
        .on("end", dragended))
        .on("click", onClick);

  });

  function dragstarted(d) {
    if (!d3.event.active) simulation.alphaTarget(.03).restart();
    d.fx = d.x;
    d.fy = d.y;
  }

  function dragged(d) {
    d.fx = d3.event.x;
    d.fy = d3.event.y;
  }

  function dragended(d) {
    if (!d3.event.active) simulation.alphaTarget(.03);
    d.fx = null;
    d.fy = null;
  }

  function types(d) {
    d.gdp = +d.gdp;
    d.size = +d.gdp / sizeDivisor;
    d.size < 3 ? d.radius = 3 : d.radius = d.size;
    return d;
  }

  function onClick(d) {
    console.log(d);

    if(d.selected === null) {
      d.selected = true;
    }
    d.selected != d.selected;
    d3.select(this).select("circle")
      .attr("fill", function(d) {
        console.log(d);
      });
  }


}
