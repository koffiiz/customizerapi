<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\BlobWaveform;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use File;

class ShopifyWebhookController extends Controller
{
    public function createOrder(Request $request) {
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
                        $waveform_url = $imageUrl[0];

                            $mail = new PHPMailer();
                            try {
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                                $mail->isSMTP();
                                $mail->Host       = 'smtp.gmail.com;';
                                $mail->SMTPAuth   = 'true';
                                $mail->Username   = 'sensoriumarte1995@gmail.com';
                                $mail->Password   = '0jV9lea7qb';
                                $mail->SMTPSecure = 'tls';
                                $mail->Port       = 587;

                                $mail->setFrom('sensoriumarte1995@gmail.com', 'sensoriumarte');
                                $mail->addAddress($email);
                                //$mail->addAddress('receiver2@gfg.com', 'Name');
                                $mail->isHTML(true);
                                $mail->Subject = 'sensoriumarte waveform';
                                $mail->Body    = "<img src='$waveform_url' />";
                                $mail->AltBody = 'Body in plain text for non-HTML mail clients';

                                if($mail->send()) {
                                    logger("Mail has been sent successfully!") ;
                                } else {
                                    logger( "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                                }
                            } catch (Exception $e) {
                                logger("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
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
                'widht' => $width,
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

        }
    }
}
