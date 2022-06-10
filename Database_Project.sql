Use airlineresvervationsystem;


-- Table structure for table `airlines`
CREATE TABLE airlines (
  A_Name varchar(70) NOT NULL,
  Airline_ID varchar(70) NOT NULL,
  Account_No varchar(70)  NULL
);


-------------------------------------------------------------------------------------------------

-- Table structure for table `airport`

CREATE TABLE airport (
  A_Name varchar(70) NOT NULL,
  City varchar(70) NOT NULL,
  Country varchar(70) NOT NULL,
  Airport_ID varchar(70) NOT NULL
);



-------------------------------------------------------------------------------------------------------

-- Table structure for table `flights`
CREATE TABLE flights (
  Flight_no varchar(70) NOT NULL,
  Economy int NOT NULL,
  Buisness int NOT NULL,
  FirstClass int NOT NULL,
  Airline_ID varchar(70) NOT NULL,
  EconomyPrice int DEFAULT NULL,
  BuisnessPrice int DEFAULT NULL,
  FirstClassPrice int DEFAULT NULL,
  Account_No varchar(70) DEFAULT NULL,
  Pilot_ID varchar(70) NOT NULL
);


-- --------------------------------------------------------

-- Table structure for table `passes`
CREATE TABLE passes (
  Flight_no varchar(70) NOT NULL,
  Airport_ID_Src varchar(70) NOT NULL,
  Airport_ID_Dst varchar(70) NOT NULL,
  DepartureTime time NOT NULL,
  ArrivalTime time NOT NULL,
  DepartureDays int NOT NULL,
  ArrivalDays int NOT NULL
);


-- ----------------------------------------------------------------------------------------------------------------------


-- Table structure for table `payment`


CREATE TABLE payment (
  Payment_ID int NOT NULL,
  Account_credited varchar(70) NOT NULL,
  Account_debited varchar(70) NOT NULL,
  TimeOfPayment_date date NULL DEFAULT NULL,
  TimeOfPayment_hours time NULL DEFAULT NULL,
  ModeOfPayment varchar(70) NOT NULL,
  Amount int NOT NULL,
  Ticket_ID varchar(70) NOT NULL
);


-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE ticket (
  Booking_Status int DEFAULT NULL,
  Cancellation_Status int DEFAULT NULL,
  RefundStatus int DEFAULT NULL,
  CancellationTime_date date NULL DEFAULT NULL,
  CancellationTime_hours time NULL DEFAULT NULL,
  Ticket_ID varchar(70) NOT NULL,
  Class int DEFAULT NULL,
  BookingTime_date date NULL DEFAULT NULL,
  BookingTime_hours time NULL DEFAULT NULL,
  Flight_no varchar(70) DEFAULT NULL,
  Userr_ID varchar(70) DEFAULT NULL,
  Date_of_departure date DEFAULT NULL
);




-- ----------------------------------------------------------------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE person(
	Person_ID varchar(70) NOT NULL UNIQUE,
	First_Name varchar(70) NOT NULL,
    Last_Name varchar(70) NOT NULL,
    DOB date NOT NULL,
    Gender char(1) NOT NULL,
    Phone_No varchar(70) NOT NULL

);

CREATE TABLE users (
  Userr_ID varchar(70) NOT NULL,	
  Email varchar(70) NOT NULL,
  Pass_word varchar(70) NOT NULL
) ;

CREATE TABLE pilots(
  Pilot_ID varchar(70) NOT NULL,
  Salary NUMERIC(15,3)

);

--
-- inserting data for table `users`
--



--
ALTER TABLE person
  ADD PRIMARY KEY (Person_ID);

--
ALTER TABLE users
  ADD PRIMARY KEY (Userr_ID),
  FOREIGN KEY (Userr_ID) REFERENCES person(Person_ID) ON DELETE CASCADE;
--
ALTER TABLE pilots
  ADD PRIMARY KEY (Pilot_ID),
  FOREIGN KEY (Pilot_ID) REFERENCES person(Person_ID) ON DELETE CASCADE;


ALTER TABLE airlines
  ADD PRIMARY KEY (Airline_ID);

--


--
ALTER TABLE airport
  ADD PRIMARY KEY (Airport_ID);

--

--
ALTER TABLE flights
  ADD PRIMARY KEY (Flight_no);

--

--
ALTER TABLE passes
  ADD PRIMARY KEY (Airport_ID_Dst,Airport_ID_Src,Flight_no,ArrivalTime,DepartureTime,DepartureDays,ArrivalDays); 


--




--
ALTER TABLE payment
  ADD PRIMARY KEY (Payment_ID);

--

--
ALTER TABLE ticket
  ADD PRIMARY KEY (Ticket_ID);

--
-- Indexes for table `users`
--


--

--
ALTER TABLE payment
  ALTER column Payment_ID int NOT NULL;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE flights
  ADD CONSTRAINT flights_ibfk_1 FOREIGN KEY (Airline_ID) REFERENCES airlines (Airline_ID),
   CONSTRAINT flights_ibfk_7 FOREIGN KEY (Pilot_ID) REFERENCES pilots (Pilot_ID);

--
-- Constraints for table `passes`
--
ALTER TABLE passes
  ADD CONSTRAINT passes_ibfk_1 FOREIGN KEY (Airport_ID_Dst) REFERENCES airport (Airport_ID),
	  CONSTRAINT passes_ibfk_2 FOREIGN KEY (Airport_ID_Src) REFERENCES airport (Airport_ID),
	  CONSTRAINT passes_ibfk_3 FOREIGN KEY (Flight_no) REFERENCES flights (Flight_no);


--
-- Constraints for table `payment`
--
ALTER TABLE payment
  ADD CONSTRAINT payment_ibfk_1 FOREIGN KEY (Ticket_ID) REFERENCES ticket (Ticket_ID);

--
-- Constraints for table `ticket`
--
ALTER TABLE ticket
  ADD CONSTRAINT ticket_ibfk_3 FOREIGN KEY (Flight_no) REFERENCES flights (Flight_no),
   CONSTRAINT ticket_ibfk_4 FOREIGN KEY (Userr_ID) REFERENCES users (Userr_ID);

--   'Inserting data'
-- person
   INSERT INTO person  VALUES
( 'ibrahim33','Ibrahim', 'Refa3y', '2001-07-14', 'M', '01256622787'),
( 'ahmed22','Ahmed', 'Ehab', '1998-12-10', 'M',  '01091359579'),
( 'maro','Marwan', 'Emad', '2001-5-28', 'M', '01555606923'),
( 'mw','Mohamed', 'Wael', '2000-12-10', 'M','01091359579'),
( 'ao56','Ahmed', 'Osama', '2000-7-10', 'M', '01191359579'),
( 'mustafa31','Mustafa', 'Ali', '1999-10-10', 'M', '01091359511');

-- users
INSERT INTO users VALUES
('ibrahim33', 'Ibrahim@gmail', '12345'),
('ahmed22','Ehab@gmail.com', '12345');

-- pilots
INSERT INTO pilots (Pilot_ID,Salary) VALUES
('maro','31000'),
('mw','21000'),
('ao56','22000'),
('mustafa31','11000');


-- airline
INSERT INTO airlines (A_Name, Airline_ID, Account_No) VALUES
('Air Arabia', 'AA',NULL),
('Air Cairo', 'AC',NULL),
('Air Sinai', 'AS',NULL),
('Go Air', 'GOW',NULL),
('Alexandria Airlines', 'AL',NULL),
('AlMasria Universal Airlines', 'AUA',NULL);



-- airport
INSERT INTO airport (A_Name, City, Country, Airport_ID) VALUES
('A El Nouzha Airport', 'Alexandria', 'Egypt', 'ALY'),
('B Borg El Arab Airport', 'Alexandria', 'Egypt', 'HBE'),
('E Paphos International Airport', 'Alexandria', 'Egypt', 'PFO'),
('Aswan International Airport', 'Aswan', 'Egypt', 'ASW'),
('Assiut International Airport', 'Assiut', 'Egypt', 'ASS'),
('Marsa Matruh Airport', 'Marsa Matruh', 'Egypt', 'MM'),
('Kheria', 'Agra', 'India', 'AGR');

-- flights
INSERT INTO flights (Flight_no, Economy, Buisness, FirstClass, Airline_ID, EconomyPrice, BuisnessPrice, FirstClassPrice, Account_No,Pilot_ID) VALUES
('2T 107', 1, 1, 0, 'AC', 3414, 4686, 5585, NULL,'maro'),
('2T 108', 0, 1, 1, 'AC', 3673, 4523, 5309, NULL,'mw'),
('2T 109', 1, 1, 1, 'AA', 3690, 4326, 5879, NULL,'mw'),
('2T 110', 1, 1, 1, 'AL', 3995, 4997, 5996, NULL,'maro'),
('2T 121', 1, 1, 1, 'AL', 3995, 4929, 5983, NULL,'maro');


-- passess (Routes)r
INSERT INTO passes (Flight_no, Airport_ID_Src, Airport_ID_Dst, DepartureTime, ArrivalTime, DepartureDays, ArrivalDays) VALUES
('2T 107', 'ALY', 'HBE', '07:20:00', '08:30:00', DATEDIFF(DAY,'2022-05-28','2022-06-2'),DATEDIFF(DAY,'2022-05-28','2022-06-15')),
('2T 108', 'HBE', 'ALY', '08:45:00', '10:05:00', DATEDIFF(DAY,'2022-05-28','2022-06-2'),DATEDIFF(DAY,'2022-05-28','2022-06-10')),
('2T 109', 'MM', 'PFO', '10:05:00', '11:25:00', DATEDIFF(DAY,'2022-05-28','2022-06-2'),DATEDIFF(DAY,'2022-05-28','2022-06-15')),
('2T 110', 'ASW', 'ASS', '07:55:00', '11:25:00',DATEDIFF(DAY,'2022-05-28','2022-06-2'),DATEDIFF(DAY,'2022-05-28','2022-06-8')),
('2T 121', 'ALY', 'PFO', '10:05:00', '9:15:00',DATEDIFF(DAY,'2022-05-28','2022-06-2'),DATEDIFF(DAY,'2022-05-28','2022-06-15'));

-- ticket
INSERT INTO ticket (Booking_Status, Cancellation_Status, RefundStatus, CancellationTime_date,CancellationTime_hours, Ticket_ID, Class, BookingTime_date,BookingTime_hours, Flight_no,  Date_of_departure,Userr_ID) VALUES
(1, 0, 0, NULL,NULL, 'AI 23', 0, '2019-11-15',' 10:31:32', '2T 107',  '14:50:00', 'ibrahim33'),
(1, 0, 0, NULL,NULL, 'AI 24', 0, '2019-11-15',' 10:21:32', '2T 107',  '14:50:00', 'ibrahim33'),
(1, 0, 0, NULL,NULL, 'I5 28', 0, '2019-11-15',' 10:51:32', '2T 107',  '14:50:00', 'ibrahim33'),
(1, 0, 0, NULL,NULL, 'I5 32', 0, '2019-11-15',' 10:41:32',  '2T 108',  '14:50:00', 'ibrahim33'),
(1, 0, 0, NULL,NULL, 'IND 15', 0, '2019-11-15',' 10:51:32',  '2T 109',  '14:50:00', 'ahmed22'),
(1, 0, 0, NULL,NULL, 'AI 26', 0, '2019-11-15',' 10:59:32', '2T 121',  '14:50:00', 'ahmed22'),
(1, 0, 0, NULL,NULL, 'IND 26', 0, '2019-11-15',' 10:11:32',  '2T 121',  '14:50:00','ahmed22');


-- payment
INSERT INTO payment (Payment_ID, Account_credited, Account_debited, TimeOfPayment_date,TimeOfPayment_hours, ModeOfPayment, Amount, Ticket_ID) VALUES
(51, '', 'as', '2019-11-15 ','11:04:13', 'online', 0, 'AI 23'),
(52, '', 'Sacc', '2019-11-15',' 07:10:43', 'online', 0, 'AI 24'),
(53, '', 'Sacc', '2019-11-15 ','07:10:43', 'online', 0, 'AI 26'),
(54, '', 'Sacc', '2019-11-15',' 07:10:43', 'online', 0, 'IND 26');


