<div class="container" style="padding: 40px 15px;">
    <div class="row">
        <!-- Main Content Column -->
        <div class="col-lg-8 mb-5">
            <h1 class="mb-3" style="font-weight: 700; color: var(--text-primary); line-height: 1.3;">{{ $post->title }}</h1>
            
            <div class="d-flex align-items-center mb-4 text-muted" style="font-size: 0.95rem;">
                <span class="me-3"><i class="fa-regular fa-calendar-days me-1"></i> {{ $post->created_at->format('d/m/Y') }}</span>
                <span class="me-3"><i class="fa-regular fa-eye me-1"></i> {{ number_format($post->views) }} lượt xem</span>
                @if($post->status == 1)
                    <span class="badge bg-success ms-auto">Đã xuất bản</span>
                @endif
            </div>

            <!-- Thumbnail if present -->
            @if($post->thumbnail || ($post->icon && $post->color))
            <div class="mb-4 rounded-4 overflow-hidden" style="width: 100%; aspect-ratio: 16/9; background: {{ $post->thumbnail ? 'url(\''.asset($post->thumbnail).'\') center/cover' : ($post->color ?? 'linear-gradient(135deg, #1d4ed8, #1e3a8a)') }}; display: flex; align-items:center; justify-content:center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                @if(!$post->thumbnail && $post->icon)
                    <i class="{{ $post->icon }}" style="font-size: 5rem; color: rgba(255,255,255,0.8);"></i>
                @endif
            </div>
            @endif

            <!-- Content Area (with auto formatting) -->
            <div id="post-content" style="line-height: 1.8; font-size: 1.1rem; color: #374151;">
                {!! $post->content !!}
            </div>
        </div>

        <!-- Sidebar Column (Table of Contents) -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 100;">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3 fw-bold d-flex align-items-center" style="color: var(--text-primary);">
                            <i class="fa-solid fa-list-ul me-2 text-primary"></i> Mục Lục Nội Dung
                        </h5>
                        
                        <!-- Table of contents will be generated here by JS -->
                        <nav id="toc-container" class="nav flex-column" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                            <!-- Auto generated items go here -->
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Styling for auto CMS content */
#post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 15px 0;
}
#post-content h2, #post-content h3, #post-content h4 {
    margin-top: 35px;
    margin-bottom: 20px;
    font-weight: 700;
    color: #111827;
}
#post-content p {
    margin-bottom: 1.25rem;
}
#post-content ul, #post-content ol {
    margin-bottom: 1.25rem;
    padding-left: 1.5rem;
}
#post-content li {
    margin-bottom: 0.5rem;
}

/* TOC Styling */
.toc-link {
    color: #4b5563;
    padding: 6px 0;
    font-size: 0.95rem;
    text-decoration: none;
    border-left: 2px solid transparent;
    padding-left: 10px;
    transition: all 0.2s;
    display: block;
}
.toc-link:hover, .toc-link.active {
    color: var(--bs-primary);
    border-left-color: var(--bs-primary);
    background: rgba(var(--bs-primary-rgb), 0.05);
}
.toc-h2 {
    font-weight: 600;
}
.toc-h3 {
    padding-left: 20px;
    font-size: 0.9rem;
}
.toc-h4 {
    padding-left: 30px;
    font-size: 0.85rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const content = document.getElementById('post-content');
    const tocContainer = document.getElementById('toc-container');
    
    // Find all headings
    const headings = content.querySelectorAll('h2, h3, h4');
    
    if (headings.length === 0) {
        tocContainer.innerHTML = '<p class="text-muted small">Không tìm thấy mục lục nào.</p>';
        return;
    }
    
    let tocHTML = '';
    
    headings.forEach((heading, index) => {
        // Generate an ID for the heading if it doesn't have one
        if (!heading.id) {
            // Slugify the text content
            let id = heading.textContent.toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/[\s_-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
            // Append index to guarantee uniqueness
            heading.id = id + '-' + index;
        }
        
        const level = heading.tagName.toLowerCase(); // h2, h3, h4
        const title = heading.textContent;
        
        tocHTML += `<a href="#${heading.id}" class="toc-link toc-${level}">${title}</a>`;
    });
    
    tocContainer.innerHTML = tocHTML;

    // Add smooth scrolling behavior for TOC links
    document.querySelectorAll('.toc-link').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                // Determine offset for fixed header
                const headerOffset = 100;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
  
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
                
                // Update history without jumped scroll
                history.pushState(null, null, '#' + targetId);
            }
        });
    });

    // Optional: Highlight active TOC item on scroll
    window.addEventListener('scroll', () => {
        let current = '';
        headings.forEach(heading => {
            const headingTop = heading.getBoundingClientRect().top;
            if (headingTop <= 150) { // Offset trigger slightly below header
                current = heading.getAttribute('id');
            }
        });

        document.querySelectorAll('.toc-link').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').substring(1) === current) {
                link.classList.add('active');
            }
        });
    });
});
</script>
