import ApexCharts from "apexcharts";
import {colors} from "./dashboard_config";
import $ from "jquery";
import axios from "axios";

(() => {
    if (!$('#admPopularDirectionsChart').length) return;
    fillChart();
})()

function fillChart() {
    axios.get("/ru/panel/api/get/dashboard/popular-directions").then(e => {
        var options = {
            chart: {
                type: 'bar',
                height: '318',
                parentHeightOffset: 0,
                toolbar: {
                    show: false
                },
            },
            colors: [colors.primary],
            fill: {
                opacity: .9
            },
            grid: {
                padding: {
                    bottom: -4
                },
                borderColor: colors.gridBorder,
                xaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            series: [{
                name: 'TotalExchanges',
                data: e.data.counts
            }],
            xaxis: {
                type: 'category',
                categories: e.data.currencies,
                axisBorder: {
                    color: colors.gridBorder,
                },
                axisTicks: {
                    color: colors.gridBorder,
                },
            },
            stroke: {
                width: 0
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '10px',
                },
                offsetY: -27
            },
            plotOptions: {
                bar: {
                    columnWidth: "50%",
                    borderRadius: 4,
                    dataLabels: {
                        position: 'top',
                        orientation: 'vertical',
                    }
                },
            },
        }
        new ApexCharts(document.querySelector("#admPopularDirectionsChart"), options).render();
    }).catch(error => {
        console.log(error);
    });

}