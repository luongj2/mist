CREATE TABLE [dbo].[Administrators]
(
	[AdministratorID] INT NOT NULL PRIMARY KEY, 
    [ModeratorID] INT NOT NULL FOREIGN KEY REFERENCES Moderators(ModeratorID)
)
