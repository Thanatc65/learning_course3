# FutureSkill Clone

A PHP-based clone of the FutureSkill.co website UI/UX, created for educational purposes only. This project demonstrates how to implement a basic course marketplace platform using PHP.

## Features

- Responsive design that matches the original FutureSkill.co website
- Fake database with sample courses, instructors, and categories
- Course listing with filtering and sorting
- Course details page with tabs for curriculum, instructor information, and reviews
- Learning paths feature
- Category browsing
- Mobile-friendly design

## Technologies Used

- PHP 7.4+ (Core functionality)
- HTML5/CSS3 (Structure and styling)
- JavaScript/jQuery (Interactive elements)
- Font Awesome (Icons)
- Google Fonts (Typography)

## Requirements

- PHP 7.4 or higher
- Web server (Apache or Nginx)
- Browser with JavaScript enabled

## Installation

1. Clone this repository to your web server directory:
   ```
   git clone https://github.com/yourusername/futureskill-clone.git
   ```

2. If using Apache, ensure the .htaccess file is properly configured and mod_rewrite is enabled.

3. Access the site through your web server, e.g., http://localhost/futureskill-clone/

## Running with PHP's Built-in Server

For development purposes, you can use PHP's built-in server:

```bash
cd futureskill-clone
php -S localhost:8000
```

Then open your browser and navigate to http://localhost:8000

## Viewing the Site

Since this is a clone project with a fake database in PHP arrays, you can browse all the pages and interact with the UI. The key pages you can visit are:

- **Home**: `/index.php` or just `/`
- **All Courses**: `/courses.php`
- **Course Details**: `/course.php?slug=facebook-ads-2025` (or any other course slug)
- **Categories**: `/category.php?slug=digital-marketing` (or any other category slug)
- **Learning Paths**: `/learning-paths.php`
- **Learning Path Details**: `/learning-path.php?slug=agile-basics-beginners` (or any other path slug)

## Project Structure

```
futureskill-clone/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   ├── jquery-3.6.0.min.js
│   │   └── main.js
│   └── images/
├── includes/
│   ├── config.php
│   ├── db.php
│   ├── functions.php
│   ├── header.php
│   └── footer.php
├── admin/    (placeholder for future admin panel)
├── index.php
├── course.php
├── courses.php
├── category.php
├── learning-paths.php
├── learning-path.php
├── error.php
├── .htaccess
└── README.md
```

## Note on the Fake Database

This project uses a "fake" database implementation for demonstration purposes. In a real-world application, you would connect to a MySQL or similar database system.

The fake database is implemented in `includes/db.php` and simulates database records using PHP arrays. Key functions:

- `getRecords('courses')` - Retrieves a list of courses
- `getRecordById('courses', 1)` - Retrieves a specific course by ID
- Helper functions in `includes/functions.php` make data retrieval even easier

## Disclaimer

This project is a UI/UX clone created for educational purposes only. It is not affiliated with or endorsed by FutureSkill.co. All product names, logos, and brands are property of their respective owners.

## License

This project is open-source and available under the MIT License.
