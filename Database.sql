CREATE DATABASE BPES;
USE BPES;

///////////////////////////////////////////////////////////////////

CREATE TABLE User(Username VARCHAR(30) NOT NULL,
				Name VARCHAR(20) NOT NULL,				
				Password VARCHAR(100) NOT NULL,
				Designation VARCHAR(30) NOT NULL,
				Status VARCHAR(10) NOT NULL,
				PRIMARY KEY(Username)
);

INSERT INTO User VALUES('admin','',md5('123'),'Admin','Employed');
INSERT INTO User VALUES('pahan90','Pahan Malinga',md5('pahan123'),'MD','Employed');
INSERT INTO User VALUES('charani93','Charani Adurapotha',md5('charani123'),'HR','Employed');
INSERT INTO User VALUES('908456978V','H K T H Gunasekara',md5('guna90'),'Employee','Employed');
INSERT INTO User VALUES('nuwan86','Nuwan Ranapana',md5('nuwan123'),'Supervisor','Employed');
INSERT INTO User VALUES('884951236V','S A S Prasanna',md5('prasanna88'),'Employee','Employed');
INSERT INTO User VALUES('894692586V','L A P Suranjeewa',md5('surnajeewa89'),'Employee','Resigned');
INSERT INTO User VALUES('859479635V','Ajith Kumara',md5('kumara85'),'Employee','Resigned');

INSERT INTO User VALUES('882152636V','D M P Kumara',md5('dmp88'),'Employee','Employed');
INSERT INTO User VALUES('911102437V','K L Deekshana',md5('deekshana91'),'Employee','Employed');
INSERT INTO User VALUES('952709322V','K H Silva',md5('silva95'),'Employee','Employed');
INSERT INTO User VALUES('920567424V','M M A C Bandara',md5('bandara92'),'Employee','Employed');
INSERT INTO User VALUES('941683921V','S L D Vishwa',md5('vishwa94'),'Employee','Employed');
INSERT INTO User VALUES('892568733V','K M L Perera',md5('perera89'),'Employee','Employed');

///////////////////////////////////////////////////////////////////

CREATE TABLE Team(Team_No INT NOT NULL,
						Team_Name VARCHAR(20) NOT NULL,
						Engineer_name VARCHAR(30) NOT NULL,
						eng_telephone VARCHAR(10) NOT NULL,
						eng_email VARCHAR(30) NOT NULL
						PRIMARY KEY(Team_No)
);

INSERT INTO Team VALUES(1,'RTG','Nishantha Mendis','0778945689','nishanthamendis@gmail.com');
INSERT INTO Team VALUES(2,'QC','Sagara Narasinghe','0784956345','sagaranarasinghe@gmail.com');
INSERT INTO Team VALUES(3,'HIPG','Vishwa De Silva','0758961245','vishwa.silva@gmail.com');
INSERT INTO Team VALUES(4,'ZCM','Janith Saputhanthri','0717895612','janithsaputhanthri@gmail.com');
INSERT INTO Team VALUES(5,'SAGT','Sujith Lasantha','0768943256','sujithlasantha@gmail.com');

////////////////////////////////////////////////////////////////////

CREATE TABLE Employee(Emp_ID INT NOT NULL AUTO_INCREMENT,
							Team_No INT NOT NULL,
							Name VARCHAR(35) NOT NULL,
							NIC VARCHAR(12) NOT NULL,
							Tel_No VARCHAR(10) NOT NULL,
							Marital_Status VARCHAR(20) NOT NULL,
							Basic_Salary DECIMAL(10,2) NOT NULL,
							Permanent_address VARCHAR(50) NOT NULL,
							Temporary_address VARCHAR(50),
							Current_status VARCHAR(15) NOT NULL,						
							PRIMARY KEY(Emp_ID),
							FOREIGN KEY(Team_No) REFERENCES Team(Team_No)
							ON DELETE CASCADE ON UPDATE CASCADE							
);

INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (1,'H K T H Gunasekara','908456978V','0768945623','Married',25000,'No 162/A,Galle Road,Negambo',' ','Employed');
INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (2,'S A S Prasanna','884951236V','0758947952','Married',28000,'No 16,Galle Road,Galle','No 15, Circular road, Mirissa','Employed');

INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (3,'L A P Suranjeewa','894692586V','0778945812','Unmarried',20000,'No 15/A,Galle Road,Aluthgama',' ','Resigned');
INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (4,'Ajith Kumara','859479635V','0758942378','Unmarried',20000,'No 13,Galle Road,Kaluthara',' ','Resigned');



INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (5,'D M P Kumara','882152636V','0712397001','Unmarried',24000,'No 182/1,Thangalle Road,Matara',' ','Employed');

INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (1,'K L Deekshana','911102437V','0779965686','Unmarried',28000,'No 18,Goodshed Road,Ratnapura',' ','Employed');

INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (2,'K H Silva','952709322V','0786483099','Unmarried',25000,'No 128,Akuressa Road,Matara',' ','Employed');

INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (3,'M M A C Bandara','920567424V','0772276494','Married',26000,'No 3,Gonnoruwa Road,Beddawala,Hambantota',' ','Employed');

INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (4,'S L D Vishwa','941683921V','0776995690','Unmarried',26000,'No 60,Weerawa Place,Ragama Road,Kadawatha',' ','Employed');

INSERT INTO Employee 
(Team_No,Name,NIC,Tel_No,Marital_Status,Basic_Salary,Permanent_address,Temporary_address,Current_status) 
VALUES (5,'K M L Perera','892568733V','0750855686','Married',28000,'No 10/A,Megalle,Galle',' ','Employed');

////////////////////////////////////////////////////////////////////////////////////////////////////////////

CREATE TABLE Bank(Acc_No VARCHAR(25) NOT NULL,
						Emp_ID INT NOT NULL,
						Bank_name VARCHAR(30) NOT NULL,
						Bank_code INT NOT NULL,
						Branch_name VARCHAR(30) NOT NULL,
						Branch_Code INT NOT NULL,
						PRIMARY KEY(Acc_No),
						FOREIGN KEY (Emp_ID) REFERENCES Employee (Emp_ID)
						ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Bank VALUES('112753780926',1,'Sampath',7278,'Negambo',24);
INSERT INTO Bank VALUES('8004514325',2,'Commercial',7056,'Galle',27);
INSERT INTO Bank VALUES('8100064895',3,'Commercial',7056,'Aluthgama',40);
INSERT INTO Bank VALUES('11114589726',4,'HNB',7083,'Kaluthara',34);

INSERT INTO Bank VALUES('7269513',5,'BOC',7010,'Matara',24);
INSERT INTO Bank VALUES('107578002398',6,'NSB',7719,'Ratnapura',10);
INSERT INTO Bank VALUES('152200110164731',7,'Peoples',7135,'Matara',152);
INSERT INTO Bank VALUES('2796482036',8,'Commercial',7056,'Hambantota',166);
INSERT INTO Bank VALUES('295810225893',9,'DFCC',7454,'Kadawatha',29);
INSERT INTO Bank VALUES('137050354690',10,'HNB',7083,'Galle',13);

///////////////////////////////////////////////////////////////////////////////////////////////////////////

CREATE TABLE Attendance(Date DATE NOT NULL,
								Emp_ID INT NOT NULL,
								checkIn_Time TIME NOT NULL,
								checkOut_Time TIME NOT NULL,
								Normal_OT DECIMAL DEFAULT 0,
								Double_OT DECIMAL DEFAULT 0,
								Remark VARCHAR(30) DEFAULT 'Weekday',
								PRIMARY KEY(Date,Emp_ID),
								FOREIGN KEY (Emp_ID) REFERENCES Employee(Emp_ID)
								ON DELETE CASCADE ON UPDATE CASCADE
);



/////////////////////////////////////////////////////////////////////////////////////////////////////////////



CREATE TABLE Salary(Emp_ID INT NOT NULL,
							Year YEAR NOT NULL,
							Month VARCHAR(20) NOT NULL,
							Worked_days INT NOT NULL,
							worked_weekdays_saturdays INT NOT NULL,
							Worked_sundays INT,
							Worked_pubHolidays INT,
							BRAllowance DECIMAL(30,2),
							tot_for_EPFETF DECIMAL(30,2) NOT NULL,
							EPF_12 DECIMAL(30,2) NOT NULL,
							ETF_3 DECIMAL(30,2) NOT NULL,
							Other_llowance DECIMAL(30,2) NOT NULL,							
							DOT_pay DECIMAL(30,2),
							NOT_pay DECIMAL(30,2),
							Net_salary DECIMAL(30,2) NOT NULL,
							EPF_8 DECIMAL(30,2) NOT NULL,
							SL_deduction DECIMAL(30,2) NOT NULL,
							tot_salary DECIMAL(40,2) NOT NULL,
							PRIMARY KEY (Emp_ID,Month,Year),
							FOREIGN KEY (Emp_ID) REFERENCES Employee(Emp_ID)
							ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Salary VALUES(1,2021,'February ',26,20,3,3,3500.00,28980.77  ,3477.69 ,869.42 ,10000.00,3000.00,14062.50,56043.27,2318.46,0.00,53724.81);
INSERT INTO Salary VALUES(1,2021,'March ',28,24,3,1,3500.00,33000.00  ,3960.00,990.00 ,10000.00,2750.00,20812.50,66562.50,2640.00,0.00,63922.50);
INSERT INTO Salary VALUES(1,2021,'July ',2,20,3,3,3500.00,28980.77  ,3477.69 ,869.42 ,10000.00,3000.00,14062.50,56043.27,2318.46,53724.81);

INSERT INTO Salary VALUES(2,2021,'February ',22,17,3,2,3080.00,29400.00  ,3528.00 ,882.00 ,7500.00,5040.00,14070.00,56010.00,2352.00,0.00,53658.00);
INSERT INTO Salary VALUES(2,2021,'March ',27,24,2,1,3500.00,34860.00  ,4183.20 ,1045.80 ,10000.00,2520.00,17010.00,64390.00,2788.80,0.00,61601.20);
INSERT INTO Salary VALUES(2,2021,'July ',26,20,3,3,3500.00,28980.77  ,3477.69 ,869.42 ,10000.00,3000.00,14062.50,56043.27,2318.46,53724.81);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

CREATE TABLE Child(Number INT NOT NULL AUTO_INCREMENT,
						Emp_ID INT NOT NULL,
						DOB DATE NOT NULL,
						PRIMARY KEY(Number),
						FOREIGN KEY (Emp_ID) REFERENCES Employee (Emp_ID)
						ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO Child VALUES(1,1,'2005-05-06');
INSERT INTO Child VALUES(2,1,'2017-05-06');
INSERT INTO Child VALUES(3,2,'2008-09-26');
INSERT INTO Child VALUES(4,2,'2019-12-29');
INSERT INTO Child VALUES(4,2,'2006-08-01');


///////////// ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

CREATE TABLE Holiday(Date Date NOT NULL,
							Remark VARCHAR(50) NOT NULL,
							PRIMARY KEY(Date)
							);

INSERT INTO holiday VALUES('2021-02-04','National Day');
INSERT INTO holiday VALUES('2021-02-26','Poya Day');

INSERT INTO holiday VALUES('2021-03-28','Poya Day');

INSERT INTO holiday VALUES('2021-04-13','Sinhala & Tamil New Year Eve');
INSERT INTO holiday VALUES('2021-04-14','Sinhala & Tamil New Year');
INSERT INTO holiday VALUES('2021-04-26','Poya Day');
	
INSERT INTO holiday VALUES('2021-05-01','May Day');
INSERT INTO holiday VALUES('2021-05-24','Government Special Holiday');
INSERT INTO holiday VALUES('2021-05-25','Government Special Holiday');
INSERT INTO holiday VALUES('2021-05-26','Poya Day');
INSERT INTO holiday VALUES('2021-05-27','Day After Poya Day');


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

CREATE TABLE suspend_attendance(Date DATE NOT NULL,
								  	Emp_ID INT NOT NULL,
									checkIn_Time TIME NOT NULL,
									checkOut_Time TIME NOT NULL,
									Normal_OT DECIMAL DEFAULT 0,
									Double_OT DECIMAL DEFAULT 0,
									Remark VARCHAR(30) DEFAULT 'Saturday',
									PRIMARY KEY(Date,Emp_ID),
									FOREIGN KEY (Emp_ID) REFERENCES Employee(Emp_ID)
									ON DELETE CASCADE ON UPDATE CASCADE
									);
									
									
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


CREATE TABLE otp_expiry(id INT(11) NOT NULL AUTO_INCREMENT,
							  otp VARCHAR(10) NOT NULL,
							  is_expired INT(11) NOT NULL,
							  create_at DATETIME NOT NULL,
							  PRIMARY KEY(id)
								);									
									
									
									
									


/////////////////////////////////////////////////////////// END ////////////////////////////////////////////////////////////////////////////////






select sum(Normal_OT) from attendance where Emp_ID=1 and month(date)=3;
select sum(Double_OT) from attendance where Emp_ID=1 and month(date)=3;
select*from attendance where Emp_ID=1 and month(date)=month(now());

select*from attendance where Emp_ID=1 and (date between  DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW() );

SELECT * FROM employee,Attendance WHERE employee.Emp_ID=Attendance.Emp_ID AND MONTH(Date)=MONTH(NOW()) AND Current_status='Employed' ORDER BY Date ASC, employee.Emp_ID  ASC
select a.Emp_ID,Basic_salary,
		sum(Normal_OT) as 'NOT',
		sum(Double_OT) as 'DOT', 
		COUNT(IF(Remark='SL01',1,NULL)) 'SL01' ,
		COUNT(IF(Remark='Halfday',1,NULL)) 'Halfday',
		COUNT(IF(Remark='SL02',1,NULL)) 'SL02'
		from attendance a,employee e
		where Month(date)=Month('2021-08-01') AND
		a.Emp_ID=e.Emp_ID AND e.Name='H K T H Gunasekara'
		GROUP BY e.Emp_ID;
		
SELECT Worked_days,worked_weekdays_saturdays,Worked_sundays,Worked_pubHolidays,BRAllowance,tot_for_EPFETF,EPF_12,ETF_3,Other_llowance,DOT_pay,NOT_pay,Net_salary,EPF_8,SL_deduction,tot_salary FROM salary WHERE salary.Year=YEAR(CURDATE()) AND salary.Month=MONTHNAME('2021-08-01') AND Emp_ID=1;



SELECT * 
FROM ( select a.Emp_ID,Basic_salary,
		sum(Normal_OT) as 'NOT',
		sum(Double_OT) as 'DOT', 
		COUNT(IF(Remark='SL01',1,NULL)) 'SL01' ,
		COUNT(IF(Remark='Halfday',1,NULL)) 'Halfday',
		COUNT(IF(Remark='SL02',1,NULL)) 'SL02'
		from attendance a,employee e
		where Month(date)=Month('2021-08-01' ) AND
		a.Emp_ID=e.Emp_ID AND e.Name='H K T H Gunasekara' GROUP BY e.Emp_ID) AS A
JOIN ( SELECT * FROM salary WHERE salary.Year=YEAR(CURDATE()) AND salary.Month=MONTHNAME('2021-08-01') AND Emp_ID=1) AS B

ON A.Emp_ID=B.Emp_ID;
		
SELECT Bank_code, Branch_code,Acc_no,Name,tot_salary,Month FROM Bank b, Employee e, Salary s WHERE Month='March' AND  e.Emp_ID=b.Emp_ID AND e.Emp_ID=s.Emp_ID;

ALTER TABLE employee AUTO_INCREMENT=11;

ALTER TABLE otp_expiry AUTO_INCREMENT=0;

SELECT SUM(Normal_OT) as 'NOT' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND DATE(date) BETWEEN '2021-02-01' AND '2021-02-29' AND e.Emp_ID=1;

SELECT SUM(Normal_OT) as 'NOT' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) BETWEEN CONCAT('2021','-02-01') AND CONCAT('2021','-02-28')) AND e.Emp_ID=1;

SELECT COUNT(date) as 'Worked_days' FROM attendance a, employee e WHERE a.Emp_ID=e.Emp_ID AND (DATE(date) between CONCAT('2021','-02-01') and CONCAT('$year','-02-28')) AND e.Emp_ID=1




SELECT * FROM ( select a.Emp_ID,Basic_salary,
                        sum(Normal_OT) as 'NOT',
                        sum(Double_OT) as 'DOT',
                        COUNT(IF(Remark='SL01',1,NULL)) 'SL01' ,
                        COUNT(IF(Remark='Halfday',1,NULL)) 'Halfday',
                        COUNT(IF(Remark='SL02',1,NULL)) 'SL02'
                        from attendance a,employee e
                        where Month(date)=Month('2021-12-01' ) AND YEAR(date)=YEAR('2021-12-01') AND
                        a.Emp_ID=e.Emp_ID AND e.Name='H K T H Gunasekara' GROUP BY e.Emp_ID) AS A
                        JOIN ( SELECT * FROM salary WHERE salary.Year=YEAR('2021-12-01') AND salary.Month=MONTHNAME('2021-12-01') AND Emp_ID='1') AS B
                        ON A.Emp_ID=B.Emp_ID;

//////////////////////////////////////////////////// UNWANTED TABLES //////////////////////////////////////////////
CREATE TABLE Allowance(Allowance_ID INT NOT NULL,
								Name VARCHAR(50) NOT NULL,
								Amount DECIMAL(10,2) NOT NULL,
								PRIMARY KEY(Allowance_ID)
);

INSERT INTO Allowance VALUES(1,'Travelling Allowance',5000.00);
INSERT INTO Allowance VALUES(2,'Attendance Allowance',5000.00);
INSERT INTO Allowance VALUES(3,'Budgetary Relief Allowance',1000.00);
INSERT INTO Allowance VALUES(4,'Budgetary Relief Allowance',2500.00);

---------------------------------------------------------------------------------------------------------------------

CREATE TABLE Gift(Category CHAR(2) NOT NULL,
						Grade_details VARCHAR(20) NOT NULL,
						blank_bk INT,
						draw_bk INT,
						pastel_box INT,
						sngl80 INT,
						sngl120 INT,
						sngl160 INT,
						sngl200 INT,
						snglCR120 INT,
						pencil INT,
						eraser INT,
						foot_ruler INT,
						blue_pen INT,
						geometry_box INT,
						PRIMARY KEY(Category)
);

INSERT INTO Gift VALUES('A','Nursery',2,1,1,0,0,0,0,0,0,0,0,0,0);
INSERT INTO Gift VALUES('B','Grade 1 2',3,2,1,3,0,0,0,0,4,0,0,0,0);														
INSERT INTO Gift VALUES('C','Grade 3 4',0,2,1,3,3,0,0,0,4,0,0,0,0);
INSERT INTO Gift VALUES('D','Grade 5',0,0,1,3,3,0,0,0,4,1,1,3,0);
INSERT INTO Gift VALUES('E','Grade 6 7 8',0,0,0,3,4,0,2,2,3,1,1,4,1);
INSERT INTO Gift VALUES('F','Grade 9 10 11',0,0,0,2,2,2,2,2,3,1,1,5,1);
INSERT INTO Gift VALUES('G','Grade 12 13',3,2,1,3,0,2,2,3,4,1,1,5,0);

--------------------------------------------------------------------------------------------------------------------------

/////////////////////////////////////////////////////////////////////////////////////////////////////////////