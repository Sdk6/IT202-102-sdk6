-- Active: 1675127507101@@db.ethereallab.app@3306@sdk6
CREATE TABLE User_Roles(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    create_time DATETIME COMMENT 'Create Time',
    user_id int NOT NULL,
    FOREIGN KEY(user_id) REFERENCES Users(id)
) COMMENT ''