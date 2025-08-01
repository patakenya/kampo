-- database.sql
-- Create database
CREATE DATABASE IF NOT EXISTS campus_hustle;
USE campus_hustle;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    membership_tier ENUM('Basic', 'Pro', 'Premium') NOT NULL,
    otp VARCHAR(6) NULL,
    is_verified BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create gigs table with category and difficulty
CREATE TABLE gigs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    icon VARCHAR(50) NOT NULL,
    icon_bg VARCHAR(50) NOT NULL,
    icon_color VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    payment VARCHAR(50) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    badge VARCHAR(50) NOT NULL,
    badge_bg VARCHAR(50) NOT NULL,
    badge_text VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL,
    difficulty VARCHAR(50) NOT NULL
);

-- Create payments table
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    membership_tier ENUM('Basic', 'Pro', 'Premium') NOT NULL,
    mpesa_code VARCHAR(20) NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert sample gigs
INSERT INTO gigs (title, icon, icon_bg, icon_color, description, payment, duration, badge, badge_bg, badge_text, category, difficulty) VALUES
('Article Writing', 'ri-edit-line', 'bg-blue-100', 'text-blue-600', 'Write blog posts on entrepreneurship or student life (500–800 words).', 'KES 600–1,000', '2–3 days', 'Premium', 'bg-yellow-100', 'text-yellow-700', 'Writing', 'Intermediate'),
('Digital Marketing', 'ri-megaphone-line', 'bg-purple-100', 'text-purple-600', 'Manage social media posts and campaigns for small businesses.', 'KES 800–2,000', '1–2 weeks', 'New', 'bg-green-100', 'text-green-600', 'Marketing', 'Advanced'),
('Transcription', 'ri-keyboard-line', 'bg-green-100', 'text-green-600', 'Transcribe audio interviews or podcasts into text.', 'KES 300–600', '1–3 hours', 'Quick Task', 'bg-blue-100', 'text-blue-600', 'Transcription', 'Beginner'),
('Data Entry', 'ri-database-line', 'bg-orange-100', 'text-orange-600', 'Enter data for market research or business records.', 'KES 400–800', '2–4 hours', 'Premium', 'bg-yellow-100', 'text-yellow-700', 'Data Entry', 'Beginner'),
('Graphic Design', 'ri-palette-line', 'bg-indigo-100', 'text-indigo-600', 'Create logos or social media graphics for businesses.', 'KES 700–1,500', '3–5 days', 'New', 'bg-green-100', 'text-green-600', 'Design', 'Intermediate'),
('Virtual Assistance', 'ri-briefcase-line', 'bg-pink-100', 'text-pink-600', 'Handle emails, scheduling, or customer support for entrepreneurs.', 'KES 500–1,200', '2–5 hours', 'Quick Task', 'bg-blue-100', 'text-blue-600', 'Virtual Assistance', 'Beginner'),
('Web Research', 'ri-search-line', 'bg-teal-100', 'text-teal-600', 'Conduct research for competitor analysis or market trends.', 'KES 400–800', '2–4 hours', 'Premium', 'bg-yellow-100', 'text-yellow-700', 'Research', 'Intermediate'),
('Content Editing', 'ri-file-edit-line', 'bg-red-100', 'text-red-600', 'Proofread and edit blog posts or website content.', 'KES 500–1,000', '1–3 hours', 'New', 'bg-green-100', 'text-green-600', 'Writing', 'Intermediate'),
('Online Surveys', 'ri-survey-line', 'bg-yellow-100', 'text-yellow-600', 'Complete paid surveys for brands targeting students.', 'KES 100–300', '30 min–1 hour', 'Quick Task', 'bg-blue-100', 'text-blue-600', 'Surveys', 'Beginner'),
('Social Media Content Creation', 'ri-video-line', 'bg-cyan-100', 'text-cyan-600', 'Create TikTok or Instagram Reels for businesses.', 'KES 600–1,500', '2–4 days', 'Premium', 'bg-yellow-100', 'text-yellow-700', 'Marketing', 'Intermediate'),
('Website Testing', 'ri-code-line', 'bg-blue-100', 'text-blue-600', 'Test websites for usability and report bugs or issues.', 'KES 300–700', '1–2 hours', 'New', 'bg-green-100', 'text-green-600', 'Testing', 'Beginner'),
('Translation', 'ri-translate-2', 'bg-purple-100', 'text-purple-600', 'Translate documents or content between English and Swahili.', 'KES 500–1,200', '2–5 hours', 'Premium', 'bg-yellow-100', 'text-yellow-700', 'Translation', 'Intermediate');