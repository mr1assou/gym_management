USE [master]
GO
/****** Object:  Database [gym_management]    Script Date: 6/29/2024 3:18:54 AM ******/
CREATE DATABASE [gym_management]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'gym_management', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\gym_management.mdf' , SIZE = 73728KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'gym_management_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\gym_management_log.ldf' , SIZE = 73728KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [gym_management] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [gym_management].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [gym_management] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [gym_management] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [gym_management] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [gym_management] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [gym_management] SET ARITHABORT OFF 
GO
ALTER DATABASE [gym_management] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [gym_management] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [gym_management] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [gym_management] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [gym_management] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [gym_management] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [gym_management] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [gym_management] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [gym_management] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [gym_management] SET  ENABLE_BROKER 
GO
ALTER DATABASE [gym_management] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [gym_management] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [gym_management] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [gym_management] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [gym_management] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [gym_management] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [gym_management] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [gym_management] SET RECOVERY FULL 
GO
ALTER DATABASE [gym_management] SET  MULTI_USER 
GO
ALTER DATABASE [gym_management] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [gym_management] SET DB_CHAINING OFF 
GO
ALTER DATABASE [gym_management] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [gym_management] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [gym_management] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [gym_management] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'gym_management', N'ON'
GO
ALTER DATABASE [gym_management] SET QUERY_STORE = ON
GO
ALTER DATABASE [gym_management] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [gym_management]
GO
/****** Object:  User [php]    Script Date: 6/29/2024 3:18:54 AM ******/
CREATE USER [php] FOR LOGIN [php] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [php]
GO
/****** Object:  Table [dbo].[client]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[client](
	[client_id] [int] IDENTITY(1,1) NOT NULL,
	[client_first_name] [varchar](20) NULL,
	[client_last_name] [varchar](20) NULL,
	[joinning_date] [date] NULL,
	[client_phone_number] [varchar](10) NULL,
	[gym_id] [int] NULL,
	[client_image] [varchar](255) NULL,
	[price] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[client_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[fees]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[fees](
	[fee_id] [int] IDENTITY(1,1) NOT NULL,
	[description] [varchar](500) NULL,
	[date_of_fee] [date] NULL,
	[gym_id] [int] NOT NULL,
	[amount] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[fee_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[gym]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[gym](
	[gym_id] [int] IDENTITY(1,1) NOT NULL,
	[gym_name] [varchar](40) NULL,
	[supervisor_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[gym_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[operations]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[operations](
	[operation_id] [int] IDENTITY(1,1) NOT NULL,
	[beginning_period_date] [date] NULL,
	[end_period_date] [date] NULL,
	[operation_status] [varchar](10) NULL,
	[client_id] [int] NULL,
	[actual_price] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[operation_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[payment]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[payment](
	[payment_id] [int] IDENTITY(1,1) NOT NULL,
	[beginning_DATE] [date] NULL,
	[end_date] [date] NULL,
	[subscription_price] [int] NULL,
	[user_id] [int] NULL,
PRIMARY KEY CLUSTERED 
(
	[payment_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[users]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[users](
	[user_id] [int] IDENTITY(1,1) NOT NULL,
	[first_name] [varchar](20) NULL,
	[Last_name] [varchar](20) NULL,
	[phone_number] [varchar](10) NULL,
	[email] [varchar](100) NULL,
	[password] [varchar](255) NULL,
	[role] [varchar](10) NULL,
	[beginning_trial_period] [date] NULL,
	[end_trial_period] [date] NULL,
	[status] [varchar](10) NULL,
	[verification_code] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY],
 CONSTRAINT [UNIQUE_EMAIL] UNIQUE NONCLUSTERED 
(
	[email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[client] ADD  DEFAULT (getdate()) FOR [joinning_date]
GO
ALTER TABLE [dbo].[operations] ADD  DEFAULT (getdate()) FOR [beginning_period_date]
GO
ALTER TABLE [dbo].[operations] ADD  DEFAULT (dateadd(month,(1),getdate())) FOR [end_period_date]
GO
ALTER TABLE [dbo].[payment] ADD  DEFAULT (getdate()) FOR [beginning_DATE]
GO
ALTER TABLE [dbo].[payment] ADD  DEFAULT (dateadd(month,(1),getdate())) FOR [end_date]
GO
ALTER TABLE [dbo].[payment] ADD  CONSTRAINT [DEFAULT_SUBSCRIPTION_PAYMENT]  DEFAULT ((15)) FOR [subscription_price]
GO
ALTER TABLE [dbo].[users] ADD  CONSTRAINT [DEFAULT_ROLE]  DEFAULT ('supervisor') FOR [role]
GO
ALTER TABLE [dbo].[users] ADD  DEFAULT (getdate()) FOR [beginning_trial_period]
GO
ALTER TABLE [dbo].[users] ADD  CONSTRAINT [DEFAULT_END_DATE]  DEFAULT (dateadd(month,(2),getdate())) FOR [end_trial_period]
GO
ALTER TABLE [dbo].[users] ADD  CONSTRAINT [DEFAULT_STATUS]  DEFAULT ('inactive') FOR [status]
GO
ALTER TABLE [dbo].[client]  WITH CHECK ADD  CONSTRAINT [GYM_id] FOREIGN KEY([gym_id])
REFERENCES [dbo].[gym] ([gym_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[client] CHECK CONSTRAINT [GYM_id]
GO
ALTER TABLE [dbo].[fees]  WITH CHECK ADD FOREIGN KEY([gym_id])
REFERENCES [dbo].[gym] ([gym_id])
GO
ALTER TABLE [dbo].[gym]  WITH CHECK ADD  CONSTRAINT [FK_SUPERVISOR_ID] FOREIGN KEY([supervisor_id])
REFERENCES [dbo].[users] ([user_id])
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[gym] CHECK CONSTRAINT [FK_SUPERVISOR_ID]
GO
ALTER TABLE [dbo].[payment]  WITH CHECK ADD  CONSTRAINT [USER_ID] FOREIGN KEY([user_id])
REFERENCES [dbo].[users] ([user_id])
GO
ALTER TABLE [dbo].[payment] CHECK CONSTRAINT [USER_ID]
GO
ALTER TABLE [dbo].[client]  WITH CHECK ADD  CONSTRAINT [CHECK_CLIENT_PHONE_NUMBER] CHECK  (([client_phone_number] like '0[0-9]%' AND len([client_phone_number])=(10)))
GO
ALTER TABLE [dbo].[client] CHECK CONSTRAINT [CHECK_CLIENT_PHONE_NUMBER]
GO
ALTER TABLE [dbo].[client]  WITH CHECK ADD  CONSTRAINT [CLIENT_First_name] CHECK  ((NOT [client_first_name] like '%[^A-Za-z]%'))
GO
ALTER TABLE [dbo].[client] CHECK CONSTRAINT [CLIENT_First_name]
GO
ALTER TABLE [dbo].[client]  WITH CHECK ADD  CONSTRAINT [Client_Last_name] CHECK  ((NOT [Client_last_name] like '%[^A-Za-z]%'))
GO
ALTER TABLE [dbo].[client] CHECK CONSTRAINT [Client_Last_name]
GO
ALTER TABLE [dbo].[gym]  WITH CHECK ADD  CONSTRAINT [GYM_NAME] CHECK  ((NOT [gym_name] like '%[^A-Za-z0-9 ]%'))
GO
ALTER TABLE [dbo].[gym] CHECK CONSTRAINT [GYM_NAME]
GO
ALTER TABLE [dbo].[operations]  WITH CHECK ADD  CONSTRAINT [check_operation_Date] CHECK  (([beginning_period_date]<[end_period_date]))
GO
ALTER TABLE [dbo].[operations] CHECK CONSTRAINT [check_operation_Date]
GO
ALTER TABLE [dbo].[operations]  WITH CHECK ADD  CONSTRAINT [OPERATION_STATUS] CHECK  (([operation_status]='reject' OR [operation_status]='access' OR [operation_status]='trial'))
GO
ALTER TABLE [dbo].[operations] CHECK CONSTRAINT [OPERATION_STATUS]
GO
ALTER TABLE [dbo].[payment]  WITH CHECK ADD  CONSTRAINT [CHECK_sub_price] CHECK  (([subscription_price]>(0)))
GO
ALTER TABLE [dbo].[payment] CHECK CONSTRAINT [CHECK_sub_price]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [CHECK_EMAIL] CHECK  (([email] like '%@gmail.com'))
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [CHECK_EMAIL]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [CHECK_PHONE_NUMBER] CHECK  (([phone_number] like '0[0-9]%' AND len([phone_number])=(10)))
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [CHECK_PHONE_NUMBER]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [CHECK_ROLE] CHECK  (([role]='supervisor' OR [role]='admin'))
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [CHECK_ROLE]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [CHECK_STATUS] CHECK  (([status]='reject' OR [status]='access' OR [status]='trial' OR [status]='inactive'))
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [CHECK_STATUS]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [check_Trial_Date] CHECK  (([beginning_trial_period]<[end_trial_period]))
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [check_Trial_Date]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [chkFirst_name] CHECK  ((NOT [first_name] like '%[^A-Za-z]%'))
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [chkFirst_name]
GO
ALTER TABLE [dbo].[users]  WITH CHECK ADD  CONSTRAINT [chkLast_name] CHECK  ((NOT [last_name] like '%[^A-Za-z]%'))
GO
ALTER TABLE [dbo].[users] CHECK CONSTRAINT [chkLast_name]
GO
/****** Object:  StoredProcedure [dbo].[activateEmail]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[activateEmail](@email varchar(40),@code varchar(30))
AS
begin
	if EXISTS(select 1 FROM users WHERE email=@email AND verification_code=@code)
	begin
		UPDATE users SET status='trial',beginning_trial_period=GETDATE(),end_trial_period=DATEADD(MONTH,2,GETDATE()),verification_code=NULL;		
	end
	ELSE
	begin
		raiserror('the code verification is incorrect check your email please',1,16);
	end
end
GO
/****** Object:  StoredProcedure [dbo].[addClientForGym]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[addClientForGym](@client_first_name varchar(70),@client_last_name varchar(80),@client_phone_number varchar(70),@gym_id int,@image varchar(255),@price int,@beginning_period_date varchar(200))
as
begin
	DECLARE @clientId int 
		IF GETDATE()>=DATEADD(MONTH,1,@beginning_period_date)
		begin
			insert into client(client_first_name,client_last_name,client_phone_number,gym_id,client_image,price,joinning_date)  VALUES 
			(@client_first_name,@client_last_name,@client_phone_number,@gym_id,@image,@price,@beginning_period_date);
			SET @clientId=SCOPE_IDENTITY();
			insert into operations VALUES (@beginning_period_date,DATEADD(MONTH,1,@beginning_period_date),'reject',@clientId,@price);
		end
		ELSE
		begin
			insert into client(client_first_name,client_last_name,client_phone_number,gym_id,client_image,price)  VALUES 
			(@client_first_name,@client_last_name,@client_phone_number,@gym_id,@image,@price);
			SET @clientId=SCOPE_IDENTITY();
			insert into operations VALUES (@beginning_period_date,DATEADD(MONTH,1,@beginning_period_date),'access',@clientId,@price);
		end
end
GO
/****** Object:  StoredProcedure [dbo].[addFee]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE Procedure [dbo].[addFee](@description varchar(500),@amount int,@gym_id int)
AS
begin
	insert into fees Values (@description,GETDATE(),@gym_id,@amount);
end
GO
/****** Object:  StoredProcedure [dbo].[addSupervisorAndGym]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[addSupervisorAndGym](@firstName Varchar(10),@lastName Varchar(10),@phoneNumber Varchar(10)
,@email varchar(40),@password varchar(255),@gym_name varchar(20),@verification_code varchar(50))
AS
begin
	DECLARE @supervisor_id int;
	if NOT EXISTS (SELECT 1 FROM users WHERE (first_name=@firstName AND Last_name=@lastName) OR (email=@email))
		begin
			insert into users(first_name,Last_name,phone_number,email,password,beginning_trial_period,
			end_trial_period,verification_code) VALUES (@firstName,@lastName,@phoneNumber,@email,@password,Null,NULL,@verification_code);
			SET @supervisor_id=SCOPE_IDENTITY();
			insert into gym VALUES(@gym_name,@supervisor_id);
		end
	else
		begin
			RAISERROR('this credentails used by another client either first name,last name or email please provide different credentials',16,1)
		end
	end
GO
/****** Object:  StoredProcedure [dbo].[adjustStatus]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[adjustStatus]
AS
begin
	UPDATE operations SET operation_status='reject' WHERE GETDATE()>=end_period_date;
	UPDATE users SET status='reject' WHERE GETDATE()>=end_trial_period;
end
GO
/****** Object:  StoredProcedure [dbo].[calculateTotalOfMonth]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[calculateTotalOfMonth](@gym_id int,@month int,@year int)
AS
begin
	SELECT client_image,client_first_name,client_last_name,beginning_period_date,end_period_date,actual_price as 'amount' FROM operations INNER JOIN 
	(SELECT client.client_id,client_first_name,client_last_name,client_phone_number,client_image FROM client INNER JOIN gym
	ON client.gym_id=gym.gym_id WHERE  gym.gym_id=@gym_id) t ON operations.client_id=t.client_id WHERE MONTH(beginning_period_date)=@month AND 
	YEAR(beginning_period_date)=@year;
end
GO
/****** Object:  StoredProcedure [dbo].[datesHistoricalData]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[datesHistoricalData](@gym_id int) 
AS
begin
	select DISTINCT  MONTH(beginning_period_date) as 'month',YEAR(beginning_period_date) as 'year' FROM operations INNER JOIN 
	(select client_id FROM client INNER JOIN gym ON client.gym_id=gym.gym_id WHERE gym.gym_id=@gym_id) t
	ON t.client_id=operations.client_id;
end
GO
/****** Object:  StoredProcedure [dbo].[detailsClient]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[detailsClient](@client_id int)
AS
begin
	SELECT beginning_period_date,end_period_date,
	actual_price,operation_status,
	CASE WHEN operation_status='access' OR operation_status='reject' THEN 'payed'
	END	AS real_operations_status
	FROM operations INNER JOIN 
	(SELECT client_id,client_first_name,client_last_name,joinning_date,client_phone_number FROM client INNER JOIN gym
	ON client.gym_id=gym.gym_id WHERE client_id=@client_id) t ON operations.client_id=t.client_id;
end
GO
/****** Object:  StoredProcedure [dbo].[displayFees]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE Procedure [dbo].[displayFees](@gym_id int,@month int,@year int)
AS
begin
	select description,date_of_fee,amount FROM fees WHERE @gym_id=gym_id AND MONTH(date_of_fee)=@month AND YEAR(date_of_fee)=@year;
end	
GO
/****** Object:  StoredProcedure [dbo].[earningOfMonth]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[earningOfMonth](@gym_id int,@month int)
AS
begin
	select SUM(actual_price) as 'amount' FROM operations INNER JOIN (
	select client_id FROM gym INNER JOIN client ON client.gym_id=gym.gym_id WHERE gym.gym_id=@gym_id) t
	ON t.client_id=operations.client_id WHERE MONTH(beginning_period_date)=@month;
end
GO
/****** Object:  StoredProcedure [dbo].[Login]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[Login](@email varchar(40))
as	
begin
	SELECT users.user_id,first_name,Last_name,gym.gym_id,status,role,password FROM users INNER JOIN gym ON users.user_id=gym.supervisor_id WHERE email=@email;
end
GO
/****** Object:  StoredProcedure [dbo].[newClientOfThisMonth]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[newClientOfThisMonth](@gymId int)
as
begin
	SELECT COUNT(*) as 'number' FROM client INNER JOIN operations ON operations.client_id=client.client_id
	WHERE MONTH(joinning_date)=MONTH(GETDATE()) AND gym_id=@gymId AND operation_status='access';
end
GO
/****** Object:  StoredProcedure [dbo].[newClientsHistoricalData]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[newClientsHistoricalData](@gym_id int,@month int,@year int)
AS
begin
	select client.client_id,client_first_name,client_last_name,joinning_date,client_image,beginning_period_date,end_period_date 
	from operations INNER JOIN client ON operations.client_id=client.client_id WHERE operations.operation_id IN
	(select MAX(operations.operation_id) as 'operation' from operations group by client_id) AND gym_id=@gym_id 
	AND MONTH(joinning_date)=@month AND YEAR(joinning_date)=@year; 	
end
GO
/****** Object:  StoredProcedure [dbo].[pay]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[pay](@gym_id int,@client_id int,@beginning_date varchar(40))
AS
begin
	IF DATEADD(MONTH,1,@beginning_date)>=GETDATE()
		begin
			insert into operations VALUES 
			(@beginning_date,DATEADD(MONTH,1,@beginning_date),'access',@client_id,(select price from client WHERE client_id=@client_id)); 
		end
	ELSE
		begin
			insert into operations VALUES 
			(@beginning_date,DATEADD(MONTH,1,@beginning_date),'reject',@client_id,(select price from client WHERE client_id=@client_id)); 
		end
end
GO
/****** Object:  StoredProcedure [dbo].[search]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[search](@gym_id int,@regex varchar(40))
AS
begin
	SET @regex=REPLACE(@regex,' ','');
	SELECT client_image,client.client_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE
	((client_first_name+client_last_name LIKE '%'+@regex+'%') OR (client_last_name+client_first_name LIKE '%'+@regex+'%')) AND gym_id=@gym_id AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
GO
/****** Object:  StoredProcedure [dbo].[searchClientsMonthExpired]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[searchClientsMonthExpired](@gym_id int)
AS
begin
	SELECT client.client_id,client_first_name,client_last_name,client_image,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operation_status='reject' 
	AND DATEDIFF(day,beginning_period_date,end_period_date)>10
	AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
GO
/****** Object:  StoredProcedure [dbo].[searchClientsWhoTheyHaveAccess]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[searchClientsWhoTheyHaveAccess](@gym_id int)
AS
begin
	SELECT client.client_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status,client_image 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operation_status='access' 
	AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
GO
/****** Object:  StoredProcedure [dbo].[searchTrialMembers]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[searchTrialMembers](@gym_id int)
AS
begin
	SELECT client.client_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND DATEDIFF(day,beginning_period_date,end_period_date)<=10 
	AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
GO
/****** Object:  StoredProcedure [dbo].[selectClients]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[selectClients](@gym_id int)
AS
begin
	SELECT client.client_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status,client_image 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
GO
/****** Object:  StoredProcedure [dbo].[selectInformationOfClient]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[selectInformationOfClient](@gym_id int,@client_id int)
AS
begin
	SELECT client_image,client_first_name,client_last_name,joinning_date,client_phone_number,price FROM client WHERE client_id=@client_id AND gym_id=@gym_id;
end
GO
/****** Object:  StoredProcedure [dbo].[sendAnotherCode]    Script Date: 6/29/2024 3:18:55 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[sendAnotherCode](@email varchar(30),@code varchar(20))
AS
begin
	UPDATE users SET verification_code=@code WHERE email=@email;
end

GO
USE [master]
GO
ALTER DATABASE [gym_management] SET  READ_WRITE 
GO




