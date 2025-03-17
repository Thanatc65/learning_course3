/**
 * FutureSkill Clone - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize mobile menu
    initMobileMenu();

    // Initialize hero slider
    initHeroSlider();

    // Initialize course sliders
    initCourseSliders();
});

/**
 * Initialize the mobile menu
 */
function initMobileMenu() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');

    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
    }
}

/**
 * Initialize the hero slider
 */
function initHeroSlider() {
    const sliderItems = document.querySelectorAll('.slider-item');
    const sliderDots = document.querySelectorAll('.slider-dot');
    let currentSlide = 0;

    if (sliderItems.length <= 0) return;

    // Set the first slide as active
    sliderItems[0].classList.add('active');

    if (sliderDots.length > 0) {
        sliderDots[0].classList.add('active');

        // Add click event to slider dots
        sliderDots.forEach(function(dot, index) {
            dot.addEventListener('click', function() {
                goToSlide(index);
            });
        });
    }

    // Auto slide every 5 seconds
    setInterval(function() {
        nextSlide();
    }, 5000);

    /**
     * Go to a specific slide
     */
    function goToSlide(index) {
        // Remove active class from all slides and dots
        sliderItems.forEach(function(item) {
            item.classList.remove('active');
        });

        if (sliderDots.length > 0) {
            sliderDots.forEach(function(dot) {
                dot.classList.remove('active');
            });
        }

        // Add active class to the selected slide and dot
        sliderItems[index].classList.add('active');

        if (sliderDots.length > 0) {
            sliderDots[index].classList.add('active');
        }

        currentSlide = index;
    }

    /**
     * Go to the next slide
     */
    function nextSlide() {
        const nextIndex = (currentSlide + 1) % sliderItems.length;
        goToSlide(nextIndex);
    }
}

/**
 * Initialize the course sliders
 */
function initCourseSliders() {
    const courseSliders = document.querySelectorAll('.course-slider');

    courseSliders.forEach(function(slider) {
        const sliderContainer = slider.querySelector('.course-slider-container');
        const prevButton = slider.querySelector('.slider-prev');
        const nextButton = slider.querySelector('.slider-next');

        if (!sliderContainer || !prevButton || !nextButton) return;

        const slideWidth = sliderContainer.querySelector('.course-card').offsetWidth + 20; // Card width + gap
        const visibleSlides = Math.floor(sliderContainer.offsetWidth / slideWidth);
        const totalSlides = sliderContainer.querySelectorAll('.course-card').length;
        let currentPosition = 0;

        // Add click event to prev button
        prevButton.addEventListener('click', function() {
            if (currentPosition > 0) {
                currentPosition--;
                updateSliderPosition();
            }
        });

        // Add click event to next button
        nextButton.addEventListener('click', function() {
            if (currentPosition < totalSlides - visibleSlides) {
                currentPosition++;
                updateSliderPosition();
            }
        });

        /**
         * Update the slider position
         */
        function updateSliderPosition() {
            const translateX = -currentPosition * slideWidth;
            sliderContainer.style.transform = `translateX(${translateX}px)`;

            // Toggle button disabled state
            prevButton.disabled = currentPosition === 0;
            nextButton.disabled = currentPosition >= totalSlides - visibleSlides;
        }

        // Initial position update
        updateSliderPosition();

        // Update on window resize
        window.addEventListener('resize', function() {
            const newVisibleSlides = Math.floor(sliderContainer.offsetWidth / slideWidth);

            if (newVisibleSlides !== visibleSlides) {
                currentPosition = 0;
                updateSliderPosition();
            }
        });
    });
}

/**
 * Add to cart functionality
 */
function addToCart(courseId) {
    // In a real implementation, this would send an AJAX request to add the course to cart
    // For our demo, we'll just show an alert
    alert('Course added to cart!');

    // Update cart count
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        cartCount.textContent = parseInt(cartCount.textContent) + 1;
    }

    return false; // Prevent default form submission
}

/**
 * Toggle course wishlist
 */
function toggleWishlist(courseId, button) {
    // In a real implementation, this would send an AJAX request to toggle wishlist status
    // For our demo, we'll just toggle the button class
    button.classList.toggle('wishlisted');

    if (button.classList.contains('wishlisted')) {
        button.innerHTML = '<i class="fas fa-heart"></i>';
    } else {
        button.innerHTML = '<i class="far fa-heart"></i>';
    }

    return false; // Prevent default click behavior
}
