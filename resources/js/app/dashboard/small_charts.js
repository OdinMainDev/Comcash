import ApexCharts from "apexcharts";
import {colors} from "./dashboard_config";
import $ from "jquery";
import axios from "axios";

(() => {
    if (!$('#admRegisterChart').length) return;
    fillChart1();
    fillChart2();
    fillChart3();
    

    
})()

function fillChart1() {
    axios.get("/ru/panel/api/get/dashboard/registers").then(e => {
        var options = {
            chart: {
                type: "bar",
                height: 60,
                sparkline: {
                    enabled: !0
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 2,
                    columnWidth: "60%"
                }
            },
            colors: [colors.primary],
            series: [{
                name: '',
                data: e.data.usersRegistered
            }],
            xaxis: {
                type: 'category',
                categories: e.data.dates,
            },
        };
        new ApexCharts(document.querySelector("#admRegisterChart"), options).render();
        $("#admRegisterTotal").html(e.data.totalUserCount);
        $("#admRegisterTotal14days").html(e.data.totalUserCount14days);
    }).catch(error => {
        console.log(error);
    });

}

function fillChart2() {
    axios.get("/ru/panel/api/get/dashboard/exchanges").then(e => {
        var options = {
            chart: {
                type: "bar",
                height: 60,
                sparkline: {
                    enabled: !0
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 2,
                    columnWidth: "60%"
                }
            },
            colors: [colors.primary],
            series: [{
                name: '',
                data: e.data.exchanges
            }],
            xaxis: {
                type: 'category',
                categories: e.data.dates,
            },
        };
        new ApexCharts(document.querySelector("#admExchangesChart"), options).render();
        $("#admExchangesTotal").html(e.data.totalExchangesCount);
        $("#admExchangesTotal14days").html(e.data.totalExchangesCount14days);
    }).catch(error => {
        console.log(error);
    });

}

function fillChart3() {
    axios.get("/ru/panel/api/get/dashboard/exchanges-complete").then(e => {
        var options = {
            chart: {
                type: "bar",
                height: 60,
                sparkline: {
                    enabled: !0
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 2,
                    columnWidth: "60%"
                }
            },
            colors: [colors.primary],
            series: [{
                name: '',
                data: e.data.exchanges
            }],
            xaxis: {
                type: 'category',
                categories: e.data.dates,
            },
        };
        new ApexCharts(document.querySelector("#admCompleteExchangesChart"), options).render();
        $("#admCompleteExchangesTotal").html(e.data.totalExchangesCount);
        $("#admCompleteExchangesTotal14days").html(e.data.totalExchangesCount14days);
    }).catch(error => {
        console.log(error);
    });

}