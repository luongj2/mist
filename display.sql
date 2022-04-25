SHOW TABLES;

SELECT
    userID,
    CONCAT(userFirstName, " ", userLastName) AS userName,
    userEmail,
    userDate
FROM
    users;

SELECT
    gameID,
    companyID,
    requestID,
    gameName,
    gameDate,
    compatibleWindows,
    compatibleMacOS,
    compatibleLinux
FROM
    games;
