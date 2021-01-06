<?php

namespace App\Modules\Application\Controllers\Frontend\Api;

use App\Modules\Domain\Models\Bill_details;
use App\Modules\Domain\Models\Bills;
use App\Modules\Domain\Models\Customers;
use App\Modules\Domain\Services\Commands\ContactServiceCommand;
use App\Modules\Domain\Services\Queries\ConfigServiceQuery;
use App\Modules\Infrastructure\Core\IController;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Modules\Domain\Services\Queries\ProductsServiceQuery;

class ContactApiController extends IController
{
    private $_service;

    function __construct() {
        parent::__construct();
        $this->_service = new ContactServiceCommand();
    }

    public function store(Request $request)
    {
        $input = $request->input();

        $configService = new ConfigServiceQuery();
        $config = $configService->getMail();

        // Send Email
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            //Server settings
            $mail->SMTPDebug = false;                             // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $config->smtp_host;                     // Specify main and backup SMTP servers
            $mail->SMTPAuth = $config->smtp_auth;                 // Enable SMTP authentication
            $mail->Username = $config->smtp_user;                 // SMTP username
            $mail->Password = $config->smtp_pass;                 // SMTP password
            $mail->SMTPSecure = $config->smtp_secure;             // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $config->smtp_port;                     // TCP port to connect to

            //Recipients
            $mail->setFrom($input['email'], $input['fullname']);
            $mail->addAddress($config->mail_from, $config->from_name);     // Add a recipient
//            $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo($input['email'], $input['fullname']);
            //        $mail->addCC('cc@example.com');
            //        $mail->addBCC('bcc@example.com');

            //Attachments
            //        $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $input['fullname'] . ' - Đăng ký tư vấn';
            $detail = '';
            if (isset($input['address']) || isset($input['title']) || isset($input['content'])) {
                $detail .= '<br>Địa chỉ: ' . $input['address'];
                $detail .= '<br>Tiêu đề: ' . $input['title'];
                $detail .= '<br>Nội dung: ' . $input['content'];
            }
            if (isset($input['is_checkout'])) {
                $mail->Subject = $input['fullname'] . ' - Đơn hàng mới';
                if ($cart = session('cart')) {
                    $customer = new Customers();
                    $customer->name = $input['fullname'];
                    $customer->email = $input['email'];
                    $customer->address = $input['address'];
                    $customer->phone_number = $input['phone'];
                    $customer->note = $input['content'];
                    $customer->save();

                    $service = new ProductsServiceQuery();

                    $ids = array_keys($cart);
                    $list = $service->getListByIn($ids);
                    $priceTotal = 0;
                    $data = [];
                    $html = '';

                    foreach ($list as $product) {
                        $product->quantity_cart = $cart[$product->id]['quantity'];
                        $data[] = $product;

                        if ($product->price_contact != 1) {
                            $priceTotal += $product->quantity_cart * $product->price;
                        }
                    }

                    $bill = new Bills();
                    $bill->customer_id = $customer->id;
                    $bill->date_order = date('Y-m-d H:i:s');
                    $bill->total = $priceTotal;
                    $bill->note = $input['content'];
                    $bill->save();

                    $html .= '<table style="width:100%;color:#333;border:1px solid #e9e9e9;">
                            <thead>
                            <tr style="background-color: #fff;">
                                <th style="text-align:center;padding:5px;white-space:nowrap;font-size: 13px;border:1px solid #e9e9e9;">Tên</th>
                                <th style="text-align:center;padding:5px;white-space:nowrap;font-size: 13px;border:1px solid #e9e9e9;">Số lượng</th>
                                <th style="text-align:center;padding:5px;white-space:nowrap;font-size: 13px;border:1px solid #e9e9e9;">Tổng</th>
                            </tr>
                            </thead><!--head-->
                            <tfoot>
                            <tr style="border:1px solid #e9e9e9;">
                                <td colspan="5" style="text-align:right;padding:10px 5px;font-weight: bold;color:#E53C2F;font-size: 17px;"><b>Tổng giá : <span class="price_all_cart">' . number_format($priceTotal) . 'đ</span></b></td>
                            </tr>
                            </tfoot><!--footer-->
                            <tbody>';
                    foreach ($data as $product) {
                        $html .= '<tr style="border-bottom:1px solid #ecedef;">
                            <td style="text-align:left;padding:5px 5px;border:1px solid #e9e9e9;">
                                <h3 class="name_p_cart" style="font-size:14px;font-weight:bold;">' . $product->title . '</h3>
                                <div class="price_p_cart_name" style="font-size:15px;color:#f00;">' . number_format($product->price) . ' đ</div>
                            </td>
                            <td style="text-align:center;padding:5px 5px;border:1px solid #e9e9e9;">
                                <div class="box_number_cart">'.
                                    $product->quantity_cart
                                . '</div><!--box number cart-->
                            </td>
                            <td style="text-align:center;padding:5px 5px;border:1px solid #e9e9e9;"><div class="price_p_cart" style="text-align: center; font-size: 16px; color: #43484D;"> ' .  number_format($product->price * $product->quantity_cart) . ' đ</div></td>
                        </tr>';

                        $billDetail = new Bill_details();
                        $billDetail->bill_id = $bill->id;
                        $billDetail->product_id = $product->id;
                        $billDetail->quality = $product->quantity_cart;
                        $billDetail->price = $product->price;
                        $billDetail->save();
                        
                    }

                    $html .= '</tbody></table>';

                    $detail .= '<br>Chi tiết đơn hàng: ' . $html;

                    $detail .= '<br>Xem chi tiết đơn hàng tại đây: ' .  route('BillEdit', $customer->id) ;

                }
            }
            $mail->Body    = 'Họ tên: ' . $input['fullname']
                . '<br>Email: ' . $input['email']
                . '<br>Điện thoại: ' . $input['phone']
                . $detail;
//                . '<br>Dự án quan tâm: ' . $input['content'];
            $mail->AltBody = '';

            $mail->send();

            $request->session()->forget('cart');
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        if (($id = $this->_service->insert($input)) === false) {
            return response()->json(['result' => 0]);
        }

        return response()->json([
            'result' => 1,
            'id' => $id
        ]);
    }
}
