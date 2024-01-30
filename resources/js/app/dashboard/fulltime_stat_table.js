import $ from "jquery";
import axios from "axios";

(() => {
    if (!$('#admAffFTStatTable').length) return;
    fillTable();
})()

function fillTable() {
    axios.get("/ru/panel/api/get/dashboard/fulltime-statistic").then(e => {
        var html = ``;
        e.data.data.forEach(element => {
            let amount = formatNumber(element.amount);

            html += `
                <tr>
                    <td>${element.get_currency.name}</td>
                    <td>${amount} ${element.get_currency.name}</td>
                    <td>${element.amount_usd} $</td>
                </tr>
            `;
        });
        $("#admAffFTStatTable").html(html);
    }).catch(error => {
        console.log(error);
    });

}

function formatNumber(number) {
    let numberString = number.toString();
    if (numberString.includes('e')) {
        return parseFloat(number).toFixed(12);
    } else {
        return number;
    }
}