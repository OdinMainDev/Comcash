<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{__("emails.subject_reset")}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Gothic+A1:wght@300;400;500;600;700&family=Inter:wght@100..900&display=swap');
    table {
      border-spacing: 0;
      mso-cellspacign: 0;
      mso-padding-alt: 0;
    }

    * {
      font-family: "Inter", sans-serif;
      font-weight: 400;
      font-style: normal;
    }
    
    .container {
      background: radial-gradient(circle, rgba(26,57,47,1) 20%, rgba(0,0,0,1) 50%);
    }

    td {
      padding: 0;
    }

    #outlook a {
      padding: 0;
    }

    a {
      text-decoration: none;
      color: #333333; 
      font-family: "Inter", sans-serif;
      font-weight: 400;
      font-style: normal;
      line-height: 30px; 
      -webkit-text-size-adjust:none; 
      display: block;
    }

    span {
      color: #333333; 
      font-family: "Inter", sans-serif;
      font-weight: 400;
      font-style: normal;
      line-height: 30px; 
      -webkit-text-size-adjust:none; 
      display: block;
    }
  </style>
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
                    padding-bottom: 20px;">{{__("emails.reset_text_1")}} <strong style="color: #009c74; font-weight: 600; font-size: 25px;">{{__("emails.reset_text_2")}}</strong></span>
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
                    padding-bottom: 30px;">{{__("emails.reset_text_3")}} <strong style="color: #009c74; font-weight: 500; font-size: 18px;">{{__("emails.reset_text_4")}}</strong> {{__("emails.reset_text_5")}}</span>
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
                    color: #ffffff;">{{__("emails.reset_text_6")}}: {{$code}}</span>
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