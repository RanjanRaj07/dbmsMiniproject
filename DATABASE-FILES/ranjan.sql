ALTER TABLE `ranjan`.`company` ADD FOREIGN KEY (`p_id`) REFERENCES `places`(`p_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

INSERT INTO `places` (`p_name`, `p_id`) VALUES ('Balglore', '560001');

INSERT INTO `users` (`u_id`, `u_name`, `c_id`, `p_id`, `gender`) VALUES ('9740200327', 'Ranjan', 'CS001', '560001', 'male');