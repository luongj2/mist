CREATE TABLE [dbo].[Organizations]
(
	[OrganizationID] INT NOT NULL PRIMARY KEY, 
    [OrganizationName] NCHAR(10) NOT NULL, 
    [OrganizationDescription] NCHAR(10) NULL, 
    [OrganizationLink] NCHAR(10) NULL
)
