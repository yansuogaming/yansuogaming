SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE shop_db;
USE shop_db;


CREATE TABLE cart (
  id int(100) NOT NULL,
  user_id int(100) NOT NULL,
  pid int(100) NOT NULL,
  name varchar(100) NOT NULL,
  price int(100) NOT NULL,
  quantity int(100) NOT NULL,
  image varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO cart (id, user_id, pid, name, price, quantity, image) VALUES
(129, 14, 16, 'lavender rose', 13, 1, 'lavender_rose.jpg'),
(130, 14, 18, 'red tulip', 11, 1, 'red_tulip.jpg'),
(131, 14, 15, 'cottage rose', 15, 1, 'cottage_rose.jpg'),
(132, 15, 13, 'pink rose', 10, 1, 'pink_rose.jpg'),
(133, 15, 15, 'cottage rose', 15, 1, 'cottage_rose.jpg'),
(134, 15, 16, 'lavender rose', 13, 3, 'lavender_rose.jpg');



CREATE TABLE message (
  id int(100) NOT NULL,
  user_id int(100) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  number varchar(12) NOT NULL,
  message varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO message (id, user_id, name, email, number, message) VALUES (13, 14, 'shaikh anas', 'shaikh@gmail.com', '0987654321', 'hi, how are you?');


CREATE TABLE orders (
  id int(100) NOT NULL,
  user_id int(100) NOT NULL,
  name varchar(100) NOT NULL,
  number varchar(12) NOT NULL,
  email varchar(100) NOT NULL,
  method varchar(50) NOT NULL,
  address varchar(500) NOT NULL,
  total_products varchar(1000) NOT NULL,
  total_price int(100) NOT NULL,
  placed_on varchar(50) NOT NULL,
  payment_status varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO orders (id, user_id, name, number, email, method, address, total_products, total_price, placed_on, payment_status) VALUES
(17, 14, 'shaikh anas', '0987654321', 'shaikh@gmail.com', 'credit card', 'flat no. 321, jogeshwari, mumbai, india - 654321', 'cottage rose (3), pink bouquet (1), yellow queen rose (1)', 80, '11-Mar-2022', 'pending'),
(18, 14, 'shaikh anas', '1234567899', 'shaikh@gmail.com', 'paypal', 'flat no. 321, jogeshwari, mumbai, india - 654321', 'yellow queen rose (1), pink rose (2)', 40, '11-Mar-2022', 'completed');
-- --------------------------------------------------------


CREATE TABLE products (
  id int(100) NOT NULL,
  name varchar(100) NOT NULL,
  details varchar(500) NOT NULL,
  price int(100) NOT NULL,
  image varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO products (id, name, details, price, image) VALUES
(13, 'pink rose', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 12, 'pink_roses.jpg'),
(15, 'cottage rose', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 15, 'cottage_rose.jpg'),
(16, 'lavender rose', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, nobis tenetur voluptatibus officiis odit minus fugit dolore accusantium fuga ipsa!', 13, 'lavender_rose.jpg'),
(17, 'yellow tulipa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 14, 'yellow_tulipa.jpg'),
(18, 'red tulipa', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, nobis tenetur voluptatibus officiis odit minus fugit dolore accusantium fuga ipsa!', 11, 'red_tulipa.jpg'),
(19, 'pink bouquet', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 15, 'pink_bouquet.jpg'),
(20, 'pink queen rose', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque error earum quasi facere optio tenetur.', 24, 'pink_queen_rose.jpg');
-- --------------------------------------------------------



CREATE TABLE users (
  id int(100) NOT NULL,
  name varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  user_type varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO users (id, name, email, password, user_type) VALUES
(10, 'admin A', 'admin01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'admin'),
(14, 'user A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(15, 'user B', 'user02@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user');


CREATE TABLE wishlist (
  id int(100) NOT NULL,
  user_id int(100) NOT NULL,
  pid int(100) NOT NULL,
  name varchar(100) NOT NULL,
  price int(100) NOT NULL,
  image varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO wishlist (id, user_id, pid, name, price, image) VALUES
(60, 14, 19, 'pink bouquet', 15, 'pink_bouquet.jpg');

ALTER TABLE cart
  ADD PRIMARY KEY (id);


ALTER TABLE message
  ADD PRIMARY KEY (id);

ALTER TABLE orders
  ADD PRIMARY KEY (id);


ALTER TABLE products
  ADD PRIMARY KEY (id);


ALTER TABLE users
  ADD PRIMARY KEY (id);

ALTER TABLE cart
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

ALTER TABLE message
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE orders
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE products
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE users
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE wishlist
  MODIFY id int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

COMMIT;


