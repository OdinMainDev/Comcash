import ApexCharts from "apexcharts";
import {colors} from "./dashboard_config";
import $ from "jquery";
import axios from "axios";

(() => {
    if (!$('#admAffiliateChart2').length) return;
    fillChart();
})()

function fillChart() {
    axios.get("/ru/panel/api/get/dashboard/affiliate2").then(e => {
        var options = {
            chart: {
              height: 260,
              type: "radialBar"
            },
            series: [e.data.percent],
            colors: [colors.primary],
            plotOptions: {
              radialBar: {
                hollow: {
                  margin: 15,
                  size: "70%"
                },
                track: {
                  show: true,
                  background: colors.info,
                  strokeWidth: '100%',
                  opacity: 1,
                  margin: 5, 
                },
                dataLabels: {
                  showOn: "always",
                  name: {
                    offsetY: -11,
                    show: true,
                    color: colors.muted,
                    fontSize: "13px"
                  },
                  value: {
                    color: colors.light,
                    fontSize: "30px",
                    show: true
                  }
                }
              }
            },
            fill: {
              opacity: 1
            },
            stroke: {
              lineCap: "round",
            },
            labels: ["Web/Affiliate"]
        };
        new ApexCharts(document.querySelector("#admAffiliateChart2"), options).render();
        $("#admAffiliateChart2Total").html(e.data.total);
        $("#admAffiliateChart2FromWeb").html(e.data.from_web);
        $("#admAffiliateChart2FromAff").html(e.data.from_affiliate);
    }).catch(error => {
        console.log(error);
    });

}