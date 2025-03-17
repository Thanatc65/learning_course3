<?php
// Set page title and description
$pageTitle = "เส้นทางการเรียนรู้ | FutureSkill Clone";
$pageDescription = "ค้นพบเส้นทางการเรียนรู้ที่ออกแบบมาเพื่อพัฒนาทักษะอย่างเป็นระบบ ตอบโจทย์ทุกความต้องการ";

// Include header
include 'includes/header.php';

// Get learning paths
$learningPaths = getLearningPaths(100, 0);
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">เส้นทางการเรียนรู้</h1>
        <p class="page-subtitle">เส้นทางการเรียนรู้ที่ออกแบบมาเพื่อพัฒนาทักษะอย่างเป็นระบบ</p>
    </div>
</div>

<!-- Learning Paths Section -->
<section class="section learning-paths-page">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">เส้นทางการเรียนรู้ทั้งหมด</h2>
            <p class="section-subtitle">เลือกเส้นทางการเรียนรู้ที่เหมาะกับเป้าหมายของคุณ</p>
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
                        <div class="learning-path-footer">
                            <a href="learning-path.php?slug=<?php echo $path['slug']; ?>" class="btn btn-primary btn-sm">ดูรายละเอียด</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Learning Path Benefits -->
<section class="section benefits-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">ทำไมต้องเรียนผ่านเส้นทางการเรียนรู้?</h2>
            <p class="section-subtitle">เส้นทางการเรียนรู้ช่วยให้คุณพัฒนาทักษะได้อย่างเป็นระบบและมีประสิทธิภาพ</p>
        </div>

        <div class="benefits-grid">
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-road"></i>
                </div>
                <div class="benefit-content">
                    <h3 class="benefit-title">เรียนรู้อย่างเป็นขั้นตอน</h3>
                    <p class="benefit-text">เส้นทางการเรียนรู้ถูกออกแบบให้มีลำดับการเรียนรู้ที่เหมาะสม ตั้งแต่พื้นฐานไปจนถึงขั้นสูง</p>
                </div>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="benefit-content">
                    <h3 class="benefit-title">ครอบคลุมทุกทักษะที่จำเป็น</h3>
                    <p class="benefit-text">แต่ละเส้นทางประกอบด้วยหลายคอร์สที่ครอบคลุมทักษะต่างๆ ที่จำเป็นสำหรับเป้าหมายนั้นๆ</p>
                </div>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="benefit-content">
                    <h3 class="benefit-title">รับใบรับรองทักษะ</h3>
                    <p class="benefit-text">เมื่อเรียนจบเส้นทางการเรียนรู้ คุณจะได้รับใบรับรองทักษะที่สามารถนำไปใช้ในการทำงานได้จริง</p>
                </div>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="benefit-content">
                    <h3 class="benefit-title">คุ้มค่ากว่าการซื้อแยก</h3>
                    <p class="benefit-text">การเรียนผ่านเส้นทางการเรียนรู้มีราคาที่คุ้มค่ากว่าการซื้อคอร์สแยกทีละคอร์ส</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section how-it-works-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">วิธีการเรียนผ่านเส้นทางการเรียนรู้</h2>
            <p class="section-subtitle">เรียนรู้ขั้นตอนง่ายๆ ในการเริ่มต้นพัฒนาทักษะผ่านเส้นทางการเรียนรู้</p>
        </div>

        <div class="steps-container">
            <div class="step-item">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3 class="step-title">เลือกเส้นทางการเรียนรู้</h3>
                    <p class="step-text">ค้นหาและเลือกเส้นทางการเรียนรู้ที่ตรงกับเป้าหมายและความสนใจของคุณ</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3 class="step-title">ลงทะเบียน</h3>
                    <p class="step-text">ลงทะเบียนเรียนในเส้นทางการเรียนรู้ที่คุณเลือก</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3 class="step-title">เรียนทีละคอร์ส</h3>
                    <p class="step-text">เริ่มเรียนไปทีละคอร์สตามลำดับที่กำหนดไว้ในเส้นทางการเรียนรู้</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">4</div>
                <div class="step-content">
                    <h3 class="step-title">ทำแบบทดสอบและโปรเจกต์</h3>
                    <p class="step-text">ทำแบบทดสอบและโปรเจกต์เพื่อวัดความเข้าใจและทักษะที่ได้เรียนรู้</p>
                </div>
            </div>

            <div class="step-item">
                <div class="step-number">5</div>
                <div class="step-content">
                    <h3 class="step-title">รับใบรับรอง</h3>
                    <p class="step-text">เมื่อเรียนจบทุกคอร์สในเส้นทางการเรียนรู้ คุณจะได้รับใบรับรองทักษะ</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content">
            <h2 class="cta-title">พร้อมที่จะเริ่มพัฒนาทักษะใหม่หรือยัง?</h2>
            <p class="cta-subtitle">เลือกเส้นทางการเรียนรู้ที่เหมาะกับคุณและเริ่มต้นพัฒนาตัวเองวันนี้</p>
            <div class="cta-buttons">
                <a href="#" class="btn btn-primary btn-lg">เริ่มเรียนเลย</a>
                <a href="#" class="btn btn-secondary btn-lg">ปรึกษาผู้เชี่ยวชาญ</a>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>
