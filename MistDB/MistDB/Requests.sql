CREATE TABLE [dbo].[Requests]
(
	[RequestID] INT NOT NULL PRIMARY KEY, 
    [UserID] INT NOT NULL FOREIGN KEY REFERENCES Users(UserID), 
    [RequestName] NCHAR(10) NOT NULL, 
    [RequestDescription] NCHAR(10) NULL, 
    [RequestLink] NCHAR(10) NULL, 
    [RequestDate] DATE NOT NULL, 
    [RequestAction] NCHAR(10) NULL, 
    [RequestReason] NCHAR(10) NULL
)
