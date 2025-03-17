<?php
// Get learning path slug from URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

// Get all learning paths
$allLearningPaths = getLearningPaths(100, 0);

// Find the learning path with matching slug
$learningPath = null;
foreach ($allLearningPaths as $path) {
    if ($path['slug'] === $slug) {
        $learningPath = $path;
        break;
    }
}

// If learning path not found, redirect to learning paths page
if (!$learningPath) {
    header('Location: learning-paths.php');
    exit;
}

// Get all courses
$allCourses = getCourses(100, 0);

// Set page title and description
$pageTitle = $learningPath['title'] . " | FutureSkill Clone";
$pageDescription = "เรียนรู้และพัฒนาทักษะกับเส้นทางการเรียนรู้ " . $learningPath['title'] . " ที่ออกแบบโดยผู้เชี่ยวชาญ";

// Include header
include 'includes/header.php';
?>

<!-- Page Header -->
<div class="page-header learning-path-header">
    <div class="container">
        <div class="breadcrumbs">
            <a href="index.php">หน้าแรก</a> &gt;
            <a href="learning-paths.php">เส้นทางการเรียนรู้</a> &gt;
            <span class="current"><?php echo $learningPath['title']; ?></span>
        </div>
        <h1 class="page-title"><?php echo $learningPath['title']; ?></h1>
        <p class="page-subtitle">เส้นทางการเรียนรู้ที่ออกแบบมาโดยผู้เชี่ยวชาญ</p>

        <div class="learning-path-meta">
            <div class="meta-item">
                <i class="fas fa-book"></i>
                <span><?php echo $learningPath['courses_count']; ?> คอร์สเรียน</span>
            </div>
            <div class="meta-item">
                <i class="far fa-clock"></i>
                <span><?php echo $learningPath['duration']; ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-certificate"></i>
                <span>ได้รับใบรับรอง</span>
            </div>
        </div>
    </div>
</div>

<!-- Learning Path Overview -->
<section class="section learning-path-overview-section">
    <div class="container">
        <div class="learning-path-overview">
            <div class="learning-path-image">
                <img src="<?php echo $learningPath['thumbnail']; ?>" alt="<?php echo $learningPath['title']; ?>">
            </div>
            <div class="learning-path-content">
                <h2>เกี่ยวกับเส้นทางการเรียนรู้นี้</h2>
                <p>เส้นทางการเรียนรู้ <?php echo $learningPath['title']; ?> ออกแบบมาเพื่อช่วยให้คุณพัฒนาทักษะอย่างเป็นระบบ ตั้งแต่ระดับพื้นฐานไปจนถึงระดับสูง</p>
                <p>เส้นทางนี้ประกอบด้วย <?php echo $learningPath['courses_count']; ?> คอร์สเรียนที่ครอบคลุมทักษะต่างๆ ที่จำเป็น ซึ่งจะใช้เวลาเรียนรวมประมาณ <?php echo $learningPath['duration']; ?></p>

                <div class="learning-path-actions">
                    <a href="#courses" class="btn btn-primary">ดูรายละเอียดคอร์ส</a>
                    <button class="btn btn-secondary buy-path-btn">ลงทะเบียนเรียน ฿5,990</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What You'll Learn -->
<section class="section what-youll-learn-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">สิ่งที่คุณจะได้เรียนรู้</h2>
            <p class="section-subtitle">ทักษะและความรู้ที่คุณจะได้รับจากเส้นทางการเรียนรู้นี้</p>
        </div>

        <div class="skills-grid">
            <div class="skill-item">
                <div class="skill-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="skill-content">
                    <h3 class="skill-title">ทักษะพื้นฐาน</h3>
                    <p class="skill-text">เรียนรู้ทักษะพื้นฐานที่จำเป็นสำหรับการเริ่มต้น</p>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="skill-content">
                    <h3 class="skill-title">ทักษะการวิเคราะห์</h3>
                    <p class="skill-text">พัฒนาความสามารถในการวิเคราะห์และแก้ไขปัญหา</p>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="skill-content">
                    <h3 class="skill-title">ทักษะการประยุกต์ใช้</h3>
                    <p class="skill-text">เรียนรู้การนำความรู้ไปประยุกต์ใช้ในสถานการณ์จริง</p>
                </div>
            </div>

            <div class="skill-item">
                <div class="skill-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="skill-content">
                    <h3 class="skill-title">ทักษะขั้นสูง</h3>
                    <p class="skill-text">พัฒนาทักษะขั้นสูงเพื่อต่อยอดความสามารถ</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Courses in Learning Path -->
<section id="courses" class="section learning-path-courses-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">คอร์สเรียนในเส้นทางการเรียนรู้</h2>
            <p class="section-subtitle">คอร์สเรียนทั้งหมด <?php echo $learningPath['courses_count']; ?> คอร์สที่คุณจะได้เรียนในเส้นทางนี้</p>
        </div>

        <div class="learning-path-courses">
            <?php
            // In a real application, you would get the actual courses in this learning path
            // For our demo, we'll just use a few random courses from our fake database
            $pathCourses = array_slice($allCourses, 0, $learningPath['courses_count']);

            foreach ($pathCourses as $index => $course):
                $instructor = getInstructor($course['instructor_id']);
            ?>
                <div class="path-course-item">
                    <div class="course-number"><?php echo $index + 1; ?></div>
                    <div class="path-course-card">
                        <div class="path-course-image">
                            <img src="<?php echo $course['thumbnail']; ?>" alt="<?php echo $course['title']; ?>">
                        </div>
                        <div class="path-course-content">
                            <h3 class="path-course-title">
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
                                <span class="course-level">
                                    <i class="fas fa-signal"></i> <?php echo $index === 0 ? 'เริ่มต้น' : ($index === $learningPath['courses_count'] - 1 ? 'ขั้นสูง' : 'ปานกลาง'); ?>
                                </span>
                            </div>
                            <div class="course-description">
                                <p>คอร์สนี้จะพาคุณเรียนรู้เกี่ยวกับ<?php echo $course['title']; ?> อย่างเป็นขั้นตอน ตั้งแต่พื้นฐานไปจนถึงการประยุกต์ใช้งานจริง</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Certificate -->
<section class="section certificate-section">
    <div class="container">
        <div class="certificate-content">
            <div class="certificate-image">
                <img src="https://ext.same-assets.com/1525811771/2273973947.png" alt="Certificate">
            </div>
            <div class="certificate-info">
                <h2>รับใบรับรองทักษะ</h2>
                <p>เมื่อเรียนจบเส้นทางการเรียนรู้นี้ คุณจะได้รับใบรับรองทักษะที่สามารถนำไปใช้พัฒนาเส้นทางอาชีพของคุณได้</p>
                <ul class="certificate-benefits">
                    <li><i class="fas fa-check"></i> เพิ่มโอกาสในการทำงาน</li>
                    <li><i class="fas fa-check"></i> แสดงความเชี่ยวชาญเฉพาะด้าน</li>
                    <li><i class="fas fa-check"></i> ใบรับรองที่ได้รับการยอมรับในวงการ</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- FAQs -->
<section class="section faqs-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">คำถามที่พบบ่อย</h2>
            <p class="section-subtitle">ข้อสงสัยที่ผู้เรียนมักจะถามเกี่ยวกับเส้นทางการเรียนรู้นี้</p>
        </div>

        <div class="faqs-list">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>เส้นทางการเรียนรู้นี้เหมาะกับใคร?</h3>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>เส้นทางการเรียนรู้นี้เหมาะสำหรับผู้เริ่มต้นที่สนใจในด้านนี้ ไปจนถึงผู้ที่มีประสบการณ์บ้างแล้วและต้องการพัฒนาทักษะเพิ่มเติม</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>ฉันจะใช้เวลานานแค่ไหนในการเรียนให้จบ?</h3>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>เวลาที่ใช้ในการเรียนขึ้นอยู่กับความเร็วในการเรียนรู้ของแต่ละคน แต่โดยเฉลี่ยแล้ว คุณสามารถเรียนจบเส้นทางนี้ได้ภายใน 1-2 เดือน หากใช้เวลาเรียนประมาณ 5-10 ชั่วโมงต่อสัปดาห์</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>ฉันจำเป็นต้องมีความรู้พื้นฐานอะไรบ้าง?</h3>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>เส้นทางการเรียนรู้นี้ถูกออกแบบมาให้เริ่มตั้งแต่ระดับพื้นฐาน คุณไม่จำเป็นต้องมีความรู้เฉพาะด้านมาก่อน เพียงแค่มีความเข้าใจการใช้คอมพิวเตอร์ขั้นพื้นฐานเท่านั้น</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>ฉันสามารถเข้าถึงคอร์สเรียนได้นานแค่ไหน?</h3>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>เมื่อซื้อเส้นทางการเรียนรู้แล้ว คุณจะสามารถเข้าถึงคอร์สเรียนทั้งหมดได้ตลอดชีพ ไม่มีกำหนดเวลาหมดอายุ</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>มีการรับประกันคืนเงินหรือไม่?</h3>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>ใช่ เรามีนโยบายคืนเงิน 100% ภายใน 30 วัน หากคุณไม่พอใจกับเส้นทางการเรียนรู้</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">พร้อมที่จะเริ่มเส้นทางการเรียนรู้นี้หรือยัง?</h2>
            <p class="cta-subtitle">ลงทะเบียนเรียนวันนี้และเริ่มต้นพัฒนาทักษะใหม่ของคุณ</p>
            <div class="cta-buttons">
                <button class="btn btn-primary btn-lg buy-path-btn">ลงทะเบียนเรียน ฿5,990</button>
                <a href="#courses" class="btn btn-secondary btn-lg">ดูรายละเอียดคอร์ส</a>
            </div>
            <div class="cta-guarantee">
                <i class="fas fa-shield-alt"></i> รับประกันคืนเงิน 100% ภายใน 30 วัน
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Toggle
    const faqQuestions = document.querySelectorAll('.faq-question');

    faqQuestions.forEach(function(question) {
        question.addEventListener('click', function() {
            const faqItem = this.parentElement;
            const faqAnswer = this.nextElementSibling;
            const faqToggle = this.querySelector('.faq-toggle i');

            // Toggle answer visibility
            if (faqAnswer.style.maxHeight) {
                faqAnswer.style.maxHeight = null;
                faqToggle.classList.remove('fa-minus');
                faqToggle.classList.add('fa-plus');
            } else {
                faqAnswer.style.maxHeight = faqAnswer.scrollHeight + 'px';
                faqToggle.classList.remove('fa-plus');
                faqToggle.classList.add('fa-minus');
            }

            // Close other answers
            faqQuestions.forEach(function(q) {
                if (q !== question) {
                    const otherAnswer = q.nextElementSibling;
                    const otherToggle = q.querySelector('.faq-toggle i');

                    if (otherAnswer.style.maxHeight) {
                        otherAnswer.style.maxHeight = null;
                        otherToggle.classList.remove('fa-minus');
                        otherToggle.classList.add('fa-plus');
                    }
                }
            });
        });
    });

    // Buy Learning Path Button
    const buyButtons = document.querySelectorAll('.buy-path-btn');

    buyButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            alert('คุณกำลังลงทะเบียนเรียนเส้นทางการเรียนรู้ <?php echo $learningPath['title']; ?> ในราคา ฿5,990');
        });
    });
});
</script>

<?php
// Include footer
include 'includes/footer.php';
?>
