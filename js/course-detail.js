// Course Detail Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Curriculum Accordion Functionality
    const sectionHeaders = document.querySelectorAll('.section-header');

    sectionHeaders.forEach(header => {
        header.addEventListener('click', function() {
            // Toggle active class on the clicked header
            this.classList.toggle('active');

            // Find the next sibling (content) and toggle display
            const content = this.nextElementSibling;

            // If the header is active, show the content, otherwise hide it
            if (this.classList.contains('active')) {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }

            // Close other sections
            sectionHeaders.forEach(otherHeader => {
                if (otherHeader !== this) {
                    otherHeader.classList.remove('active');
                    otherHeader.nextElementSibling.style.display = 'none';
                }
            });
        });
    });

    // Initialize first section as open
    if (sectionHeaders.length > 0) {
        sectionHeaders[0].classList.add('active');
        sectionHeaders[0].nextElementSibling.style.display = 'block';
    }

    // Bundle Thumbnails Selection
    const bundleThumbs = document.querySelectorAll('.bundle-thumb');

    bundleThumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Remove active class from all thumbnails
            bundleThumbs.forEach(t => {
                t.classList.remove('active');
            });

            // Add active class to clicked thumbnail
            this.classList.add('active');
        });
    });

    // Add to Cart Functionality
    const addToCartBtn = document.querySelector('.add-to-cart-btn');
    const cartIcon = document.querySelector('.cart-icon');

    if (addToCartBtn && cartIcon) {
        addToCartBtn.addEventListener('click', function() {
            // Change button text and style to indicate item was added
            this.innerHTML = '<i class="fas fa-check"></i> Added to Cart';
            this.style.backgroundColor = var(--accent-color);
            this.style.borderColor = var(--accent-color);
            this.style.color = 'white';

            // Animate cart icon
            cartIcon.classList.add('bounce');

            // Reset button after delay
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-cart-plus"></i> Add to Cart';
                this.style.backgroundColor = '';
                this.style.borderColor = '';
                this.style.color = '';
                cartIcon.classList.remove('bounce');
            }, 2000);
        });
    }

    // Buy Now Button
    const buyNowBtn = document.querySelector('.buy-now-btn');

    if (buyNowBtn) {
        buyNowBtn.addEventListener('click', function() {
            // Change button text to indicate processing
            const originalText = this.textContent;
            this.textContent = 'Processing...';
            this.disabled = true;

            // Simulate checkout process
            setTimeout(() => {
                // Redirect to checkout page in a real implementation
                alert('Redirecting to checkout...');
                this.textContent = originalText;
                this.disabled = false;
            }, 1500);
        });
    }

    // Buy Series Button
    const buySeriesBtn = document.querySelector('.buy-series-btn');

    if (buySeriesBtn) {
        buySeriesBtn.addEventListener('click', function() {
            // Change button text to indicate processing
            const originalText = this.textContent;
            this.textContent = 'Processing...';
            this.disabled = true;

            // Simulate checkout process
            setTimeout(() => {
                // Redirect to checkout page in a real implementation
                alert('Redirecting to series checkout...');
                this.textContent = originalText;
                this.disabled = false;
            }, 1500);
        });
    }

    // Video Preview Functionality
    const videoFrame = document.querySelector('.course-video iframe');

    if (videoFrame) {
        // Add loading indicator for the video
        const videoContainer = document.querySelector('.course-video');
        const loadingIndicator = document.createElement('div');
        loadingIndicator.className = 'video-loading';
        loadingIndicator.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        videoContainer.appendChild(loadingIndicator);

        // Hide loading indicator when video is loaded
        videoFrame.addEventListener('load', function() {
            loadingIndicator.style.display = 'none';
        });
    }

    // Add CSS for animations
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

        .video-loading {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 24px;
        }
    `;
    document.head.appendChild(style);
});
