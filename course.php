<?php
// Get course slug from URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Get all courses
$allCourses = getCourses(100, 0);

// Find the course with matching slug
$course = null;
foreach ($allCourses as $c) {
    if ($c['slug'] === $slug) {
        $course = $c;
        break;
    }
}

// If course not found, redirect to courses page
if (!$course) {
    header('Location: courses.php');
    exit;
}

// Get course details
$instructor = getInstructor($course['instructor_id']);
$category = getCategory($course['category_id']);
$discountPercent = getDiscountPercentage($course['original_price'], $course['price']);

// Set page title and description
$pageTitle = $course['title'] . " | FutureSkill Clone";
$pageDescription = truncateText($course['title'] . " - เรียนรู้กับ " . $instructor['name'], 160);

// Include header
include 'includes/header.php';
?>

<!-- Course Header -->
<div class="course-header">
    <div class="container">
        <div class="course-header-inner">
            <div class="course-header-content">
                <div class="breadcrumbs">
                    <a href="index.php">หน้าแรก</a> &gt;
                    <a href="courses.php">คอร์สเรียน</a> &gt;
                    <a href="category.php?slug=<?php echo $category['slug']; ?>"><?php echo $category['name']; ?></a> &gt;
                    <span class="current"><?php echo $course['title']; ?></span>
                </div>
                <h1 class="course-title"><?php echo $course['title']; ?></h1>
                <p class="course-subtitle">เรียนรู้ทักษะใหม่และพัฒนาตัวเองกับคอร์สเรียนคุณภาพสูง</p>

                <div class="course-meta">
                    <div class="instructor-info">
                        <div class="instructor-image">
                            <img src="<?php echo $instructor['profile_image']; ?>" alt="<?php echo $instructor['name']; ?>">
                        </div>
                        <span class="instructor-name">สอนโดย <?php echo $instructor['name']; ?></span>
                    </div>

                    <div class="course-stats">
                        <span class="course-duration">
                            <i class="far fa-clock"></i> <?php echo $course['duration']; ?>
                        </span>
                        <span class="course-students">
                            <i class="far fa-user"></i> <?php echo $course['students']; ?> ผู้เรียน
                        </span>
                        <span class="course-category">
                            <i class="far fa-folder"></i> <?php echo $category['name']; ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="course-header-card">
                <div class="course-thumbnail">
                    <img src="<?php echo $course['thumbnail']; ?>" alt="<?php echo $course['title']; ?>">
                </div>
                <div class="course-card-content">
                    <div class="course-pricing">
                        <?php if ($course['price'] > 0): ?>
                            <div class="price-info">
                                <span class="course-price"><?php echo formatCurrency($course['price']); ?></span>
                                <?php if ($course['original_price'] > $course['price']): ?>
                                    <span class="course-original-price"><?php echo formatCurrency($course['original_price']); ?></span>
                                    <span class="discount-label"><?php echo $discountPercent; ?>% ส่วนลด</span>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="price-info">
                                <span class="course-price free">ฟรี</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="course-actions">
                        <button class="btn btn-primary btn-block add-to-cart-btn" onclick="addToCart(<?php echo $course['id']; ?>)">
                            <i class="fas fa-shopping-cart"></i> เพิ่มลงตะกร้า
                        </button>
                        <button class="btn btn-outline btn-block buy-now-btn">
                            <i class="fas fa-bolt"></i> ซื้อทันที
                        </button>
                    </div>

                    <div class="course-includes">
                        <h4>คอร์สนี้ประกอบด้วย:</h4>
                        <ul>
                            <li><i class="fas fa-video"></i> วิดีโอเต็มรูปแบบ</li>
                            <li><i class="fas fa-infinity"></i> เข้าถึงตลอดชีพ</li>
                            <li><i class="fas fa-mobile-alt"></i> เข้าถึงผ่านมือถือ</li>
                            <li><i class="fas fa-file-download"></i> ไฟล์ประกอบการเรียน</li>
                            <li><i class="fas fa-certificate"></i> ใบรับรอง</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Course Content -->
<section class="section course-content-section">
    <div class="container">
        <div class="tabs">
            <div class="tab-nav">
                <button class="tab-btn active" data-tab="overview">ภาพรวม</button>
                <button class="tab-btn" data-tab="curriculum">เนื้อหาคอร์ส</button>
                <button class="tab-btn" data-tab="instructor">ผู้สอน</button>
                <button class="tab-btn" data-tab="reviews">รีวิว</button>
            </div>

            <div class="tab-content">
                <!-- Overview Tab -->
                <div class="tab-pane active" id="overview">
                    <div class="course-description">
                        <h3>รายละเอียดคอร์ส</h3>
                        <p>นี่คือคอร์สเรียน <?php echo $course['title']; ?> ที่ออกแบบมาเพื่อผู้เรียนที่ต้องการพัฒนาทักษะด้าน<?php echo $category['name']; ?> โดยเฉพาะ</p>

                        <h3>สิ่งที่คุณจะได้เรียนรู้</h3>
                        <ul class="learning-points">
                            <li>เข้าใจหลักการพื้นฐานของ <?php echo $category['name']; ?></li>
                            <li>พัฒนาทักษะและเทคนิคที่จำเป็น</li>
                            <li>สามารถนำความรู้ไปประยุกต์ใช้ในงานจริงได้</li>
                            <li>เรียนรู้จากกรณีศึกษาและตัวอย่างจริง</li>
                        </ul>

                        <h3>ข้อกำหนดเบื้องต้น</h3>
                        <ul class="requirements">
                            <li>ไม่จำเป็นต้องมีประสบการณ์มาก่อน</li>
                            <li>คอมพิวเตอร์พื้นฐานที่สามารถเข้าถึงอินเทอร์เน็ตได้</li>
                            <li>ความกระตือรือร้นที่จะเรียนรู้และฝึกฝนด้วยตนเอง</li>
                        </ul>

                        <h3>หัวข้อที่น่าสนใจ</h3>
                        <div class="tags">
                            <?php foreach ($course['tags'] as $tag): ?>
                                <span class="tag"><?php echo $tag; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Curriculum Tab -->
                <div class="tab-pane" id="curriculum">
                    <div class="course-curriculum">
                        <h3>หลักสูตรการเรียน</h3>

                        <div class="curriculum-section">
                            <div class="section-header">
                                <h4>บทที่ 1: บทนำ</h4>
                                <div class="section-meta">
                                    <span>3 บทเรียน</span>
                                    <span>20 นาที</span>
                                </div>
                            </div>
                            <div class="section-content">
                                <div class="lesson-item">
                                    <div class="lesson-icon">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <span class="lesson-title">บทนำสู่หลักสูตร</span>
                                        <span class="lesson-duration">5:30</span>
                                    </div>
                                </div>
                                <div class="lesson-item">
                                    <div class="lesson-icon">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <span class="lesson-title">ข้อมูลพื้นฐาน</span>
                                        <span class="lesson-duration">8:45</span>
                                    </div>
                                </div>
                                <div class="lesson-item">
                                    <div class="lesson-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <span class="lesson-title">เอกสารประกอบการเรียน</span>
                                        <span class="lesson-duration">PDF</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="curriculum-section">
                            <div class="section-header">
                                <h4>บทที่ 2: ความรู้พื้นฐาน</h4>
                                <div class="section-meta">
                                    <span>4 บทเรียน</span>
                                    <span>45 นาที</span>
                                </div>
                            </div>
                            <div class="section-content">
                                <div class="lesson-item">
                                    <div class="lesson-icon">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <span class="lesson-title">หลักการและแนวคิด</span>
                                        <span class="lesson-duration">12:20</span>
                                    </div>
                                </div>
                                <div class="lesson-item">
                                    <div class="lesson-icon">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <span class="lesson-title">เครื่องมือที่จำเป็น</span>
                                        <span class="lesson-duration">15:45</span>
                                    </div>
                                </div>
                                <div class="lesson-item locked">
                                    <div class="lesson-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <span class="lesson-title">การฝึกปฏิบัติ</span>
                                        <span class="lesson-duration">10:30</span>
                                    </div>
                                </div>
                                <div class="lesson-item locked">
                                    <div class="lesson-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div class="lesson-details">
                                        <span class="lesson-title">บททดสอบ</span>
                                        <span class="lesson-duration">Quiz</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Instructor Tab -->
                <div class="tab-pane" id="instructor">
                    <div class="instructor-profile">
                        <div class="instructor-header">
                            <div class="instructor-image">
                                <img src="<?php echo $instructor['profile_image']; ?>" alt="<?php echo $instructor['name']; ?>">
                            </div>
                            <div class="instructor-info">
                                <h3 class="instructor-name"><?php echo $instructor['name']; ?></h3>
                                <p class="instructor-title"><?php echo $instructor['bio']; ?></p>
                                <div class="instructor-stats">
                                    <div class="stat">
                                        <span class="stat-value"><?php echo $instructor['courses_count']; ?></span>
                                        <span class="stat-label">คอร์สเรียน</span>
                                    </div>
                                    <div class="stat">
                                        <span class="stat-value">4.8</span>
                                        <span class="stat-label">คะแนนเฉลี่ย</span>
                                    </div>
                                    <div class="stat">
                                        <span class="stat-value">5,240</span>
                                        <span class="stat-label">นักเรียน</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="instructor-bio">
                            <h4>เกี่ยวกับผู้สอน</h4>
                            <p>เป็นผู้เชี่ยวชาญในด้าน<?php echo $category['name']; ?> ที่มีประสบการณ์มากกว่า 10 ปี ผ่านการทำงานกับองค์กรชั้นนำมากมาย และถ่ายทอดความรู้ผ่านการสอนมามากกว่า 5 ปี</p>
                            <p>ปัจจุบันเป็นที่ปรึกษาให้กับบริษัทชั้นนำหลายแห่ง และเป็นวิทยากรรับเชิญในงานสัมมนาต่างๆ อย่างต่อเนื่อง</p>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane" id="reviews">
                    <div class="course-reviews">
                        <div class="reviews-summary">
                            <div class="rating-average">
                                <div class="average-score">4.8</div>
                                <div class="star-rating">
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star half-filled">★</span>
                                </div>
                                <div class="reviews-count">จาก 125 รีวิว</div>
                            </div>

                            <div class="rating-breakdown">
                                <div class="rating-row">
                                    <div class="rating-label">5 ดาว</div>
                                    <div class="rating-progress">
                                        <div class="progress-bar" style="width: 75%"></div>
                                    </div>
                                    <div class="rating-percent">75%</div>
                                </div>
                                <div class="rating-row">
                                    <div class="rating-label">4 ดาว</div>
                                    <div class="rating-progress">
                                        <div class="progress-bar" style="width: 20%"></div>
                                    </div>
                                    <div class="rating-percent">20%</div>
                                </div>
                                <div class="rating-row">
                                    <div class="rating-label">3 ดาว</div>
                                    <div class="rating-progress">
                                        <div class="progress-bar" style="width: 5%"></div>
                                    </div>
                                    <div class="rating-percent">5%</div>
                                </div>
                                <div class="rating-row">
                                    <div class="rating-label">2 ดาว</div>
                                    <div class="rating-progress">
                                        <div class="progress-bar" style="width: 0%"></div>
                                    </div>
                                    <div class="rating-percent">0%</div>
                                </div>
                                <div class="rating-row">
                                    <div class="rating-label">1 ดาว</div>
                                    <div class="rating-progress">
                                        <div class="progress-bar" style="width: 0%"></div>
                                    </div>
                                    <div class="rating-percent">0%</div>
                                </div>
                            </div>
                        </div>

                        <div class="reviews-list">
                            <div class="review-item">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">
                                        <img src="assets/images/user-1.jpg" alt="Reviewer">
                                    </div>
                                    <div class="reviewer-meta">
                                        <div class="reviewer-name">สมชาย ใจดี</div>
                                        <div class="review-date">1 เดือนที่แล้ว</div>
                                    </div>
                                </div>
                                <div class="review-content">
                                    <div class="review-rating">
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                    </div>
                                    <div class="review-text">
                                        <p>คอร์สเรียนดีมาก เนื้อหาเข้าใจง่าย อาจารย์สอนได้ละเอียด ทำให้ผมสามารถนำไปใช้ได้จริงในการทำงาน ขอบคุณมากครับ</p>
                                    </div>
                                </div>
                            </div>

                            <div class="review-item">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar">
                                        <img src="assets/images/user-2.jpg" alt="Reviewer">
                                    </div>
                                    <div class="reviewer-meta">
                                        <div class="reviewer-name">สมหญิง รักเรียน</div>
                                        <div class="review-date">2 เดือนที่แล้ว</div>
                                    </div>
                                </div>
                                <div class="review-content">
                                    <div class="review-rating">
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star filled">★</span>
                                        <span class="star">☆</span>
                                    </div>
                                    <div class="review-text">
                                        <p>คอร์สนี้ดีมาก แต่อยากให้มีตัวอย่างเพิ่มเติมอีกนิดหน่อย อาจารย์สอนเข้าใจง่ายมาก</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Courses -->
<section class="section related-courses-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">คอร์สเรียนที่ใกล้เคียง</h2>
            <p class="section-subtitle">คอร์สเรียนอื่นๆ ที่คุณอาจสนใจ</p>
        </div>

        <div class="course-grid">
            <?php
            // Get courses in the same category (up to 4)
            $relatedCourses = [];
            $count = 0;

            foreach ($allCourses as $c) {
                if ($c['id'] !== $course['id'] && $c['category_id'] === $course['category_id']) {
                    $relatedCourses[] = $c;
                    $count++;

                    if ($count >= 4) {
                        break;
                    }
                }
            }

            foreach ($relatedCourses as $relatedCourse):
                $relatedInstructor = getInstructor($relatedCourse['instructor_id']);
                $relatedDiscountPercent = getDiscountPercentage($relatedCourse['original_price'], $relatedCourse['price']);
            ?>
                <div class="course-card">
                    <div class="course-image">
                        <img src="<?php echo $relatedCourse['thumbnail']; ?>" alt="<?php echo $relatedCourse['title']; ?>">
                        <?php if ($relatedDiscountPercent > 0): ?>
                            <span class="discount-badge"><?php echo $relatedDiscountPercent; ?>% OFF</span>
                        <?php endif; ?>
                    </div>
                    <div class="course-content">
                        <h3 class="course-title">
                            <a href="course.php?slug=<?php echo $relatedCourse['slug']; ?>"><?php echo $relatedCourse['title']; ?></a>
                        </h3>
                        <div class="instructor-info">
                            <div class="instructor-image">
                                <img src="<?php echo $relatedInstructor['profile_image']; ?>" alt="<?php echo $relatedInstructor['name']; ?>">
                            </div>
                            <span class="instructor-name"><?php echo $relatedInstructor['name']; ?></span>
                        </div>
                        <div class="course-meta">
                            <span class="course-duration">
                                <i class="far fa-clock"></i> <?php echo $relatedCourse['duration']; ?>
                            </span>
                            <span class="course-students">
                                <i class="far fa-user"></i> <?php echo $relatedCourse['students']; ?>
                            </span>
                        </div>
                        <div class="course-pricing">
                            <div class="price-info">
                                <?php if ($relatedCourse['price'] > 0): ?>
                                    <span class="course-price"><?php echo formatCurrency($relatedCourse['price']); ?></span>
                                    <?php if ($relatedCourse['original_price'] > $relatedCourse['price']): ?>
                                        <span class="course-original-price"><?php echo formatCurrency($relatedCourse['original_price']); ?></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="course-price">ฟรี</span>
                                <?php endif; ?>
                            </div>
                            <button class="add-to-cart" onclick="addToCart(<?php echo $relatedCourse['id']; ?>)">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Script to handle tabs -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons and panes
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            // Add active class to clicked button and corresponding pane
            btn.classList.add('active');
            const tabId = btn.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
});
</script>

<?php
// Include footer
include 'includes/footer.php';
?>
