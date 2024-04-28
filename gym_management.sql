

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

--create a trigger
CREATE TRIGGER triggerOperation ON operations
AFTER INSERT
AS
BEGIN
	UPDATE operations SET operation_status='reject' WHERE GETDATE()>=end_period_date;
END
--When user login do this
UPDATE operations SET operation_status='reject' WHERE GETDATE()>=end_period_date;
--create table payment
Create Table payment(
	payment_id int primary key identity(1,1), 
	payment_DATE DATE,
	subscription_price int,
	user_id int,
	Constraint USER_ID FOREIGN KEY (user_id) REFERENCES users(user_id),
)
--constraints of payment
ALTER TABLE payment ADD constraint DEFAULT_SUBSCRIPTION_PAYMENT DEFAULT 15 FOR subscription_price; 
ALTER TABLE payment ADD constraint PAYMENT_DATE DEFAULT GETDATE() FOR payment_date;
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
CREATE PROCEDURE addClient(@client_first_name varchar(50),@client_last_name varchar(50),@client_phone_number varchar(50),
@gym_id int,@status varchar(40))
AS 
begin
	DECLARE @idCl int
	IF NOT EXISTS(SELECT 1 FROM client WHERE client_first_name=@client_first_name AND client_last_name=@client_last_name AND gym_id=@gym_id)
	begin
		insert into client(client_first_name,client_last_name,client_phone_number,gym_id)  VALUES 
		(@client_first_name,@client_last_name,@client_phone_number,@gym_id);
		SET @idCl=SCOPE_IDENTITY();
		insert into operations(operation_status,client_id) VALUES(@status,@idCl);
	end
	ELSE
	begin
		RAISERROR('Client Already Exist in Your Gym',16,1)
	end
end
--select client for 
ALTER PROCEDURE selectClients(@gym_id int)
AS
begin
	SELECT operation_id,client_first_name,client_last_name,beginning_period_date,end_period_date,operation_status 
	FROM client INNER JOIN operations ON operations.client_id=client.client_id WHERE gym_id=@gym_id AND operations.operation_id 
	IN (SELECT MAX(operations.operation_id) as 'operation' FROM operations group by client_id)
end
