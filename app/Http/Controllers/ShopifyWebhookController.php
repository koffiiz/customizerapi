<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\BlobWaveform;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class ShopifyWebhookController extends Controller
{
    public function createOrder(Request $request) {



        $raw = json_encode($request->all());
        $line_items = $request->get("line_items");
        $order_id = intval($request->get("id"));
        $customer = $request->get("customer");
        $email = $request->get("email");

        foreach ($line_items as $key => $line_item) {

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
                                    echo "Mail has been sent successfully!";
                                } else {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
                            } catch (Exception $e) {
                                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                        break;
                    case 'Audio':
                        $splitedFirstWaveaudioBlobId = explode("id='", $property_value);
                        $splitedSecondWaveaudioBlobId = explode("'>Audio</div>", $splitedFirstWaveaudioBlobId[1]);

                        $audio_id = (int)$splitedSecondWaveaudioBlobId[0];
                        $blobData = BlobWaveform::find((int)$splitedSecondWaveaudioBlobId[0]);

                        $waveFormDirectory = public_path("storage/waveformAudio");
                        $time = time();

                        $audio = str_replace("data:$blobData->blob_ext;base64,", '', $blobData->blob_data);
                        $final_path = $waveFormDirectory.'/'.$time.".$blobData->blob_raw_extention";
                        file_put_contents($final_path, base64_decode($audio));
                        $waveform_audio_url = $final_path;
                        break;
                    case 'WaveFormData':
                        $sizeRaw = $line_item['variant_title'];
                        $size = explode("x", $sizeRaw);
                        $height = (int) $size[0] * 0.0254;
                        $width = (int) $size[1] * 0.0254;
                        logger('Widht = '.$width);
                        logger('Height = '.$height);
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
            ];

            logger($data);
            $order = new Order;
            $order->customer_id = $customer['id'];
            $order->order_id = $order_id;
            $order->waveform_url = $waveform_url;
            $order->waveform_file_url = $waveform_audio_url;
            $order->waveform_data = $data;
            $order->raw = $raw;
            $order->save();

            $blobData = BlobWaveform::find($audio_id);
            $blobData->delete();

            $waveData = BlobWaveform::find($waveform_data_id);
            $waveData->delete();
        }
    }
}
