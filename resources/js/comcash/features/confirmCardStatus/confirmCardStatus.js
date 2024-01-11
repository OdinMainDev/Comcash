import $ from 'jquery'
import { getConfirmStatus } from './api';
import { closeForm } from '@/shared/scripts/modal/integrateMagnificPopup';
import { setForm } from '@/shared/scripts/modal';

export const confirmCardStatus = (lang, id) => { 
  setForm('confirm-verification');
  let interval = null;
  getStatus(lang, id, interval);
  interval = setInterval(async () => {
    getStatus(lang, id, interval)
  }, 5000)

}

const getStatus = async (lang, id, interval) => {
  const confirm = $('#confirm-verification');
  const confirmStatus = confirm.find('.confirm-verification__status');
  const loader = confirm.find('.confirm-verification__loader');
  const data = await getConfirmStatus({ lang, id });
  if (data.data) {
    if (interval) {
      clearInterval(interval);
    }
    loader.hide();
    confirmStatus.text('Все прошло успешно!')
    setTimeout(() => {
      closeForm();
    }, 3000)

  }
}

