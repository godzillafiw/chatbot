
<?php

//print_r($_GET["hub_challenge"]);

//file_put_contents("fb.txt",file_get_contents("php://input"));

$fb = file_get_contents("php://input");//file_get_contents("fb.txt");

$res = json_decode($fb);

function _send($message,$rid)
{
    $random_message = array_rand($message);
    $data = array(
                'recipient' => array('id' => $rid),
                'message'   => array('text' => $message[$random_message])
            );
     $option = array(
                    'http' => array(
                    'method'    => 'POST',
                    'content'   => json_encode($data),
                                    'header'    => "Content-Type: application/json\n"
                            )
                );
                    
     $context = stream_context_create($option);
     $token = EAABmZANIyvd8BAKZAxzIroD8sndNZARxehuhfAX3JNX4SueKaUy4WrEvkA3D1B6laYlobTocanUrmwaoONNVvjKgGZAfUQVv0T3NYmQyVII4oMkXxlx8LUJd7Kbycl4RSsYowvoLKb4ZAnkOMrsiqdZC8B7nBHpkvGRX5Yr2ZBpM3dgsK26NrmD;
     file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
}


    $rid = $res->entry[0]->messaging[0]->sender->id;


       //for($i = 0; $i < count($res->entry[0]->messaging[0]); $i++) {
            $event = $res->entry[0]->messaging[0];
            $rid = $res->entry[0]->messaging[0]->sender->id;
            if (isset($res->entry[0]->messaging[0]) && $res->entry[0]->messaging[0]->message->text) {
                
                $text = $res->entry[0]->messaging[0]->message->text;
                
                if ($text=='สวัสดี' || $text=='สวัสดีครับ') {
                    $message = array('สวัสดีครับ :D','สวัสดีค่ะ :D');
                    _send($message,$rid);
                     $res = array('ให้ช่วยอะไรไหมครับ','มีอะไรให้ช่วยไหมครับ');
                    _send($res,$rid);
                } 
                
                
                if (ereg('หางาน',$text) || ereg('มีงานไหม',$text)) {
                    $message = array('ไม่ทราบว่าสนใจตำแหน่งอะไหรครับ');
                     _send($message,$rid);
                     choose_occupation($rid);
                }
                
                if ($text=='ขอบคุณ' || $text=='ขอบคุณครับ' || $text=='ขอบใจ' || $text=='ขอบคุณค่ะ') {
                    $message = array("ยินดีให้บริการครับ \nขอบคุณที่ไว้ใจใช้บริการกับ Jobbkk นะครับ :D");
                    _send($message,$rid);    
                    $message_2nd = array("หากต้องการสอบถามข้อมูลเพิ่มเติม \nสามารถ Inbox เข้ามาสอบถามได้นะครับ");
                    _send($message_2nd,$rid); 
                }
                
                if ($text == 'เข้าระบบไม่ได้'){
                    $message = array('ขออภัยในความไม่สะดวกด้วยนะครับ');
                    _send($message,$rid);
                    $message_sec = array('รบกวนขอชื่อ-สกุล และ E-mail เบอร์โทร ที่ใช้สมัครสมาชิก เพื่อให้เจ้าหน้าที่ตรวจสอบด้วยครับ');
                    _send($message_sec,$rid);
                    $message_3rd = array('หากเจ้าหน้าที่ตรวจสอบและแก้ไขเรียบร้อยแล้ว จะรีบติดต่อกลับอีกครั้งนะครับ');
                    _send($message_3rd,$rid);
                    $message_4th = array('ขออภัยในความไม่สะดวกอีกครั้งนะครับ');
                    _send($message_4th,$rid);
                    $message_5th = array("ขอบคุณครับ :'(");
                    _send($message_5th,$rid);
                }
                
                if (ereg('แก้ไขข้อมูลรีซูเม่ยังไง', $text)) {
                    $message = array("สามารถเข้าระบบและเลือกที่เมนู “สร้าง/แก้ไขเรซูเม่” ");
                    _send($message,$rid);
                    $message_2nd = array("จากนั้นเลือกที่เมนู “แก้ไข” และสามารถแก้ไขข้อมูลได้ตามต้องการเลยครับ");
                    _send($message_2nd,$rid);
                    $message_3rd = array(" และหลังจากแก้ไขเสร็จเรียบร้อยแล้ว อย่าลืมกด “บันทึก Resume” ด้วยนะครับ\nสามารถเข้าดูตัวอย่างการใช้งานได้ที่ลิ้งด้านล่างนี้ครับ\nคลิก-> https://www.jobbkk.com/help");
                    _send($message_3rd,$rid);
                }
                
                if (ereg('ได้งานแล้วจะลบเรซูเม่ออก', $text)) {
                    $message = array("สามารถออฟไลน์เรซูเม่ไว้ก่อนได้นะครับ");
                    _send($message,$rid);
                    $message_2nd = array("โดยการเข้าระบบแล้วเลือกที่เมนู “สร้าง/แก้ไขเรซูเม่");
                    _send($message_2nd,$rid);
                    $message_3rd = array("จากนั้นเลือกที่เมนู “ออนไลน์” ตรงช่องสถานะและเปลี่ยนเป็น “ออฟไลน์” ได้เลยครับ");
                    _send($message_3rd,$rid);
                    $message_3rd = array("และเมื่อต้องการหางาน สามารถกดออนไลน์สถานะเรซูเม่ และสามารถสมัครงานได้ทันทีครับ\nสามารถเข้าดูตัวอย่างการใช้งานได้ที่ลิ้งด้านล่างนี้ครับ\nคลิก-> https://www.jobbkk.com/help");
                    _send($message_3rd,$rid);
                }
                
                 if (ereg('รบกวนฝากประกาศรับสมัครงาน', $text)) {
                    $message = array("สามารถติดต่อเจ้าหน้าที่ เพื่อลงประกาศตำแหน่งงานได้ที่ (+66.25147472) นะครับ\nขอบคุณครับ :D");
                    _send($message,$rid);
                    _help($rid);
                }
                
                 if (ereg('สมัครงานเป็นเดือนแล้ว', $text)) {
                    $message = array("ขออนุญาตสอบถามเพิ่มเติมครับ\nไม่ทราบว่าสมัครเรซูเม่กับ JOBBKK รึยังครับ");
                    _send($message,$rid);
                    choose_register($rid);
                }
                
                 if (ereg('ยังไม่มีรีซูเม่', $text)) {
                    $message = array("สามารถสมัครเรซูเม่เพื่อใช้ในการสมัครงานทุกตำแหน่งงานได้ที่ลิงค์นี้นะครับ\nคลิก-> https://www.jobbkk.com/jobseeker/create");
                    _send($message,$rid);
                }
                
                 if (ereg('มีรีซูเม่แล้ว', $text)) {
                    $message = array("รบกวนขอชื่อ-สกุล เบอร์โทร ตำแหน่งที่สมัครและพื้นที่ที่สะดวกปฏิบัติงานด้วยครับ\nเพื่อให้เจ้าหน้าที่พิจารณาข้อมูลที่ตรงกับ ตำแหน่งงานและติดต่อกลับอีกครั้งครับ");
                    _send($message,$rid);
                    $message_2nd = array("ขอบคุณครับ :D");
                    _send($message_2nd,$rid);
                }
                
                if ($text=='กฎหมาย/การปกครอง') {
                    political_raw($rid);
                }
                
                
                
                
    
                 if ($text=='คอมพิวเตอร์/IT') {
                     
                   /* $data = array(
                                'recipient' => array('id' => $rid),
                                'message'   => array('attachment' => array(
                                                            'type'      => 'image',
                                                            'payload'   => array(
                                                                    'url' => 'https://c2b.jobbkk.com/www/images/2ac143b06ce1169937a11b09b3fed65d.gif',
                                                                    'is_reusable' => TRUE
                                                                            )
                                                                )
                                                )
                    );*/
                        
                 $data = array(
                                'recipient' => array('id' => $rid),
                                'message'   => array('attachment' => array(
                                                                            'type'      => 'template',
                                                                            'payload'   => array(
                                                                                                'template_type' => 'list',
                                                                                                'top_element_style' => 'large',
                                                                                                 'elements'      => [
                                                                                                                        array(
                                                                                                                            'title' => 'บริษัท จัดหางาน จ๊อบ บี เคเค ดอท คอม',
                                                                                                                            'image_url' => 'https://www.jobbkk.com/assets/template/jobbkk/theme01/assets/images/mr_job.png',
                                                                                                                            'subtitle'  => 'ตำแหน่ง โปรแกรมเมอร์ เงินเดือน 50,000',
                                                                                                                            'buttons' => [
                                                                                                                                                array(
                                                                                                                                                    'type' => 'web_url',
                                                                                                                                                    'url'  => 'https://www.jobbkk.com/jobs/detail/165429/843897/CFB%20Consulting%20and%20Services%20Recruitment%20Co.,%20Ltd./%E0%B8%AB%E0%B8%B2%E0%B8%87%E0%B8%B2%E0%B8%99,%E0%B8%84%E0%B8%AD%E0%B8%A1%E0%B8%9E%E0%B8%B4%E0%B8%A7%E0%B9%80%E0%B8%95%E0%B8%AD%E0%B8%A3%E0%B9%8C-IT-%E0%B9%82%E0%B8%9B%E0%B8%A3%E0%B9%81%E0%B8%81%E0%B8%A3%E0%B8%A1%E0%B9%80%E0%B8%A1%E0%B8%AD%E0%B8%A3%E0%B9%8C,Php%20Programmer',
                                                                                                                                                    'title' => 'ดูรายละเอียด'
                                                                                                                                                )
                                                                                                                                            ]
                                                                                                                        ),
                                                                                                                          array(
                                                                                                                            'title' => 'กลุ่มบริษัทจันวาณิชย์',
                                                                                                                            'image_url' => 'https://www.jobbkk.com/upload/employer/02/512/029512/images/1692341.jpg',
                                                                                                                            'subtitle'  => 'ตำแหน่ง  Data Engineer เงินเดือน 50,0000 จังหวัด เชียงใหม่',
                                                                                                                            'buttons' => [
                                                                                                                                                array(
                                                                                                                                                    'type' => 'web_url',
                                                                                                                                                    'url'  => 'https://www.jobbkk.com/jobs/detail/169234/863389/%E0%B8%81%E0%B8%A5%E0%B8%B8%E0%B9%88%E0%B8%A1%E0%B8%9A%E0%B8%A3%E0%B8%B4%E0%B8%A9%E0%B8%B1%E0%B8%97%E0%B8%88%E0%B8%B1%E0%B8%99%E0%B8%A7%E0%B8%B2%E0%B8%93%E0%B8%B4%E0%B8%8A%E0%B8%A2%E0%B9%8C/%E0%B8%AB%E0%B8%B2%E0%B8%87%E0%B8%B2%E0%B8%99,%E0%B8%84%E0%B8%AD%E0%B8%A1%E0%B8%9E%E0%B8%B4%E0%B8%A7%E0%B9%80%E0%B8%95%E0%B8%AD%E0%B8%A3%E0%B9%8C-IT-%E0%B9%82%E0%B8%9B%E0%B8%A3%E0%B9%81%E0%B8%81%E0%B8%A3%E0%B8%A1%E0%B9%80%E0%B8%A1%E0%B8%AD%E0%B8%A3%E0%B9%8C,Senior%20Software%20Developer%20Education%20Products%20and%20Services',
                                                                                                                                                    'title' => 'ดูรายละเอียด'
                                                                                                                                                )
                                                                                                                                            ]
                                                                                                                        ),
                                                                                                                        array(
                                                                                                                            'title' => 'บมจ.ธนาคารไทยเครดิต',
                                                                                                                            'image_url' => 'https://www.jobbkk.com/upload/employer/08/FB8/00DFB8/images/57272.jpg',
                                                                                                                            'subtitle'  => 'ตำแหน่ง Web Designer เงินเดือน 25,000',
                                                                                                                            'buttons' => [
                                                                                                                                                array(
                                                                                                                                                    'type' => 'web_url',
                                                                                                                                                    'url'  => 'https://www.jobbkk.com/jobs/detail/57272/757118/%E0%B8%9A%E0%B8%A1%E0%B8%88.%E0%B8%98%E0%B8%99%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%A3%E0%B9%84%E0%B8%97%E0%B8%A2%E0%B9%80%E0%B8%84%E0%B8%A3%E0%B8%94%E0%B8%B4%E0%B8%95%20%E0%B9%80%E0%B8%9E%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%A3%E0%B8%B2%E0%B8%A2%E0%B8%A2%E0%B9%88%E0%B8%AD%E0%B8%A2/%E0%B8%AB%E0%B8%B2%E0%B8%87%E0%B8%B2%E0%B8%99,%E0%B8%84%E0%B8%AD%E0%B8%A1%E0%B8%9E%E0%B8%B4%E0%B8%A7%E0%B9%80%E0%B8%95%E0%B8%AD%E0%B8%A3%E0%B9%8C-IT-%E0%B9%82%E0%B8%9B%E0%B8%A3%E0%B9%81%E0%B8%81%E0%B8%A3%E0%B8%A1%E0%B9%80%E0%B8%A1%E0%B8%AD%E0%B8%A3%E0%B9%8C,Programmer',
                                                                                                                                                    'title' => 'ดูรายละเอียด'
                                                                                                                                                )
                                                                                                                                            ]
                                                                                                                        ),
                                                                                                                        array(
                                                                                                                            'title' => 'Adecco Engineering & IT',
                                                                                                                            'image_url' => 'https://www.jobbkk.com/upload/employer/04/2E4/00D2E4/images/53988.JPG',
                                                                                                                            'subtitle'  => 'ตำแหน่ง  Network Engineer เงินเดือน 70,0000',
                                                                                                                            'buttons' => [
                                                                                                                                                array(
                                                                                                                                                    'type' => 'web_url',
                                                                                                                                                    'url'  => 'https://www.jobbkk.com/jobs/detail/53988/876646/Adecco%20Engineering%20&%20IT/%E0%B8%AB%E0%B8%B2%E0%B8%87%E0%B8%B2%E0%B8%99,%E0%B8%84%E0%B8%AD%E0%B8%A1%E0%B8%9E%E0%B8%B4%E0%B8%A7%E0%B9%80%E0%B8%95%E0%B8%AD%E0%B8%A3%E0%B9%8C-IT-%E0%B9%82%E0%B8%9B%E0%B8%A3%E0%B9%81%E0%B8%81%E0%B8%A3%E0%B8%A1%E0%B9%80%E0%B8%A1%E0%B8%AD%E0%B8%A3%E0%B9%8C,PHP%20Programmer',
                                                                                                                                                    'title' => 'ดูรายละเอียด'
                                                                                                                                                )
                                                                                                                                            ]
                                                                                                                        )
                                                                                                                    
                                                                                                                    ]
                                                                                                                      
                                                                                            )
                                                                                )
                                                                )
                                        );
                                    
                                    $option = array(
                                                'http' => array(
                                                    'method'    => 'POST',
                                                    'content'   => json_encode($data),
                                                    'header'    => "Content-Type: application/json\n"
                                                    )
                                    
                                        );
                                    $context = stream_context_create($option);
                                    $token = EAABmZANIyvd8BAKZAxzIroD8sndNZARxehuhfAX3JNX4SueKaUy4WrEvkA3D1B6laYlobTocanUrmwaoONNVvjKgGZAfUQVv0T3NYmQyVII4oMkXxlx8LUJd7Kbycl4RSsYowvoLKb4ZAnkOMrsiqdZC8B7nBHpkvGRX5Yr2ZBpM3dgsK26NrmD;
                                    file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
                                }
                                
                                if ($text=='ขอความช่วยเหลือ') {
                     
                                     $data = array(
                                                    'recipient' => array('id' => $rid),
                                                    'message'   => array('attachment' => array(
                                                                                                'type'      => 'template',
                                                                                                'payload'   => array(
                                                                                                                        'template_type' => 'button',
                                                                                                                        'text' => 'เบอร์ติดต่อฝ่ายบริการหลังการขาย',
                                                                                                                        'buttons' => [
                                                                                                                                        array(
                                                                                                                                                'type' => 'phone_number',
                                                                                                                                                'title' => 'กดเพื่อโทรออก',
                                                                                                                                                'payload' => '+66.25147472'
                                                                                                                                                ),
                                                                                                                                         array(
                                                                                                                                                'type'      => 'web_url',
                                                                                                                                                'title'     => 'ที่อยู่ของเรา',
                                                                                                                                                'url'       => 'https://www.google.co.th/maps/place/%E0%B8%9A%E0%B8%A3%E0%B8%B4%E0%B8%A9%E0%B8%B1%E0%B8%97+%E0%B8%88%E0%B8%B1%E0%B8%94%E0%B8%AB%E0%B8%B2%E0%B8%87%E0%B8%B2%E0%B8%99+%E0%B8%88%E0%B9%8A%E0%B8%AD%E0%B8%9A%E0%B8%9A%E0%B8%B5%E0%B9%80%E0%B8%84%E0%B9%80%E0%B8%84+%E0%B8%94%E0%B8%AD%E0%B8%97+%E0%B8%84%E0%B8%AD%E0%B8%A1+%E0%B8%88%E0%B8%B3%E0%B8%81%E0%B8%B1%E0%B8%94/@13.7675372,100.5946679,18.83z/data=!4m13!1m7!3m6!1s0x30e29e7a2ede9915:0x30100b25de24e90!2z4LmA4LiC4LiVIOC4q-C5ieC4p-C4ouC4guC4p-C4suC4hyDguIHguKPguLjguIfguYDguJfguJ7guKHguKvguLLguJnguITguKM!3b1!8m2!3d13.769284!4d100.5813324!3m4!1s0x0:0x26c51ebf048d0da0!8m2!3d13.7670059!4d100.5947471',
                                                                                                                                                'webview_height_ratio'   => 'full'
                                                                                                                                                )
                                                                                                                                     ]
                                                                                                                )
                                                                                                    )
                                                                                    )
                                                            );
                                                        
                                                        $option = array(
                                                                    'http' => array(
                                                                        'method'    => 'POST',
                                                                        'content'   => json_encode($data),
                                                                        'header'    => "Content-Type: application/json\n"
                                                                        )
                                                        
                                                            );
                                    $context = stream_context_create($option);
                                    $token = EAABmZANIyvd8BAKZAxzIroD8sndNZARxehuhfAX3JNX4SueKaUy4WrEvkA3D1B6laYlobTocanUrmwaoONNVvjKgGZAfUQVv0T3NYmQyVII4oMkXxlx8LUJd7Kbycl4RSsYowvoLKb4ZAnkOMrsiqdZC8B7nBHpkvGRX5Yr2ZBpM3dgsK26NrmD;
                                    file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
                                }
                
            }
            
            function choose_occupation($rid){

                                    $data = array(
                                                'recipient' => array('id' => $rid),
                                                'message'   => array('text' => 'เลือกเมนูงานด้านล่าง',
                                                                     'quick_replies'   =>   [      
                                                                                                        array(
                                                                                                            'content_type'  => 'text',
                                                                                                            'title'         => 'กฎหมาย/การปกครอง',
                                                                                                            'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                            ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'คอมพิวเตอร์/IT',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                         array('content_type'  => 'text',
                                                                                                                 'title'         => 'การตลาด/การขาย',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'การจัดการ',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'วิศวกร',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'สถาปัตยกรรม/ช่าง',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'เศรษฐศาสตร์/การเงิน/ธนาคาร',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'การบริการ',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'เทคโนโลยี/อุตสาหกรรม',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'ราชการ/รัฐวิสาหกิจ',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'อื่นๆ',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 )
                                                                                                    ]
                                                                        
                                                        )
                                            );
                                            
                                                    
                                    $option = array('http' => array(
                                                                    'method'    => 'POST',
                                                                    'content'   => json_encode($data),
                                                                    'header'    => "Content-Type: application/json\n"
                                                                )
                                    );
                                                            
                                    $context = stream_context_create($option);
                                    $token = EAABmZANIyvd8BAKZAxzIroD8sndNZARxehuhfAX3JNX4SueKaUy4WrEvkA3D1B6laYlobTocanUrmwaoONNVvjKgGZAfUQVv0T3NYmQyVII4oMkXxlx8LUJd7Kbycl4RSsYowvoLKb4ZAnkOMrsiqdZC8B7nBHpkvGRX5Yr2ZBpM3dgsK26NrmD;
                                    file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
                        }
                        
                        
                        
                         function choose_register($rid){

                                    $data = array(
                                                'recipient' => array('id' => $rid),
                                                'message'   => array('text' => 'เลือกเมนูงานด้านล่าง',
                                                                     'quick_replies'   =>   [      
                                                                                                        array(
                                                                                                            'content_type'  => 'text',
                                                                                                            'title'         => 'มีรีซูเม่แล้ว',
                                                                                                            'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                            ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'ยังไม่มีรีซูเม่',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 )
                                                                                                    ]
                                                                        
                                                        )
                                            );
                                            
                                                    
                                    $option = array('http' => array(
                                                                    'method'    => 'POST',
                                                                    'content'   => json_encode($data),
                                                                    'header'    => "Content-Type: application/json\n"
                                                                )
                                    );
                                                            
                                    $context = stream_context_create($option);
                                    $token = EAABmZANIyvd8BAKZAxzIroD8sndNZARxehuhfAX3JNX4SueKaUy4WrEvkA3D1B6laYlobTocanUrmwaoONNVvjKgGZAfUQVv0T3NYmQyVII4oMkXxlx8LUJd7Kbycl4RSsYowvoLKb4ZAnkOMrsiqdZC8B7nBHpkvGRX5Yr2ZBpM3dgsK26NrmD;
                                    file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
                                
                        }
                        
                        function political_raw($rid){

                                    $data = array(
                                                'recipient' => array('id' => $rid),
                                                'message'   => array('text' => 'เลือกเมนูงานด้านล่าง',
                                                                     'quick_replies'   =>   [      
                                                                                                        array(
                                                                                                            'content_type'  => 'text',
                                                                                                            'title'         => 'กฎหมาย',
                                                                                                            'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                            ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'รัฐศาสตร์การปกครอง Political Science/Government',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 )
                                                                                                    ]
                                                                        
                                                        )
                                            );
                                            
                                                    
                                    $option = array('http' => array(
                                                                    'method'    => 'POST',
                                                                    'content'   => json_encode($data),
                                                                    'header'    => "Content-Type: application/json\n"
                                                                )
                                    );
                                                            
                                    $context = stream_context_create($option);
                                    $token = EAABmZANIyvd8BAKZAxzIroD8sndNZARxehuhfAX3JNX4SueKaUy4WrEvkA3D1B6laYlobTocanUrmwaoONNVvjKgGZAfUQVv0T3NYmQyVII4oMkXxlx8LUJd7Kbycl4RSsYowvoLKb4ZAnkOMrsiqdZC8B7nBHpkvGRX5Yr2ZBpM3dgsK26NrmD;
                                    file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
                                
                        }
                        
                        function computer_it($rid){

                                    $data = array(
                                                'recipient' => array('id' => $rid),
                                                'message'   => array('text' => 'เลือกเมนูงานด้านล่าง',
                                                                     'quick_replies'   =>   [      
                                                                                                        array(
                                                                                                            'content_type'  => 'text',
                                                                                                            'title'         => 'กราฟฟิกดีไซน์/ออกแบบ',
                                                                                                            'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                            ),
                                                                                                        array('content_type'  => 'text',
                                                                                                                 'title'         => 'รัฐศาสตร์การปกครอง',
                                                                                                                 'payload'       => '<POSTBACK_PAYLOAD>'
                                                                                                                 )
                                                                                                    ]
                                                                        
                                                        )
                                            );
                                            
                                                    
                                    $option = array('http' => array(
                                                                    'method'    => 'POST',
                                                                    'content'   => json_encode($data),
                                                                    'header'    => "Content-Type: application/json\n"
                                                                )
                                    );
                                                            
                                    $context = stream_context_create($option);
                                    $token = EAABmZANIyvd8BAKZAxzIroD8sndNZARxehuhfAX3JNX4SueKaUy4WrEvkA3D1B6laYlobTocanUrmwaoONNVvjKgGZAfUQVv0T3NYmQyVII4oMkXxlx8LUJd7Kbycl4RSsYowvoLKb4ZAnkOMrsiqdZC8B7nBHpkvGRX5Yr2ZBpM3dgsK26NrmD;
                                    file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
                                
                        }
                        
                        function _help($rid){
                            $data = array(
                                                    'recipient' => array('id' => $rid),
                                                    'message'   => array('attachment' => array(
                                                                                                'type'      => 'template',
                                                                                                'payload'   => array(
                                                                                                                        'template_type' => 'button',
                                                                                                                        'text' => 'เบอร์ติดต่อฝ่ายบริการหลังการขาย',
                                                                                                                        'buttons' => [
                                                                                                                                        array(
                                                                                                                                                'type' => 'phone_number',
                                                                                                                                                'title' => 'กดเพื่อโทรออก',
                                                                                                                                                'payload' => '+66.25147472'
                                                                                                                                                ),
                                                                                                                                         array(
                                                                                                                                                'type'      => 'web_url',
                                                                                                                                                'title'     => 'ที่อยู่ของเรา',
                                                                                                                                                'url'       => 'https://www.google.co.th/maps/place/%E0%B8%9A%E0%B8%A3%E0%B8%B4%E0%B8%A9%E0%B8%B1%E0%B8%97+%E0%B8%88%E0%B8%B1%E0%B8%94%E0%B8%AB%E0%B8%B2%E0%B8%87%E0%B8%B2%E0%B8%99+%E0%B8%88%E0%B9%8A%E0%B8%AD%E0%B8%9A%E0%B8%9A%E0%B8%B5%E0%B9%80%E0%B8%84%E0%B9%80%E0%B8%84+%E0%B8%94%E0%B8%AD%E0%B8%97+%E0%B8%84%E0%B8%AD%E0%B8%A1+%E0%B8%88%E0%B8%B3%E0%B8%81%E0%B8%B1%E0%B8%94/@13.7675372,100.5946679,18.83z/data=!4m13!1m7!3m6!1s0x30e29e7a2ede9915:0x30100b25de24e90!2z4LmA4LiC4LiVIOC4q-C5ieC4p-C4ouC4guC4p-C4suC4hyDguIHguKPguLjguIfguYDguJfguJ7guKHguKvguLLguJnguITguKM!3b1!8m2!3d13.769284!4d100.5813324!3m4!1s0x0:0x26c51ebf048d0da0!8m2!3d13.7670059!4d100.5947471',
                                                                                                                                                'webview_height_ratio'   => 'full'
                                                                                                                                                )
                                                                                                                                     ]
                                                                                                                )
                                                                                                    )
                                                                                    )
                                                            );
                                                        
                                                        $option = array(
                                                                    'http' => array(
                                                                        'method'    => 'POST',
                                                                        'content'   => json_encode($data),
                                                                        'header'    => "Content-Type: application/json\n"
                                                                        )
                                                        
                                                            );
                                    $context = stream_context_create($option);
                                    $token = EAABmZANIyvd8BAKZAxzIroD8sndNZARxehuhfAX3JNX4SueKaUy4WrEvkA3D1B6laYlobTocanUrmwaoONNVvjKgGZAfUQVv0T3NYmQyVII4oMkXxlx8LUJd7Kbycl4RSsYowvoLKb4ZAnkOMrsiqdZC8B7nBHpkvGRX5Yr2ZBpM3dgsK26NrmD;
                                    file_get_contents("https://graph.facebook.com/v2.6/me/messages?access_token=$token",false,$context);
                        }

?>