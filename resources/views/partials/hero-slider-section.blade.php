<section class="custom-hero-banner">
    <div class="container hero-split-container">
        
        <!-- Left: Carousel Slider -->
        <div class="hero-left-slider">
            <div class="slider-viewport" id="heroSlider">
                <div class="slides-container" id="slidesContainer">
                    @forelse($slides as $slide)
                        <div class="custom-slide" style="background-image: linear-gradient(90deg, rgba(6, 12, 29, 0.95) 0%, rgba(13, 27, 62, 0.4) 100%), url('{{ $slide->image_path }}');">
                            <div class="slide-content-wrapper">
                                <span class="slide-label">{{ __('Cover Story') }}</span>
                                <h2 class="slide-heading">{{ $slide->title }}</h2>
                                @if($slide->subtitle)
                                    <p class="slide-description">{{ $slide->subtitle }}</p>
                                @endif
                                
                                @if($slide->date || $slide->location)
                                    <div class="slide-meta-box">
                                        @if($slide->date)
                                            <div class="meta-item">
                                                <span class="meta-icon">📅</span>
                                                <div class="meta-info">
                                                    <span class="meta-label">{{ __('DATE') }}</span>
                                                    <span class="meta-val">{{ $slide->date }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        @if($slide->location)
                                            <div class="meta-item">
                                                <span class="meta-icon">📍</span>
                                                <div class="meta-info">
                                                    <span class="meta-label">{{ __('LOCATION') }}</span>
                                                    <span class="meta-val">{{ $slide->location }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if($slide->link)
                                    <div class="slide-actions">
                                        <a href="{{ $slide->link }}" class="btn-slide-primary">{{ __('Learn More') }} ➜</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <!-- Default Slide Fallback -->
                        <div class="custom-slide" style="background-image: linear-gradient(135deg, #132b5b 0%, #0f1e3d 100%);">
                            <div class="slide-content-wrapper">
                                <span class="slide-label">{{ __('Cover Story') }}</span>
                                <h2 class="slide-heading">{{ __('Vigyanmev Jayate') }} - विज्ञानमेव जयते</h2>
                                <p class="slide-description">{{ __('National Hindi-English Science & Technology Publication') }}, promoting scientific temper and technological awareness across India.</p>
                                <div class="slide-actions">
                                    <a href="{{ route('news.detail', 'about-us') }}" class="btn-slide-primary">{{ __('Learn More & Explore') }} ➜</a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Navigation Arrows -->
                <button class="slider-arrow arrow-prev" id="prevBtn" aria-label="Previous Slide">❮</button>
                <button class="slider-arrow arrow-next" id="nextBtn" aria-label="Next Slide">❯</button>

                <!-- Slider Controls Footer -->
                <div class="slider-controls-footer">
                    <!-- Dots -->
                    <div class="slider-dots" id="sliderDots">
                        @if(count($slides) > 1)
                            @foreach($slides as $index => $slide)
                                <span class="dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></span>
                            @endforeach
                        @else
                            <span class="dot active" data-slide="0"></span>
                        @endif
                    </div>
                    <!-- Play/Pause -->
                    <button class="btn-slider-pause" id="sliderPlayPauseBtn" aria-label="Play/Pause Slider">
                        <span class="pause-icon">II</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Right: "What's New" Scroller -->
        <div class="hero-right-whatsnew">
            <div class="whatsnew-header">
                <h3>{{ __('What\'s New') }}</h3>
                <div class="whatsnew-controls">
                    <button class="whatsnew-ctrl-btn" id="whatsNewPlayPause" aria-label="Play/Pause News">
                        <span class="play-symbol" style="display: none;">▶</span>
                        <span class="pause-symbol">II</span>
                    </button>
                </div>
            </div>
            
            <div class="whatsnew-scroll-container" id="whatsNewScrollContainer">
                <ul class="whatsnew-list" id="whatsNewList">
                    @forelse($announcements as $ann)
                        <li class="whatsnew-item">
                            <span class="whatsnew-icon">
                                @if($ann->icon_type === 'calendar') 📅
                                @elseif($ann->icon_type === 'star') ⭐
                                @elseif($ann->icon_type === 'file') 📄
                                @elseif($ann->icon_type === 'link') 🔗
                                @else 📢
                                @endif
                            </span>
                            <div class="whatsnew-content">
                                @if($ann->file_path)
                                    <a href="{{ $ann->file_path }}" target="_blank" class="whatsnew-link">
                                        {{ $ann->title }}
                                        @if($ann->is_highlighted)
                                            <span class="highlight-new-tag">New</span>
                                        @endif
                                    </a>
                                @elseif($ann->link)
                                    <a href="{{ $ann->link }}" target="_blank" class="whatsnew-link">
                                        {{ $ann->title }}
                                        @if($ann->is_highlighted)
                                            <span class="highlight-new-tag">New</span>
                                        @endif
                                    </a>
                                @else
                                    <span class="whatsnew-text">
                                        {{ $ann->title }}
                                        @if($ann->is_highlighted)
                                            <span class="highlight-new-tag">New</span>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </li>
                    @empty
                        <li class="whatsnew-item">
                            <span class="whatsnew-icon">📢</span>
                            <div class="whatsnew-content">
                                <span class="whatsnew-text">{{ __('No active announcements at this time.') }}</span>
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</section>

<!-- Front-end interactive Javascript Logic -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    /* ==========================================================================
       1. Left Slider Controller
       ========================================================================== */
    const sliderContainer = document.getElementById('slidesContainer');
    const slides = document.querySelectorAll('.custom-slide');
    const dots = document.querySelectorAll('.slider-dots .dot');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const sliderPlayPauseBtn = document.getElementById('sliderPlayPauseBtn');

    let currentSlide = 0;
    const totalSlides = slides.length;
    let sliderInterval = null;
    let isSliderPlaying = true;
    const slideDuration = 6000; // 6 seconds

    function updateSlider() {
        if (totalSlides === 0) return;
        sliderContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        dots.forEach((dot, idx) => {
            if (idx === currentSlide) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    }

    function startSliderAutoplay() {
        if (totalSlides <= 1) return;
        clearInterval(sliderInterval);
        sliderInterval = setInterval(nextSlide, slideDuration);
    }

    function stopSliderAutoplay() {
        clearInterval(sliderInterval);
    }

    function toggleSliderPlay() {
        isSliderPlaying = !isSliderPlaying;
        if (isSliderPlaying) {
            sliderPlayPauseBtn.innerHTML = '<span class="pause-icon">II</span>';
            startSliderAutoplay();
        } else {
            sliderPlayPauseBtn.innerHTML = '<span class="play-icon">▶</span>';
            stopSliderAutoplay();
        }
    }

    if (totalSlides > 1) {
        // Event Listeners for arrows
        nextBtn.addEventListener('click', () => {
            nextSlide();
            if (isSliderPlaying) startSliderAutoplay(); // Reset timer
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            if (isSliderPlaying) startSliderAutoplay(); // Reset timer
        });

        // Event Listeners for dots
        dots.forEach(dot => {
            dot.addEventListener('click', function() {
                const target = parseInt(this.getAttribute('data-slide'));
                currentSlide = target;
                updateSlider();
                if (isSliderPlaying) startSliderAutoplay(); // Reset timer
            });
        });

        // Play/Pause Button
        sliderPlayPauseBtn.addEventListener('click', toggleSliderPlay);

        // Start playing
        startSliderAutoplay();
    } else {
        // Hide control elements if only 1 slide exists
        if (prevBtn) prevBtn.style.display = 'none';
        if (nextBtn) nextBtn.style.display = 'none';
        if (sliderPlayPauseBtn) sliderPlayPauseBtn.style.display = 'none';
    }


    /* ==========================================================================
       2. Right "What's New" Scroller (Smooth Marquee)
       ========================================================================== */
    const whatsNewContainer = document.getElementById('whatsNewScrollContainer');
    const whatsNewList = document.getElementById('whatsNewList');
    const whatsNewPlayPause = document.getElementById('whatsNewPlayPause');
    const playSymbol = whatsNewPlayPause.querySelector('.play-symbol');
    const pauseSymbol = whatsNewPlayPause.querySelector('.pause-symbol');

    let scrollSpeed = 0.6; // Scroll speed in pixels per frame
    let scrollY = 0;
    let isNewsPlaying = true;
    let isMouseOver = false;
    let animationFrameId = null;

    // Clone list items to create infinite looping effect if there are enough items
    const itemsCount = whatsNewList.querySelectorAll('.whatsnew-item').length;
    if (itemsCount > 2) {
        const originalContent = whatsNewList.innerHTML;
        // Duplicate content for smooth looping
        whatsNewList.innerHTML = originalContent + originalContent;
    }

    function scrollNews() {
        if (!isNewsPlaying || isMouseOver) {
            animationFrameId = requestAnimationFrame(scrollNews);
            return;
        }

        scrollY += scrollSpeed;
        const threshold = whatsNewList.scrollHeight / 2;

        if (scrollY >= threshold) {
            scrollY = 0; // Seamless snap back to start
        }

        whatsNewContainer.scrollTop = scrollY;
        animationFrameId = requestAnimationFrame(scrollNews);
    }

    // Hover listeners to pause scrolling
    whatsNewContainer.addEventListener('mouseenter', () => {
        isMouseOver = true;
    });

    whatsNewContainer.addEventListener('mouseleave', () => {
        isMouseOver = false;
    });

    // Control Play/Pause
    whatsNewPlayPause.addEventListener('click', () => {
        isNewsPlaying = !isNewsPlaying;
        if (isNewsPlaying) {
            playSymbol.style.display = 'none';
            pauseSymbol.style.display = 'inline';
        } else {
            playSymbol.style.display = 'inline';
            pauseSymbol.style.display = 'none';
        }
    });

    // Initialize scrolling
    if (itemsCount > 2) {
        scrollNews();
    } else {
        whatsNewPlayPause.style.display = 'none'; // No need for controls for very few items
    }
});
</script>
