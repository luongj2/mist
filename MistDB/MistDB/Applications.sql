CREATE TABLE [dbo].[Applications]
(
	[ApplicationID] INT NOT NULL PRIMARY KEY, 
    [OrganizationID] INT NOT NULL FOREIGN KEY REFERENCES Organizations(OrganizationID), 
    [ApplicationName] NCHAR(10) NOT NULL, 
    [ApplicationDescription] NCHAR(50) NULL, 
    [ApplicationCategory] NCHAR(10) NULL, 
    [ApplicationDate] DATE NULL, 
    [ApplicationIcon] NCHAR(10) NULL, 
    [ApplicationPreview1] NCHAR(10) NULL, 
    [ApplicationPreview2] NCHAR(10) NULL, 
    [ApplicationPreview3] NCHAR(10) NULL, 
    [AndroidCompatible] BIT NOT NULL DEFAULT 0, 
    [IOSCompatible] BIT NOT NULL DEFAULT 0, 
    [WindowsCompatible] BIT NOT NULL DEFAULT 0,
)
