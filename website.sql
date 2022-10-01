USE ;

DROP TABLE IF EXISTS RATES;
DROP TABLE IF EXISTS HASTAGS;
DROP TABLE IF EXISTS POST;
DROP TABLE IF EXISTS TAG;
DROP TABLE IF EXISTS ACCOUNT;

CREATE TABLE ACCOUNT (
	accountID INT(5) NOT NULL AUTO_INCREMENT,
	accountName VARCHAR(30) NOT NULL,
    accountPassword VARCHAR(50) NOT NULL,
    accountRole VARCHAR(10) NOT NULL, 
    accountEmail VARCHAR(200) NOT NULL,
	PRIMARY KEY (accountID)
	)
	ENGINE=InnoDB;

CREATE TABLE TAG (
    tagID INT(5) NOT NULL AUTO_INCREMENT,
    tagName VARCHAR(50) NOT NULL,
    PRIMARY KEY(tagID)
    )
    ENGINE=InnoDB;

CREATE TABLE POST (
    postID INT(5) NOT NULL AUTO_INCREMENT,
    postContent MEDIUMTEXT NOT NULL,
    postDATE DATE NOT NULL,
    postTitle VARCHAR(200) NOT NULL,
    accountID INT(5) NOT NULL,
    PRIMARY KEY (postID),
    FOREIGN KEY (accountID) REFERENCES ACCOUNT (accountID)
    )
    ENGINE=InnoDB;

CREATE TABLE HASTAGS (
    postID INT(5) NOT NULL,
    tagID INT(5) NOT NULL,
    PRIMARY KEY(postID, tagID),
    FOREIGN KEY (postID) REFERENCES POST (postID),
    FOREIGN KEY (tagID) REFERENCES TAG (tagID)
    )
    ENGINE=InnoDB;

CREATE TABLE RATES (
    accountID INT(5) NOT NULL,
    postID INT(5) NOT NULL,
    PRIMARY KEY(accountID, postID),
    FOREIGN KEY (accountID) REFERENCES ACCOUNT (accountID),
    FOREIGN KEY (postID) REFERENCES POST (postID)
    )
    ENGINE=InnoDB;

INSERT INTO ACCOUNT VALUES (1,'admin', 'kit202', 'ADMIN', 'admin@admin.com');
INSERT INTO ACCOUNT VALUES (2,'member', 'kit202', 'MEMBER', 'member@member.com');

INSERT INTO TAG VALUES (1,'lorem');
INSERT INTO TAG VALUES (2,'ipsum');

INSERT INTO POST VALUES (1,"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
Ut enim ad minim veniam, quis nostrud exercitation ullamco* laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
mollit anim id est laborum.", '2022-9-28', "Lorem Ipsum", 1);
INSERT INTO POST VALUES (2,"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
mollit anim id est laborum.", '2022-9-28', "Lorem Ipsum", 1);
INSERT INTO POST VALUES (3,"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
mollit anim id est laborum.", '2022-9-28', "Lorem Ipsum", 1);
INSERT INTO POST VALUES (4,"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
mollit anim id est laborum.", '2022-9-28', "Lorem Ipsum",1);
INSERT INTO POST VALUES (5,"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
mollit anim id est laborum.", '2022-9-28', "Lorem Ipsum", 1);

INSERT INTO HASTAGS VALUES (5,1);
INSERT INTO HASTAGS VALUES (5,2);
INSERT INTO HASTAGS VALUES (4,1);
INSERT INTO HASTAGS VALUES (4,2);
INSERT INTO HASTAGS VALUES (3,1);
INSERT INTO HASTAGS VALUES (3,2);
INSERT INTO HASTAGS VALUES (2,1);
INSERT INTO HASTAGS VALUES (2,2);
INSERT INTO HASTAGS VALUES (1,1);
INSERT INTO HASTAGS VALUES (1,2);

INSERT INTO RATES VALUES (2,1);
INSERT INTO RATES VALUES (2,3);
