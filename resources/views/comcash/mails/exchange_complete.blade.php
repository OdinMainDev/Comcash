<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{__("emails.subject_exchange_complete")}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include("comcash.mails.style")
</head>
<body style="Margin:0;padding:0;min-width:100%;background-color:#dde0e1;">
  <center style="width: 100%;table-layout:fixed;background-color: #dde0e1;padding-top: 40px;">
    <div style="max-width: 650px;background-color: #fafdfe;box-shadow: 0 0 10px rgba(0, 0, 0, .2);">
      <table class="container" border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%" role="presentation" 
        style="margin:0; padding:0; width: 100%; max-width: 650px;">
        <tr>
          <td>
            <span style="max-width: 650px; margin: 0 auto;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td width="33%" valign="top">
                    <img src="{{env("APP_URL")}}/comcash/img/mails/leaves_left.png" class="leaves" alt="leaves">
                  </td>
                  <td align="center"  width="33%">
                    <a style="padding-top: 30px; padding-bottom: 30px;" href="#" target="_blank">
                      <img src="{{env("APP_URL")}}/comcash/img/mails/logo.png" style="height: 40px;" alt="logo">
                    </a>
                  </td>
                  <td width="33%" align="right"  valign="top">
                    <img src="{{env("APP_URL")}}/comcash/img/mails/leaves_right.png" alt="leaves">
                  </td>
                </tr>
              </table>
            </span>
          </td>
        </tr>
        <?php
          if(!isset($id) || !$id)
            $id = "TEST";
          if(!isset($url) || !$url)
            $url = "https://test.test.test.test";
          if(!isset($currencyFrom) || !$currencyFrom)
            $currencyFrom = "CurrencyFrom";
          if(!isset($currencyTo) || !$currencyTo)
            $currencyTo = "CurrencyTo";
          if(!isset($amountFrom) || !$amountFrom)
            $amountFrom = "AmountFrom";
          if(!isset($amountTo) || !$amountTo)
            $amountTo = "AmountTo";
        ?>
        <tr>
          <td style="padding-bottom: 30px;">
            <span style="max-width: 650px; margin: 0 auto;">
              <table align="center" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td>
                    <span style="
                    padding: 7px 15px;
                    background: #009c74;
                    border-radius: 10px;
                    font-weight: 600;
                    font-size: 20px;
                    color: #ffffff;">{{__("emails.exchange_id")}} {{$id}}</span>
                  </td>
                </tr>
              </table>
            </span>
          </td>
        </tr>
        <tr>
          <td >
            <span style="max-width: 650px; margin: 0 auto;">
              <table border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td style="padding: 0 40px;">
                    <span style="
                    font-weight: 600;
                    font-size: 25px;
                    color: #ffffff;
                    padding-bottom: 20px;">{{__("emails.exchange_complete_text_1")}} <strong style="color: #009c74; font-weight: 600; font-size: 25px;">{{__("emails.exchange_complete_text_2")}}</strong></span>
                  </td>
                </tr>
              </table>
            </span>
          </td>
        </tr>
        <tr>
          <td >
            <span style="max-width: 650px; margin: 0 auto;">
              <table border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td style="padding: 0 40px;">
                    <ul  style="
                    font-weight: 500;
                    font-size: 18px;
                    color: #ffffff;
                    padding-bottom: 30px;">
                      <li>
                        {{__("emails.exchange_complete_text_3")}} <strong style="color: #009c74; font-weight: 500; font-size: 18px;">{{$currencyFrom}} -> {{$currencyTo}}</strong>
                      </li>
                      <li>
                        {{__("emails.exchange_complete_text_4")}} <strong style="color: #009c74; font-weight: 500; font-size: 18px;">{{$amountFrom}} {{$currencyFrom}}</strong>
                      </li>
                      <li>
                        {{__("emails.exchange_complete_text_5")}} <strong style="color: #009c74; font-weight: 500; font-size: 18px;">{{$amountTo}} {{$currencyTo}}</strong>
                      </li>
                    </ul>
                  </td>
                </tr>
              </table>
            </span>
          </td>
        </tr>
        <tr>
          <td >
            <span style="max-width: 650px; margin: 0 auto;">
              <table border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td style="padding: 0 40px;">
                    <span style="
                    font-weight: 500;
                    font-size: 18px;
                    color: #ffffff;
                    padding-bottom: 30px;">{{__("emails.exchange_complete_text_6")}}</span>
                  </td>
                </tr>
              </table>
            </span>
          </td>
        </tr>
        <?php
          if(!isset($code) || !$code)
            $code = "TEST";
        ?>
        <tr>
          <td>
            <span style="max-width: 650px; margin: 0 auto;">
              <table align="center" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td style="padding-top: 20px; padding-bottom: 50px;">
                    <a style="      
                    padding: 10px 20px;
                    background: #009c74;
                    border-radius: 100px;
                    font-weight: 600;
                    font-size: 25px;
                    color: #ffffff;
                    cursor: pointer;" href="{{$url}}" blank="_target">{{__("emails.exchange_complete_text_7")}}</a>
                  </td>
                </tr>
              </table>
            </span>
          </td>
        </tr>
        <tr>
          <td>
            <span>
              <table border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td style="padding: 0 40px;">
                    <a style="font-size: 15px; color: #ffffff;">{{__("emails.exchange_complete_text_8")}}</a>
                    <a style="font-size: 18px; color: #009c74; text-decoration: underline;">{{$url}}</a>
                  </td>
                </tr>
              </table>
            </span>
          </td>
        </tr>
        <tr>
          <td style="padding-top: 70px; padding-bottom: 60px;">
            <span>
              <table border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td style="padding: 0 40px;">
                    <img src="{{env("APP_URL")}}/comcash/img/mails/logo.png" style="height: 30px;" alt="logo">
                  </td>
                </tr>
              </table>
            </span>
          </td>
        </tr>
      </table>
    </div>
  </center>
</body>
</html>