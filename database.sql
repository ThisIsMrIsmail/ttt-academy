
-- DATABASE NAME: ttt
CREATE DATABASE triblet;
USE triblet;

CREATE TABLE courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    course_name VARCHAR(255) NOT NULL,
    course_description TEXT,
    course_price DECIMAL(10, 2) NOT NULL,
    instructor_id INT
);

-- -----------------------------------------------------------

CREATE TABLE levels (
    level_id INT PRIMARY KEY AUTO_INCREMENT,
    level_name VARCHAR(50) NOT NULL,
    level_description TEXT,
    level_duration INT,
    course_id INT
);
-- -----------------------------------------------------------

CREATE TABLE users_courses (
    user_id INT NOT NULL,
    course_id INT NOT NULL
);

-- -----------------------------------------------------------

CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_full_name VARCHAR(50) NOT NULL,
    user_contact_number VARCHAR(50) NOT NULL,
    user_age INT,
    user_gender VARCHAR(50),
    user_bio TEXT,
    username VARCHAR(50) UNIQUE KEY NOT NULL,
    user_email VARCHAR(255) UNIQUE KEY NOT NULL,
    user_password VARCHAR(255) NOT NULL
);
-- -----------------------------------------------------------

CREATE TABLE instructors (
    instructor_id INT PRIMARY KEY AUTO_INCREMENT,
    instructor_full_name VARCHAR(50) NOT NULL,
    instructor_title VARCHAR(50) NOT NULL,
    instructor_email VARCHAR(50) UNIQUE KEY,
    instructor_contact_number VARCHAR(255) UNIQUE KEY,
    instructor_bio TEXT,
    instructor_years_of_experience INT
);
-- -----------------------------------------------------------

CREATE TABLE reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    review_rating INT NOT NULL,
    review_comment TEXT,
    user_id INT NOT NULL,
    course_id INT NOT NULL
);

CREATE TABLE carts (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    course_id INT NOT NULL
);

CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    payment_status INT NOT NULL,
    payment_action_date DATE,
    payment_total_paid_amount DECIMAL(10,2) NOT NULL,
    payment_transfer_number VARCHAR(50),
    payment_platform_transfare_numbers VARCHAR(50) NOT NULL,
    payment_operation_number VARCHAR(50),
    user_id INT NOT NULL
);

CREATE TABLE payment_courses (
    payment_courses_id INT PRIMARY KEY AUTO_INCREMENT,
    payment_id INT NOT NULL,
    course_id INT NOT NULL
);

CREATE TABLE admins (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    admin_username varchar(50) UNIQUE KEY NOT NULL,
    admin_password varchar(255) NOT NULL
);

CREATE TABLE platform_transfar_numbers (
  plat_trans_id INT PRIMARY KEY AUTO_INCREMENT,
  plat_trans_no VARCHAR(50) NOT NULL
);



ALTER TABLE payments
    ADD FOREIGN KEY (user_id) REFERENCES users (user_id);
    
ALTER TABLE payment_courses
    ADD FOREIGN KEY (course_id) REFERENCES courses (course_id),
    ADD FOREIGN KEY (payment_id) REFERENCES payments (payment_id);

ALTER TABLE courses
    ADD FOREIGN KEY (instructor_id) REFERENCES instructors (instructor_id);

ALTER TABLE levels
    ADD FOREIGN KEY (course_id) REFERENCES courses (course_id);

ALTER TABLE carts
    ADD FOREIGN KEY (user_id) REFERENCES users (user_id),
    ADD FOREIGN KEY (course_id) REFERENCES courses (course_id);

ALTER TABLE reviews
    ADD FOREIGN KEY (user_id) REFERENCES users (user_id),
    ADD FOREIGN KEY (course_id) REFERENCES courses (course_id);

ALTER TABLE users_courses
    ADD PRIMARY KEY (user_id, course_id),
    ADD FOREIGN KEY (user_id) REFERENCES users (user_id),
    ADD FOREIGN KEY (course_id) REFERENCES courses (course_id);



-- DATA INSERT
INSERT INTO admins (admin_username, admin_password)
VALUES ('admin', 'admin');
