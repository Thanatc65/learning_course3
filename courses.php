<?php
// Set page title and description
$pageTitle = "คอร์สเรียนทั้งหมด | FutureSkill Clone";
$pageDescription = "ค้นหาและเรียนรู้กับคอร์สเรียนออนไลน์คุณภาพสูงที่หลากหลาย ทั้ง Data, Technology, Business และอื่นๆ อีกมากมาย";

// Include header
include 'includes/header.php';

// Get categories for filtering
$categories = getCategories(100, 0);

// Get courses (in a real application, you would handle pagination and filtering here)
$courses = getCourses(100, 0);

// Initialize filter variables
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$price_filter = isset($_GET['price']) ? $_GET['price'] : '';
$search_query = isset($_GET['q']) ? $_GET['q'] : '';

// Apply filters
if (!empty($category_filter) || !empty($price_filter) || !empty($search_query)) {
    $filtered_courses = [];

    foreach ($courses as $course) {
        // Category filter
        if (!empty($category_filter) && $course['category_id'] != $category_filter) {
            continue;
        }

        // Price filter
        if ($price_filter === 'free' && $course['price'] > 0) {
            continue;
        } elseif ($price_filter === 'paid' && $course['price'] <= 0) {
            continue;
        }

        // Search query
        if (!empty($search_query) && stripos($course['title'], $search_query) === false) {
            continue;
        }

        $filtered_courses[] = $course;
    }

    $courses = $filtered_courses;
}
?>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">คอร์สเรียนทั้งหมด</h1>
        <p class="page-subtitle">ค้นหาและเรียนรู้กับคอร์สเรียนที่หลากหลายของเรา</p>
    </div>
</div>

<!-- Courses Section -->
<section class="section courses-page">
    <div class="container">
        <div class="courses-layout">
            <!-- Sidebar / Filters -->
            <div class="courses-sidebar">
                <div class="filter-section">
                    <h3 class="filter-title">ค้นหา</h3>
                    <form action="courses.php" method="GET" class="search-form">
                        <div class="form-group">
                            <input type="text" name="q" placeholder="ค้นหาคอร์ส..." value="<?php echo $search_query; ?>" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">ค้นหา</button>
                    </form>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">หมวดหมู่</h3>
                    <form action="courses.php" method="GET" class="category-filter-form">
                        <div class="form-group">
                            <select name="category" class="form-control" onchange="this.form.submit()">
                                <option value="">ทั้งหมด</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" <?php echo $category_filter == $category['id'] ? 'selected' : ''; ?>>
                                        <?php echo $category['name']; ?> (<?php echo $category['courses_count']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>

                <div class="filter-section">
                    <h3 class="filter-title">ราคา</h3>
                    <form action="courses.php" method="GET" class="price-filter-form">
                        <div class="form-group">
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="price" value="" <?php echo $price_filter === '' ? 'checked' : ''; ?> onchange="this.form.submit()">
                                    <span class="radio-text">ทั้งหมด</span>
                                </label>
                            </div>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="price" value="free" <?php echo $price_filter === 'free' ? 'checked' : ''; ?> onchange="this.form.submit()">
                                    <span class="radio-text">ฟรี</span>
                                </label>
                            </div>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="price" value="paid" <?php echo $price_filter === 'paid' ? 'checked' : ''; ?> onchange="this.form.submit()">
                                    <span class="radio-text">มีค่าใช้จ่าย</span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Courses Grid -->
            <div class="courses-content">
                <!-- Filtering info -->
                <div class="filtering-info">
                    <div class="courses-count">
                        พบ <strong><?php echo count($courses); ?></strong> คอร์สเรียน
                    </div>
                    <?php if (!empty($category_filter) || !empty($price_filter) || !empty($search_query)): ?>
                        <div class="active-filters">
                            <span>กำลังกรอง:</span>
                            <?php if (!empty($category_filter)): ?>
                                <?php $filter_category = getCategory($category_filter); ?>
                                <span class="filter-tag">
                                    <?php echo $filter_category['name']; ?>
                                    <a href="courses.php?<?php echo http_build_query(array_merge($_GET, ['category' => ''])); ?>" class="remove-filter">×</a>
                                </span>
                            <?php endif; ?>

                            <?php if (!empty($price_filter)): ?>
                                <span class="filter-tag">
                                    <?php echo $price_filter === 'free' ? 'ฟรี' : 'มีค่าใช้จ่าย'; ?>
                                    <a href="courses.php?<?php echo http_build_query(array_merge($_GET, ['price' => ''])); ?>" class="remove-filter">×</a>
                                </span>
                            <?php endif; ?>

                            <?php if (!empty($search_query)): ?>
                                <span class="filter-tag">
                                    ค้นหา: "<?php echo $search_query; ?>"
                                    <a href="courses.php?<?php echo http_build_query(array_merge($_GET, ['q' => ''])); ?>" class="remove-filter">×</a>
                                </span>
                            <?php endif; ?>

                            <a href="courses.php" class="clear-filters">ล้างทั้งหมด</a>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (empty($courses)): ?>
                    <div class="no-results">
                        <div class="no-results-icon">
                            <i class="far fa-frown"></i>
                        </div>
                        <h3>ไม่พบคอร์สเรียน</h3>
                        <p>ขออภัย ไม่พบคอร์สเรียนที่ตรงกับเงื่อนไขการค้นหาของคุณ</p>
                        <a href="courses.php" class="btn btn-primary">ดูคอร์สเรียนทั้งหมด</a>
                    </div>
                <?php else: ?>
                    <div class="course-grid">
                        <?php foreach ($courses as $course): ?>
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
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>
