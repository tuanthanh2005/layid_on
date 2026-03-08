<?php

namespace App\Livewire\Placeholders;

use Livewire\Component;

class Feature extends Component
{
    public $type;
    public $title = 'Tính Năng Đang Phát Triển';
    public $desc = 'Tính năng đang trong quá trình phát triển (Beta). Vui lòng quay lại sau!';

    public function mount($type)
    {
        $this->type = $type;
        $this->setFeatureData();
    }

    private function setFeatureData()
    {
        switch ($this->type) {
            case 'gemini':
                $this->title = 'Gemini Business Free';
                $this->desc = 'Nhận tài khoản miễn phí và bộ công cụ loại bỏ Watermark ảnh của Google Gemini.';
                break;
            case 'watermark':
                $this->title = 'Xóa Watermark AI';
                $this->desc = 'Dùng AI xóa logo ẩn dưới hình ảnh từ Gemini/Midjourney cực nhanh.';
                break;
            case 'blog':
                $this->title = 'Blog & Hướng Dẫn';
                $this->desc = 'Danh sách bài viết, thủ thuật công nghệ sẽ được đăng tải tại đây.';
                break;
            case 'ai-tips':
                $this->title = 'Mẹo Sử dụng AI';
                $this->desc = 'Kho lưu trữ Prompts, tips ChatGPT/Claude sắp ra mắt.';
                break;
            case 'buff':
                $this->title = 'Tương Tác MXH';
                $this->desc = 'Buff Like, Share, Cmt cho TikTok, FB, Instagram tự động.';
                break;
            case 'proxy':
                $this->title = 'Proxy Nuôi Acc';
                $this->desc = 'Dành riêng cho MMO: Proxy Private, IPv4/IPv6 giá rẻ.';
                break;
        }
    }

    public function render()
    {
        return view('livewire.placeholders.feature');
    }
}
