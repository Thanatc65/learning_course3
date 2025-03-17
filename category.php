<?php
// Get category slug from URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Get all categories
$allCategories = getCategories(100, 0);

// Find the category with matching slug
$category = null;
foreach ($allCategories as $c) {
    if ($c['slug'] === $slug) {
        $category = $c;
        break;
    }
}

// If category not found, redirect to courses page
if (!$category) {
    header('Location: courses.php');
    exit;
}

// Get all courses
$allCourses = getCourses(100, 0);

// Filter courses by category
$categoryCourses = [];
foreach ($allCourses as $course) {
    if ($course['category_id'] == $category['id']) {
        $categoryCourses[] = $course;
    }
}

// Set page title and description
$pageTitle = $category['name'] . " | FutureSkill Clone";
$pageDescription = "เรียนรู้ทักษะด้าน" . $category['name'] . " กับคอร์สเรียนออนไลน์คุณภาพสูง ที่ออกแบบมาโดยผู้เชี่ยวชาญ";

// Include header
include 'includes/header.php';
?>

<!-- Page Header -->
<div class="page-header category-header">
    <div class="container">
        <h1 class="page-title"><?php echo $category['name']; ?></h1>
        <p class="page-subtitle">เรียนรู้ทักษะด้าน<?php echo $category['name']; ?> กับคอร์สเรียนคุณภาพสูง</p>
        <div class="category-stats">
            <div class="category-stat">
                <span class="stat-number"><?php echo count($categoryCourses); ?></span>
                <span class="stat-label">คอร์สเรียน</span>
            </div>
            <div class="category-stat">
                <span class="stat-number">4.8</span>
                <span class="stat-label">คะแนนเฉลี่ย</span>
            </div>
            <div class="category-stat">
                <span class="stat-number">5,200+</span>
                <span class="stat-label">ผู้เรียน</span>
            </div>
        </div>
    </div>
</div>

<!-- Category Description -->
<section class="section category-description-section">
    <div class="container">
        <div class="category-description">
            <h2>เกี่ยวกับหมวดหมู่ <?php echo $category['name']; ?></h2>
            <p>คอร์สเรียนในหมวดหมู่ <?php echo $category['name']; ?> ครอบคลุมเนื้อหาตั้งแต่ระดับพื้นฐานไปจนถึงระดับสูง เหมาะสำหรับผู้ที่ต้องการพัฒนาทักษะด้าน<?php echo $category['name']; ?> อย่างเป็นระบบ</p>
            <p>ทุกคอร์สเรียนได้รับการออกแบบโดยผู้เชี่ยวชาญที่มีประสบการณ์จริงในวงการ เพื่อให้ผู้เรียนสามารถนำความรู้ไปประยุกต์ใช้ได้จริง</p>
        </div>
    </div>
</section>

<!-- Category Courses -->
<section class="section category-courses-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">คอร์สเรียนในหมวดหมู่ <?php echo $category['name']; ?></h2>
            <p class="section-subtitle">เลือกคอร์สเรียนที่เหมาะกับระดับความรู้และความสนใจของคุณ</p>
        </div>

        <?php if (empty($categoryCourses)): ?>
            <div class="no-results">
                <div class="no-results-icon">
                    <i class="far fa-frown"></i>
                </div>
                <h3>ยังไม่มีคอร์สเรียนในหมวดหมู่นี้</h3>
                <p>ขออภัย ขณะนี้ยังไม่มีคอร์สเรียนในหมวดหมู่ <?php echo $category['name']; ?></p>
                <a href="courses.php" class="btn btn-primary">ดูคอร์สเรียนทั้งหมด</a>
            </div>
        <?php else: ?>
            <!-- Filter Options -->
            <div class="filter-options">
                <div class="filter-label">เรียงตาม:</div>
                <div class="filter-buttons">
                    <button class="filter-btn active" data-filter="popular">ยอดนิยม</button>
                    <button class="filter-btn" data-filter="newest">ใหม่ล่าสุด</button>
                    <button class="filter-btn" data-filter="price-low">ราคาต่ำ-สูง</button>
                    <button class="filter-btn" data-filter="price-high">ราคาสูง-ต่ำ</button>
                </div>
            </div>

            <div class="course-grid">
                <?php foreach ($categoryCourses as $course): ?>
                    <?php
                    $instructor = getInstructor($course['instructor_id']);
                    $discountPercent = getDiscountPercentage($course['original_price'], $course['price']);
                    ?>
                    <div class="course-card">
                        <div class="course-image">
                            <img src="<?php echo $course['thumbnail']; ?>" alt="<?php echo $course['title']; ?>">
                            <?php if ($discountPercent > 0): ?>
                                <span class="discount-badge"><?php echo $discountPercent; ?>% OFF</span>
                            <?php endif; ?>
                        </div>
                        <div class="course-content">
                            <h3 class="course-title">
                                <a href="course.php?slug=<?php echo $course['slug']; ?>"><?php echo $course['title']; ?></a>
                            </h3>
                            <div class="instructor-info">
                                <div class="instructor-image">
                                    <img src="<?php echo $instructor['profile_image']; ?>" alt="<?php echo $instructor['name']; ?>">
                                </div>
                                <span class="instructor-name"><?php echo $instructor['name']; ?></span>
                            </div>
                            <div class="course-meta">
                                <span class="course-duration">
                                    <i class="far fa-clock"></i> <?php echo $course['duration']; ?>
                                </span>
                                <span class="course-students">
                                    <i class="far fa-user"></i> <?php echo $course['students']; ?>
                                </span>
                            </div>
                            <div class="course-pricing">
                                <div class="price-info">
                                    <?php if ($course['price'] > 0): ?>
                                        <span class="course-price"><?php echo formatCurrency($course['price']); ?></span>
                                        <?php if ($course['original_price'] > $course['price']): ?>
                                            <span class="course-original-price"><?php echo formatCurrency($course['original_price']); ?></span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="course-price">ฟรี</span>
                                    <?php endif; ?>
                                </div>
                                <button class="add-to-cart" onclick="addToCart(<?php echo $course['id']; ?>)">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Related Categories -->
<section class="section related-categories-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">หมวดหมู่ที่เกี่ยวข้อง</h2>
            <p class="section-subtitle">ค้นพบทักษะใหม่ๆ ในหมวดหมู่อื่นๆ</p>
        </div>

        <div class="categories-grid">
            <?php
            // Get 3 random categories that are different from the current one
            $relatedCategories = [];
            $count = 0;

            foreach ($allCategories as $c) {
                if ($c['id'] !== $category['id']) {
                    $relatedCategories[] = $c;
                    $count++;

                    if ($count >= 3) {
                        break;
                    }
                }
            }

            foreach ($relatedCategories as $relatedCategory):
            ?>
                <div class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="category-content">
                        <h3 class="category-title"><?php echo $relatedCategory['name']; ?></h3>
                        <p class="category-courses-count"><?php echo $relatedCategory['courses_count']; ?> คอร์สเรียน</p>
                        <a href="category.php?slug=<?php echo $relatedCategory['slug']; ?>" class="btn btn-outline">ดูคอร์สเรียน</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">พร้อมที่จะพัฒนาทักษะด้าน<?php echo $category['name']; ?> หรือยัง?</h2>
            <p class="cta-subtitle">เริ่มต้นการเรียนรู้กับคอร์สเรียนออนไลน์คุณภาพสูงได้แล้ววันนี้</p>
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary btn-lg">เริ่มเรียนเลย</a>
                <a href="#" class="btn btn-secondary btn-lg">ขอคำแนะนำ</a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter buttons
    const filterButtons = document.querySelectorAll('.filter-btn');
    const courseGrid = document.querySelector('.course-grid');

    if (filterButtons.length > 0 && courseGrid) {
        const courseCards = Array.from(document.querySelectorAll('.course-card'));

        filterButtons.forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(b => b.classList.remove('active'));

                // Add active class to clicked button
                btn.classList.add('active');

                // Get filter type
                const filterType = btn.getAttribute('data-filter');

                // Sort courses based on filter
                let sortedCourses = [...courseCards];

                switch(filterType) {
                    case 'popular':
                        sortedCourses.sort((a, b) => {
                            const aStudents = parseInt(a.querySelector('.course-students').innerText.replace(/\D/g, ''));
                            const bStudents = parseInt(b.querySelector('.course-students').innerText.replace(/\D/g, ''));
                            return bStudents - aStudents;
                        });
                        break;
                    case 'newest':
                        // In a real application, you would sort by date added
                        // For this demo, we'll just randomize
                        sortedCourses.sort(() => Math.random() - 0.5);
                        break;
                    case 'price-low':
                        sortedCourses.sort((a, b) => {
                            const aPrice = parseFloat(a.querySelector('.course-price').innerText.replace(/[^\d.]/g, '')) || 0;
                            const bPrice = parseFloat(b.querySelector('.course-price').innerText.replace(/[^\d.]/g, '')) || 0;
                            return aPrice - bPrice;
                        });
                        break;
                    case 'price-high':
                        sortedCourses.sort((a, b) => {
                            const aPrice = parseFloat(a.querySelector('.course-price').innerText.replace(/[^\d.]/g, '')) || 0;
                            const bPrice = parseFloat(b.querySelector('.course-price').innerText.replace(/[^\d.]/g, '')) || 0;
                            return bPrice - aPrice;
                        });
                        break;
                }

                // Update the DOM
                courseGrid.innerHTML = '';
                sortedCourses.forEach(card => courseGrid.appendChild(card));
            });
        });
    }
});
</script>

<?php
// Include footer
include 'includes/footer.php';
?>
