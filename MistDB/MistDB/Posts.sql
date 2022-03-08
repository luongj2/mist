CREATE TABLE [dbo].[Posts]
(
	[PostID] INT NOT NULL PRIMARY KEY, 
    [UserID] INT NOT NULL FOREIGN KEY REFERENCES Users(UserID), 
    [PostName] NCHAR(10) NOT NULL, 
    [PostDescription] NCHAR(10) NULL, 
    [PostLikes] INT NOT NULL DEFAULT 0, 
    [PostDate] DATE NOT NULL, 
    [PostDeleted] BIT NOT NULL DEFAULT 0
)
