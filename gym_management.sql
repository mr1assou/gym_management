

CREATE TABLE users(
	user_id int primary key identity(1,1),
	first_name varchar(20),
	Last_name varchar(20),
	phone_number varchar(10),
	email varchar(100),
	password varchar(50),
	role varchar(10),
	beginning_trial_period date DEFAULT getDATE(), 
	end_trial_period date,
	status varchar(10)
)
--constraints for users tables
--first name and Last name
ALTER TABLE users
ADD CONSTRAINT chkFirst_name
CHECK (first_name NOT LIKE '%[^A-Za-z]%');
go
ALTER TABLE users
ADD CONSTRAINT chkLast_name
CHECK (last_name NOT LIKE '%[^A-Za-z]%');
--phone number
ALTER TABLE users ADD CONSTRAINT CHECK_PHONE_NUMBER check (phone_number LIKE '0[0-9]%' AND len(phone_number)=10);
--email
ALTER TABLE users ADD CONSTRAINT CHECK_EMAIL check (email LIKE '%@gmail.com');
go
ALTER TABLE users ADD CONSTRAINT UNIQUE_EMAIL UNIQUE (email);
--role
ALTER TABLE users ADD CONSTRAINT CHECK_ROLE check (role IN ('admin','supervisor'));
ALTER TABLE users ADD CONSTRAINT DEFAULT_ROLE DEFAULT 'supervisor' FOR role;
--beginning trial period and end_trial period
ALTER TABLE users ADD CONSTRAINT check_Trial_Date check(beginning_trial_period<end_trial_period)
go
ALTER TABLE users ADD CONSTRAINT DEFAULT_END_DATE DEFAULT DATEADD(month,2,getDate()) FOR end_trial_period;
--status
ALTER TABLE users ADD CONSTRAINT CHECK_STATUS check(status IN ('inactive','trial','access','reject'));
go
ALTER TABLE users ADD CONSTRAINT DEFAULT_STATUS DEFAULT 'inactive' FOR status;
ALTER TABLE users ADD verification_code varchar(20);
--gym table
CREATE TABLE gym(
	gym_id int primary key identity(1,1),
	gym_name varchar(40),
	price_per_month int,
	supervisor_id int,
	CONSTRAINT FK_SUPERVISOR_ID FOREIGN KEY (supervisor_id) REFERENCES users(user_id) ON DELETE CASCADE
)
--constraints gym
ALTER TABLE gym ADD CONSTRAINT GYM_NAME CHECK (gym_name NOT LIKE '%[^A-Za-z0-9 ]%');
go
ALTER TABLE gym ADD CONSTRAINT PRICE_PER_MONTH CHECK (price_per_month>0);
--clients table
CREATE TABLE client(
	client_id int primary key identity(1,1),
	client_first_name varchar(20),
	client_last_name varchar(20),
	joinning_date date DEFAULT getDate(),
	client_phone_number varchar(10),
	type_joinning_date varchar(20), 
	gym_id int,
	CONSTRAINT GYM_id FOREIGN KEY (gym_id) REFERENCES gym(gym_id) ON DELETE CASCADE
)
--constraints
ALTER TABLE Client
ADD CONSTRAINT CLIENT_First_name
CHECK (client_first_name NOT LIKE '%[^A-Za-z]%');
go
ALTER TABLE Client
ADD CONSTRAINT Client_Last_name
CHECK (Client_last_name NOT LIKE '%[^A-Za-z]%');
--phone number
ALTER TABLE client ADD CONSTRAINT CHECK_CLIENT_PHONE_NUMBER check (client_phone_number LIKE '0[0-9]%' AND len(client_phone_number)=10);
--create operation table
CREATE TABLE operations(
	operation_id int primary key identity(1,1),
	beginning_period_date DATE DEFAULT getDate(),
	end_period_date DATE DEFAULT DATEADD(month,1,getDate()),
	operation_status varchar(10),
	client_id int,
	CONSTRAINT CLIENT_ID FOREIGN KEY (client_id) REFERENCES client(client_id) ON DELETE CASCADE
)
--constraints
ALTER TABLE operations DROP CONSTRAINT CLIENT_ID;
ALTER TABLE operations ADD CONSTRAINT check_operation_Date check(beginning_period_date<end_period_date)
go
ALTER TABLE operations ADD CONSTRAINT OPERATION_STATUS check(operation_status IN ('trial','access','reject'));

--When user login do this
UPDATE operations SET operation_status='reject' WHERE GETDATE()>=end_period_date;
--create table payment
CREATE Table payment(
	payment_id int primary key identity(1,1), 
	beginning_DATE DATE DEFAULT GETDATE(),
	end_date DATE DEFAULT DATEADD(MONTH,1,GETDATE()),
	subscription_price int,
	user_id int,
	Constraint USER_ID FOREIGN KEY (user_id) REFERENCES users(user_id),
)
--constraints of payment
ALTER TABLE payment ADD constraint DEFAULT_SUBSCRIPTION_PAYMENT DEFAULT 15 FOR subscription_price; 
ALTER TABLE payment ADD CONSTRAINT CHECK_sub_price CHECK(subscription_price>0);
--Create Trigger if user pay change his status in users table
ALTER TRIGGER status_user ON payment
AFTER INSERT
AS
begin
	UPDATE users SET users.status='access' WHERE user_id=(SELECT top 1 user_id FROM payment ORDER BY payment_id DESC);
end
--functions and procedure
--procedure sign up
select * from users;
ALTER PROCEDURE addSupervisorAndGym(@firstName Varchar(10),@lastName Varchar(10),@phoneNumber Varchar(10)
,@email varchar(40),@password varchar(255),@gym_name varchar(20),@price_per_month int,@verification_code varchar(50))
AS
begin
	DECLARE @supervisor_id int;
	if NOT EXISTS (SELECT 1 FROM users WHERE (first_name=@firstName AND Last_name=@lastName) OR (email=@email))
		begin
			insert into users(first_name,Last_name,phone_number,email,password,beginning_trial_period,
			end_trial_period,verification_code) VALUES (@firstName,@lastName,@phoneNumber,@email,@password,Null,NULL,@verification_code);
			SET @supervisor_id=SCOPE_IDENTITY();
			insert into gym VALUES(@gym_name,@price_per_month,@supervisor_id);
		end
	else
		begin
			RAISERROR('this credentails used by another client either first name,last name or email please provide different credentials',16,1)
		end
	end
exec addSupervisorAndGym 'j','j','0635103092','waller@gmail.com','password1','X',300,'cxjhsgyfrzvghchscd';
--login
ALTER PROCEDURE Login(@email varchar(40))
as	
begin
	SELECT users.user_id,first_name,Last_name,gym.gym_id,status,role,password FROM users INNER JOIN gym ON users.user_id=gym.supervisor_id WHERE email=@email;
end
--add Trigger
CREATE TRIGGER addClient On client 
AFTER  insert
AS 
begin
	DECLARE @clFName varchar(70)
	DECLARE @clLName varchar(70)
	DECLARE @gymId int
	DECLARE @count int
	select @clFName=client_first_name,@clLName=client_last_name,@gymId=gym_id FROM inserted
	SET @count=(SELECT COUNT(*) FROM client WHERE client_first_name=@clFName AND client_last_name=@clLName AND gym_id=@gymId)
	if (@count>=2)
		begin
			raiserror('this client already exist',16,1)
			rollback
		end
end
ALTER PROCEDURE addClientForGym(@client_first_name varchar(70),@client_last_name varchar(80),@client_phone_number varchar(70),@gym_id int,@image varchar(255))
as
begin
	DECLARE @clientId int 
		insert into client(client_first_name,client_last_name,client_phone_number,gym_id,client_image)  VALUES 
		(@client_first_name,@client_last_name,@client_phone_number,@gym_id,@image);
		SET @clientId=SCOPE_IDENTITY();
		insert into operations(operation_status, client_id) VALUES ('access',@clientId);
end
EXEC addClientForGym 'Hamza','Assou','0661805085',74,'blabla';
select * from client;
--select client for supervisor 
ALTER PROCEDURE selectClients(@gym_id int)
AS
begin
	SELECT client.client_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status,client_image 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end


--search client
ALTER PROCEDURE search(@gym_id int,@regex varchar(40))
AS
begin
	SET @regex=REPLACE(@regex,' ','');
	SELECT client.client_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE
	((client_first_name+client_last_name LIKE '%'+@regex+'%') OR (client_last_name+client_first_name LIKE '%'+@regex+'%')) AND gym_id=@gym_id AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
exec search 2,'assouhamza';
--clients which their month expired
ALTER PROCEDURE searchClientsMonthExpired(@gym_id int)
AS
begin
	SELECT client.client_id,client_first_name,client_last_name,client_image,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operation_status='reject' 
	AND DATEDIFF(day,beginning_period_date,end_period_date)>10
	AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
select * from operations;
--clients which they have access
ALTER PROCEDURE searchClientsWhoTheyHaveAccess(@gym_id int)
AS
begin
	SELECT client.client_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status,client_image 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operation_status='access' 
	AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
--client in trial period
CREATE PROCEDURE searchTrialMembers(@gym_id int)
AS
begin
	SELECT client.client_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND DATEDIFF(day,beginning_period_date,end_period_date)<=10 
	AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
--search trial members
CREATE PROCEDURE newClientOfThisMonth(@gymId int)
as
begin
	SELECT COUNT(*) as 'number' FROM client INNER JOIN operations ON operations.client_id=client.client_id
	WHERE MONTH(joinning_date)=MONTH(GETDATE()) AND gym_id=@gymId AND operation_status='access';
end

--set client operation status who their month expired
ALTER PROCEDURE setOperationStatus
AS
begin
	UPDATE operations SET operation_status='reject' WHERE GETDATE()>=end_period_date;
end
exec setOperationStatus;
go
select * from operations INNER JOIN client ON operations.client_id=client.client_id WHERE client_first_name='sbix';
use gym_management;
--calculate total of specific month of specific gym
CREATE PROCEDURE calculateTotalOfMonth(@gym_id int,@month int,@year int)
AS
begin
	SELECT client_first_name,client_last_name,beginning_period_date,end_period_date,price_per_month as 'amount' FROM operations INNER JOIN 
	(SELECT client.client_id,client_first_name,client_last_name,joinning_date,client_phone_number,gym.price_per_month FROM client INNER JOIN gym
	ON client.gym_id=gym.gym_id WHERE  gym.gym_id=@gym_id) t ON operations.client_id=t.client_id WHERE MONTH(beginning_period_date)=@month AND 
	YEAR(end_period_date)=@year AND (operation_status='access' OR operation_status='reject') AND 
	DATEDIFF(day,beginning_period_date,end_period_date)>10;
end

--earnning actual month
CREATE PROCEDURE earningOfMonth(@gym_id int,@month int)
AS
begin
	select SUM(price_per_month) as 'amount' FROM operations INNER JOIN (
	select client_id,price_per_month FROM gym INNER JOIN client ON client.gym_id=gym.gym_id WHERE gym.gym_id=@gym_id) t
	ON t.client_id=operations.client_id WHERE operation_status='access';
			
end
exec earningOfMonth 35,5;--give access to client
Create PROCEDURE giveAccessToClient(@client_id int)
As
begin
	insert into operations(operation_status,client_id) Values('access',@client_id) ;
end
--add payment
CREATE PROCEDURE addPayment(@user_id int)
AS
begin
	insert into payment(user_id) VALUES(@user_id);
end
--select users information
CREATE PROCEDURE selectUerInformation(@user_id int)
AS
begin
	SELECT first_name,last_name,phone_number,beginning_trial_period,end_trial_period,status 
	FROM users WHERE user_id=@user_id;
end
--SELECT payment status of each user
ALTER PROCEDURE selectUsers
AS
begin
	SELECT first_name,Last_name,beginning_trial_period,end_trial_period,beginning_DATE,end_date,subscription_price FROM users INNER JOIN payment ON users.user_id=payment.user_id WHERE payment.payment_id 
	IN (SELECT MAX(payment.payment_id) as 'payment_id' FROM payment group by user_id)
end
--details payment for specific user
ALTER PROCEDURE detailsUsers(@user_id int)
AS
begin
	SELECT first_name,Last_name,phone_number,beginning_trial_period,end_trial_period,beginning_DATE,end_date,subscription_price FROM 
	users INNER JOIN payment ON payment.user_id=users.user_id WHERE users.user_id=@user_id;
end

CREATE PROCEDURE newClientsHistoricalData(@gym_id int,@month int,@year int)
AS
begin
	select client_id,client_first_name,client_last_name,client_phone_number,joinning_date FROM client WHERE gym_id=@gym_id 
	AND type_joinning_date='access' AND MONTH(joinning_date)=@month AND YEAR(joinning_date)=@year;
end
exec newClientsHistoricalData 2,5,2024;

select * from client;
go
select * from operations;



CREATE PROCEDURE adjustOperationStatus
AS
begin
	UPDATE operations SET operation_status='reject' WHERE GETDATE()>=end_period_date;
end

select DISTINCT MONTH(beginning_period_date) as 'month',YEAR(beginning_period_date) as 'year' from operations;
go
select * from operations;

CREATE PROCEDURE datesHistoricalData(@gym_id int) 
AS
begin
	select DISTINCT  MONTH(beginning_period_date) as 'month',YEAR(end_period_date) as 'year' FROM operations INNER JOIN 
	(select client_id FROM client INNER JOIN gym ON client.gym_id=gym.gym_id WHERE gym.gym_id=@gym_id) t
	ON t.client_id=operations.client_id;
end
exec datesHistoricalData 2;

CREATE PROCEDURE confirmClientTrialPriod(@client_id int)
AS
begin
	insert into operations VALUES (GETDATE(),DATEADD(MONTH,1,GETDATE()),'access',@client_id); 
	update client SET type_joinning_date='access' WHERE client_id=@client_id;
end


insert into client VALUES('k','k','2024-05-6','0635103092','trial',69);
go
insert into operations VALUES('2024-06-8','2024-06-11','access',25);

select * from client;
go 
select * from operations;
--details of client
CREATE PROCEDURE detailsClient(@client_id int)
AS
begin
	SELECT beginning_period_date,end_period_date,
	price_per_month,operation_status,
	CASE WHEN DATEDIFF(day,beginning_period_date,end_period_date)>10 THEN 'payed'
		WHEN DATEDIFF(day,beginning_period_date,end_period_date)<10 THEN 'trial'
	END	AS real_operations_status
	FROM operations INNER JOIN 
	(SELECT client_id,client_first_name,client_last_name,joinning_date,client_phone_number,gym.price_per_month FROM client INNER JOIN gym
	ON client.gym_id=gym.gym_id WHERE client_id=@client_id) t ON operations.client_id=t.client_id;
end
exec detailsClient 21;

--select client information
CREATE PROCEDURE selectInformationOfClient(@client_id int)
AS
begin
	SELECT client_first_name,client_last_name,joinning_date,client_phone_number FROM client WHERE client_id=@client_id;
end


select * from gym;

insert into client VALUES ('mohamed','grmat','2024-05-5','0635103092','access',73);
go
insert into operations VALUES ('2024-05-5','2024-06-5','access',34);

select * from client;
update users SET email='assou@gmail.com' where user_id=7;
go
select * from client;

use gym_management;
select * from users;
delete from users where user_id=31;


CREATE PROCEDURE activateEmail(@email varchar(40),@code varchar(30))
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

CREATE PROCEDURE sendAnotherCode(@email varchar(30),@code varchar(20))
AS
begin
	UPDATE users SET verification_code=@code WHERE email=@email;
end


select * from client;
go
select * from operations;

insert into client values('k','cap','2024-04-12','0635103092',74,'../images/nCHrdjlh_400x400.jpg')
go
insert into operations values('2024-04-12','2024-05-12','reject',76)