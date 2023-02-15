<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>{{__('Password reset') }}</title>
  </head>
  <body style="margin:0; padding: 0;">
    <table cellpadding="0" cellspacing="0" width="100%" style="width:100%; background:#EBEBEB" bgcolor="#EBEBEB">
      <tr>
        <td>
          <table width="440" cellpadding="0" cellspacing="0"style="width:440px; min-width:440px;background:#f4f5f1;  margin:0 auto" align="center"bgcolor="#f4f5f1" class="container">
          </table>
      <tr>
        <table  cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
          <tr>
            <td style="padding: 20px 0 30px 0;">
              {{-- <p style="margin: 0;"><strong>Hi</strong> {{ucfirst($username)}}<br/></p> --}}
            </td>
          </tr>
          <tr>
            <td style="font-style: normal;font-weight: normal;font-size: 16px;line-height: 25px;color: #242424;  font-family:Arial, Helvetica, sans-serif"><strong>{{__('Trouble signing into Machine account?')}}</strong><br><br>
              <p>{{__('Resetting your password is easy. Just press / click the button below and follow the instructions and we will have you up and running in no time.')}}</p></td>
          </tr>
          <tr>
            <td>
              <table cellpadding="0" cellspacing="0" width="100%" align="center"
                style="border-radius:5px;">
                <tr>
                  <td class="btn_text" align="center" height="55" valign="middle" bgcolor="#365558" style="color:#fff;font-family:arial, Helvetica, sans-serif;font-size:16px; height: 55px; line-height:55px; background:#365558;border-radius:5px;font-weight: 600;font-size: 18px;line-height: 22px;"><a href="{{$actionUrl}}" style="display:block;text-decoration:none;color:#fff;font-style: normal;font-weight: 600;font-size: 18px;line-height: 22px; width:100%;align-self: center; ">{{__('Password reset')}}
                    </a>
                  </td>
                  <br>
                </tr>
                 
                
              </table>
            </td>
          </tr>
        </table>
      </tr>
      </td>
      </tr>
    </table>
  </body>
</html>