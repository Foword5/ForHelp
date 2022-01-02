DROP DATABASE IF EXISTS projet;
CREATE DATABASE projet;

create table IF NOT EXISTS projet.categories (
    categoryid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    description varchar(500),
    parent int DEFAULT NULL,
    FOREIGN KEY (parent) REFERENCES projet.categories(categoryid) ON DELETE CASCADE
);

create table IF NOT EXISTS projet.users ( 
    userid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username varchar(32) NOT NULL,
    email varchar(255) NOT NULL,
    profilepic BLOB,
    password varchar(64) NOT NULL,
    points int NOT NULL DEFAULT 0,
    isteacher int NOT NULL DEFAULT 0
);

create table IF NOT EXISTS projet.posts (
    postid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title varchar(512) NOT NULL,
    text varchar(16384) NOT NULL,
    categoryid int,
    userid int,
    FOREIGN KEY (categoryid) REFERENCES projet.categories(categoryid) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES projet.users(userid) ON DELETE CASCADE
);

create table IF NOT EXISTS projet.edits (
    editid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    text varchar(16384) NOT NULL,
    postid int,
    FOREIGN KEY (postid) REFERENCES projet.posts(postid) ON DELETE CASCADE
);

create table IF NOT EXISTS projet.answers (
    answerid int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    text varchar(16384) NOT NULL,
    isgood int NOT NULL DEFAULT 0,
    postid int,
    userid int,
    parent int,
    FOREIGN KEY (parent) REFERENCES projet.answers(answerid) ON DELETE CASCADE,
    FOREIGN KEY (postid) REFERENCES projet.posts(postid) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES projet.users(userid) ON DELETE CASCADE
);

create table IF NOT EXISTS projet.follow (
    categoryid int,
    userid int,
    notificationactivate int NOT NULL DEFAULT 0,
    FOREIGN KEY (categoryid) REFERENCES projet.categories(categoryid) ON DELETE CASCADE,
    FOREIGN KEY (userid) REFERENCES projet.users(userid) ON DELETE CASCADE,
    PRIMARY KEY (userid,categoryid)
);

-- ---Insertion for example and tests
DELETE FROM projet.categories;
ALTER TABLE projet.categories AUTO_INCREMENT = 1;

DELETE FROM projet.users;
ALTER TABLE projet.users AUTO_INCREMENT = 1;

DELETE FROM projet.posts;
ALTER TABLE projet.posts AUTO_INCREMENT = 1;

DELETE FROM projet.edits;
ALTER TABLE projet.edits AUTO_INCREMENT = 1;

DELETE FROM projet.answers;
ALTER TABLE projet.answers AUTO_INCREMENT = 1;

DELETE FROM projet.follow;
ALTER TABLE projet.follow AUTO_INCREMENT = 1;

-- projet.categories
INSERT INTO projet.categories(name,description) VALUES ("Programmation","Tous les languages ou concept de programmation");
    INSERT INTO projet.categories(parent,name,description) VALUES (1,"Web","Tous les languages de programmation web");
        INSERT INTO projet.categories(parent,name) VALUES (2,"HTML");
        INSERT INTO projet.categories(parent,name) VALUES (2,"CSS");
        INSERT INTO projet.categories(parent,name) VALUES (2,"JavaScript");
        INSERT INTO projet.categories(parent,name) VALUES (2,"PHP");
    INSERT INTO projet.categories(parent,name,description) VALUES (1,"Objet","Tous les languages de programmation orienté objet");
        INSERT INTO projet.categories(parent,name) VALUES (7,"C#");
        INSERT INTO projet.categories(parent,name) VALUES (7,"Java");
    INSERT INTO projet.categories(parent,name) VALUES (1,"C");
    INSERT INTO projet.categories(parent,name) VALUES (1,"Python");

INSERT INTO projet.categories(name,description) VALUES ("Langue","Toutes les langues");
    INSERT INTO projet.categories(parent,name) VALUES (12,"Français");
    INSERT INTO projet.categories(parent,name) VALUES (12,"Anglais");
    INSERT INTO projet.categories(parent,name) VALUES (12,"vietnamien");

-- projet.users

INSERT INTO projet.users(username,email,password) VALUES("Foword","foword@gmail.com","123456");
INSERT INTO projet.users(username,email,password) VALUES("Minh Duc","mduc@gmail.com","123456");
INSERT INTO projet.users(username,email,password) VALUES("Galla","galla@gmail.com","123456");
INSERT INTO projet.users(username,email,password) VALUES("Luckar","luckar@gmail.com","123456");
INSERT INTO projet.users(username,email,password) VALUES("Aélar","thesuperaelar@gmail.com","123456");

-- projet.posts

INSERT INTO projet.posts(title,categoryid,userid,text) VALUES("Le PHP c'est pas facile",6,4,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in dapibus ipsum, a auctor nibh. Donec dignissim arcu sit amet lorem faucibus commodo. Morbi blandit rutrum ullamcorper. Mauris porttitor in felis sollicitudin fermentum. Vivamus eu placerat justo. Donec mauris risus, suscipit a lacus quis, sollicitudin ullamcorper dui. In hac habitasse. ");
INSERT INTO projet.posts(title,categoryid,userid,text) VALUES("J'aime bien le francais mais je comprend pas",13,1,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in dapibus ipsum, a auctor nibh. Donec dignissim arcu sit amet lorem faucibus commodo. Morbi blandit rutrum ullamcorper. Mauris porttitor in felis sollicitudin fermentum. Vivamus eu placerat justo. Donec mauris risus, suscipit a lacus quis, sollicitudin ullamcorper dui. In hac habitasse. ");
INSERT INTO projet.posts(title,categoryid,userid,text) VALUES("De l'aide avec le python svp",11,5,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in dapibus ipsum, a auctor nibh. Donec dignissim arcu sit amet lorem faucibus commodo. Morbi blandit rutrum ullamcorper. Mauris porttitor in felis sollicitudin fermentum. Vivamus eu placerat justo. Donec mauris risus, suscipit a lacus quis, sollicitudin ullamcorper dui. In hac habitasse. ");
INSERT INTO projet.posts(title,categoryid,userid,text) VALUES("Le Desygn Pattern State en Java",9,3,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in dapibus ipsum, a auctor nibh. Donec dignissim arcu sit amet lorem faucibus commodo. Morbi blandit rutrum ullamcorper. Mauris porttitor in felis sollicitudin fermentum. Vivamus eu placerat justo. Donec mauris risus, suscipit a lacus quis, sollicitudin ullamcorper dui. In hac habitasse. ");

-- projet.edits

INSERT INTO projet.edits(postid,text) VALUES (1,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis justo nec ex posuere, eget rutrum tellus posuere. In lobortis. ");
INSERT INTO projet.edits(postid,text) VALUES (3,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mattis justo nec ex posuere, eget rutrum tellus posuere. In lobortis. ");

-- projet.answers

INSERT INTO projet.answers(isgood,userid,postid,text) VALUES (0,1,1,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin laoreet. ");
INSERT INTO projet.answers(isgood,userid,postid,text) VALUES (0,3,2,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin laoreet. ");
INSERT INTO projet.answers(isgood,userid,postid,text) VALUES (1,2,1,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin laoreet. ");
INSERT INTO projet.answers(isgood,userid,postid,text) VALUES (0,1,3,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin laoreet. ");
INSERT INTO projet.answers(isgood,userid,postid,text) VALUES (1,2,3,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin laoreet. ");
INSERT INTO projet.answers(isgood,userid,postid,text) VALUES (0,3,3,"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin laoreet. ");

-- projet.follow

INSERT INTO projet.follow(categoryid,userid) VALUES (3,1);
INSERT INTO projet.follow(categoryid,userid) VALUES (4,1);
INSERT INTO projet.follow(categoryid,userid) VALUES (5,2);
INSERT INTO projet.follow(categoryid,userid) VALUES (15,2);
INSERT INTO projet.follow(categoryid,userid) VALUES (9,3);
INSERT INTO projet.follow VALUES (2,1,1);
INSERT INTO projet.follow VALUES (8,3,1);
INSERT INTO projet.follow VALUES (2,3,1);
INSERT INTO projet.follow VALUES (8,2,1);
INSERT INTO projet.follow VALUES (1,5,1);