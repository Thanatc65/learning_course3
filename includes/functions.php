<?php
require_once 'db.php';

/**
 * Format currency with the site's currency settings
 *
 * @param float $amount The amount to format
 * @return string The formatted amount
 */
function formatCurrency($amount) {
    $formatted = number_format($amount, 2, DECIMAL_POINT, THOUSANDS_SEPARATOR);
    return CURRENCY_SYMBOL . $formatted;
}

/**
 * Get a course by ID
 *
 * @param int $id The course ID
 * @return array|null The course data
 */
function getCourse($id) {
    global $db;
    return $db->getRecordById('courses', $id);
}

/**
 * Get courses
 *
 * @param int $limit The maximum number of courses to get
 * @param int $offset The offset
 * @return array The courses
 */
function getCourses($limit = 10, $offset = 0) {
    global $db;
    return $db->getRecords('courses', $limit, $offset);
}

/**
 * Get an instructor by ID
 *
 * @param int $id The instructor ID
 * @return array|null The instructor data
 */
function getInstructor($id) {
    global $db;
    return $db->getRecordById('instructors', $id);
}

/**
 * Get instructors
 *
 * @param int $limit The maximum number of instructors to get
 * @param int $offset The offset
 * @return array The instructors
 */
function getInstructors($limit = 10, $offset = 0) {
    global $db;
    return $db->getRecords('instructors', $limit, $offset);
}

/**
 * Get a category by ID
 *
 * @param int $id The category ID
 * @return array|null The category data
 */
function getCategory($id) {
    global $db;
    return $db->getRecordById('categories', $id);
}

/**
 * Get categories
 *
 * @param int $limit The maximum number of categories to get
 * @param int $offset The offset
 * @return array The categories
 */
function getCategories($limit = 10, $offset = 0) {
    global $db;
    return $db->getRecords('categories', $limit, $offset);
}

/**
 * Get learning paths
 *
 * @param int $limit The maximum number of learning paths to get
 * @param int $offset The offset
 * @return array The learning paths
 */
function getLearningPaths($limit = 10, $offset = 0) {
    global $db;
    return $db->getRecords('learning_paths', $limit, $offset);
}

/**
 * Get upcoming courses
 *
 * @param int $limit The maximum number of upcoming courses to get
 * @param int $offset The offset
 * @return array The upcoming courses
 */
function getUpcomingCourses($limit = 10, $offset = 0) {
    global $db;
    return $db->getRecords('upcoming_courses', $limit, $offset);
}

/**
 * Get testimonials
 *
 * @param int $limit The maximum number of testimonials to get
 * @param int $offset The offset
 * @return array The testimonials
 */
function getTestimonials($limit = 10, $offset = 0) {
    global $db;
    return $db->getRecords('testimonials', $limit, $offset);
}

/**
 * Get partners
 *
 * @param int $limit The maximum number of partners to get
 * @param int $offset The offset
 * @return array The partners
 */
function getPartners($limit = 10, $offset = 0) {
    global $db;
    return $db->getRecords('partners', $limit, $offset);
}

/**
 * Get featured courses
 *
 * @param int $limit The maximum number of featured courses to get
 * @return array The featured courses
 */
function getFeaturedCourses($limit = 4) {
    $courses = getCourses(100, 0);
    $featured = array_filter($courses, function($course) {
        return isset($course['is_featured']) && $course['is_featured'] === true;
    });

    return array_slice($featured, 0, $limit);
}

/**
 * Generate a star rating HTML
 *
 * @param int $rating The rating (1-5)
 * @return string The star rating HTML
 */
function generateStarRating($rating) {
    $html = '<div class="star-rating">';

    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            $html .= '<span class="star filled">★</span>';
        } else {
            $html .= '<span class="star">☆</span>';
        }
    }

    $html .= '</div>';

    return $html;
}

/**
 * Get discount percentage
 *
 * @param float $originalPrice The original price
 * @param float $currentPrice The current price
 * @return int The discount percentage
 */
function getDiscountPercentage($originalPrice, $currentPrice) {
    if ($originalPrice <= 0) {
        return 0;
    }

    $discount = (($originalPrice - $currentPrice) / $originalPrice) * 100;
    return round($discount);
}

/**
 * Truncate text to a specific length
 *
 * @param string $text The text to truncate
 * @param int $length The maximum length
 * @param string $append The string to append if truncated
 * @return string The truncated text
 */
function truncateText($text, $length = 100, $append = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }

    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, ' '));

    return $text . $append;
}

/**
 * Check if a URL is active (for navigation)
 *
 * @param string $url The URL to check
 * @return bool True if the URL is active, false otherwise
 */
function isActiveUrl($url) {
    $currentUrl = $_SERVER['REQUEST_URI'];

    if ($url === '/') {
        return $currentUrl === '/' || $currentUrl === '/index.php';
    }

    return strpos($currentUrl, $url) !== false;
}

/**
 * Get the active class for a navigation item
 *
 * @param string $url The URL to check
 * @param string $activeClass The class to add if the URL is active
 * @return string The active class if the URL is active, empty otherwise
 */
function getActiveClass($url, $activeClass = 'active') {
    return isActiveUrl($url) ? $activeClass : '';
}
