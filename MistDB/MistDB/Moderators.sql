CREATE TABLE [dbo].[Moderators]
(
	[ModeratorID] INT NOT NULL PRIMARY KEY, 
    [UserID] INT NOT NULL FOREIGN KEY REFERENCES Users(UserID)
)
