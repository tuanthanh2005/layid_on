@extends('layouts.admin')

@section('styles')
<style>
    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .stat-title {
        color: var(--text-secondary);
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .stat-trend {
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .trend-up { background: rgba(10, 207, 151, 0.1); color: #0acf97; }
    .trend-down { background: rgba(250, 92, 124, 0.1); color: #fa5c7c; }

    .stat-chart-placeholder {
        height: 40px;
        display: flex;
        align-items: flex-end;
        gap: 3px;
    }

    .bar {
        width: 4px;
        background: var(--accent-color);
        border-radius: 2px;
        opacity: 0.3;
        transition: height 0.3s;
    }

    /* Main Chart Section */
    .section-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        padding: 25px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .card-title {
        font-size: 15px;
        font-weight: 700;
    }

    /* Visitor Stats Section */
    .visitor-map {
        width: 100%;
        height: 350px;
        background: #f8f9fa url('https://upload.wikimedia.org/wikipedia/commons/e/ec/World_map_blank_without_borders.svg') no-repeat center;
        background-size: contain;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }

    .map-dot {
        position: absolute;
        width: 12px;
        height: 12px;
        background: var(--accent-color);
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 10px rgba(62, 142, 247, 0.5);
    }

    .dot-usa { top: 35%; left: 20%; }
    .dot-europe { top: 30%; left: 50%; }
    .dot-india { top: 50%; left: 70%; }
    .dot-australia { top: 75%; left: 85%; }

    /* Progress Items */
    .progress-list {
        list-style: none;
    }

    .progress-item {
        margin-bottom: 25px;
    }

    .progress-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .progress-label {
        font-weight: 600;
        color: var(--text-secondary);
    }

    .progress-value {
        font-weight: 700;
    }

    .progress-bar-bg {
        height: 4px;
        background: #f1f3fa;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: var(--accent-color);
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<h1 class="page-title">Dashboard Overview</h1>

<div class="dashboard-grid">
    <!-- Card 1 -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <p class="stat-title">Total Visits</p>
                <h3 class="stat-value">25,486</h3>
            </div>
            <span class="stat-trend trend-up"><i data-lucide="arrow-up-right" size="12"></i> 10%</span>
        </div>
        <div class="stat-chart-placeholder">
            @for($i=0; $i<15; $i++)
                <div class="bar" style="height: {{ rand(10, 40) }}px; opacity: {{ 0.2 + ($i * 0.05) }}"></div>
            @endfor
        </div>
    </div>

    <!-- Card 2 -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <p class="stat-title">Total Page Views</p>
                <h3 class="stat-value">84,520</h3>
            </div>
            <span class="stat-trend trend-down"><i data-lucide="arrow-down-right" size="12"></i> 7%</span>
        </div>
        <div class="stat-chart-placeholder">
            @for($i=0; $i<15; $i++)
                <div class="bar" style="height: {{ rand(10, 40) }}px; background: #fa5c7c; opacity: {{ 0.2 + ($i * 0.05) }}"></div>
            @endfor
        </div>
    </div>

    <!-- Card 3 -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <p class="stat-title">Unique Visitors</p>
                <h3 class="stat-value">12,150</h3>
            </div>
            <span class="stat-trend trend-up"><i data-lucide="arrow-up-right" size="12"></i> 12%</span>
        </div>
        <div class="stat-chart-placeholder">
            @for($i=0; $i<15; $i++)
                <div class="bar" style="height: {{ rand(10, 40) }}px; background: #0acf97; opacity: {{ 0.2 + ($i * 0.05) }}"></div>
            @endfor
        </div>
    </div>

    <!-- Card 4 -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <p class="stat-title">Bounce Rate</p>
                <h3 class="stat-value">33.5%</h3>
            </div>
            <span class="stat-trend trend-up"><i data-lucide="arrow-up-right" size="12"></i> 5%</span>
        </div>
        <div class="stat-chart-placeholder">
            @for($i=0; $i<15; $i++)
                <div class="bar" style="height: {{ rand(10, 40) }}px; background: #727cf5; opacity: {{ 0.2 + ($i * 0.05) }}"></div>
            @endfor
        </div>
    </div>
</div>

<div class="section-grid">
    <!-- Map Section -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Site Visits</h4>
            <div class="card-actions">
                <button class="icon-btn"><i data-lucide="more-vertical" size="18"></i></button>
            </div>
        </div>
        <div class="visitor-map">
            <div class="map-dot dot-usa"></div>
            <div class="map-dot dot-europe"></div>
            <div class="map-dot dot-india"></div>
            <div class="map-dot dot-australia"></div>
        </div>
    </div>

    <!-- Visitor Stats -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Regional Statistics</h4>
        </div>
        <ul class="progress-list">
            <li class="progress-item">
                <div class="progress-info">
                    <span class="progress-label">United States</span>
                    <span class="progress-value">50%</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: 50%; background: #727cf5;"></div>
                </div>
            </li>
            <li class="progress-item">
                <div class="progress-info">
                    <span class="progress-label">Europe</span>
                    <span class="progress-value">80%</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: 80%; background: #0acf97;"></div>
                </div>
            </li>
            <li class="progress-item">
                <div class="progress-info">
                    <span class="progress-label">Australia</span>
                    <span class="progress-value">40%</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: 40%; background: #39afd1;"></div>
                </div>
            </li>
            <li class="progress-item">
                <div class="progress-info">
                    <span class="progress-label">India</span>
                    <span class="progress-value">90%</span>
                </div>
                <div class="progress-bar-bg">
                    <div class="progress-bar-fill" style="width: 90%; background: #fa5c7c;"></div>
                </div>
            </li>
        </ul>
    </div>
</div>

@endsection
