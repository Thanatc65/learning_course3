<?php
// Get error code from URL
$code = isset($_GET['code']) ? intval($_GET['code']) : 404;

// Set default error message and title
$errorTitle = 'ไม่พบหน้าที่คุณต้องการ';
$errorMessage = 'ขออภัย ไม่พบหน้าที่คุณกำลังค้นหา';

// Customize error message based on code
if ($code === 500) {
    $errorTitle = 'เกิดข้อผิดพลาดบนเซิร์ฟเวอร์';
    $errorMessage = 'ขออภัย เกิดข้อผิดพลาดบนเซิร์ฟเวอร์ โปรดลองใหม่อีกครั้งในภายหลัง';
}

// Set page title
$pageTitle = $errorTitle . ' | FutureSkill Clone';
$pageDescription = $errorMessage;

// Include header
include 'includes/header.php';
?>

<!-- Error Section -->
<section class="section error-section">
    <div class="container">
        <div class="error-content">
            <div class="error-code"><?php echo $code; ?></div>
            <h1 class="error-title"><?php echo $errorTitle; ?></h1>
            <p class="error-message"><?php echo $errorMessage; ?></p>

            <div class="error-actions">
                <a href="index.php" class="btn btn-primary">กลับไปที่หน้าแรก</a>
                <a href="javascript:history.back()" class="btn btn-secondary">กลับไปหน้าก่อนหน้า</a>
            </div>

            <div class="error-suggestions">
                <h3>คุณอาจลองดู:</h3>
                <ul>
                    <li><a href="courses.php">ค้นหาคอร์สเรียน</a></li>
                    <li><a href="learning-paths.php">สำรวจเส้นทางการเรียนรู้</a></li>
                    <li><a href="#">ติดต่อเรา</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>
