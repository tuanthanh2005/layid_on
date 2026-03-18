<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Component;
use Livewire\WithPagination;

class Movies extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $genre = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'genre' => ['except' => ''],
    ];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingGenre() { $this->resetPage(); }

    public function render()
    {
        $query = Movie::where('status', true);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('original_title', 'like', '%' . $this->search . '%')
                  ->orWhere('summary', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->genre) {
            $query->where('genre', 'like', '%' . $this->genre . '%');
        }

        $featuredMovie = Movie::where('status', true)->where('is_main_featured', true)->latest()->first();
        $movies = $query->latest()->paginate(10);
        $sidebarMovies = Movie::where('status', true)->where('is_featured', true)->latest()->take(6)->get();
        
        // Lấy danh sách genres từ DB (cho filter)
        $allMovies = Movie::where('status', true)->get();
        $genres = [];
        foreach($allMovies as $m) {
            $gs = explode(',', $m->genre);
            foreach($gs as $g) {
                $g = trim($g);
                if ($g && !in_array($g, $genres)) $genres[] = $g;
            }
        }

        return view('livewire.movies', compact('featuredMovie', 'movies', 'sidebarMovies', 'genres'));
    }
}
