CREATE DATABASE IF NOT EXISTS MovieBooking;
USE MovieBooking;

-- Bảng status_movies (trạng thái phim)
CREATE TABLE status_movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(50) NOT NULL UNIQUE
);

-- Bảng seat_types (loại ghế)
CREATE TABLE seat_types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    seat_type VARCHAR(50) NOT NULL UNIQUE
);

-- Bảng booking_status (trạng thái đặt vé)
CREATE TABLE booking_status (
    id INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(50) NOT NULL UNIQUE
);

-- Bảng payment_methods (phương thức thanh toán)
CREATE TABLE payment_methods (
    id INT PRIMARY KEY AUTO_INCREMENT,
    payment_method VARCHAR(50) NOT NULL UNIQUE
);

-- Insert dữ liệu vào các bảng trạng thái và loại hình
INSERT INTO status_movies (status) VALUES 
    ('coming soon'), ('now showing'), ('ended');

INSERT INTO seat_types (seat_type) VALUES 
    ('standard'), ('VIP');

INSERT INTO booking_status (status) VALUES 
    ('pending'), ('confirmed'), ('canceled');

INSERT INTO payment_methods (payment_method) VALUES 
    ('credit card'), ('paypal'), ('momo'), ('vnpay');

-- Bảng movies (thông tin phim)
CREATE TABLE movies (
    movie_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    director VARCHAR(255),
    cast TEXT,
    genre VARCHAR(100),
    duration INT,
    release_date DATE,
    status_id INT DEFAULT 1,
    poster_url VARCHAR(255),
    trailer_url VARCHAR(255),
    FOREIGN KEY (status_id) REFERENCES status_movies(id)
);

-- Bảng cinemas (thông tin rạp chiếu)
CREATE TABLE cinemas (
    cinema_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100),
    phone_number VARCHAR(20)
);

-- Bảng screens (phòng chiếu)
CREATE TABLE screens (
    screen_id INT PRIMARY KEY AUTO_INCREMENT,
    cinema_id INT,
    name VARCHAR(50) NOT NULL,
    seat_capacity INT NOT NULL,
    FOREIGN KEY (cinema_id) REFERENCES cinemas(cinema_id) ON DELETE CASCADE
);

-- Bảng seats (ghế ngồi)
CREATE TABLE seats (
    seat_id INT PRIMARY KEY AUTO_INCREMENT,
    screen_id INT,
    `row` CHAR(1) NOT NULL,
    number INT NOT NULL,
    seat_type_id INT DEFAULT 1,
    FOREIGN KEY (screen_id) REFERENCES screens(screen_id) ON DELETE CASCADE,
    FOREIGN KEY (seat_type_id) REFERENCES seat_types(id)
);

-- Bảng showtimes (lịch chiếu)
CREATE TABLE showtimes (
    showtime_id INT PRIMARY KEY AUTO_INCREMENT,
    movie_id INT,
    screen_id INT,
    show_date DATE NOT NULL,
    show_time TIME NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id) ON DELETE CASCADE,
    FOREIGN KEY (screen_id) REFERENCES screens(screen_id) ON DELETE CASCADE
);

-- Bảng customers (khách hàng)
CREATE TABLE customers (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone_number VARCHAR(20),
    password_hash VARCHAR(255) NOT NULL,
    registered_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng bookings (đặt vé)
CREATE TABLE bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT,
    showtime_id INT,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10, 2) NOT NULL,
    booking_status_id INT DEFAULT 1,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (showtime_id) REFERENCES showtimes(showtime_id) ON DELETE CASCADE,
    FOREIGN KEY (booking_status_id) REFERENCES booking_status(id)
);

-- Bảng booking_details (chi tiết đặt vé)
CREATE TABLE booking_details (
    detail_id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT,
    seat_id INT,
    price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE,
    FOREIGN KEY (seat_id) REFERENCES seats(seat_id) ON DELETE CASCADE
);

-- Bảng payments (thanh toán)
CREATE TABLE payments (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method_id INT NOT NULL,
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id) ON DELETE CASCADE,
    FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id)
);

-- Bảng reviews (đánh giá phim)
CREATE TABLE reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    movie_id INT,
    customer_id INT,
    rating INT NOT NULL,
    comment TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE
);
