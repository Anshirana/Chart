window.onload = function () {
//simple chart below
var data = [
    { x: 10, y: 71 },
    { x: 20, y: 55},
    { x: 30, y: 50 },
    { x: 40, y: 65 },
    { x: 50, y: 95 },
    { x: 60, y: 68 },
    { x: 70, y: 28 },
    { x: 80, y: 34 },
    { x: 90, y: 14}

    ];

    var chart = new CanvasJS.Chart("chartContainersimple",
    {
      title:{
      },
      data: [
      {
        type: "bar", //change type to bar, line, area, pie, etc
        dataPoints: data
      }
      ]
    });

    chart.render();

  var chart2 = new CanvasJS.Chart("chartContainersimple2",
    {
      title:{
      },
      data: [
      {
        type: "pie", //change type to bar, line, area, pie, etc
        dataPoints: data
      }
      ]
    });

    chart2.render();
  

  var chart3 = new CanvasJS.Chart("chartContainersimple3",
  {
    title:{
    },
    data: [
    {
      type: "area", //change type to bar, line, area, pie, etc
      dataPoints: data
    }
    ]
  });

  chart3.render();

}