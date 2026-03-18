<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $movies = [
            [
                'title' => 'Thiên thần hộ mệnh',
                'slug' => 'thien-than-ho-menh',
                'original_title' => 'The Guardian',
                'genre' => 'Kinh dị, Tâm lý',
                'country' => 'Việt Nam',
                'release_year' => 2021,
                'director' => 'Victor Vũ',
                'duration_text' => '1h 45p',
                'rating' => 4.5,
                'rating_label' => 'Rất hay!',
                'thumbnail' => 'https://thanhnien.mediacdn.vn/Uploaded/longnt/2021_04_30/thien-than-ho-menh_SMLX.jpg',
                'summary' => 'Thiên thần hộ mệnh là một bộ phim tâm lý - giật gân, siêu nhiên năm 2021 của đạo diễn Victor Vũ. Bộ phim tập trung vào chủ đề tâm linh Kumanthong.',
                'content' => '<h2>Nội dung kịch tính</h2><p>Bộ phim xoay quanh Mai Ly, một nữ ca sĩ triển vọng nhưng sự nghiệp đang đứng trước nguy cơ bị lu mờ bởi người bạn thân. Cô tìm đến "Thiên thần hộ mệnh" (Kumanthong) để cầu danh vọng, nhưng cái giá phải trả là vô cùng đắt.</p><blockquote>"Phim của Victor Vũ chưa bao giờ làm khán giả thất vọng về mặt hình ảnh và âm thanh."</blockquote><p>Với diễn xuất ấn tượng của Trúc Anh và Salim, phim mang đến những giây phút nghẹt thở.</p>',
                'trailer_url' => 'https://www.youtube.com/watch?v=S01Z6M-mYI0',
                'tags' => 'VictorVu, PhimViet, KinhDi',
                'status' => true,
                'is_featured' => true,
                'is_main_featured' => true,
                'is_interested' => true,
                'is_trending' => true,
            ],
            [
                'title' => 'Avatar: Dòng Chảy Của Nước',
                'slug' => 'avatar-dong-chay-cua-nuoc',
                'original_title' => 'Avatar: The Way of Water',
                'genre' => 'Hành động, Sci-Fi',
                'country' => 'Mỹ',
                'release_year' => 2022,
                'director' => 'James Cameron',
                'duration_text' => '3h 12p',
                'rating' => 5.0,
                'rating_label' => 'Tuyệt đỉnh',
                'thumbnail' => 'https://image.tmdb.org/t/p/original/t6HIqrRAclwbhsURoUu3w97T9wH.jpg',
                'summary' => 'Câu chuyện lấy bối cảnh hơn một thập kỷ sau các sự kiện của phần phim đầu tiên, Jake Sully và Ney\'tiri phải bảo vệ gia đình mới của họ trên hành tinh Pandora.',
                'content' => '<h2>Siêu phẩm hình ảnh 3D</h2><p>Không quá khi nói Avatar phần 2 là một cuộc cách mạng về CGI. Từng tia nước, từng sinh vật biển được tái hiện sống động đến mức không thể tin được.</p><h3>Cốt truyện cảm động</h3><p>Mối liên kết gia đình là sợi chỉ đỏ xuyên suốt bộ phim, khiến nó không chỉ là một phim hành động đơn thuần.</p>',
                'trailer_url' => 'https://www.youtube.com/watch?v=d9MyW72ELq0',
                'tags' => 'Avatar, JamesCameron, SciFi',
                'status' => true,
                'is_featured' => true,
                'is_interested' => true,
                'is_trending' => true,
            ],
            [
                'title' => 'Lật Mặt 7: Một Điều Ước',
                'slug' => 'lat-mat-7-mot-dieu-uoc',
                'genre' => 'Tâm lý, Gia đình',
                'country' => 'Việt Nam',
                'release_year' => 2024,
                'director' => 'Lý Hải',
                'duration_text' => '2h 18p',
                'rating' => 4.8,
                'rating_label' => 'Rất cảm động',
                'thumbnail' => 'https://m.media-amazon.com/images/M/MV5BNmU4MzhjZjItY2I3Mi00MDJjLWExOWEtODhmODk4YTY2NWI0XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
                'summary' => 'Tác phẩm mới của Lý Hải kể về câu chuyện của bà Hai và những người con, mang thông điệp ý nghĩa về tình mẫu tử.',
                'content' => '<h2>Lý Hải tiếp tục bùng nổ</h2><p>Không dùng hành động dồn dập, phần 7 hướng sâu vào khai thác nội tâm và mâu thuẫn gia đình. Phim đã lấy đi nước mắt của hàng triệu khán giả.</p>',
                'trailer_url' => 'https://www.youtube.com/watch?v=p4vIInm339Y',
                'tags' => 'LyHai, LatMat7, PhimViet',
                'status' => true,
                'is_featured' => true,
                'is_interested' => true,
                'is_trending' => true,
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}
