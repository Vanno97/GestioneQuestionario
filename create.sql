CREATE TABLE `role` (
    `role_id` INT AUTO_INCREMENT,
    `role_name` VARCHAR(50),
    PRIMARY KEY (`role_id`)
);

CREATE TABLE `user` (
    `user_id` INT AUTO_INCREMENT,
    `username` VARCHAR(500),
    `password` VARCHAR(500),
    PRIMARY KEY (`user_id`)
);

CREATE TABLE `user_roles` (
    `user_id` INT,
    `role_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY (`role_id`) REFERENCES `role`(`role_id`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

DELIMITER $$
CREATE PROCEDURE insertUser(IN usernameToInsert VARCHAR(50), IN passwordToInsert VARCHAR(50))
BEGIN
    DECLARE userId INT;
    DECLARE roleId INT;
    INSERT INTO `user` (`username`,`password`) VALUES (usernameToInsert,passwordToInsert);
    SELECT user_id INTO userId FROM `user` WHERE `username` = usernameToInsert AND `password` = passwordToInsert;
    SELECT role_id INTO roleId FROM `role` WHERE `role_name` = 'ROLE_USER';
    INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES (userId, roleId);
END $$
DELIMITER ;