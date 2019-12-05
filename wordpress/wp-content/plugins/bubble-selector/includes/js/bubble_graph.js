document.addEventListener('DOMContentLoaded', init, false);
console.log(php_vars);

// TODO get interested topics from db (ajax)
// TODO write interested topics to db (ajax)

const g_orange = '#fb7107';
const g_blue = '#1e2931';

let g_selection = new Array();

function init() {
  // issue ajax call and create the graph on resolution.
  getData().then(onData, function(err) {
    console.log(err);
  });

  // Set event handler
  document
    .getElementById('postButton')
    .addEventListener('click', postSelection);
}

/**
 * Category ajax handler.
 * @param {*} categories Array of available categories.
 */
function onData(data) {
  console.log(data);

  let categories = data.categories;
  g_selection = data.preferred;

  categories.forEach(d => {
    if (g_selection.includes(d.term_id)) {
      d.selectd = true;
    } else {
      d.selected = false;
    }

    // TODO set radius according to category size or some other metric
    d.radius = 80;
    d.radius += (Math.random() - 0.5) * 30; // Get some mock size variation
  });

  // sort the nodes so that the bigger ones are at the back
  categories = categories.sort(function(a, b) {
    return b.size - a.size;
  });

  var width = window.innerWidth,
    height = window.innerHeight,
    nodePadding = 0;

  // Create SVG
  var svg = d3
    .select('#bubbleGraph')
    .append('svg')
    .attr('width', width)
    .attr('height', height);

  // Create force simulation
  var simulation = d3
    .forceSimulation()
    .force(
      'forceX',
      d3
        .forceX()
        .strength(0.1)
        .x(width * 0.5)
    )
    .force(
      'forceY',
      d3
        .forceY()
        .strength(0.1)
        .y(height * 0.5)
    )
    .force(
      'center',
      d3
        .forceCenter()
        .x(width * 0.5)
        .y(height * 0.5)
    )
    .force('charge', d3.forceManyBody().strength(-15));

  //update the simulation based on the data
  simulation
    .nodes(categories)
    .force(
      'collide',
      d3
        .forceCollide()
        .strength(0.5)
        .radius(function(d) {
          return d.radius + nodePadding;
        })
        .iterations(1)
    )
    .on('tick', function() {
      node.attr('transform', function(d) {
        return 'translate(' + d.x + ',' + d.y + ')';
      });
    });

  //
  // nodes
  var node = svg
    .append('g')
    .attr('class', 'nodes')
    .selectAll('nodes')
    .data(categories)
    .enter()
    .append('g')
    .on('click', onClick)
    .call(
      d3
        .drag()
        .on('start', dragstarted)
        .on('drag', dragged)
        .on('end', dragended)
    );

  //
  // Circles
  var circles = node
    .append('circle')
    .attr('r', function(d) {
      return d.radius;
    })
    .attr('fill', function(d) {
      if (d.selected) {
        return g_orange;
      } else {
        return g_blue;
      }
    })
    .attr('cx', function(d) {
      return d.x;
    })
    .attr('cy', function(d) {
      return d.y;
    });

  node.each(function(d) {
    var instance = d3.select(this);

    const array = d.name.split(' ');
    array.forEach(function(value, i) {
      // replace ampersand
      value = value.replace(/&amp;/g, '&');

      instance
        .append('text')
        .text(value.replace())
        .attr('transform', `translate(0, ${i * 24})`)
        .attr('dx', function(d) {
          return d.x;
        })
        .attr('dy', function(d) {
          return d.y;
        })
        .style('font-size', '18px')
        .attr('text-anchor', 'middle')
        .style('fill', 'green');
    });
  });

  //
  // Labels
  // var label = node
  //   .append('text')
  //   .attr('cx', function(d) {
  //     return d.x;
  //   })
  //   .attr('cy', function(d) {
  //     return d.y;
  //   })
  //   .text(function(d) {
  //     const array = d.name.split(' ');
  //     console.log(array);
  //     if (array.length > 1) {
  //       console.log('a');
  //     }

  //     return array[1];
  //   })
  //   .style('text-anchor', 'middle')
  //   .style('font-size', 20)
  //   .style('font-weight', 900)
  //   .style('fill', function(d) {
  //     if (d.selected) {
  //       return 'blue';
  //     } else {
  //       return 'orange';
  //     }
  //   });

  // Since line breaks do not work in svg we need this ugly workaround

  //
  // Drag functions
  function dragstarted(d) {
    if (!d3.event.active) simulation.alphaTarget(0.03).restart();
    d.fx = d.x;
    d.fy = d.y;
  }

  function dragged(d) {
    d.fx = d3.event.x;
    d.fy = d3.event.y;
  }

  function dragended(d) {
    if (!d3.event.active) simulation.alphaTarget(0.03);
    d.fx = null;
    d.fy = null;
  }

  //
  // Circle Click handler
  function onClick(d) {
    // change selected state

    console.log(d3.select(this).select('circle'));

    d.selected = !d.selected;

    const group = d3.select(this);

    // console.log(d);

    // Set color
    if (d.selected) {
      console.log(d.name + ' selected');

      // Add term_id to g_selection array
      g_selection.push(d.term_id);

      // Set circle color (color in hex)
      group.select('circle').attr('fill', g_orange);

      // Set text color (color in weird)
      group.selectAll('text').style('fill', 'black');
    } else {
      console.log(d.name + ' deselected');

      // Remove term_id from g_selection array
      const index = g_selection.indexOf(d.term_id);
      if (index > -1) {
        g_selection.splice(index, 1);
      }

      // set circle color (color in hex)
      group.select('circle').attr('fill', g_blue);

      // set text color (color in weird)
      group.selectAll('text').style('fill', 'darkOrange');
    }
  }
}

//
// Simulation update tick
function onTick() {
  node.attr('transform', function(d) {
    return 'translate(' + d.cx + ', ' + d.cy + ')';
  });
}

//
// Ajax functions
//

// Ajax function to write the selection to the DB
function postSelection() {
  console.log('issue ajax request...\n ');
  // get all selected items id's

  jQuery.ajax({
    type: 'POST',
    dataType: 'html',
    url: php_vars.ajax_url,
    data: {
      action: 'post_selection',
      selection: g_selection
    },
    success: function() {
      alert('success');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      // console.log("...failed: " + errorThrown + "!");
      console.log(
        JSON.stringify(jqXHR) + ' :: ' + textStatus + ' :: ' + errorThrown
      );
      alert('Ajax request failed...');
    }
  });
}

/**
 * The jQuery ajax request is asynchronous and thus a callback
 * function should be passed to execute once the response is
 * received.
 */
function getData() {
  console.log('ajax: getData');

  return new Promise((resolve, reject) => {
    jQuery.ajax({
      type: 'GET',
      dataType: 'html',
      url: php_vars.ajax_url,
      data: {
        action: 'get_data'
      },
      success: function(response) {
        // Pass the data as JSON to the callback
        resolve(JSON.parse(response));
      },
      error: function(error) {
        reject(error);
      }
    });
  });
}
