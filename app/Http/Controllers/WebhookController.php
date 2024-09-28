<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        try {
            // Đường dẫn tới thư mục chứa code
            $repoDir = '/var/www/api.goro.fun';

            // Xác thực webhook (nếu cần)
            $secret = 'jdy4758fjgnd5'; // Nếu bạn đã thiết lập secret khi tạo webhook
            $signature = 'sha1=' . hash_hmac('sha1', $request->getContent(), $secret);

            // Kiểm tra chữ ký hợp lệ
            if (hash_equals($signature, $request->header('X-Hub-Signature'))) {
                // Nhận webhook thành công, thực hiện git pull
                // shell_exec("cd {$repoDir} && sudo git pull");
                $output = [];
                $returnVar = 0;
                exec("cd {$repoDir} && sudo git pull", $output, $returnVar);

                return response()->json(['status' => 'Success'], 200);
            } else {
                // Webhook không hợp lệ
                return response()->json(['status' => 'Forbidden'], 403);
            }
        }
        catch (Exception $e) {
            // 例外が発生した場合、ログを出力する
            Log::error(__CLASS__ . ', ' . __FUNCTION__ . ', SYS-WEBHOOK, ' . $e->getMessage());
        }
    }
}
