import $ from "jquery";
import { statusList, statusAffstatusList, registerTypes } from "./constants";
import axios from 'axios';



$(document).ready(async function() {
    const table = $('.eaDatatable');
    const currenciesList = await getCurrencies();
    const selectOptionDefault = `<option value="">` + "—" + '</option>';

    table.each(function() {
        $(this).find("thead tr:eq(1) th").each(function() {
            const select = $(this).find('select.form-select');

            select.append(selectOptionDefault);
            switch ($(this).data('select-type')) {
                case 'code': 
                    renderCurrenciesCode(select)
                    break;
                case 'code_id':
                    renderCurrenciesCodeId(select)
                    break;
                case 'id':
                    renderCurrenciesId(select)
                    break;
                case 'status':
                    renderStatus(select)
                    break;
                case 'status_withdraws':
                    renderStatusWithdraws(select)
                    break;
                case 'register_type':
                    renderRegisterTypes(select)
                    break;
            }

            $(this).removeAttr(Object.values($(this).get(0).attributes).map(attr => attr.name).join(' '));
            $(this).removeClass("sorting");
            $(this).addClass("sorting_disabled");
        })
    });

MediaKeyMessageEvent, 
    function renderCurrenciesCode(select) {
        currenciesList.forEach(item => {
            const selectOption = `<option value=${item.name}>` + item.name + '</option>'
            select.append(selectOption);
        })
    }

    function renderCurrenciesCodeId(select) {
        currenciesList.forEach(item => {
            const selectOption = `<option value=${item.id}>` + item.name + '</option>'
            select.append(selectOption);
        })
    }

    function renderStatusWithdraws(select) {
        statusAffstatusList.forEach(item => {
            const selectOption = `<option value=${item.number}>` + item.name + '</option>'
            select.append(selectOption);
        })
    }

    function renderStatus(select) {
        statusList.forEach(item => {
            const selectOption = `<option value=${item.number}>` + item.name + '</option>'
            select.append(selectOption);
        })
    }

    function renderCurrenciesId(select) {
        currenciesList.forEach(item => {
            const selectOption = `<option value=${item.id}>` + item.id + '</option>'
            select.append(selectOption);
        })
    }

    async function getCurrencies() {
        const url = window.location.href;
        const languagePattern = /\/(en|ru)\//;
      
        const match = url.match(languagePattern);
        const path = `/${match[1]}/panel/currencies/list/data`;
        const data = (await axios.get(path)).data;
        return data.data
    }

    function renderRegisterTypes(select) {
        registerTypes.forEach(item => {
            const selectOption = `<option value=${item.number}>` + item.name + '</option>'
            select.append(selectOption);
        })
    }
});