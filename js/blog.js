// Blog Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Featured Articles Slider
    const slides = document.querySelectorAll('.featured-slide');
    const dots = document.querySelectorAll('.slider-dots .dot');
    const prevBtn = document.querySelector('.slider-arrows .prev');
    const nextBtn = document.querySelector('.slider-arrows .next');
    let currentSlide = 0;
    let slideInterval;

    // Function to show a specific slide
    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // Remove active class from all dots
        dots.forEach(dot => {
            dot.classList.remove('active');
        });

        // Show current slide and activate corresponding dot
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    }

    // Function to go to next slide
    function nextSlide() {
        currentSlide++;
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }
        showSlide(currentSlide);
    }

    // Function to go to previous slide
    function prevSlide() {
        currentSlide--;
        if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }
        showSlide(currentSlide);
    }

    // Set up automatic slider
    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    // Stop automatic slider on user interaction
    function stopSlideShow() {
        clearInterval(slideInterval);
    }

    // Add event listeners for next and prev buttons
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            stopSlideShow();
            nextSlide();
            startSlideShow();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            stopSlideShow();
            prevSlide();
            startSlideShow();
        });
    }

    // Add event listeners for dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            stopSlideShow();
            currentSlide = index;
            showSlide(currentSlide);
            startSlideShow();
        });
    });

    // Start the slideshow
    startSlideShow();

    // Category filtering animation
    const categoryItems = document.querySelectorAll('.category-item');

    categoryItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            // Highlight the active category
            categoryItems.forEach(cat => {
                cat.classList.remove('active');
            });

            this.classList.add('active');

            // Here you would typically filter the articles by category
            // This is a placeholder for actual filtering functionality
            const category = this.textContent.trim();
            console.log(`Filtering by category: ${category}`);

            // Add some animation to show filtering is happening
            const articlesGrid = document.querySelectorAll('.articles-grid');

            articlesGrid.forEach(grid => {
                grid.style.opacity = '0.5';

                setTimeout(() => {
                    grid.style.opacity = '1';
                }, 500);
            });
        });
    });

    // Lazy loading for article images
    const articleImages = document.querySelectorAll('.article-image img');

    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.getAttribute('data-src');

                    if (src) {
                        img.src = src;
                        img.removeAttribute('data-src');
                    }

                    observer.unobserve(img);
                }
            });
        });

        articleImages.forEach(img => {
            if (img.hasAttribute('data-src')) {
                imageObserver.observe(img);
            }
        });
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        articleImages.forEach(img => {
            const src = img.getAttribute('data-src');
            if (src) {
                img.src = src;
                img.removeAttribute('data-src');
            }
        });
    }
});
