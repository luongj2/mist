DROP DATABASE IF EXISTS mist;
CREATE DATABASE mist;

USE mist;

CREATE TABLE users (
    userID                  INT                 NOT NULL                AUTO_INCREMENT,
    userFirstName           VARCHAR(16),
    userLastName            VARCHAR(16),
    userEmail               VARCHAR(64),
    userPassword            VARCHAR(128),
    userDate            DATE,

    PRIMARY KEY (userID)
);

CREATE TABLE admins (
    adminID                 INT                 NOT NULL                AUTO_INCREMENT,
    userID                  INT,

    PRIMARY KEY (adminID),
    FOREIGN KEY (userID)                        REFERENCES users(userID)
);

CREATE TABLE mods (
    modID                   INT                 NOT NULL                AUTO_INCREMENT,
    userID                  INT,

    PRIMARY KEY (modID),
    FOREIGN KEY (userID)                        REFERENCES users(userID)
);

CREATE TABLE companies (
    companyID               INT                 NOT NULL                AUTO_INCREMENT,
    companyName             VARCHAR(64),
    companyDescription      VARCHAR(1028),
    companyLink             VARCHAR(64),

    PRIMARY KEY (companyID)
);

CREATE TABLE games (
    gameID                  INT                 NOT NULL                AUTO_INCREMENT,
    companyID               INT,
    userID                  INT,
    gameName                VARCHAR(64),
    gameDescription         VARCHAR(1028),
    gameGenre               VARCHAR(16),
    gameDate                DATE,
    compatibleWindows       TINYINT(1),
    compatibleMacOS         TINYINT(1),
    compatibleLinux         TINYINT(1),
    gameThumbnail           LONGBLOB,

    PRIMARY KEY (gameID),
    FOREIGN KEY (companyID)                     REFERENCES companies(companyID),
    FOREIGN KEY (userID)                        REFERENCES users(userID)
);

CREATE TABLE requests (
    requestID               INT                 NOT NULL                AUTO_INCREMENT,
    userID                  INT,
    requestAction           VARCHAR(16),
    requestReason           VARCHAR(64),

    PRIMARY KEY (requestID),
    FOREIGN KEY (userID)                        REFERENCES users(userID)
);

CREATE TABLE posts (
    postID                  INT                 NOT NULL                AUTO_INCREMENT,
    userID                  INT,
    postName                VARCHAR(64),
    postDescription         VARCHAR(1028),
    postLikes               INT,
    postDate                DATE,
    postDeleted             TINYINT(1),

    PRIMARY KEY (postID),
    FOREIGN KEY (userID)                        REFERENCES users(userID)
);

CREATE TABLE comments (
    commentID               INT                 NOT NULL                AUTO_INCREMENT,
    userID                  INT,
    postID                  INT,
    commentDescription      VARCHAR(1028),
    commentDate             DATE,
    commentDeleted          TINYINT(1),

    PRIMARY KEY (commentID),
    FOREIGN KEY (userID)                        REFERENCES users(userID),
    FOREIGN KEY (postID)                        REFERENCES posts(postID)
);

DELIMITER $$

CREATE PROCEDURE spCreateGame (
    IN      spUserID                             INT,
    IN      spGameName                           VARCHAR(64),
    IN      spGameDescription                    VARCHAR(1028),
    IN      spGameGenre                          VARCHAR(16),
    IN      spCompatibleWindows                  TINYINT(1),
    IN      spCompatibleMacOS                    TINYINT(1),
    IN      spCompatibleLinux                    TINYINT(1),
    IN      spGameThumbnail                      LONGBLOB
)

INSERT INTO games (
    userID,
    gameName,
    gameDescription,
    gameGenre,
    gameDate,
    compatibleWindows,
    compatibleMacOS,
    compatibleLinux,
    gameThumbnail
) VALUES (
    spUserID,
    spGameName,
    spGameDescription,
    spGameGenre,
    CAST(NOW() AS Date),
    spCompatibleWindows,
    spCompatibleMacOS,
    spCompatibleLinux,
    spGameThumbnail
)

$$

CREATE PROCEDURE spCreateRequest (
    IN spUserID INT
)

INSERT INTO requests (
	userID,
    requestAction
) VALUES (
	spUserID,
    "In Progress"
)

$$

CREATE PROCEDURE spCreatePost (
    IN spUserID INT,
    IN spPostName VARCHAR(64),
    IN spPostDescription VARCHAR(1028)
)

INSERT INTO posts (
    userID,
    postName,
    postDescription,
    postLikes,
    postDate,
    postDeleted
) VALUES (
    spUserID,
    spPostName,
    spPostDescription,
    0,
    CAST(NOW() AS Date),
    0
)

$$

CREATE PROCEDURE spGetGameFromID (
    IN spGameID INT
)

SELECT
	*
FROM
	games
WHERE
	gameID = spGameID
    
$$

CREATE PROCEDURE spGetCompanyFromID (
    IN spCompanyID INT
)

SELECT
	*
FROM
	companies
WHERE
	companyID = spCompanyID

$$

CREATE PROCEDURE spGetUserFromID (
    IN spUserID INT
)

SELECT
	*
FROM
	users
WHERE
	userID = spUserID
    
$$

CREATE PROCEDURE spGetRequestFromID (
    IN spRequestID INT
)

SELECT
	*
FROM
	requests
WHERE
	requestID = @spRequestID
    
$$

CREATE PROCEDURE spGetPostFromID (
    IN spPostID INT
)

SELECT
	*
FROM
	posts
WHERE
	postID = spPostID
    
$$

CREATE PROCEDURE spGetGamesFromSearch (
    IN spSearch VARCHAR(64),
    IN spSort VARCHAR(16),
    IN spFilter VARCHAR(16)
)

SELECT
	*
FROM
	games
WHERE
	gameName LIKE CONCAT('%', spSearch, '%') AND
    gameGenre = 
    CASE
    	WHEN spFilter = "casual"
    	THEN "Casual"
    
        WHEN spFilter = "fps"
    	THEN "FPS"
    
    	WHEN spFilter = "rpg"
    	THEN "RPG"
        
        ELSE gameGenre
    END
ORDER BY
	CASE
    	WHEN spSort = "alphabetical"
    	THEN gameName
    
    	WHEN spSort = "date"
    	THEN gameDate
        
        ELSE gameName
    END

$$

CREATE PROCEDURE spGetPostsFromSearch (
    IN spSearch VARCHAR(64),
    IN spSort VARCHAR(16)
)

SELECT
	*
FROM
	posts
WHERE
	postName LIKE CONCAT('%', spSearch, '%')
ORDER BY
	CASE
    	WHEN spSort = "date"
    	THEN postDate
    
    	WHEN spSort = "likes"
    	THEN postLikes
        
        ELSE postDate
    END
    
$$

CREATE PROCEDURE spGetUserFromEmail (
    IN spUserEmail VARCHAR(64)
)

SELECT
	*
FROM
	users
WHERE
	userEmail = spUserEmail
    
$$

CREATE PROCEDURE spSignupUser (
    IN spUserFirstName VARCHAR(16),
    IN spUserLastName VARCHAR(16),
    IN spUserEmail VARCHAR(64),
    IN spUserPassword VARCHAR(128)
) INSERT INTO users (
	userFirstName,
    userLastName,
    userEmail,
    userPassword,
    userDate
) VALUES (
	spUserFirstName,
    spUserLastName,
    spUserEmail,
    spUserPassword,
    CAST(NOW() AS Date)
)

$$

DELIMITER ;
