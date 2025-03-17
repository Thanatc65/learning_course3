// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const headerActions = document.querySelector('.header-actions');

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            headerActions.classList.toggle('active');
            this.classList.toggle('active');
        });
    }

    // Hero Slider
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.slider-arrows .prev');
    const nextBtn = document.querySelector('.slider-arrows .next');
    let currentSlide = 0;

    // Initialize the slider
    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        // Remove active class from all dots
        dots.forEach(dot => {
            dot.classList.remove('active');
        });

        // Show the current slide and activate the corresponding dot
        slides[index].classList.add('active');
        dots[index].classList.add('active');
    }

    // Next slide function
    function nextSlide() {
        currentSlide++;
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }
        showSlide(currentSlide);
    }

    // Previous slide function
    function prevSlide() {
        currentSlide--;
        if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }
        showSlide(currentSlide);
    }

    // Add event listeners for next and prev buttons
    if (nextBtn) {
        nextBtn.addEventListener('click', nextSlide);
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', prevSlide);
    }

    // Add event listeners for dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // Auto slide (uncomment to enable)
    // setInterval(nextSlide, 5000);

    // Course filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const courseCards = document.querySelectorAll('.course-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(btn => {
                btn.classList.remove('active');
            });

            // Add active class to the clicked button
            this.classList.add('active');

            // Get the category to filter by
            const category = this.textContent.trim().toLowerCase();

            // If "All" is selected, show all cards
            if (category === 'all') {
                courseCards.forEach(card => {
                    card.style.display = 'block';
                });
                return;
            }

            // Filter the cards
            courseCards.forEach(card => {
                const cardCategory = card.querySelector('.course-category').textContent.trim().toLowerCase();
                if (cardCategory === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Course Slider Navigation
    const sliderControls = document.querySelectorAll('.slider-controls');

    sliderControls.forEach(control => {
        const prevBtn = control.querySelector('.prev');
        const nextBtn = control.querySelector('.next');
        const pageIndicator = control.querySelector('.page-indicator');
        const parent = control.parentElement;
        const grid = parent.querySelector('.courses-grid, .learning-paths-grid, .upcoming-courses-grid');
        const gridItems = grid.children;
        const itemsPerPage = getItemsPerPage();
        let currentPage = 1;
        const totalPages = Math.ceil(gridItems.length / itemsPerPage);

        // Update page indicator
        function updatePageIndicator() {
            if (pageIndicator) {
                let pageNum = currentPage.toString().padStart(2, '0');
                let totalPagesNum = totalPages.toString().padStart(2, '0');
                pageIndicator.textContent = `${pageNum} / ${totalPagesNum}`;
            }
        }

        // Show items for current page
        function showPage(page) {
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            for (let i = 0; i < gridItems.length; i++) {
                if (i >= startIndex && i < endIndex) {
                    gridItems[i].style.display = 'block';
                } else {
                    gridItems[i].style.display = 'none';
                }
            }

            updatePageIndicator();
        }

        // Get number of items to display per page based on screen size
        function getItemsPerPage() {
            if (window.innerWidth < 576) {
                return 1;
            } else if (window.innerWidth < 992) {
                return 2;
            } else if (window.innerWidth < 1200) {
                return 3;
            } else {
                return 4;
            }
        }

        // Initialize the page
        showPage(currentPage);

        // Add event listeners for prev and next buttons
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                }
            });
        }

        // Update on window resize
        window.addEventListener('resize', function() {
            const newItemsPerPage = getItemsPerPage();
            if (newItemsPerPage !== itemsPerPage) {
                currentPage = 1; // Reset to first page
                showPage(currentPage);
            }
        });
    });

    // Add to cart functionality
    const addToCartBtns = document.querySelectorAll('.add-to-cart-btn');
    const cartIcon = document.querySelector('.cart-icon');

    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Simple animation effect
            this.textContent = 'Added to Cart';
            this.style.backgroundColor = '#2bcb99';

            // Animate cart icon
            cartIcon.classList.add('bounce');

            // Reset after animation
            setTimeout(() => {
                this.textContent = 'Add to Cart';
                this.style.backgroundColor = '';
                cartIcon.classList.remove('bounce');
            }, 2000);
        });
    });

    // Add CSS for cart animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .cart-icon.bounce {
            animation: bounce 0.5s ease;
        }
    `;
    document.head.appendChild(style);
});
