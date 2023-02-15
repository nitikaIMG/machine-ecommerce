<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8 Content-Type: image/png">
      <title>{{__('Machine')}}</title>
      <style type="text/css">
         @charset "utf-8";
         #footerDiv{
         }
         .dataDiv{
         }
      </style>
   </head>
   <body>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
         <tr>
            <td style="padding:40px 0px 40px 0px;background-color:#f4f4f4;">
               <table width="702" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFFFFF">
                  <tr>
                     <td width="700" bgcolor="#f4f4f4">
                        <table width="700" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#FFF">
                           <tr>
                              <td width="100%" align="center" style="padding:0 0px 0 0px;background: #f4f4f4;" colspan="3">
                                 <h2 style="color:rgb(255,255,255);"></h2>
                              </td>
                           </tr>
                           <tr>
                              <td width="1" bgcolor="#dadada"></td>
                              <td width="697" align="center">
                                 <table width="696" cellspacing="0" cellpadding="1" border="0" bgcolor="#FFFFFF">
                                    <tr>
                                       <td>
                                          <div class="dataDiv" style="color:#666666;font-family:Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif;font-size:12.5px;line-height:1.75em;padding:0 60px;">
                                             <br>
                                             Hello,
                                             <br>
                                             <br>
                                             <p>{{__('We are excited to have you join the Graphic NewsPlus family. To complete your registration and confirm your account, you need to confirm your email by pressing or clicking the button below.')}}</p>
                                             <br>
                                             <div style="width:100%;text-align:center;"><p>{{ $user['otp']}}</p>
                                             <br>
                                             {{__('Cheers')}}<br>
                                             {{__('Machine  Team')}}<br><br>
                                          </div>
                                       </td>
                                    </tr>
                                 </table>
                              </td>
                              <td width="1" bgcolor="#dadada"></td>
                           </tr>
                        </table>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
</html>