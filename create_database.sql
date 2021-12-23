create table IF NOT EXISTS categories (
    categoryid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    description varchar(500),
    parent int DEFAULT NULL,
    FOREIGN KEY (parent) REFERENCES categories(categoryid) ON DELETE CASCADE
);

create table IF NOT EXISTS users ( 
    userid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username varchar(32) NOT NULL,
    email varchar(255) NOT NULL,
    profilepic BLOB,
    password varchar(64) NOT NULL,
    points int NOT NULL DEFAULT 0,
    isteacher int NOT NULL DEFAULT 0
);

create table IF NOT EXISTS posts (
    postid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title varchar(512) NOT NULL,
    text varchar(16384) NOT NULL,
    categoryid int,
    userid int,
    FOREIGN KEY (categoryid) REFERENCES categories(categoryid) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE
);

create table IF NOT EXISTS edits (
    editid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    text varchar(16384) NOT NULL,
    postid int,
    FOREIGN KEY (postid) REFERENCES posts(postid)
);

create table IF NOT EXISTS answers (
    answerid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    text varchar(16384) NOT NULL,
    isgood int NOT NULL DEFAULT 0,
    postid int,
    userid int,
    FOREIGN KEY (postid) REFERENCES posts(postid) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE
);

create table IF NOT EXISTS follow (
    categoryid int,
    userid int,
    notificationactivate int NOT NULL DEFAULT 0,
    FOREIGN KEY (categoryid) REFERENCES categories(categoryid) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES users(userid) ON DELETE CASCADE,
    PRIMARY KEY (userid,categoryid)
);

-- ---Insertion for example and tests
DELETE FROM categories;
ALTER TABLE categories AUTO_INCREMENT = 1;

DELETE FROM users;
ALTER TABLE users AUTO_INCREMENT = 1;

DELETE FROM posts;
ALTER TABLE posts AUTO_INCREMENT = 1;

DELETE FROM edits;
ALTER TABLE edits AUTO_INCREMENT = 1;

DELETE FROM answers;
ALTER TABLE answers AUTO_INCREMENT = 1;

DELETE FROM follow;
ALTER TABLE follow AUTO_INCREMENT = 1;

-- Categories
INSERT INTO categories(name,description) VALUES ("Programmation","Tous les languages ou concept de programmation");
    INSERT INTO categories(parent,name,description) VALUES (1,"Web","Tous les languages de programmation web");
        INSERT INTO categories(parent,name) VALUES (3,"HTML");
        INSERT INTO categories(parent,name) VALUES (3,"CSS");
        INSERT INTO categories(parent,name) VALUES (3,"JavaScript");
        INSERT INTO categories(parent,name) VALUES (3,"PHP");
    INSERT INTO categories(parent,name,description) VALUES (1,"Objet","Tous les languages de programmation orienté objet");
        INSERT INTO categories(parent,name) VALUES (7,"C#");
        INSERT INTO categories(parent,name) VALUES (7,"Java");
    INSERT INTO categories(parent,name) VALUES (1,"C");
    INSERT INTO categories(parent,name) VALUES (1,"Python");

INSERT INTO categories(name,description) VALUES ("Langue","Toutes les langues");
    INSERT INTO categories(parent,name) VALUES (12,"Français");
    INSERT INTO categories(parent,name) VALUES (12,"Anglais");
    INSERT INTO categories(parent,name) VALUES (12,"vietnamien");

-- Users

INSERT INTO users(username,email,password) VALUES("Foword","foword@gmail.com","123456");
INSERT INTO users(username,email,password) VALUES("Minh Duc","mduc@gmail.com","123456");
INSERT INTO users(username,email,password) VALUES("Galla","galla@gmail.com","123456");
INSERT INTO users(username,email,password) VALUES("Luckar","luckar@gmail.com","123456");
INSERT INTO users(username,email,password) VALUES("Aélar","thesuperaelar@gmail.com","123456");

-- Posts

INSERT INTO posts(title,categoryid,userid,text) VALUES("Le PHP c'est pas facile",6,4,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in dapibus ipsum, a auctor nibh. Donec dignissim arcu sit amet lorem faucibus commodo. Morbi blandit rutrum ullamcorper. Mauris porttitor in felis sollicitudin fermentum. Vivamus eu placerat justo. Donec mauris risus, suscipit a lacus quis, sollicitudin ullamcorper dui. In hac habitasse. ");
INSERT INTO posts(title,categoryid,userid,text) VALUES("J'aime bien le francais mais je comprend pas",13,1,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in dapibus ipsum, a auctor nibh. Donec dignissim arcu sit amet lorem faucibus commodo. Morbi blandit rutrum ullamcorper. Mauris porttitor in felis sollicitudin fermentum. Vivamus eu placerat justo. Donec mauris risus, suscipit a lacus quis, sollicitudin ullamcorper dui. In hac habitasse. ");
INSERT INTO posts(title,categoryid,userid,text) VALUES("De l'aide avec le python svp",11,5,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in dapibus ipsum, a auctor nibh. Donec dignissim arcu sit amet lorem faucibus commodo. Morbi blandit rutrum ullamcorper. Mauris porttitor in felis sollicitudin fermentum. Vivamus eu placerat justo. Donec mauris risus, suscipit a lacus quis, sollicitudin ullamcorper dui. In hac habitasse. ");
INSERT INTO posts(title,categoryid,userid,text) VALUES("Le Desygn Pattern State en Java",9,3,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in dapibus ipsum, a auctor nibh. Donec dignissim arcu sit amet lorem faucibus commodo. Morbi blandit rutrum ullamcorper. Mauris porttitor in felis sollicitudin fermentum. Vivamus eu placerat justo. Donec mauris risus, suscipit a lacus quis, sollicitudin ullamcorper dui. In hac habitasse. ");

-- Edits

INSERT INTO edits(text,)