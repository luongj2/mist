CREATE TABLE users (
	userID 					INT						AUTO_INCREMENT,
    userFirstName 			VARCHAR(16),
    userLastName 			VARCHAR(16),
    userEmail 				VARCHAR(64),
    userPassword 			VARCHAR(128),
    userJoinDate 			DATE,
    
    PRIMARY KEY 			(userID)
);

CREATE TABLE mods (
	modID 			        INT						AUTO_INCREMENT, 
    userID 					INT,
    
    PRIMARY KEY				(modID),
    FOREIGN KEY				(userID)				REFERENCES		users(userID)
);

CREATE TABLE admins (
	adminID 		        INT						AUTO_INCREMENT, 
    userID 					INT,
    
    PRIMARY KEY				(adminID),
    FOREIGN KEY				(userID)				REFERENCES		users(userID)
);

CREATE TABLE companies (
	companyID 			    INT						AUTO_INCREMENT, 
    companyName 		    VARCHAR(64),
    companyDescription      VARCHAR(1028),
    companyLink 		    VARCHAR(64),
    
    PRIMARY KEY				(companyID)
);

CREATE TABLE games (
    gameID                  INT						AUTO_INCREMENT,
    companyID               INT,
    gameName 		        VARCHAR(64),
    gameDescription 	    VARCHAR(1028),
    gameGenre 	            VARCHAR(16),
    gameReleaseDate 		DATE,
    compatibleWindows 		BOOLEAN,
    compatibleMacOS 		BOOLEAN,
    compatibleLinux 		BOOLEAN,

    PRIMARY KEY				(gameID),
    FOREIGN KEY				(companyID)		        REFERENCES		companies(companyID)
);

CREATE TABLE posts (
	postID 					INT						AUTO_INCREMENT, 
    userID 					INT, 
    postName 				VARCHAR(64), 
    postDescription 		VARCHAR(1028), 
    postLikes 				INT, 
    postDate 				DATE, 
    postDeleted 			BOOLEAN,
    
    PRIMARY KEY				(postID),
    FOREIGN KEY				(userID)				REFERENCES		users(userID)
);

CREATE TABLE comments (
	commentID 				INT						AUTO_INCREMENT, 
    userID 					INT, 
    postID 					INT, 
    commentDescription 		VARCHAR(1028), 
    commentDate 			DATE, 
    commentDeleted 			BOOLEAN,
    
    PRIMARY KEY				(commentID),
    FOREIGN KEY				(userID)				REFERENCES		users(userID),
    FOREIGN KEY				(postID)				REFERENCES		posts(postID)
);

CREATE TABLE requests (
	requestID 				INT						AUTO_INCREMENT, 
    userID 					INT,
    requestName 			VARCHAR(64), 
    requestDescription 		VARCHAR(1028), 
    requestLink 			VARCHAR(64),
    requestDate 			DATE,
    requestAction 			VARCHAR(64),
    requestReason 			VARCHAR(64),
    
    PRIMARY KEY				(requestID),
    FOREIGN KEY				(userID)				REFERENCES		users(userID)
);

INSERT INTO `games`(`gameID`, `companyID`, `gameName`, `gameDescription`, `gameGenre`, `gameReleaseDate`, `compatibleWindows`, `compatibleMacOS`, `compatibleLinux`) VALUES
    (1, 1, 'Counter-Strike: Local Inconvenience', NULL, 'FPS', '2012-08-21', 1, 1, 1),
    (2, 1, 'Squad Bunker Mk.2', NULL, 'FPS', '2007-10-10', 1, 1, 1),
    (3, 2, 'Overepic', NULL, 'RPG', '2015-09-15', 1, 1, 1),
    (4, 3, 'Within Ourselves', NULL, 'Casual', '2018-11-16', 1, 0, 0),
    (5, 4, 'TAXWEEK II', NULL, 'FPS', '2013-08-13', 1, 0, 1);