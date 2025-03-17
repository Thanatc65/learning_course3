// Small update to enable versioning
<?php
// Set page title and description
$pageTitle = "FutureSkill Clone - คอร์สเรียนออนไลน์ พัฒนาทักษะใหม่แห่งอนาคต";
$pageDescription = "แหล่งรวมคอร์สเรียนออนไลน์พัฒนาทักษะในอนาคต เรียน Data, Tech, Business และ Creative ครอบคลุมทุกสายงาน สอนโดยผู้เชี่ยวชาญมากประสบการณ์ พร้อมรับเกียรติบัตร";

// Include header
include 'includes/header.php';

// Get featured courses
$featuredCourses = getFeaturedCourses(4);

// Get learning paths
$learningPaths = getLearningPaths(5);

// Get upcoming courses
$upcomingCourses = getUpcomingCourses(3);

// Get testimonials
$testimonials = getTestimonials(3);

// Get partners
$partners = getPartners(5);
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-slider">
            <div class="slider-item active">
                <div class="hero-content">
                    <h1 class="hero-title">สร้างและวิเคราะห์โมเดล "มีความ"</h1>
                    <p class="hero-subtitle">ว่างจากวิกฤต 6 ปี FutureSkill นำเสนอเครื่องมือช่วยออกแบบงานให้มีความยั่งยืน</p>
                    <div class="hero-buttons">
                        <a href="course.php" class="btn btn-primary btn-lg">ดูรายละเอียด</a>
                    </div>
                </div>
                <img src="https://ext.same-assets.com/3143747843/491311024.jpeg" alt="Hero Image" class="hero-image">
            </div>

            <div class="slider-item">
                <div class="hero-content">
                    <h1 class="hero-title">FutureSkill App Optimization</h1>
                    <p class="hero-subtitle">เรียนรู้ทักษะใหม่ได้ทุกที่ทุกเวลาผ่านแอปพลิเคชันบนมือถือ</p>
                    <div class="hero-buttons">
                        <a href="courses.php" class="btn btn-primary btn-lg">ดูรายละเอียด</a>
                    </div>
                </div>
                <img src="https://ext.same-assets.com/1619978622/4210029210.jpeg" alt="Hero Image" class="hero-image">
            </div>

            <div class="slider-item">
                <div class="hero-content">
                    <h1 class="hero-title">ครบรอบ 6 ปี FutureSkill</h1>
                    <p class="hero-subtitle">ร่วมฉลองครบรอบ 6 ปีกับเรา พร้อมส่วนลดพิเศษสำหรับคอร์สเรียนและสมาชิกรายเดือน</p>
                    <div class="hero-buttons">
                        <a href="courses.php" class="btn btn-primary btn-lg">ดูรายละเอียด</a>
                    </div>
                </div>
                <img src="https://ext.same-assets.com/2116725310/1859087448.jpeg" alt="Hero Image" class="hero-image">
            </div>

            <div class="slider-dots">
                <span class="slider-dot active"></span>
                <span class="slider-dot"></span>
                <span class="slider-dot"></span>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section features-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">แพลตฟอร์มเรียนรู้ออนไลน์</h2>
            <p class="section-subtitle">สำหรับทักษะอนาคตที่ครอบคลุมทุกสายงาน</p>
        </div>

        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <img src="https://ext.same-assets.com/1873312779/3995084480.png" alt="Feature 1">
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">FutureSkill Class Project ที่ดีที่สุด</h3>
                    <p class="feature-text">เรียนรู้และฝึกฝนทักษะใหม่ผ่านโปรเจกต์ที่ใช้งานได้จริง</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon">
                    <img src="https://ext.same-assets.com/182344871/291024402.png" alt="Feature 2">
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">คอร์สเรียนออนไลน์คุณภาพสูง</h3>
                    <p class="feature-text">เรียนรู้กับผู้เชี่ยวชาญในวงการ ด้วยเนื้อหาที่ทันสมัยและเข้าใจง่าย</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses Section -->
<section class="section courses-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">คอร์สเรียนยอดนิยม</h2>
            <p class="section-subtitle">เริ่มต้นพัฒนาทักษะใหม่กับคอร์สเรียนแนะนำของเรา</p>
        </div>

        <div class="course-grid">
            <?php foreach ($featuredCourses as $course): ?>
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

        <div class="section-footer text-center">
            <a href="courses.php" class="btn btn-primary">ดูคอร์สเรียนทั้งหมด</a>
        </div>
    </div>
</section>

<!-- Learning Paths Section -->
<section class="section learning-paths-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">เส้นทางการเรียนรู้</h2>
            <p class="section-subtitle">แนะนำเส้นทางการเรียนรู้ที่ตอบโจทย์ความต้องการของคุณ</p>
        </div>

        <div class="learning-paths-grid course-grid">
            <?php foreach ($learningPaths as $path): ?>
                <div class="learning-path-card">
                    <div class="course-image">
                        <img src="<?php echo $path['thumbnail']; ?>" alt="<?php echo $path['title']; ?>">
                    </div>
                    <div class="learning-path-content">
                        <h3 class="learning-path-title">
                            <a href="learning-path.php?slug=<?php echo $path['slug']; ?>"><?php echo $path['title']; ?></a>
                        </h3>
                        <div class="learning-path-meta">
                            <span class="learning-path-courses">
                                <i class="fas fa-book"></i> <?php echo $path['courses_count']; ?> คอร์ส
                            </span>
                            <span class="learning-path-duration">
                                <i class="far fa-clock"></i> <?php echo $path['duration']; ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="section-footer text-center">
            <a href="learning-paths.php" class="btn btn-primary">ดูเส้นทางการเรียนรู้ทั้งหมด</a>
        </div>
    </div>
</section>

<!-- Upcoming Courses Section -->
<section class="section upcoming-courses-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">คอร์สเรียนที่กำลังจะเปิด</h2>
            <p class="section-subtitle">คอร์สเรียนใหม่ที่จะเปิดให้ลงทะเบียนเร็วๆ นี้</p>
        </div>

        <div class="upcoming-courses-list">
            <?php foreach ($upcomingCourses as $course): ?>
                <?php $instructor = getInstructor($course['instructor_id']); ?>
                <div class="upcoming-course">
                    <div class="upcoming-course-image">
                        <img src="<?php echo $course['thumbnail']; ?>" alt="<?php echo $course['title']; ?>">
                    </div>
                    <div class="upcoming-course-content">
                        <h3 class="upcoming-course-title"><?php echo $course['title']; ?></h3>
                        <p class="upcoming-course-description"><?php echo $course['description']; ?></p>
                        <div class="upcoming-course-info">
                            <span class="upcoming-course-instructor"><?php echo $instructor['name']; ?></span>
                            <span class="upcoming-course-date"><?php echo $course['release_date']; ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="section partners-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">ได้รับการไว้วางใจจากหลากหลายองค์กร</h2>
        </div>

        <div class="partners-list">
            <?php foreach ($partners as $partner): ?>
                <div class="partner-item">
                    <img src="<?php echo $partner['logo']; ?>" alt="<?php echo $partner['name']; ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section testimonials-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">เสียงตอบรับจากผู้เรียนในโปรแกรม FutureSkill</h2>
        </div>

        <div class="testimonials-list">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card">
                    <?php echo generateStarRating($testimonial['rating']); ?>
                    <p class="testimonial-text">"<?php echo $testimonial['text']; ?>"</p>
                    <div class="testimonial-author-info">
                        <span class="testimonial-author"><?php echo $testimonial['author']; ?></span>
                        <span class="testimonial-position"><?php echo $testimonial['position']; ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="stats-container">
            <div class="stat-item">
                <div class="stat-number">+200</div>
                <div class="stat-label">วิทยากร</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">+490</div>
                <div class="stat-label">คอร์สเรียน</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">+219,000</div>
                <div class="stat-label">ผู้เรียน</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">+220</div>
                <div class="stat-label">องค์กร</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">พร้อมที่จะพัฒนาทักษะใหม่หรือยัง?</h2>
            <p class="cta-subtitle">เริ่มต้นการเรียนรู้กับคอร์สเรียนออนไลน์คุณภาพสูงได้แล้ววันนี้</p>
            <div class="cta-buttons">
                <a href="courses.php" class="btn btn-primary btn-lg">เริ่มเรียนเลย</a>
                <a href="subscription.php" class="btn btn-secondary btn-lg">สมัครสมาชิกรายเดือน</a>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>
