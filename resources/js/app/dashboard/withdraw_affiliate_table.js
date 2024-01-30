import $ from "jquery";
import axios from "axios";

(() => {
    if (!$('#admAffWithdrawTable').length) return;
    fillTable();
})()

function fillTable() {
    axios.get("/ru/panel/api/get/dashboard/affiliate-withdraws").then(e => {
        var html = ``;
        e.data.data.forEach(element => {
            let amount = formatNumber(element.amount);

            html += `
                <a href="/ru/panel/affiliate/withdraws/edit/${element.id}" class="d-flex align-items-center border-bottom pb-3 pt-1">
                    <div class="w-100">
                        <div class="d-flex justify-content-between">
                            <h6 class="text-body mb-2">${element.get_user.email} (${element.user_id})</h6>
                            <p class="text-muted tx-12">${element.created_at}</p>
                        </div>
                        <p class="text-muted tx-13">${element.get_currency.name} ${amount}</p>
                    </div>
                </a>
            `;
        });
        $("#admAffWithdrawTable").html(html);
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