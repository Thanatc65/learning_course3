<?php
require_once 'config.php';

class Database {
    private $conn = null;

    // Constructor - would normally connect to a real database
    public function __construct() {
        // In a real implementation, this would connect to MySQL
        // $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        //
        // if ($this->conn->connect_error) {
        //     die("Connection failed: " . $this->conn->connect_error);
        // }

        // For our fake DB, we're just setting up the connection as successful
        $this->conn = true;
    }

    // Fake query method that would normally run SQL
    public function query($sql) {
        // In a real implementation, this would execute the SQL query
        // return $this->conn->query($sql);

        // For our fake DB, we're just returning a successful result
        return true;
    }

    // Method to get a specific number of records from the fake DB
    public function getRecords($type, $limit = 10, $offset = 0) {
        // This would normally run a SELECT query
        // For our fake DB, we'll return predefined data based on the type

        switch ($type) {
            case 'courses':
                return $this->getFakeCourses($limit, $offset);
            case 'instructors':
                return $this->getFakeInstructors($limit, $offset);
            case 'categories':
                return $this->getFakeCategories($limit, $offset);
            case 'learning_paths':
                return $this->getFakeLearningPaths($limit, $offset);
            case 'upcoming_courses':
                return $this->getFakeUpcomingCourses($limit, $offset);
            case 'testimonials':
                return $this->getFakeTestimonials($limit, $offset);
            case 'partners':
                return $this->getFakePartners($limit, $offset);
            default:
                return [];
        }
    }

    // Method to get a single record by ID
    public function getRecordById($type, $id) {
        // This would normally run a SELECT query with a WHERE clause
        // For our fake DB, we'll return a single fake record

        $allRecords = $this->getRecords($type, 100, 0);
        foreach ($allRecords as $record) {
            if ($record['id'] == $id) {
                return $record;
            }
        }

        return null; // Record not found
    }

    // Get fake courses
    private function getFakeCourses($limit, $offset) {
        $courses = [
            [
                'id' => 1,
                'title' => '[Shortcut] เรียนรู้ Facebook Ads 2025: ใช้เทคนิค AI เพิ่มประสิทธิภาพ',
                'slug' => 'facebook-ads-2025',
                'thumbnail' => 'https://assets.futureskill.co/course%2Fa3efec03-adc5-479e-85ea-863dd36bc1cc.jpg',
                'price' => 790.00,
                'original_price' => 1790.00,
                'duration' => '1.10 ชม.',
                'students' => 348,
                'instructor_id' => 1,
                'is_featured' => true,
                'category_id' => 1,
                'tags' => ['Facebook Ads', 'Digital Marketing', 'AI']
            ],
            [
                'id' => 2,
                'title' => 'เริ่มงาน Agile แบบมืออาชีพ',
                'slug' => 'professional-agile',
                'thumbnail' => 'https://assets.futureskill.co/course%2F2c5d6292-7341-4578-91ef-3d92baace86c.jpg',
                'price' => 990.00,
                'original_price' => 1590.00,
                'duration' => '47 นาที',
                'students' => 178,
                'instructor_id' => 2,
                'is_featured' => true,
                'category_id' => 2,
                'tags' => ['Agile', 'Project Management']
            ],
            [
                'id' => 3,
                'title' => 'พื้นฐานการทำงานแบบ Agile ด้วย Scrum',
                'slug' => 'agile-scrum-basics',
                'thumbnail' => 'https://assets.futureskill.co/course%2Fa888fe9d-f4a0-4afe-a735-b77ed4d656f5.jpg',
                'price' => 990.00,
                'original_price' => 1590.00,
                'duration' => '1.33 ชม.',
                'students' => 90,
                'instructor_id' => 2,
                'is_featured' => true,
                'category_id' => 2,
                'tags' => ['Agile', 'Scrum', 'Project Management']
            ],
            [
                'id' => 4,
                'title' => 'การจัดการงานด้วยเทคนิค Agile',
                'slug' => 'agile-techniques',
                'thumbnail' => 'https://assets.futureskill.co/course%2Fc44809a1-2c18-4c6e-b6d8-3df33572d856.jpg',
                'price' => 990.00,
                'original_price' => 1590.00,
                'duration' => '1.06 ชม.',
                'students' => 155,
                'instructor_id' => 2,
                'is_featured' => true,
                'category_id' => 2,
                'tags' => ['Agile', 'Project Management']
            ],
            [
                'id' => 5,
                'title' => '(Webinar) เทคนิคการเขียน Resume ให้ผ่านตา HR',
                'slug' => 'resume-writing-webinar',
                'thumbnail' => 'https://ext.same-assets.com/2094387062/2521960639.jpeg',
                'price' => 0.00,
                'original_price' => 0.00,
                'duration' => '1.11 ชม.',
                'students' => 544,
                'instructor_id' => 3,
                'is_featured' => true,
                'category_id' => 3,
                'tags' => ['Resume', 'Career', 'HR', 'Free']
            ],
            [
                'id' => 6,
                'title' => '(Webinar) เริ่มต้นใช้งาน AI ในการทำงาน',
                'slug' => 'ai-for-work-webinar',
                'thumbnail' => 'https://ext.same-assets.com/1619978622/4210029210.jpeg',
                'price' => 0.00,
                'original_price' => 0.00,
                'duration' => '1.06 ชม.',
                'students' => 1370,
                'instructor_id' => 4,
                'is_featured' => true,
                'category_id' => 4,
                'tags' => ['AI', 'Webinar', 'Free']
            ],
            [
                'id' => 7,
                'title' => 'วิเคราะห์งบการเงิน EPS',
                'slug' => 'financial-statement-eps-analysis',
                'thumbnail' => 'https://ext.same-assets.com/2253760366/88872207.jpeg',
                'price' => 990.00,
                'original_price' => 1390.00,
                'duration' => '38 นาที',
                'students' => 184,
                'instructor_id' => 5,
                'is_featured' => true,
                'category_id' => 5,
                'tags' => ['Finance', 'EPS', 'Financial Analysis']
            ],
            [
                'id' => 8,
                'title' => 'เจาะลึกงบการเงิน EPS',
                'slug' => 'deep-financial-eps-analysis',
                'thumbnail' => 'https://ext.same-assets.com/2253760366/88872207.jpeg',
                'price' => 990.00,
                'original_price' => 1390.00,
                'duration' => '1.26 ชม.',
                'students' => 121,
                'instructor_id' => 5,
                'is_featured' => false,
                'category_id' => 5,
                'tags' => ['Finance', 'EPS', 'Financial Analysis']
            ],
            [
                'id' => 9,
                'title' => 'พื้นฐานงบการเงิน EPS',
                'slug' => 'basic-financial-eps',
                'thumbnail' => 'https://ext.same-assets.com/2253760366/88872207.jpeg',
                'price' => 990.00,
                'original_price' => 1390.00,
                'duration' => '1.02 ชม.',
                'students' => 132,
                'instructor_id' => 5,
                'is_featured' => false,
                'category_id' => 5,
                'tags' => ['Finance', 'EPS', 'Basic Financial']
            ],
            [
                'id' => 10,
                'title' => 'การตลาด B2B ด้วย Account-Based Marketing และ CRM',
                'slug' => 'b2b-marketing-abm-crm',
                'thumbnail' => 'https://ext.same-assets.com/1092176369/1885827276.jpeg',
                'price' => 590.00,
                'original_price' => 1590.00,
                'duration' => '1.01 ชม.',
                'students' => 397,
                'instructor_id' => 6,
                'is_featured' => false,
                'category_id' => 1,
                'tags' => ['B2B', 'Marketing', 'CRM', 'ABM']
            ]
        ];

        // Apply limit and offset
        $result = array_slice($courses, $offset, $limit);
        return $result;
    }

    // Get fake instructors
    private function getFakeInstructors($limit, $offset) {
        $instructors = [
            [
                'id' => 1,
                'name' => 'อาจารย์ โอม',
                'profile_image' => 'https://assets.futureskill.co/instructor/81fd57ab-32a3-4079-b8da-d13116c57437.ohm',
                'bio' => 'ผู้เชี่ยวชาญด้าน Digital Marketing และ Facebook Ads',
                'courses_count' => 5
            ],
            [
                'id' => 2,
                'name' => 'อาจารย์ เอก',
                'profile_image' => 'https://assets.futureskill.co/instructor%2Fe7dfd874-a088-4357-96d7-507e636747a9.JPG',
                'bio' => 'ผู้เชี่ยวชาญด้าน Agile และ Project Management',
                'courses_count' => 12
            ],
            [
                'id' => 3,
                'name' => 'อาจารย์ นุช',
                'profile_image' => 'https://ext.same-assets.com/1873312779/3995084480.png',
                'bio' => 'ผู้เชี่ยวชาญด้าน HR และการพัฒนาบุคลากร',
                'courses_count' => 3
            ],
            [
                'id' => 4,
                'name' => 'อาจารย์ ปิง',
                'profile_image' => 'https://ext.same-assets.com/182344871/291024402.png',
                'bio' => 'ผู้เชี่ยวชาญด้าน AI และ Technology',
                'courses_count' => 7
            ],
            [
                'id' => 5,
                'name' => 'อาจารย์ เบน',
                'profile_image' => 'https://assets.futureskill.co/instructor%2F9d49cf0c-8be9-4c38-b417-6b04a259ea8c.JPG',
                'bio' => 'ผู้เชี่ยวชาญด้านการเงินและการลงทุน',
                'courses_count' => 9
            ],
            [
                'id' => 6,
                'name' => 'อาจารย์ แทน',
                'profile_image' => 'https://ext.same-assets.com/3187326085/2551382539.png',
                'bio' => 'ผู้เชี่ยวชาญด้าน Marketing และ CRM',
                'courses_count' => 4
            ]
        ];

        // Apply limit and offset
        $result = array_slice($instructors, $offset, $limit);
        return $result;
    }

    // Get fake categories
    private function getFakeCategories($limit, $offset) {
        $categories = [
            [
                'id' => 1,
                'name' => 'Digital Marketing',
                'slug' => 'digital-marketing',
                'courses_count' => 28
            ],
            [
                'id' => 2,
                'name' => 'Business',
                'slug' => 'business',
                'courses_count' => 45
            ],
            [
                'id' => 3,
                'name' => 'Soft Skills',
                'slug' => 'soft-skills',
                'courses_count' => 15
            ],
            [
                'id' => 4,
                'name' => 'Technology',
                'slug' => 'technology',
                'courses_count' => 67
            ],
            [
                'id' => 5,
                'name' => 'Finance & Investment',
                'slug' => 'finance-investment',
                'courses_count' => 32
            ],
            [
                'id' => 6,
                'name' => 'Data',
                'slug' => 'data',
                'courses_count' => 41
            ],
            [
                'id' => 7,
                'name' => 'Design',
                'slug' => 'design',
                'courses_count' => 23
            ],
            [
                'id' => 8,
                'name' => 'Programming',
                'slug' => 'programming',
                'courses_count' => 39
            ]
        ];

        // Apply limit and offset
        $result = array_slice($categories, $offset, $limit);
        return $result;
    }

    // Get fake learning paths
    private function getFakeLearningPaths($limit, $offset) {
        $learning_paths = [
            [
                'id' => 1,
                'title' => 'ทักษะพื้นฐาน Agile สำหรับมือใหม่',
                'slug' => 'agile-basics-beginners',
                'courses_count' => 3,
                'duration' => '3.26 ชม.',
                'thumbnail' => 'https://assets.futureskill.co/course%2F2c5d6292-7341-4578-91ef-3d92baace86c.jpg'
            ],
            [
                'id' => 2,
                'title' => 'วิเคราะห์งบการเงินด้วย EPS',
                'slug' => 'financial-analysis-eps',
                'courses_count' => 3,
                'duration' => '3.06 ชม.',
                'thumbnail' => 'https://ext.same-assets.com/2253760366/88872207.jpeg'
            ],
            [
                'id' => 3,
                'title' => 'เรียนรู้ Microsoft Azure พร้อมสอบ AZ-900 ภายใน 7 วัน',
                'slug' => 'microsoft-azure-az900',
                'courses_count' => 4,
                'duration' => '4.24 ชม.',
                'thumbnail' => 'https://ext.same-assets.com/3413174855/798943743.jpeg'
            ],
            [
                'id' => 4,
                'title' => 'สร้างคอนเทนต์กับ Pandaboyz',
                'slug' => 'content-creation-pandaboyz',
                'courses_count' => 3,
                'duration' => '3.15 ชม.',
                'thumbnail' => 'https://ext.same-assets.com/1525811771/2273973947.png'
            ],
            [
                'id' => 5,
                'title' => 'Business English in the Workplace',
                'slug' => 'business-english-workplace',
                'courses_count' => 3,
                'duration' => '3.14 ชม.',
                'thumbnail' => 'https://ext.same-assets.com/3143747843/491311024.jpeg'
            ]
        ];

        // Apply limit and offset
        $result = array_slice($learning_paths, $offset, $limit);
        return $result;
    }

    // Get fake upcoming courses
    private function getFakeUpcomingCourses($limit, $offset) {
        $upcoming_courses = [
            [
                'id' => 1,
                'title' => 'สร้างแบบจำลอง AI จากศูนย์',
                'description' => 'เรียนรู้การสร้างแบบจำลอง AI ตั้งแต่เริ่มต้น',
                'release_date' => '27 มิถุนายน 2568',
                'instructor_id' => 5,
                'thumbnail' => 'https://assets.futureskill.co/instructor%2F9d49cf0c-8be9-4c38-b417-6b04a259ea8c.JPG'
            ],
            [
                'id' => 2,
                'title' => 'ประยุกต์ใช้ AI ในการสร้างคอนเทนต์',
                'description' => 'เรียนรู้การใช้ AI ในการสร้างคอนเทนต์ที่มีคุณภาพ',
                'release_date' => '27 มิถุนายน 2568',
                'instructor_id' => 5,
                'thumbnail' => 'https://assets.futureskill.co/instructor%2F9d49cf0c-8be9-4c38-b417-6b04a259ea8c.JPG'
            ],
            [
                'id' => 3,
                'title' => 'วิเคราะห์ข้อมูลด้วย AI และเทคนิคการนำเสนอ AI',
                'description' => 'เรียนรู้การวิเคราะห์ข้อมูลด้วย AI และการนำเสนอผลลัพธ์อย่างมีประสิทธิภาพ',
                'release_date' => '27 มิถุนายน 2568',
                'instructor_id' => 5,
                'thumbnail' => 'https://assets.futureskill.co/instructor%2F9d49cf0c-8be9-4c38-b417-6b04a259ea8c.JPG'
            ]
        ];

        // Apply limit and offset
        $result = array_slice($upcoming_courses, $offset, $limit);
        return $result;
    }

    // Get fake testimonials
    private function getFakeTestimonials($limit, $offset) {
        $testimonials = [
            [
                'id' => 1,
                'text' => 'คอร์สเรียนดีมาก ได้ความรู้เยอะมาก สามารถนำไปใช้ในการทำงานได้จริง',
                'rating' => 5,
                'author' => 'คุณ กมล',
                'position' => 'Marketing Manager'
            ],
            [
                'id' => 2,
                'text' => 'เนื้อหาเข้าใจง่าย อาจารย์สอนดี มีตัวอย่างประกอบทำให้เข้าใจได้ง่ายขึ้น',
                'rating' => 5,
                'author' => 'คุณ พลอย',
                'position' => 'Digital Content Creator'
            ],
            [
                'id' => 3,
                'text' => 'คุ้มค่ากับราคา ได้ความรู้ที่สามารถนำไปใช้ได้จริง',
                'rating' => 5,
                'author' => 'คุณ ไผ่',
                'position' => 'Business Owner'
            ]
        ];

        // Apply limit and offset
        $result = array_slice($testimonials, $offset, $limit);
        return $result;
    }

    // Get fake partners
    private function getFakePartners($limit, $offset) {
        $partners = [
            [
                'id' => 1,
                'name' => 'Kubota',
                'logo' => 'https://ext.same-assets.com/2958442199/1751373217.png'
            ],
            [
                'id' => 2,
                'name' => 'Siam Cement Group',
                'logo' => 'https://ext.same-assets.com/260559727/2905721738.png'
            ],
            [
                'id' => 3,
                'name' => 'Thai Beverage',
                'logo' => 'https://ext.same-assets.com/349175279/2687955506.png'
            ],
            [
                'id' => 4,
                'name' => 'Tangerine',
                'logo' => 'https://ext.same-assets.com/3049790260/3376547105.png'
            ],
            [
                'id' => 5,
                'name' => 'Toyota',
                'logo' => 'https://ext.same-assets.com/3187326085/2551382539.png'
            ]
        ];

        // Apply limit and offset
        $result = array_slice($partners, $offset, $limit);
        return $result;
    }
}

// Create database instance
$db = new Database();
