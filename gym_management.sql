

CREATE DATABASE gym_management;

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

--constraints for users table
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
ALTER TABLE users ADD CONSTRAINT CHECK_STATUS check(status IN ('trial','access','reject'));
go
ALTER TABLE users ADD CONSTRAINT DEFAULT_STATUS DEFAULT 'trial' FOR status;
--test
INSERT INTO users (first_name, last_name, phone_number, email, password, role,beginning_trial_period,end_trial_period,status) 
VALUES ('Marwane', 'Assou', '0123456789', 'marwane.assou@gmail.com', 'password1', 'admin',NULL,NULL,'access');
go
INSERT INTO users (first_name, last_name, phone_number, email, password, role) 
VALUES ('Raghad', 'Assou', '0635103092', 'ko1@gmail.com', 'password2', 'supervisor');
go
INSERT INTO users (first_name, last_name, phone_number, email, password, role) 
VALUES ('Alice', 'Smith', '0987654321', 'alice.smith@gmail.com', 'password3', 'supervisor');
go
INSERT INTO users (first_name, last_name, phone_number, email, password, role) 
VALUES ('Bob', 'Johnson', '0654321098', 'bob.johnson@gmail.com', 'password4', 'supervisor');
go
INSERT INTO users (first_name, last_name, phone_number, email, password, role) 
VALUES ('Emily', 'Davis', '0976543210', 'emily.davis@gmail.com', 'password5', 'supervisor');

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
--values gym
INSERT INTO gym (gym_name, price_per_month, supervisor_id)
VALUES ('Gym 1', 50, 1);
go
INSERT INTO gym (gym_name, price_per_month, supervisor_id)
VALUES ('Gym 2', 60, 2);
go
INSERT INTO gym (gym_name, price_per_month, supervisor_id)
VALUES ('Gym 3', 70, 3);
go
INSERT INTO gym (gym_name, price_per_month, supervisor_id)
VALUES ('Gym 4', 80, 4);
--clients table
CREATE TABLE client(
	client_id int primary key identity(1,1),
	client_first_name varchar(20),
	client_last_name varchar(20),
	joinning_date date DEFAULT getDate(),
	client_phone_number varchar(10),
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
--insert data to client table
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('John', 'Doe', 1, '0123456789');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('Alice', 'Smith', 2, '0234567890');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('Bob', 'Johnson', 3, '0345678901');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('Emily', 'Davis', 4, '0456789012');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('Michael', 'Wilson', 1, '0567890123');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('Emma', 'Brown', 2, '0678901234');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('David', 'Martinez', 3, '0789012345');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('Olivia', 'Taylor', 4, '0890123456');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('Sophia', 'Anderson', 1, '0901234567');
go
INSERT INTO client (client_first_name, client_last_name, gym_id, client_phone_number)
VALUES ('James', 'Garcia', 2, '0123456789');
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
--insert values
insert into operations(operation_status,client_id) VALUES('trial',5);

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
CREATE TRIGGER status_user ON payment
AFTER INSERT
AS
begin
	UPDATE users SET users.status='access' WHERE user_id=(SELECT top 1 user_id FROM payment ORDER BY payment_id DESC);
end
---functions and stored procedures
SELECT * FROM users;
go
SELECT * FROM gym;
go
SELECT * FROM client;
go
SELECT * FROM operations;
go
SELECT * FROM payment;

--procedure sign up
ALTER PROCEDURE addSupervisorAndGym(@firstName Varchar(10),@lastName Varchar(10),@phoneNumber Varchar(10)
,@email varchar(40),@password varchar(40),@gym_name varchar(20),@price_per_month int)
AS
begin
	DECLARE @supervisor_id int;
	if NOT EXISTS (SELECT 1 FROM users WHERE (first_name=@firstName AND Last_name=@lastName) OR (email=@email))
		begin
			insert into users(first_name,Last_name,phone_number,email,password) VALUES (@firstName,@lastName,@phoneNumber,@email,@password);
			SET @supervisor_id=SCOPE_IDENTITY();
			insert into gym VALUES(@gym_name,@price_per_month,@supervisor_id);
		end
	else
		begin
			RAISERROR('this credentails used by another client either first name,last name or email please provide different credentials',16,1)
		end
	end
--login
ALTER PROCEDURE Login(@email varchar(40))
as	
begin
	SELECT users.user_id,gym.gym_id,role FROM users INNER JOIN gym ON users.user_id=gym.supervisor_id WHERE email=@email;
end
--add client
ALTER PROCEDURE addClientWithTrialPeriod(@client_first_name varchar(50),@client_last_name varchar(50),@client_phone_number varchar(50),
@gym_id int,@numberOfTrialDays int)
AS 
begin
	DECLARE @idCl int
	IF NOT EXISTS(SELECT 1 FROM client WHERE client_first_name=@client_first_name AND client_last_name=@client_last_name AND gym_id=@gym_id)
	begin
		insert into client(client_first_name,client_last_name,client_phone_number,gym_id)  VALUES 
		(@client_first_name,@client_last_name,@client_phone_number,@gym_id);
		SET @idCl=SCOPE_IDENTITY();
		IF @numberOfTrialDays<>0
		begin
			insert into operations(end_period_date,operation_status,client_id) VALUES(DATEADD(Day,@numberOfTrialDays,GETDATE()),'trial',@idCl);
		end
		else
		BEGIN
			insert into operations(end_period_date,operation_status,client_id) VALUES(DATEADD(MONTH,1,GETDATE()),'access',@idCl);
		end
	end
	ELSE
	begin
		RAISERROR('Client Already Exist in Your Gym',16,1)
	end
end
--select client for supervisor 
ALTER PROCEDURE selectClients(@gym_id int)
AS
begin
	SELECT operation_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
--search client
ALTER PROCEDURE searchClient(@gym_id int,@regex varchar(40))
AS
begin
	SET @regex=REPLACE(@regex,' ','');
	SELECT operation_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE
	(client_first_name+client_last_name LIKE '%'+@regex+'%') AND gym_id=@gym_id AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
--details of client
ALTER PROCEDURE detailsClient(@client_id int)
AS
begin
	SELECT beginning_period_date,end_period_date,
	price_per_month,operation_status FROM operations INNER JOIN 
	(SELECT client_id,client_first_name,client_last_name,joinning_date,client_phone_number,gym.price_per_month FROM client INNER JOIN gym
	ON client.gym_id=gym.gym_id WHERE client_id=@client_id) t ON operations.client_id=t.client_id;
end
--select client information
CREATE PROCEDURE selectInformationOfClient(@client_id int)
AS
begin
	SELECT client_first_name,client_last_name,joinning_date,client_phone_number FROM client WHERE client_id=@client_id;
end
--clients which their month expired
CREATE PROCEDURE searchClientsMonthExpired(@gym_id int)
AS
begin
	SELECT operation_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operation_status='reject' 
	AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
--clients which they have access
CREATE PROCEDURE searchClientsWhoTheyHaveAccess(@gym_id int)
AS
begin
	SELECT operation_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operation_status='access' 
	AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end

--set client operation status who their month expired
CREATE PROCEDURE setOperationStatus
AS
begin
	UPDATE operations SET operation_status='reject' WHERE GETDATE()>end_period_date;
end
exec setOperationStatus;

--calculate total of specific month of specific gym
alter PROCEDURE calculateTotalOfMonth(@gym_id int,@month int)
AS
begin
	SELECT client_first_name,client_last_name,client_phone_number,beginning_period_date,end_period_date,price_per_month as 'amount' FROM operations INNER JOIN 
	(SELECT client_id,client_first_name,client_last_name,joinning_date,client_phone_number,gym.price_per_month FROM client INNER JOIN gym
	ON client.gym_id=gym.gym_id WHERE  gym.gym_id=@gym_id) t ON operations.client_id=t.client_id WHERE MONTH(beginning_period_date)=@month;
end
--give access to client
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
exec selectUerInformation 3;
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


