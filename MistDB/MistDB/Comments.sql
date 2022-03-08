CREATE TABLE [dbo].[Comments]
(
	[CommentID] INT NOT NULL PRIMARY KEY, 
    [UserID] INT NOT NULL FOREIGN KEY REFERENCES Users(UserID), 
    [PostID] INT NOT NULL FOREIGN KEY REFERENCES Posts(PostID), 
    [CommentDescription] NCHAR(10) NOT NULL, 
    [CommentDate] DATE NOT NULL, 
    [CommentDeleted] BIT NOT NULL DEFAULT 0
)
