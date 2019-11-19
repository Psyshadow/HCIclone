document.addEventListener('DOMContentLoaded', init, false);
console.log(php_vars);

// TODO add available topics from db (ajax)
// TODO get interested topics from db (ajax)
// TODO write interested topics to db (ajax)

const g_orange = "#fb7107";
const g_blue = "#1e2931";

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

  // TODO replace with data from wpdb (pass from plugin)
  d3.csv("/wordpress/wp-content/plugins/bubble-selector/includes/js/data.csv", types, function (error, graph) {
    if (error) throw error;

    // sort the nodes so that the bigger ones are at the back
    graph = graph.sort(function (a, b) { return b.size - a.size; });
    // add selected field to each node
    graph.forEach(d => {
      d.selected = false;
    });

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
      .attr("fill", function () { return g_blue; })
      .attr("cx", function (d) { return d.x; })
      .attr("cy", function (d) { return d.y; })
      .call(d3.drag()
        .on("start", dragstarted)
        .on("drag", dragged)
        .on("end", dragended))
      .on("click", onClick)


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
    // change selected state
    d.selected = !d.selected;

    // Set color
    if (d.selected) {
      d3.select(this)
        .attr("fill", function (d) {
          return g_orange;
        });
    } else {
      d3.select(this)
        .attr("fill", function(d) {
          return g_blue;
        })
    }
  }

  // Ajax function to write the selection to the DB
  function ajaxSubmit(){
    console.log("issue ajax request...\n ");

    jQuery.ajax({
      type:'POST',
      dataType: 'html',
      url: php_vars.ajax_url, // url is passed from plugin
      data: {
        action: 'selection_callback', // set callback name
        test: 1
      },
      success: function() {
        console.log("...success!");
        alert("Ajax request successful!");
      },
      error: function(jqXHR, textStatus, errorThrown) {
        // console.log("...failed: " + errorThrown + "!");
        console.log(JSON.stringify(jqXHR) + ' :: ' + textStatus + ' :: ' + errorThrown);
        alert("Ajax request failed...");
      }
    });
  }

  document.getElementById("demoButton").addEventListener("click", ajaxSubmit);

  // Add ajax request to demobutton
  // document.getElementById("demoButton").addEventListener("click",
  //   ajaxSubmit);

}
