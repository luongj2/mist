SHOW TABLES;

SELECT
    userID,
    CONCAT(userFirstName, " ", userLastName) AS userName,
    userEmail,
    userJoinDate
FROM
    users;

SELECT
    gameID,
    gameName,
    gameDate
FROM
    games;
