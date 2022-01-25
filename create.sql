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
)