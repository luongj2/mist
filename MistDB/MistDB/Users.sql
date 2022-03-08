CREATE TABLE [dbo].[Users]
(
	[UserID] INT NOT NULL PRIMARY KEY, 
    [UserFirstName] NCHAR(10) NOT NULL, 
    [UserLastName] NCHAR(10) NOT NULL, 
    [UserEmail] NCHAR(10) NOT NULL, 
    [UserPassword] NCHAR(10) NOT NULL, 
    [UserJoinDate] DATE NOT NULL
)
