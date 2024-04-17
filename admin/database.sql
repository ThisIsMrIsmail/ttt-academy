
-- DATABASE NAME: triblet
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
    user_contact_number VARCHAR(50),
    user_age INT,
    user_gender VARCHAR(50),
    user_bio TEXT,
    username VARCHAR(50) UNIQUE KEY NOT NULL,
    user_email VARCHAR(255) UNIQUE KEY NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_verified INT NOT NULL,
    user_verification_code VARCHAR(255)
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
    payment_action_date DATETIME,
    payment_total_paid_amount DECIMAL(10,2) NOT NULL,
    payment_transfer_number VARCHAR(50),
    payment_platform_transfer_number VARCHAR(50) NOT NULL,
    payment_operation_number VARCHAR(50),
    user_id INT
);

CREATE TABLE payment_courses (
    payment_courses_id INT PRIMARY KEY AUTO_INCREMENT,
    payment_id INT NOT NULL,
    course_id INT,
    course_name VARCHAR(255) NOT NULL,
    course_price DECIMAL(10, 2) NOT NULL
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
VALUES ('admin', 'helloworld');

INSERT INTO platform_transfar_numbers (plat_trans_no)
VALUES ('010123456789');

-- INSERT INTO instructors (instructor_full_name, instructor_title, instructor_email, instructor_contact_number, instructor_bio, instructor_years_of_experience) VALUES
-- ('Mr. Ismail Sherif', 'Programmer (Full Stack)', 'ismailsherifwork@gmail.com', '201212145841', '   Hi, ThisIsMrIsmail. student at faculty of computers and AI. skilled in web development and passionate about artificial intelligence, especially deep learning.   ', 3),
-- ('Mr. Nader Ahmed', 'Professor', 'nader@gmail.com', '201099276090', 'I am student.', 4),
-- ('Hassanin Said', 'Front end Developer', 'hassanin@gmail.com', '201063464320', 'I am a Front end Developer.', 3),
-- ('Mina Hany', 'Front end Developer', 'mina@gmail.com', '0123456799', ' I am a Front end Developer. ', 10),
-- ('Omar Ehab', 'Professor PhD HUN-FCAI', 'omar@gmail.com', '201004875770', '  I am a Professor PhD Hurghada FCAI.  ', 15);


-- INSERT INTO courses (course_name, course_description, course_price, instructor_id)
-- VALUES
-- ('Automate the Boring Stuff with Python Programming', 'Automate the Boring Stuff with Python was written for people who want to get up to speed writing small programs that do practical tasks as soon as possible. Automate the Boring Stuff with Python was written for people who want to get up to speed writing small programs that do practical tasks as soon as possible.', '19.99', 1),
-- ('Machine Learning A-Z: AI, Python & R + ChatGPT Bonus [2023]', 'Interested in the field of Machine Learning? Then this course is for you! This course has been designed by a Data Scientist and a Machine Learning expert so that we can share our knowledge. Interested in the field of Machine Learning? Then this course is for you! This course has been designed by a Data Scientist and a Machine Learning expert so that we can share our knowledge.', '30.99', 1),
-- ('100 Days of Code: The Complete Python Pro Bootcamp for 2023', 'Welcome to the 100 Days of Code - The Complete Python Pro Bootcamp, the only course you need to learn to code with Python. With over 500,000 5 STAR reviews and a 4.8 average, my courses are some of the HIGHEST RATED courses in the history of Udemy! Welcome to the 100 Days of Code - The Complete Python Pro Bootcamp, the only course you need to learn to code with Python. With over 500,000 5 STAR reviews and a 4.8 average, my courses are some of the HIGHEST RATED courses in the history of Udemy!', '24.55', 1),
-- ('The Complete Flutter Development Bootcamp with Dart', 'We built this course over months, perfecting the curriculum together with the Flutter team to teach you Flutter from scratch and make you into  a skilled Flutter developer with a strong portfolio of beautiful Flutter apps. We built this course over months, perfecting the curriculum together with the Flutter team to teach you Flutter from scratch and make you into  a skilled Flutter developer with a strong portfolio of beautiful Flutter apps.', '59.99', 4),
-- ('Beginner Canon Digital SLR (DSLR) Photography', 'You\"ll learn how all those buttons and dials work on your Canon DSLR. Including the exercises, this course will take you about 2.5 hours. Through the exercises you\"ll do and through the explanations of the concepts, JP is committed that you retain the information there is to retain without memorizing. You\"ll learn how all those buttons and dials work on your Canon DSLR. Including the exercises, this course will take you about 2.5 hours. Through the exercises you\"ll do and through the explanations of the concepts, JP is committed that you retain the information there is to retain without memorizing.', '19.99', 2),
-- ('Photography Starter Kit For Canon Dslr Beginners', 'In Photography Starter Kit for Canon DSLR Beginners you will learn the most essential functions of your camera and more importantly taught how to put this useful knowledge into action. Youï¿½ll get the swing of basic photographic terminology and absolutely feel prepared to move on to more advanced classes. In Photography Starter Kit for Canon DSLR Beginners you will learn the most essential functions of your camera and more importantly taught how to put this useful knowledge into action. Youï¿½ll get the swing of basic photographic terminology and absolutely feel prepared to move on to more advanced classes.', '10.00', 3),
-- ('Take Your Camera Off Auto Mode for Canon Entry-Level DSLR', 'When I first started teaching photography in 2007, I taught it just like a photographer. In a very technical way. And I used to explain what every button on their camera did. I realized quickly that, for the average person, it was way too much info!  When I first started teaching photography in 2007, I taught it just like a photographer. In a very technical way. And I used to explain what every button on their camera did. I realized quickly that, for the average person, it was way too much info!', '16.00', 4),
-- ('User Experience Design Fundamentals', 'Are your web conversion rates low? Do you know whether your web site is effective at meeting your goals?  Do users get \"stuck\" and aren\"t able to complete the tasks they want to?  Are your forms effective? How can your mobile app be improved? Are your web conversion rates low? Do you know whether your web site is effective at meeting your goals?  Do users get \"stuck\" and aren\"t able to complete the tasks they want to?  Are your forms effective? How can your mobile app be improved?', '30.00', 2),
-- ('UX & Web Design Master Course: Strategy, Design, Development', 'This course will teach you everything you need to know about UX, including design, content, and coding. And you\"ll learn from the ground up, so it doesn\"t matter how much experience you have when you start. This course will teach you everything you need to know about UX, including design, content, and coding. And you\"ll learn from the ground up, so it doesn\"t matter how much experience you have when you start.', '54.00', 5);