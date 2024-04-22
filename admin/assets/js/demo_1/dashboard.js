// Ajax - get data variable

function GetDateValues(){

	 $.ajax({

		url: "./pages/dashboard/functions/get_chart_values.php",

		success: function(data){

      var data2 = $.parseJSON(data);

      MessageChartFunction(data2.message);

      ViewChartFunction(data2.view_list);

    },

		error: function(){

			alert("Error!");

		}

	});

}



// JSON FIND MAX VALUE FUNCTION

function getMax_jsonArray(jsonArray, prop) {

    var max;

    for (var i=0 ; i < jsonArray[prop].length ; i++) {

        if (max == null || parseInt(jsonArray[prop][i]) > parseInt(max)){

            max = jsonArray[prop][i];

        }

    }

    return max;

}



/* 1nd Chart Function */



// Chart Values Function Message

function MessageChartFunction(dataValues) {

  // GET Array

  // GET MAX

  // week

  var weekMax = getMax_jsonArray(dataValues.week, 0);

  if(weekMax < 5){

    weekMax = 5

  }

  var week_stepSize = Math.round(weekMax / 5);

  // month

  var monthMax = getMax_jsonArray(dataValues.month, 0);

  if(monthMax < 5){

    monthMax = 5

  }

  var month_stepSize = Math.round(monthMax / 5);

  // year

  var yearMax = getMax_jsonArray(dataValues.year, 0);

  if(yearMax < 5){

    yearMax = 5

  }

  var year_stepSize = Math.round(yearMax / 5);

  // end GET MAX

  // end GET Array

  if ($('#messages-statistics-overview').length) {

    var salesChartCanvas = $("#messages-statistics-overview").get(0).getContext("2d");

    var data_2_2 = dataValues.week[0];

    var data_3_2 = dataValues.month[0];

    var data_4_2 = dataValues.year[0];

    var areaData = {

      labels: dataValues.week[1],

      datasets: [{

        label: 'Messages',

        data: data_2_2,

        borderColor: "#089446",

        backgroundColor: "#8fcbff59",

        borderWidth: 3

      }]

    };

    var areaOptions = {

      responsive: true,

      animation: {

        animateScale: true,

        animateRotate: true

      },

      elements: {

        point: {

          radius: 5,

          backgroundColor: "black"

        },

        line: {

          tension: 0.5

        }

      },

      layout: {

        padding: {

          left: 0,

          right: 10,

          top: 0,

          bottom: 0

        }

      },

      legend: false,

      legendCallback: function (chart) {

        var text = [];

        text.push('<div class="chartjs-legend"><ul>');

        for (var i = 0; i < chart.data.datasets.length; i++) {

          text.push('<li>');

          text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');

          text.push(chart.data.datasets[i].label);

          text.push('</li>');

        }

        text.push('</ul></div>');

        return text.join("");

      },

      scales: {

        xAxes: [{

          display: false,

          ticks: {

            display: false,

            beginAtZero: false

          },

          gridLines: {

            drawBorder: false

          }

        }],

        yAxes: [{

          ticks: {

            max: parseFloat(weekMax),

            min: 0,

            stepSize: parseFloat(week_stepSize),

            fontColor: "blue",

            beginAtZero: false

          },

          gridLines: {

            color: '#e2e6ec',

            display: true,

            drawBorder: false

          }

        }]

      }

    }

    var salesChart = new Chart(salesChartCanvas, {

      type: 'line',

      data: areaData,

      options: areaOptions

    });

    document.getElementById('messages-statistics-legend').innerHTML = salesChart.generateLegend();

    $("#messages-statistics_switch_1").click(function () {

      // Week

      var data = salesChart.data;

      data.datasets[0].data = data_2_2;

      data.labels = dataValues.week[1];

      var options = salesChart.options;

      options.scales.yAxes[0].ticks.max = parseFloat(weekMax);

      options.scales.yAxes[0].ticks.stepSize = parseFloat(week_stepSize);

      salesChart.update();

    });

    $("#messages-statistics_switch_2").click(function () {

      // Month

      var data = salesChart.data;

      data.datasets[0].data = data_3_2;

      data.labels = dataValues.month[1];

      var options = salesChart.options;

      options.scales.yAxes[0].ticks.max = parseFloat(monthMax);

      options.scales.yAxes[0].ticks.stepSize = parseFloat(month_stepSize);

      salesChart.update();

    });

    $("#messages-statistics_switch_3").click(function () {

      // Year

      var data = salesChart.data;

      data.datasets[0].data = data_4_2;

      data.labels = dataValues.year[1];

      var options = salesChart.options;

      options.scales.yAxes[0].ticks.max = parseFloat(yearMax);

      options.scales.yAxes[0].ticks.stepSize = parseFloat(year_stepSize);

      salesChart.update();

    });

  }

}

// end Chart Values Function Message



/* 2nd Chart Function */



// Chart Values Function View

function ViewChartFunction (dataValues){

  // GET Array

  // GET MAX

  // week

  var weekMax = getMax_jsonArray(dataValues.week, 0);

  if(weekMax < 5){

    weekMax = 5

  }

  var week_stepSize = Math.round(weekMax / 5);

  // month

  var monthMax = getMax_jsonArray(dataValues.month, 0);

  if(monthMax < 5){

    monthMax = 5

  }

  var month_stepSize = Math.round(monthMax / 5);

  // year

  var yearMax = getMax_jsonArray(dataValues.year, 0);

  if(yearMax < 5){

    yearMax = 5

  }

  var year_stepSize = Math.round(yearMax / 5);

  // end GET MAX

  // end GET Array

  if ($("#barChart").length) {

    var barChartCanvas = $("#barChart").get(0).getContext("2d");

    var data_2_2 = dataValues.week[0];

    var data_3_2 = dataValues.month[0];

    var data_4_2 = dataValues.year[0];

    var barChart = {

        labels: dataValues.week[1],

        datasets: [{

          label: 'Views',

          data: data_2_2,

          backgroundColor: ChartColor[0],

          borderColor: ChartColor[0],

          borderWidth: 0

        }]

      };

    var areaOptions = {

        responsive: true,

        maintainAspectRatio: true,

        layout: {

          padding: {

            left: 0,

            right: 10,

            top: 0,

            bottom: 0

          }

        },

        scales: {

          xAxes: [{

            display: false,

            ticks: {

              fontColor: '#bfccda',

              min: 0,

              max: parseFloat(weekMax),

              stepSize: parseFloat(week_stepSize),

              autoSkip: true,

              autoSkipPadding: 15,

              maxRotation: 0,

              maxTicksLimit: 10

            },

            gridLines: {

              color: 'transparent',

              display: true,

              drawBorder: false,

              zeroLineColor: '#eeeeee'

            }

          }],

          yAxes: [{

            display: true,

            ticks: {

              fontColor: 'blue',

              min: 0,

              max: parseFloat(weekMax),

              stepSize: parseFloat(week_stepSize),

              display: true,

              autoSkip: false,

              maxRotation: 0

            },

            gridLines: {

              color: '#e2e6ec',

              display: true,

              drawBorder: false

            }

          }]

        },

        legend: {

          display: false

        },

        legendCallback: function (chart) {

          var text = [];

          text.push('<div class="chartjs-legend"><ul>');

          for (var i = 0; i < chart.data.datasets.length; i++) {

            text.push('<li>');

            text.push('<span style="border-radius:0px;background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');

            text.push(chart.data.datasets[i].label);

            text.push('</li>');

          }

          text.push('</ul></div>');

          return text.join("");

        },

        elements: {

          point: {

            radius: 0

          }

        }

    };

    var salesChart = new Chart(barChartCanvas, {

      type: 'bar',

      data: barChart,

      options: areaOptions

    });

    document.getElementById('views-statistics-legend').innerHTML = salesChart.generateLegend();

    $("#views-statistics_switch_1").click(function () {

      // Week

      var data = salesChart.data;

      data.datasets[0].data = data_2_2;

      data.labels = dataValues.week[1];

      var options = salesChart.options;

      options.scales.yAxes[0].ticks.max = parseFloat(weekMax);

      options.scales.yAxes[0].ticks.stepSize = parseFloat(week_stepSize);

      salesChart.update();

    });

    $("#views-statistics_switch_2").click(function () {

      // Month

      var data = salesChart.data;

      data.datasets[0].data = data_3_2;

      data.labels = dataValues.month[1];

      var options = salesChart.options;

      options.scales.yAxes[0].ticks.max = parseFloat(monthMax);

      options.scales.yAxes[0].ticks.stepSize = parseFloat(month_stepSize);

      salesChart.update();

    });

    $("#views-statistics_switch_3").click(function () {

      // Year

      var data = salesChart.data;

      data.datasets[0].data = data_4_2;

      data.labels = dataValues.year[1];

      var options = salesChart.options;

      options.scales.yAxes[0].ticks.max = parseFloat(yearMax);

      options.scales.yAxes[0].ticks.stepSize = parseFloat(year_stepSize);

      salesChart.update();

    });

  }

}

// end Chart Values Function View



/* Get Function */

GetDateValues();

/* end Get Function */

