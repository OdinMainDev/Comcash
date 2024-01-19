import $ from "jquery";
import flatpickr from "flatpickr";
import 'flatpickr/dist/flatpickr.min.css'
import { Russian } from "flatpickr/dist/l10n/ru.js";
import { English } from "flatpickr/dist/l10n/default.js";
import { statusList } from "./constants";


import axios from "axios";


$(document).ready(async function() {
    const table = $('.eaDatatable');
    const currenciesList = await getCurrencies();
    const selectOptionDefault = `<option value="">` + "—" + '</option>';

    table.each(function() {
        $(this).find("thead tr:eq(1) th").each(function() {
            const select = $(this).find('select.form-select');
            const datepicker = $(this).find('input.datepicker')
            const url = window.location.href;
            const languagePattern = /\/(en|ru)\//;
          
            const match = url.match(languagePattern);
        
            flatpickr(datepicker, {
                enableTime: true,
                dateFormat: "d.m.Y H:i",
                locale: match[1] === 'ru' ? Russian : English,
            });

            datepicker.on('lc')

            select.append(selectOptionDefault);
            switch ($(this).data('select-type')) {
                case 'code': 
                    renderCurrenciesCode(select)
                    break;
                case 'id':
                    renderCurrenciesId(select)
                    break;
                case 'status':
                    renderStatus(select)
                    break;
            }
            $(this).removeAttr(Object.values($(this).get(0).attributes).map(attr => attr.name).join(' '));
            $(this).removeClass("sorting");
            $(this).addClass("sorting_disabled");
        })
    });

    function renderCurrenciesCode(select) {
        currenciesList.forEach(item => {
            const selectOption = `<option value=${item.name}>` + item.name + '</option>'
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

    
});