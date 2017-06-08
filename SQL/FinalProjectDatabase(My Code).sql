

CREATE TABLE Users (
	userID int(10) NOT NULL AUTO_INCREMENT,
	firstName varchar(25) NOT NULL,
	lastName varchar(25) NOT NULL,
	email varchar(30) NOT NULL,
	password varchar(25) NOT NULL,
	phone varchar(11),
	username varchar(25) NOT NULL,
	PRIMARY KEY(userID)
);

CREATE TABLE Topics (
	topicID int(10) NOT NULL AUTO_INCREMENT,
	title varchar(25) NOT NULL,
	PRIMARY KEY(topicID)
);

CREATE TABLE Tickets (
	ticketID int(10) NOT NULL AUTO_INCREMENT,
	userID int(10) NOT NULL,
	topicID int(10) NOT NULL,
	message varchar(250) NOT NULL,
	PRIMARY KEY(ticketID),
	FOREIGN KEY (userID) REFERENCES Users(userID),
	FOREIGN KEY (topicID) REFERENCES Topics(topicID)
);

CREATE TABLE Comments (
	commentID int(10) NOT NULL AUTO_INCREMENT,
	userID int(10) NOT NULL,
	ticketID int(10) NOT NULL,
	message varchar(250) NOT NULL,
	PRIMARY KEY(commentID),
	FOREIGN KEY (userID) REFERENCES Users(userID),
	FOREIGN KEY (ticketID) REFERENCES Tickets(ticketID)
);



--Manual Topic Population
INSERT INTO topics (title) VALUES ('Software');
INSERT INTO topics (title) VALUES ('General');
INSERT INTO topics (title) VALUES ('Hardware');



