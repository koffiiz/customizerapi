<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\BlobWaveform;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use File;

class ShopifyWebhookController extends Controller
{

    public function mailTest(Request $request) {

        $name = 'Mark';
        $password = '5SDF12Ds';
        $email = 'mark@email.com';
        $changepassUrl = config('app.url').'/update/password/testest';

        try {
            logger('=================mail start=========================');
            $mail = new PHPMailer();
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = 'true';
            $mail->Username   = 'sensoriumarte1995@gmail.com';
            $mail->Password   = '8huzmfj0t';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->setFrom('sensoriumarte1995@gmail.com', 'sensoriumarte');
            $mail->addAddress('kofiikofii20902@gmail.com');
            $mail->isHTML(true);
            $mail->Subject = 'sensoriumarte waveform';
            // $mail->Body    = "<img src='$waveform_url' />";
            $mail->Body = '<!doctype html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet" type="text/css">
                <style>
                    * {
                        box-sizing: border-box;
                    }

                    body {
                        margin: 0;
                        padding: 0;
                    }

                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: inherit !important;
                    }

                    #MessageViewBody a {
                        color: inherit;
                        text-decoration: none;
                    }

                    p {
                        line-height: inherit
                    }

                    @media (max-width:620px) {
                        .row-content {
                            width: 100% !important;
                        }

                        .image_block img.big {
                            width: auto !important;
                        }

                        .stack .column {
                            width: 100%;
                            display: block;
                        }
                    }
                </style>
            </head>

            <body style="background-color: #f7f7f7; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
                <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f7f7f7;">
                    <tbody>
                        <tr>
                            <td>
                                <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 600px;" width="600">
                                                    <tbody>
                                                        <tr>
                                                            <td class="column" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                <table class="image_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td style="width:100%;padding-right:0px;padding-left:0px;">
                                                                            <div align="center" style="line-height:10px"><img class="big" src="https://i.postimg.cc/CLRHwkdh/Sensorium-Brand-Style.png" style="display: block; height: auto; border: 0; width: 600px; max-width: 100%;" width="600"></div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 600px;" width="600">
                                                    <tbody>
                                                        <tr>
                                                            <td class="column" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 25px; padding-bottom: 10px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                <table class="image_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td style="width:100%;padding-right:0px;padding-left:0px;">
                                                                            <div align="center" style="line-height:10px"><a href="https://www.sensoriumarte.com/" target="_blank" style="outline:none" tabindex="-1"><img src="https://i.postimg.cc/x1QNJztV/sensorium-logo.png" style="display: block; height: auto; border: 0; width: 300px; max-width: 100%;" width="300" alt="Senosoriumarte" title="Senosoriumarte"></a></div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class="divider_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td>
                                                                            <div align="center">
                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #FC887B;"><span>&#8202;</span></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 600px;" width="600">
                                                    <tbody>
                                                        <tr>
                                                            <td class="column" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 25px; padding-right: 25px; padding-top: 5px; padding-bottom: 25px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                <table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                    <tr>
                                                                        <td>
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 14px; mso-line-height-alt: 21px; color: #000000; line-height: 1.5; font-family: Work Sans, Trebuchet MS, Helvetica, sans-serif;">
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Hey '.$name.',</span></p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Thank you so much for your order. We appreciate you for trusting Sensorium Arte with creating and delivering your special artwork.</span></p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">To rewatch your favorite memories, you need access to the Sensorium Arte application. Below, you can find your generated password.</span></p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Email: <a href="#" target="_blank" rel="noopener" title="kofiikofii20902@gmail.com" style="text-decoration: underline; color: #fc887b;">'.$email.'</a></span></p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Generated Password: '.$password.'</span></p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                                    <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Enjoy your artwork!</span></p>
                                                                                    <p style="margin: 0; font-size: 17px;"><strong><span style="font-size:17px;">Team Sensorium Arte</span></strong></p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class="button_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td>
                                                                        <a href='.$changepassUrl.'>
                                                                                <div align="center">
                                                                                <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#fc887b;border-radius:40px;width:auto;border-top:1px solid #FC887B;border-right:1px solid #FC887B;border-bottom:1px solid #FC887B;border-left:1px solid #FC887B;padding-top:5px;padding-bottom:5px;font-family:Work Sans, Trebuchet MS, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">Change password</span></span></div>
                                                                            </div>
                                                                        </a>

                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fc887b; color: #000000; width: 600px;" width="600">
                                                    <tbody>
                                                        <tr>
                                                            <td class="column" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                <table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                    <tr>
                                                                        <td>
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Work Sans, Trebuchet MS, Helvetica, sans-serif;">
                                                                                    <p style="margin: 0; font-size: 17px; text-align: center; mso-line-height-alt: 22.5px;"><span style="font-size:15px;">support@sensoriumarte.com</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class="text_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                    <tr>
                                                                        <td style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Work Sans, Trebuchet MS, Helvetica, sans-serif;">
                                                                                    <p style="margin: 0; font-size: 17px; text-align: center; mso-line-height-alt: 22.5px;"><span style="font-size:15px;">FOLLOW US</span></p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class="social_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td>
                                                                            <table class="social-table" width="108px" border="0" cellpadding="0" cellspacing="0" role="presentation" align="center" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                <tr>
                                                                                    <td style="padding:0 2px 0 2px;"><a href="https://www.facebook.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-circle-white/facebook@2x.png" width="32" height="32" alt="Facebook" title="facebook" style="display: block; height: auto; border: 0;"></a></td>
                                                                                    <td style="padding:0 2px 0 2px;"><a href="https://www.twitter.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-circle-white/twitter@2x.png" width="32" height="32" alt="Twitter" title="twitter" style="display: block; height: auto; border: 0;"></a></td>
                                                                                    <td style="padding:0 2px 0 2px;"><a href="https://www.instagram.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-circle-white/instagram@2x.png" width="32" height="32" alt="Instagram" title="instagram" style="display: block; height: auto; border: 0;"></a></td>
                                                                                </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class="divider_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                    <tr>
                                                                        <td>
                                                                            <div align="center">
                                                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="90%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                    <tr>
                                                                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #FFFFFF;"><span>&#8202;</span></td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                    <tr>
                                                                        <td>
                                                                            <div style="font-family: sans-serif">
                                                                                <div style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Work Sans, Trebuchet MS, Helvetica, sans-serif;">
                                                                                    <p style="margin: 0; font-size: 17px; text-align: center;">© Copyright 2021 Sensorium Arte</p>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
            </html>';
            if($mail->send()) {
                logger("Mail has been sent successfully!") ;
            } else {
                logger( "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            }
            logger('=================mail END =========================');
        } catch (Exception $e) {
            logger("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }

    public function createOrder(Request $request) {
        logger('================= Shopify webhook start =================');
        $raw = json_encode($request->all());
        $line_items = $request->get("line_items");
        $order_id = intval($request->get("id"));
        $customer = $request->get("customer");
        $email = $request->get("email");
        $total_price = $request->get('total_price');

        foreach ($line_items as $key => $line_item) {
            $name = $line_item['name'];
            $properties = $line_item['properties'];
            $waveform_url = '';
            $waveform_audio_url = '';
            $waveform_data = '';
            $audio_id = '';
            $waveform_data_id = '';
            $height ='';
            $width ='';

            foreach ($properties as $key => $property) {
                $property_name = $property['name'];
                $property_value = $property['value'];
                $line_item_id = $line_item['id'];

                switch ($property_name) {
                    case 'Waveform':
                        $splitedFirstWaveformBlob = explode("img-url='", $property_value);
                        $splitedSecondWaveformBlob = explode("'>", $splitedFirstWaveformBlob[1]);
                        $imageUrl = $splitedSecondWaveformBlob;
                        $waveform_url = $imageUrl[0].'?width=5000';

                        $customer_default_address = $customer['default_address'];
                        $customer_name = $customer_default_address['first_name'];

                        $findUser = User::where('email', $email)->first();
                        $generatedPassword = Str::random(8);
                        if(empty($findUser)) {
                            $user = new User();
                            $user->email = $email;
                            $user->name = $customer_name;
                            $user->password = Hash::make($generatedPassword);
                            $user->password_reset = Str::random(12);
                            $user->save();


                            $name = $customer_name;
                            $password = $user->password;
                            $email = $email;
                            $changepassUrl = config('app.url').'/update/password/'.$user->password_reset;


                        logger(Str::random(8));
                         $mail = new PHPMailer();
                         try {
                            $flag = 0;
                            $mailsuccess = false;
                            if($flag < 5 && !$mailsuccess ) {
                                $flag ++ ;

                             logger('=================mail start=========================');
                             $mail->SMTPDebug = 2;
                             $mail->isSMTP();
                             $mail->Host       = 'smtp.gmail.com';
                             $mail->SMTPAuth   = 'true';
                             $mail->Username   = 'sensoriumarte1995@gmail.com';
                             $mail->Password   = '8huzmfj0t';
                             $mail->SMTPSecure = 'tls';
                             $mail->Port       = 587;

                             $mail->setFrom('sensoriumarte1995@gmail.com', 'sensoriumarte');
                             $mail->addAddress($email);
                             $mail->isHTML(true);
                             $mail->Subject = 'sensoriumarte waveform';
                             // $mail->Body    = "<img src='$waveform_url' />";
                             $mail->Body = '<!doctype html>
                             <html lang="en">
                             <head>
                                 <meta charset="UTF-8">
                                 <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                 <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet" type="text/css">
                                 <style>
                                     * {
                                         box-sizing: border-box;
                                     }

                                     body {
                                         margin: 0;
                                         padding: 0;
                                     }

                                     a[x-apple-data-detectors] {
                                         color: inherit !important;
                                         text-decoration: inherit !important;
                                     }

                                     #MessageViewBody a {
                                         color: inherit;
                                         text-decoration: none;
                                     }

                                     p {
                                         line-height: inherit
                                     }

                                     @media (max-width:620px) {
                                         .row-content {
                                             width: 100% !important;
                                         }

                                         .image_block img.big {
                                             width: auto !important;
                                         }

                                         .stack .column {
                                             width: 100%;
                                             display: block;
                                         }
                                     }
                                 </style>
                             </head>

                             <body style="background-color: #f7f7f7; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
                                 <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f7f7f7;">
                                     <tbody>
                                         <tr>
                                             <td>
                                                 <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                     <tbody>
                                                         <tr>
                                                             <td>
                                                                 <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 600px;" width="600">
                                                                     <tbody>
                                                                         <tr>
                                                                             <td class="column" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 0px; padding-bottom: 0px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                 <table class="image_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                     <tr>
                                                                                         <td style="width:100%;padding-right:0px;padding-left:0px;">
                                                                                             <div align="center" style="line-height:10px"><img class="big" src="https://i.postimg.cc/CLRHwkdh/Sensorium-Brand-Style.png" style="display: block; height: auto; border: 0; width: 600px; max-width: 100%;" width="600"></div>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                             </td>
                                                                         </tr>
                                                                     </tbody>
                                                                 </table>
                                                             </td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
                                                 <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                     <tbody>
                                                         <tr>
                                                             <td>
                                                                 <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 600px;" width="600">
                                                                     <tbody>
                                                                         <tr>
                                                                             <td class="column" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 25px; padding-bottom: 10px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                 <table class="image_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                     <tr>
                                                                                         <td style="width:100%;padding-right:0px;padding-left:0px;">
                                                                                             <div align="center" style="line-height:10px"><a href="https://www.sensoriumarte.com/" target="_blank" style="outline:none" tabindex="-1"><img src="https://i.postimg.cc/x1QNJztV/sensorium-logo.png" style="display: block; height: auto; border: 0; width: 300px; max-width: 100%;" width="300" alt="Senosoriumarte" title="Senosoriumarte"></a></div>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                                 <table class="divider_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                     <tr>
                                                                                         <td>
                                                                                             <div align="center">
                                                                                                 <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                     <tr>
                                                                                                         <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #FC887B;"><span>&#8202;</span></td>
                                                                                                     </tr>
                                                                                                 </table>
                                                                                             </div>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                             </td>
                                                                         </tr>
                                                                     </tbody>
                                                                 </table>
                                                             </td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
                                                 <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                     <tbody>
                                                         <tr>
                                                             <td>
                                                                 <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff; color: #000000; width: 600px;" width="600">
                                                                     <tbody>
                                                                         <tr>
                                                                             <td class="column" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-left: 25px; padding-right: 25px; padding-top: 5px; padding-bottom: 25px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                 <table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                     <tr>
                                                                                         <td>
                                                                                             <div style="font-family: sans-serif">
                                                                                                 <div style="font-size: 14px; mso-line-height-alt: 21px; color: #000000; line-height: 1.5; font-family: Work Sans, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Hey '.$name.',</span></p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Thank you so much for your order. We appreciate you for trusting Sensorium Arte with creating and delivering your special artwork.</span></p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">To rewatch your favorite memories, you need access to the Sensorium Arte application. Below, you can find your generated password.</span></p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Email: <a href="#" target="_blank" rel="noopener" title="kofiikofii20902@gmail.com" style="text-decoration: underline; color: #fc887b;">'.$email.'</a></span></p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Generated Password: '.$password.'</span></p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 21px;">&nbsp;</p>
                                                                                                     <p style="margin: 0; font-size: 17px; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">Enjoy your artwork!</span></p>
                                                                                                     <p style="margin: 0; font-size: 17px;"><strong><span style="font-size:17px;">Team Sensorium Arte</span></strong></p>
                                                                                                 </div>
                                                                                             </div>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                                 <table class="button_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                     <tr>
                                                                                         <td>
                                                                                         <a href='.$changepassUrl.'>
                                                                                                 <div align="center">
                                                                                                 <div style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#fc887b;border-radius:40px;width:auto;border-top:1px solid #FC887B;border-right:1px solid #FC887B;border-bottom:1px solid #FC887B;border-left:1px solid #FC887B;padding-top:5px;padding-bottom:5px;font-family:Work Sans, Trebuchet MS, Helvetica, sans-serif;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:20px;padding-right:20px;font-size:16px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; line-height: 2; word-break: break-word; mso-line-height-alt: 32px;">Change password</span></span></div>
                                                                                             </div>
                                                                                         </a>

                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                             </td>
                                                                         </tr>
                                                                     </tbody>
                                                                 </table>
                                                             </td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
                                                 <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                     <tbody>
                                                         <tr>
                                                             <td>
                                                                 <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #fc887b; color: #000000; width: 600px;" width="600">
                                                                     <tbody>
                                                                         <tr>
                                                                             <td class="column" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                                                                                 <table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                     <tr>
                                                                                         <td>
                                                                                             <div style="font-family: sans-serif">
                                                                                                 <div style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Work Sans, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                     <p style="margin: 0; font-size: 17px; text-align: center; mso-line-height-alt: 22.5px;"><span style="font-size:15px;">support@sensoriumarte.com</span></p>
                                                                                                 </div>
                                                                                             </div>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                                 <table class="text_block" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                     <tr>
                                                                                         <td style="padding-bottom:10px;padding-left:10px;padding-right:10px;">
                                                                                             <div style="font-family: sans-serif">
                                                                                                 <div style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Work Sans, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                     <p style="margin: 0; font-size: 17px; text-align: center; mso-line-height-alt: 22.5px;"><span style="font-size:15px;">FOLLOW US</span></p>
                                                                                                 </div>
                                                                                             </div>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                                 <table class="social_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                     <tr>
                                                                                         <td>
                                                                                             <table class="social-table" width="108px" border="0" cellpadding="0" cellspacing="0" role="presentation" align="center" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                 <tr>
                                                                                                     <td style="padding:0 2px 0 2px;"><a href="https://www.facebook.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-circle-white/facebook@2x.png" width="32" height="32" alt="Facebook" title="facebook" style="display: block; height: auto; border: 0;"></a></td>
                                                                                                     <td style="padding:0 2px 0 2px;"><a href="https://www.twitter.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-circle-white/twitter@2x.png" width="32" height="32" alt="Twitter" title="twitter" style="display: block; height: auto; border: 0;"></a></td>
                                                                                                     <td style="padding:0 2px 0 2px;"><a href="https://www.instagram.com/" target="_blank"><img src="https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/t-circle-white/instagram@2x.png" width="32" height="32" alt="Instagram" title="instagram" style="display: block; height: auto; border: 0;"></a></td>
                                                                                                 </tr>
                                                                                             </table>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                                 <table class="divider_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                     <tr>
                                                                                         <td>
                                                                                             <div align="center">
                                                                                                 <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="90%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                                                                                     <tr>
                                                                                                         <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #FFFFFF;"><span>&#8202;</span></td>
                                                                                                     </tr>
                                                                                                 </table>
                                                                                             </div>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                                 <table class="text_block" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                                                                                     <tr>
                                                                                         <td>
                                                                                             <div style="font-family: sans-serif">
                                                                                                 <div style="font-size: 14px; mso-line-height-alt: 21px; color: #ffffff; line-height: 1.5; font-family: Work Sans, Trebuchet MS, Helvetica, sans-serif;">
                                                                                                     <p style="margin: 0; font-size: 17px; text-align: center;">© Copyright 2021 Sensorium Arte</p>
                                                                                                 </div>
                                                                                             </div>
                                                                                         </td>
                                                                                     </tr>
                                                                                 </table>
                                                                             </td>
                                                                         </tr>
                                                                     </tbody>
                                                                 </table>
                                                             </td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </body>
                             </html>';
                             if($mail->send()) {
                                 $mailsuccess = true;
                                 logger("Mail has been sent successfully!") ;
                             } else {
                                 logger( "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                             }
                             logger('=================mail END =========================');
                            }

                         } catch (Exception $e) {
                             logger("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                         }
                        }
                        break;
                    case 'Audio':
                        $splitedFirstWaveaudioBlobId = explode("id='", $property_value);
                        $splitedSecondWaveaudioBlobId = explode("'>Audio</div>", $splitedFirstWaveaudioBlobId[1]);

                        $audio_id = (int)$splitedSecondWaveaudioBlobId[0];
                        $blobData = BlobWaveform::find((int)$splitedSecondWaveaudioBlobId[0]);

                        $waveFormDirectory = public_path("/waveformAudio");
                        $time = time();
                        if(!File::exists($waveFormDirectory)) {
                            File::makeDirectory($waveFormDirectory);
                        }

                        $audio = str_replace("data:$blobData->blob_ext;base64,", '', $blobData->blob_data);
                        $final_path = $waveFormDirectory.'/'.$time.".$blobData->blob_raw_extention";
                        $url = config('app.url').'/waveformAudio/'.$time.".$blobData->blob_raw_extention";
                        file_put_contents($final_path, base64_decode($audio));

                        $waveform_audio_url = $url;
                        break;
                    case 'WaveFormData':
                        $sizeRaw = $line_item['variant_title'];
                        $size = explode("x", $sizeRaw);
                        $height = (int) $size[0] * 0.0254;
                        $width = (int) $size[1] * 0.0254;

                        $splitedFirstWaveDataId = explode("id='", $property_value);
                        $splitedSecondWaveDataId = explode("'>Audio</div>", $splitedFirstWaveDataId[1]);

                        $waveform_data_id = (int)$splitedSecondWaveDataId[0];
                        // $blobData = BlobWaveform::find((int)$splitedSecondWaveDataId[0]);

                        // $waveform_data = $blobData->blob_data;
                        break;
                    default:
                        # code...
                        break;
                }
            }

            $data = [
                'customer_id' => $customer['id'],
                'order_id' =>  $order_id,
                'waveform_image_url' => $waveform_url,
                'waveform_file_url' => $waveform_audio_url,
                'product_name' => $name,
                'total_price' => $total_price,
                'height' => $height,
                'width' => $width,
            ];

            $order = new Order;
            $order->customer_id = $customer['id'];
            $order->order_id = $order_id;
            $order->waveform_url = $waveform_url;
            $order->waveform_file_url = $waveform_audio_url;
            $order->waveform_data = $data;
            $order->raw = $raw;
            $order->save();

            if($order->save()) {
                    if($line_item['title'] != 'Raw Artwork') {
                        $curl = curl_init();
                        $customer_default_address = $customer['default_address'];
                        $customer_name = $customer_default_address['first_name'];
                        $customer_address1 = $customer_default_address['address1'];
                        $city = $customer_default_address['city'];
                        $country_code = $customer_default_address['country_code'];
                        $state_code = $customer_default_address['province_code'];
                        $zip = $customer_default_address['zip'];
                        $variantID = '';

                        if($line_item['title'] == 'Poster') {
                            if($line_item['variant_title'] == '8x10') {
                                $variantID = 4463;
                            }
                            else if($line_item['variant_title'] == '12x16') {
                                $variantID = 1349;
                            }
                            else if($line_item['variant_title'] == '16x20') {
                                $variantID = 3877;
                            }
                            else if($line_item['variant_title'] == '24x36') {
                                $variantID = 2;
                            }
                        } else if ($line_item['title'] == 'Framed Poster') {
                            if($line_item['variant_title'] == '8x10') {
                                $variantID = 4651;
                            }
                            else if($line_item['variant_title'] == '12x16') {
                                $variantID = 1350;
                            }
                            else if($line_item['variant_title'] == '16x20') {
                                $variantID = 4399;
                            }
                            else if($line_item['variant_title'] == '24x36') {
                                $variantID = 3;
                            }
                        } else if ($line_item['title'] == 'Canvas') {
                            if($line_item['variant_title'] == '12x16') {
                                $variantID = 5;
                            }
                            else if($line_item['variant_title'] == '18x24') {
                                $variantID = 7;
                            }
                            else if($line_item['variant_title'] == '24x36') {
                                $variantID = 825 ;
                            }
                        }

                        logger('Variant ID: '.$variantID);
                        logger('Variant title: '.$line_item['variant_title'] );
                        logger('waveform_url'.$waveform_url);
                        $data = json_encode(array(
                            "recipient"  => [
                                "name" => $customer_name,
                                "address1" => $customer_address1,
                                "city" => $city,
                                "state_code" => $state_code,
                                "country_code"=> $country_code,
                                "zip" => $zip
                            ],
                            "items" => [
                                [
                                    "variant_id" => $variantID,
                                    "quantity" => 1,
                                    "files" => [
                                        [
                                            "url" => $waveform_url
                                        ]
                                    ]
                                ]
                            ],
                            ));
                        logger('DATA'.$data);
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.printful.com/orders',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: Basic NDZvMnY4b2otMGk5NS11NzQ2OnpwcDAtcDJtdGJnYmwzYWl3',
                            'Content-Type: application/json',
                        ),
                        CURLOPT_POSTFIELDS => $data,
                        ));

                        $response = curl_exec($curl);
                        logger($response);
                        curl_close($curl);
                    }
            }

            $blobData = BlobWaveform::find($audio_id);
            $blobData->delete();

            $waveData = BlobWaveform::find($waveform_data_id);
            $waveData->delete();

            logger('============ END OF SHOPIFY WEBHOOK ===========');
            return response()->json([
            'status' => true,
            'message' => 'Shopify webhook success',
            ], 200);
        }
    }
}
