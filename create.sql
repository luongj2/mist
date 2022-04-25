DROP DATABASE IF EXISTS mist;
CREATE DATABASE mist;

USE mist;

CREATE TABLE users (
    userID                  INT                 NOT NULL                AUTO_INCREMENT,
    userFirstName           VARCHAR(16),
    userLastName            VARCHAR(16),
    userEmail               VARCHAR(64),
    userPassword            VARCHAR(128),
    userDate                DATE,
    userRole                VARCHAR(16),

    PRIMARY KEY (userID)
);

CREATE TABLE companies (
    companyID               INT                 NOT NULL                AUTO_INCREMENT,
    companyName             VARCHAR(64),
    companyDescription      VARCHAR(1028),
    companyLink             VARCHAR(64),

    PRIMARY KEY (companyID)
);

CREATE TABLE requests (
    requestID               INT                 NOT NULL                AUTO_INCREMENT,
    userID                  INT,
    requestAction           VARCHAR(16),
    requestReason           VARCHAR(64),

    PRIMARY KEY (requestID),
    FOREIGN KEY (userID)                        REFERENCES users(userID)
);

CREATE TABLE games (
    gameID                  INT                 NOT NULL                AUTO_INCREMENT,
    companyID               INT,
    requestID               INT,
    gameName                VARCHAR(64),
    gameDescription         VARCHAR(1028),
    gameGenre               VARCHAR(16),
    gameDate                DATE,
    gamePicture             LONGBLOB,
    compatibleWindows       TINYINT(1),
    compatibleMacOS         TINYINT(1),
    compatibleLinux         TINYINT(1),

    PRIMARY KEY (gameID),
    FOREIGN KEY (companyID)                     REFERENCES companies(companyID),
    FOREIGN KEY (requestID)                     REFERENCES requests(requestID)
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

CREATE PROCEDURE spCreateUser (
    IN spUserFirstName VARCHAR(16),
    IN spUserLastName VARCHAR(16),
    IN spUserEmail VARCHAR(64),
    IN spUserPassword VARCHAR(128)
)

BEGIN
    INSERT INTO users (
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
    );
END

$$

CREATE PROCEDURE spCreateGame (
    IN      spUserID                            INT,
    IN      spGameName                          VARCHAR(64),
    IN      spGameDescription                   VARCHAR(1028),
    IN      spGameGenre                         VARCHAR(16),
    IN      spGamePicture                       LONGBLOB,
    IN      spCompatibleWindows                 TINYINT(1),
    IN      spCompatibleMacOS                   TINYINT(1),
    IN      spCompatibleLinux                   TINYINT(1)
)

BEGIN
    INSERT INTO requests (
        userID,
        requestAction,
        RequestReason
    ) VALUES (
        spUserID,
        "Pending",
        "Pending"
    );

    INSERT INTO games (
        requestID,
        gameName,
        gameDescription,
        gameGenre,
        gameDate,
        gamePicture,
        compatibleWindows,
        compatibleMacOS,
        compatibleLinux
    ) VALUES (
        LAST_INSERT_ID(),
        spGameName,
        spGameDescription,
        spGameGenre,
        CAST(NOW() AS Date),
        spGamePicture,
        spCompatibleWindows,
        spCompatibleMacOS,
        spCompatibleLinux
    );
END

$$

CREATE PROCEDURE spCreatePost (
    IN spUserID INT,
    IN spPostName VARCHAR(64),
    IN spPostDescription VARCHAR(1028)
)

BEGIN
    INSERT INTO posts (
        userID,
        postName,
        postDescription,
        postLikes,
        postDate
    ) VALUES (
        spUserID,
        spPostName,
        spPostDescription,
        0,
        CAST(NOW() AS Date)
    );
END

$$

CREATE PROCEDURE spGetGameFromID (
    IN spGameID INT
)

BEGIN
    SELECT
        gameID,
        gameName,
        gameDescription,
        gameGenre,
        gameDate,
        gamePicture,
        compatibleWindows,
        compatibleMacOS,
        compatibleLinux,
        IFNULL(companyName, CONCAT(userFirstName, " ", userLastName)) AS developerName 
    FROM
        games
        LEFT JOIN   companies       ON      games.companyID = companies.companyID
        LEFT JOIN   requests        ON      games.requestID = requests.requestID
        LEFT JOIN   users           ON      requests.userID = users.userID
    WHERE
        gameID = spGameID;
END
        
$$

CREATE PROCEDURE spGetUserFromID (
    IN spUserID INT
)

BEGIN
    SELECT
        users.userID,
        CONCAT(userFirstName, " ", userLastName) AS userName,
        userDate,
        modID,
        adminID
    FROM
        users
        LEFT JOIN   mods        ON          users.userID = mods.userID
        LEFT JOIN   admins      ON          users.userID = admins.userID
    WHERE
        users.userID = spUserID;
END       

$$

CREATE PROCEDURE spGetPostFromID (
    IN spPostID INT
)

BEGIN
    SELECT
        postID,
        CONCAT(userFirstName, " ", userLastName) AS postAuthor,
        postName,
        postDescription,
        postLikes,
        postDate,
        postDeleted
    FROM
        posts
        LEFT JOIN   users      ON          posts.userID = users.userID
    WHERE
        postID = spPostID;
END
 
$$

CREATE PROCEDURE spGetGamesFromSearch (
    IN spSearch VARCHAR(64),
    IN spSort VARCHAR(16),
    IN spFilter VARCHAR(16)
)

BEGIN
    SELECT
        gameID
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
        END;
END

$$

CREATE PROCEDURE spGetPostsFromSearch (
    IN spSearch VARCHAR(64),
    IN spSort VARCHAR(16)
)

BEGIN
    SELECT
        postID
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
        END;
END
   
$$

CREATE PROCEDURE spGetUserFromEmail (
    IN spUserEmail VARCHAR(64)
)

BEGIN
    SELECT
        *
    FROM
        users
    WHERE
        userEmail = spUserEmail;
END

$$

DELIMITER ;
