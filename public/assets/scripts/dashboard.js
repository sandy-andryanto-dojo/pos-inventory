var pieOptions = {
    //Boolean - Whether we should show a stroke on each segment
    segmentShowStroke: true,
    //String - The colour of each segment stroke
    segmentStrokeColor: "#fff",
    //Number - The width of each segment stroke
    segmentStrokeWidth: 1,
    //Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    //Number - Amount of animation steps
    animationSteps: 100,
    //String - Animation easing effect
    animationEasing: "easeOutBounce",
    //Boolean - Whether we animate the rotation of the Doughnut
    animateRotate: true,
    //Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li style=\"color:<%=segments[i].fillColor%>\"><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
};

var createPiechart = function(elem, data){
    let pieChartCanvas = $(elem).get(0).getContext("2d");
    let pieChart = new Chart(pieChartCanvas);
    let myPieChart = pieChart.Doughnut(data, pieOptions);
    let chartLegend = myPieChart.generateLegend();
    $(elem+"-legend").html(chartLegend);
}

var pieChartPurchaseProduct = function(data){
    let elem = "#purchase-product";
    let PieData = data.piechart.purchase_product;
    createPiechart(elem, PieData);
}

var pieChartSaleProduct = function(data){
    let elem = "#sale-product";
    let PieData = data.piechart.sale_product;
    createPiechart(elem, PieData);
}

var pieChartUserActivity = function(data){
    let elem = "#user-activity";
    let PieData = data.piechart.user_activity;
    createPiechart(elem, PieData);
}

var lineChart = function(dt){
    var areaChartOptions = {
        responsive: true,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    };

    var areaChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "Sept", "Oct", "Nov", "Dec"],
    datasets: [
        {
            label: "Purchase",
            fillColor: "rgba(210, 214, 222, 1)",
            strokeColor: "rgba(210, 214, 222, 1)",
            pointColor: "rgba(210, 214, 222, 1)",
            pointStrokeColor: "#c1c7d1",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: dt.linechart.purchase
        },
        {
            label: "Sale",
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: dt.linechart.sale
        }
    ]
    };

      let elem = "#line-chart";
      var lineChartCanvas = $(elem).get(0).getContext("2d");
      var lineChart = new Chart(lineChartCanvas);
      var lineChartOptions = areaChartOptions;
      lineChartOptions.datasetFill = false;
      lineChart.Line(areaChartData, lineChartOptions);
}

$(document).ready(function(){
    headerRequest();
    $.post(BASE_URL + "/api/dashboard/summary", {}, function(result) {
        if(result){
           $(".txt-purchase").html(result.count_purchase || 0);
           $(".txt-sale").html(result.count_sale || 0);
           $(".txt-product").html(result.count_product);
           $(".txt-supplier").html(result.count_supplier);
           $(".txt-customer").html(result.count_customer);
           $(".txt-brand").html(result.count_brand);
           pieChartPurchaseProduct(result);
           pieChartSaleProduct(result);
           pieChartUserActivity(result);
           lineChart(result);
        }
    });
});