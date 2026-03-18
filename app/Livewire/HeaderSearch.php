<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Movie;
use App\Models\Post;
use App\Models\Product;
use App\Models\SocialService;
use App\Models\GeminiTrick;
use Livewire\Component;

class HeaderSearch extends Component
{
    public $query = '';
    public $results = [];

    public function updated($property)
    {
        if ($property === 'query') {
            if (strlen($this->query) < 2) {
                $this->results = [];
                return;
            }

            $search = '%' . $this->query . '%';

            // 1. Sản phẩm AI (Store)
            $products = Product::where('status', true)->where('name', 'like', $search)->take(2)->get()->map(function($p) {
                return ['title' => $p->name, 'url' => route('store.ai'), 'type' => 'Sản phẩm AI', 'icon' => 'fa-solid fa-robot'];
            });

            // 2. Bài viết (Blog)
            $posts = Post::where('status', true)->where('title', 'like', $search)->take(2)->get()->map(function($p) {
                return ['title' => $p->title, 'url' => route('post.show', $p->slug), 'type' => 'Thủ thuật Blog', 'icon' => 'fa-solid fa-newspaper'];
            });

            // 3. Review phim
            $movies = Movie::where('status', true)->where('title', 'like', $search)->take(2)->get()->map(function($p) {
                return ['title' => $p->title, 'url' => route('movies.show', $p->slug), 'type' => 'Review Phim', 'icon' => 'fa-solid fa-film'];
            });

            // 4. Khóa học
            $courses = Course::where('status', true)->where('title', 'like', $search)->take(2)->get()->map(function($p) {
                return ['title' => $p->title, 'url' => route('course.detail', $p->slug), 'type' => 'Khóa học IT', 'icon' => 'fa-solid fa-graduation-cap'];
            });

            // 5. Dịch vụ MXH (Buff)
            $socials = SocialService::where('status', true)->where('name', 'like', $search)->take(2)->get()->map(function($p) {
                return ['title' => $p->name, 'url' => route('social.buff', $p->slug), 'type' => 'Dịch vụ MXH', 'icon' => 'fa-solid fa-share-nodes'];
            });

            // 6. Mẹo Gemini/AI
            $tricks = GeminiTrick::where('status', true)->where('title', 'like', $search)->take(2)->get()->map(function($p) {
                return ['title' => $p->title, 'url' => route('gemini.business', $p->slug), 'type' => 'Mẹo AI & Gemini', 'icon' => 'fa-solid fa-wand-magic-sparkles'];
            });

            $this->results = collect([])
                ->concat($products)
                ->concat($posts)
                ->concat($movies)
                ->concat($courses)
                ->concat($socials)
                ->concat($tricks)
                ->toArray();
        }
    }

    public function search()
    {
        if (empty($this->query)) return;
        return redirect()->intended('/?q=' . urlencode($this->query));
    }

    public function render()
    {
        return view('livewire.header-search');
    }
}
