SHOW ENGINES;

CREATE DATABASE krotravel_db;


USE krotravel_db;

CREATE TABLE `paket_tour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(255) NOT NULL,
  `destinasi` varchar(255) NOT NULL,
  `harga_normal` int(11) NOT NULL,
  `harga_promo` int(11) NOT NULL,
  PRIMARY KEY (`id`)
)

INSERT INTO `paket_tour` (`nama_paket`, `destinasi`, `harga_normal`, `harga_promo`) VALUES
('7D/5N Fun Adventure Of Korea', 'Korea Selatan', 21000000, 18533000),
('8D/7N Amazing Turkey', 'Turki', 14000000, 12500000),
('5D/4N Explore Singapore & Cruise', 'Singapura & Royal Caribbean', 11500000, 9800000);

SHOW TABLES;
