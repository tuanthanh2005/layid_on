<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Component;

class MovieDetail extends Component
{
    public Movie $movie;

    public function mount(string $slug)
    {
        $this->movie = Movie::where('slug', $slug)->where('status', true)->firstOrFail();
        // Tăng view count
        $this->movie->increment('views');
    }

    public function render()
    {
        $interestedMovies = Movie::where('status', true)->where('is_interested', true)->where('id', '!=', $this->movie->id)->latest()->take(5)->get();
        $trendingMovies = Movie::where('status', true)->where('is_trending', true)->where('id', '!=', $this->movie->id)->latest()->take(5)->get();

        return view('livewire.movie-detail', compact('interestedMovies', 'trendingMovies'));
    }
}
