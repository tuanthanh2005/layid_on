<?php

namespace App\Livewire\Tools;

use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorAuth extends Component
{
    public $secret = '';
    public $results = []; // Array to store multiple results
    public $error = '';

    public function generateCode()
    {
        $this->error = '';
        $this->results = [];

        if (empty($this->secret)) {
            $this->error = 'Vui lòng nhập 2FA Secret.';
            return;
        }

        $lines = explode("\n", str_replace("\r", "", $this->secret));
        $google2fa = new Google2FA();

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Xử lý nếu line có dạng user|pass|secret hoặc chỉ secret
            // Lấy phần cuối cùng hoặc phần có độ dài giống secret (thường > 10 ký tự Base32)
            $parts = explode('|', $line);
            $targetSecret = end($parts); // Giả định secret nằm ở cuối
            $cleanSecret = str_replace(' ', '', $targetSecret);

            try {
                $code = $google2fa->getCurrentOtp($cleanSecret);
                $this->results[] = [
                    'input' => $line,
                    'code' => $code
                ];
            } catch (\Exception $e) {
                $this->results[] = [
                    'input' => $line,
                    'code' => 'Invalid Secret'
                ];
            }
        }

        if (count($this->results) > 0) {
            session()->flash('success', 'Đã lấy mã thành công!');
        } else {
            $this->error = 'Không tìm thấy Secret hợp lệ.';
        }
    }

    public function render()
    {
        return view('livewire.tools.two-factor-auth')->layout('layouts.app');
    }
}
