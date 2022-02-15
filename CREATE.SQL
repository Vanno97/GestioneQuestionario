CREATE TABLE `role` (
    `role_id` INT AUTO_INCREMENT,
    `role` VARCHAR(20),
    PRIMARY KEY (`role_id`)
);

CREATE TABLE `course` (
    `course_id` INT AUTO_INCREMENT,
    `course_name` VARCHAR (50),
    `course_description` VARCHAR (500),
    PRIMARY KEY (`course_id`)
);

CREATE TABLE `user` (
    `user_id` INT AUTO_INCREMENT,
    `username` VARCHAR (255),
    `password` VARCHAR (255),
    PRIMARY KEY (`user_id`)
);

CREATE TABLE `user_roles` (
    `user` INT,
    `role` INT,
    FOREIGN KEY (`user`) REFERENCES `user`(`user_id`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY (`role`) REFERENCES `role`(`role_id`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE `user_courses` (
    `can_vote` BOOLEAN,
    `user` INT,
    `course` INT,
    FOREIGN KEY (`user`) REFERENCES `user`(`user_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (`course`) REFERENCES `course`(`course_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE `survey` (
    `survey_id` INT AUTO_INCREMENT,
    `title` VARCHAR (50),
    `description` VARCHAR (500),
    `course` INT,
    PRIMARY KEY (`survey_id`),
    FOREIGN KEY (`course`) REFERENCES `course`(`course_id`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

CREATE TABLE `project` (
    `project_id` INT AUTO_INCREMENT,
    `name` VARCHAR (255),
    `description` VARCHAR(500),
    `survey` INT,
    PRIMARY KEY (`project_id`),
    FOREIGN KEY (`survey`) REFERENCES `survey`(`survey_id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE `answer` (
    `answer_id` INT AUTO_INCREMENT,
    `project` INT,
    `user` INT,
    PRIMARY KEY (`answer_id`),
    FOREIGN KEY (`project`) REFERENCES `project`(`project_id`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
)