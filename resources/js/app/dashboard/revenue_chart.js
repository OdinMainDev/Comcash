import ApexCharts from "apexcharts";
import {colors} from "./dashboard_config";
import $ from "jquery";
import axios from "axios";

(() => {
    if (!$('#admRevenueChart').length) return;
    fillChart();
})()

function fillChart() {
    axios.get("/ru/panel/api/get/dashboard/revenue").then(e => {
        var series = [];
        const names = Object.keys(e.data.statistics);
        names.forEach(name => {
            let seriesData = [];

            e.data.dates.forEach(date => {
                const value = e.data.statistics[name][date] || 0;
                seriesData.push(value);
            });

            series.push({
                name: name,
                data: seriesData
            });
        });
        
        var options = {
            series: series,
            chart: {
                height: 350,
                type: 'area'
            },
            // если включено то даже приколдеснее работает
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'category',
                categories: e.data.dates,
            },
        };
        new ApexCharts(document.querySelector("#admRevenueChart"), options).render();
    }).catch(error => {
        console.log(error);
    });

}