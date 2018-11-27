use db_60186160;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS Store;
DROP TABLE IF EXISTS PaymentMethod;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS InOrder;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Stock;
DROP TABLE IF EXISTS Shipment;
DROP TABLE IF EXISTS CommentsOn;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE Store (
    storeID int  AUTO_INCREMENT,
    storeName VARCHAR(40),
    street VARCHAR(20),
    city VARCHAR(20),
    province VARCHAR(20),
    country VARCHAR(20),
    PRIMARY KEY (storeID)
);

CREATE TABLE Shipment (
    trackingNumber int  AUTO_INCREMENT,
    method VARCHAR(20)   NOT NULL,
    status VARCHAR(200),
    shipDate DATE   NOT NULL,
    firstName VARCHAR(20)   NOT NULL,
    lastName VARCHAR(20)   NOT NULL,
    country VARCHAR(20)   NOT NULL,
    province VARCHAR(20)   NOT NULL,
    city VARCHAR(20)   NOT NULL,
    street VARCHAR(20)   NOT NULL,
    postalCode CHAR(7)   NOT NULL,
    email VARCHAR(40)   NOT NULL,
    PRIMARY KEY (trackingNumber)
);

CREATE TABLE User (
    userID int   AUTO_INCREMENT,
    username VARCHAR(30)   NOT NULL,
    password VARCHAR(20)   NOT NULL,
    firstName VARCHAR(20)   NOT NULL,
    lastName VARCHAR(20)   NOT NULL,
    email VARCHAR(40)   NOT NULL,
    image blob,
    status boolean DEFAULT TRUE,
    PRIMARY KEY (userID)
);

CREATE TABLE PaymentMethod (
    method VARCHAR(20)   NOT NULL,
    nameOnCard VARCHAR(40)   NOT NULL,
    cardNumber int   NOT NULL,
    expirationDate int   NOT NULL,
    csv int   NOT NULL,
    userID int NOT NULL,
    PRIMARY KEY (cardNumber),
    FOREIGN KEY (userID) REFERENCES
    User(userID)
);
/*Add user id instead of cardNnumber*/

CREATE TABLE Customer (
    userID int,
    PRIMARY KEY (userID)
);

CREATE TABLE Product (
    pID int   AUTO_INCREMENT,
    pName VARCHAR(40),
    description VARCHAR(500),
    price DECIMAL(9,2)   NOT NULL,
    category VARCHAR(20),
    image blob,
    PRIMARY KEY (pID)
);


CREATE TABLE Reviews(
    userID int,
    pID int,
    comment VARCHAR(500)   NOT NULL,
    PRIMARY KEY (userID, pID),
    FOREIGN KEY (userID) REFERENCES
    Customer (userID),
    FOREIGN KEY (pID) REFERENCES Product
    (pID)
);

CREATE TABLE Orders (
    orderID int   AUTO_INCREMENT,
    totalPrice DECIMAL(9,2)   NOT NULL,
    trackingNumber int,
    userID int,
    storeID int,
    PRIMARY KEY (orderID),
    FOREIGN KEY (trackingNumber)
    REFERENCES Shipment (trackingNumber),
    FOREIGN KEY (userID) REFERENCES User
    (userID),
    FOREIGN KEY (storeID) REFERENCES Store
    (storeID)
);

CREATE TABLE InOrder (
    orderID int,
    pID int,
    quantity int   NOT NULL,
    PRIMARY KEY (orderID, pID),
    FOREIGN KEY (orderID) REFERENCES Orders
    (orderID),
    FOREIGN KEY (pID) REFERENCES Product
    (pID)
);


CREATE TABLE Admin (
    userID int,
    title VARCHAR(30)   NOT NULL,
    PRIMARY KEY (userID),
    FOREIGN KEY (userID) REFERENCES User
    (userID)
);

CREATE TABLE CommentsOn (
    userID int,
    pID int,
    comment VARCHAR(500)   NOT NULL,
    PRIMARY KEY (userID, pID),
    FOREIGN KEY (userID) REFERENCES Customer
    (userID),
    FOREIGN KEY (pID) REFERENCES Product
    (pID)
);

CREATE TABLE Stock (
    pID int,
    storeID int,
    quantity int   NOT NULL,
    PRIMARY KEY ( pID, storeID),
    FOREIGN KEY (pID) REFERENCES Product
    (pID),
    FOREIGN KEY (storeID) REFERENCES Store
    (storeID)
);

/*Create Store*/
INSERT INTO Store VALUES (DEFAULT,'Vancouver Super(natural) Store', '1015 Burrad Street', 'Vancouver', 'British Columbia', 'Canada');

/*Create Users*/
INSERT INTO User VALUES (DEFAULT, 'Admin', MD5('Password1'), 'Courtney', 'Gosselin', 'courtneygosselin@gmail.com',NULL,DEFAULT);
INSERT INTO User VALUES (DEFAULT, 'Customer', MD5('Password1'), 'Bob', 'Builder', 'bobbuilder@hotmail.com',NULL,DEFAULT);

/*Create Admin*/
INSERT INTO Admin VALUES (1,'Junior Dev');

/*Create Customer*/
INSERT INTO Customer VALUES (2);

/*Add Products*/

/*Add Vampires*/
INSERT INTO Product VALUES (DEFAULT, 'Average Male Vampire', 'Empty', 0.99, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Average Female Vampire', 'Empty', 0.99, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Premium Male Vampire', 'Empty', 50.99, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Premium Female Vampire', 'Empty', 50.99, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Dracula', 'Empty', 1000.00, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Edward Collin', 'Empty', 0.50, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Stefan Salcatore', 'Empty', 200.00, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Gordan Walker', 'Empty', 500.00, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Barnabus', 'Empty', 500.00, 'Vampire');
INSERT INTO Product VALUES (DEFAULT, 'Darren Shan', 'Empty', 500.00, 'Vampire');

/*Add Shifters*/
INSERT INTO Product VALUES (DEFAULT, 'Average Male Shifter', 'Empty', 0.99, 'Shifter');
INSERT INTO Product VALUES (DEFAULT, 'Average Female Shifter', 'Empty', 0.99, 'Shifter');
INSERT INTO Product VALUES (DEFAULT, 'Premium Male Shifter', 'Empty', 0.99, 'Shifter');
INSERT INTO Product VALUES (DEFAULT, 'Premium female Shifter', 'Empty', 0.99, 'Shifter');

/*Add Ghosts*/
INSERT INTO Product VALUES (DEFAULT, 'Average Male Ghost', 'Empty', 0.99, 'Ghost');
INSERT INTO Product VALUES (DEFAULT, 'Average Female Ghost', 'Empty', 0.99, 'Ghost');
INSERT INTO Product VALUES (DEFAULT, 'Premium Male Ghost', 'Empty', 0.99, 'Ghost');
INSERT INTO Product VALUES (DEFAULT, 'Premium Female Ghost', 'Empty', 0.99, 'Ghost');
INSERT INTO Product VALUES (DEFAULT, 'Casper', 'Empty', 5000.00, 'Ghost');
INSERT INTO Product VALUES (DEFAULT, 'Beetle Juice', 'Empty', 500.99, 'Ghost');
INSERT INTO Product VALUES (DEFAULT, 'Bloody Mary', 'Empty', 500.99, 'Ghost');
INSERT INTO Product VALUES (DEFAULT, 'Slimer', 'Empty', 500.99, 'Ghost');
INSERT INTO Product VALUES (DEFAULT, 'Women in White', 'Empty', 500.99, 'Ghost');

/*Add Werewolves*/
INSERT INTO Product VALUES (DEFAULT, 'Average Female Werewolf', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Average Male Werewolf', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Premium Female Werewolf', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Premium Male Werewolf', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Alpha Werewolf', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Garth Fitzgerald IV', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Scott McCall', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Derek Hale', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Dragluin', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Lucian Greymark', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Fenrir Greyback', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Remus Lupin', 'Empty', 500.99, 'Werewolf');
INSERT INTO Product VALUES (DEFAULT, 'Grubbs Grady', 'Empty', 500.99, 'Werewolf');

/*Angels*/
INSERT INTO Product VALUES (DEFAULT, 'Lucifer', 'Empty', 500.99, 'Angel');
INSERT INTO Product VALUES (DEFAULT, 'Micheal', 'Empty', 500.99, 'Angel');
INSERT INTO Product VALUES (DEFAULT, 'Castiel', 'Empty', 500.99, 'Angel');
INSERT INTO Product VALUES (DEFAULT, 'Raphael', 'Empty', 500.99, 'Angel');
INSERT INTO Product VALUES (DEFAULT, 'Gabriel', 'Empty', 500.99, 'Angel');
INSERT INTO Product VALUES (DEFAULT, 'Metatron', 'Empty', 500.99, 'Angel');
INSERT INTO Product VALUES (DEFAULT, 'Naomi', 'Empty', 500.99, 'Angel');
INSERT INTO Product VALUES (DEFAULT, 'Balthazar', 'Empty', 500.99, 'Angel');

/*Deity*/
INSERT INTO Product VALUES (DEFAULT, 'Zeus', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'God', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Amara', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Isis', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Osiris', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Artemis', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Atropos', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Dionysius', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Kali', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Loki', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Odin', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Mercury', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Vesta', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Veritas', 'Empty', 500.99, 'Deity');
INSERT INTO Product VALUES (DEFAULT, 'Eve', 'Empty', 500.99, 'Deity');

/*Gear*/
INSERT INTO Product VALUES (DEFAULT, 'Silver Bullets Caliber .45', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Silver Bullets Caliber .22', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Silver Bullets Caliber .380', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Silver Bullets Caliber 9mm', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Silver Bullets Caliber .50', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Silver Bullets Caliber 12GA', 'Empty', 500.99, 'Gear');

INSERT INTO Product VALUES (DEFAULT, 'Holly Water Blessed by Pope John Paul the second', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Holly Water Blessed by Martin Luther', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Holly Water Blessed by Average Male', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Holly Water Blessed by Average Female', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Holly Water Blessed by Pope Benedict XVI', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Holly Water Blessed by Jim Murphy', 'Empty', 500.99, 'Gear');

INSERT INTO Product VALUES (DEFAULT, 'Salt Bullets Caliber .45', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Salt Bullets Caliber .22', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Salt ullets Caliber .380', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Salt Bullets Caliber 9mm', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Salt Bullets Caliber .50', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Salt Bullets Caliber 12GA', 'Empty', 500.99, 'Gear');

INSERT INTO Product VALUES (DEFAULT, 'Wooden Stake', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Hot Garlic', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Blessed Rossary', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Angel Blade', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Angel Sword', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Hunter Journal', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Book of the Damned', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'The Colt', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'The First Blade', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Death Scythe', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Flame Thrower', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Demon-Killing knife', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Lambs Blood', 'Empty', 500.99, 'Gear');

/*famous*/
INSERT INTO Product VALUES (DEFAULT, 'Horn of Gabreil', 'Empty', 500.99, 'Gear');
INSERT INTO Product VALUES (DEFAULT, 'Hand of God', 'Empty', 500.99, 'Gear');

/*Stock*/
INSERT INTO Stock VALUES (0, 1, 10);
INSERT INTO Stock VALUES (1, 1, 10);
INSERT INTO Stock VALUES (2, 1, 10);
INSERT INTO Stock VALUES (3, 1, 10);
INSERT INTO Stock VALUES (4, 1, 10);
INSERT INTO Stock VALUES (5, 1, 1);
INSERT INTO Stock VALUES (6, 1, 1);
INSERT INTO Stock VALUES (7, 1, 1);
INSERT INTO Stock VALUES (8, 1, 1);
INSERT INTO Stock VALUES (9, 1, 1);
INSERT INTO Stock VALUES (10, 1, 1);
INSERT INTO Stock VALUES (11, 1, 10);
INSERT INTO Stock VALUES (12, 1, 10);
INSERT INTO Stock VALUES (13, 1, 10);
INSERT INTO Stock VALUES (14, 1, 10);
INSERT INTO Stock VALUES (15, 1, 10);
INSERT INTO Stock VALUES (16, 1, 10);
INSERT INTO Stock VALUES (17, 1, 10);
INSERT INTO Stock VALUES (18, 1, 10);
INSERT INTO Stock VALUES (19, 1, 1);
INSERT INTO Stock VALUES (20, 1, 1);
INSERT INTO Stock VALUES (21, 1, 1);
INSERT INTO Stock VALUES (22, 1, 1);
INSERT INTO Stock VALUES (23, 1, 1);
INSERT INTO Stock VALUES (24, 1, 10);
INSERT INTO Stock VALUES (25, 1, 10);
INSERT INTO Stock VALUES (26, 1, 10);
INSERT INTO Stock VALUES (27, 1, 10);

INSERT INTO Stock VALUES (28, 1, 1);
INSERT INTO Stock VALUES (29, 1, 1);
INSERT INTO Stock VALUES (30, 1, 1);
INSERT INTO Stock VALUES (31, 1, 1);
INSERT INTO Stock VALUES (32, 1, 1);
INSERT INTO Stock VALUES (33, 1, 1);
INSERT INTO Stock VALUES (34, 1, 1);
INSERT INTO Stock VALUES (35, 1, 1);
INSERT INTO Stock VALUES (36, 1, 1);
INSERT INTO Stock VALUES (37, 1, 1);
INSERT INTO Stock VALUES (38, 1, 1);
INSERT INTO Stock VALUES (39, 1, 1);
INSERT INTO Stock VALUES (40, 1, 1);
INSERT INTO Stock VALUES (41, 1, 1);
INSERT INTO Stock VALUES (42, 1, 1);
INSERT INTO Stock VALUES (43, 1, 1);
INSERT INTO Stock VALUES (44, 1, 1);
INSERT INTO Stock VALUES (45, 1, 1);
INSERT INTO Stock VALUES (46, 1, 1);
INSERT INTO Stock VALUES (47, 1, 1);
INSERT INTO Stock VALUES (48, 1, 1);
INSERT INTO Stock VALUES (49, 1, 1);
INSERT INTO Stock VALUES (50, 1, 1);
INSERT INTO Stock VALUES (51, 1, 1);
INSERT INTO Stock VALUES (52, 1, 1);
INSERT INTO Stock VALUES (53, 1, 1);
INSERT INTO Stock VALUES (54, 1, 1);
INSERT INTO Stock VALUES (55, 1, 1);
INSERT INTO Stock VALUES (56, 1, 1);
INSERT INTO Stock VALUES (57, 1, 1);
INSERT INTO Stock VALUES (58, 1, 1);
INSERT INTO Stock VALUES (59, 1, 1);

INSERT INTO Stock VALUES (60, 1, 10);
INSERT INTO Stock VALUES (61, 1, 10);
INSERT INTO Stock VALUES (62, 1, 10);
INSERT INTO Stock VALUES (63, 1, 10);
INSERT INTO Stock VALUES (64, 1, 10);
INSERT INTO Stock VALUES (65, 1, 10);
INSERT INTO Stock VALUES (66, 1, 10);
INSERT INTO Stock VALUES (67, 1, 10);
INSERT INTO Stock VALUES (68, 1, 10);
INSERT INTO Stock VALUES (69, 1, 10);
INSERT INTO Stock VALUES (70, 1, 10);
INSERT INTO Stock VALUES (71, 1, 10);
INSERT INTO Stock VALUES (72, 1, 10);
INSERT INTO Stock VALUES (73, 1, 10);
INSERT INTO Stock VALUES (74, 1, 10);
INSERT INTO Stock VALUES (75, 1, 10);
INSERT INTO Stock VALUES (76, 1, 10);
INSERT INTO Stock VALUES (77, 1, 10);
INSERT INTO Stock VALUES (78, 1, 10);
INSERT INTO Stock VALUES (79, 1, 10);
INSERT INTO Stock VALUES (80, 1, 10);
INSERT INTO Stock VALUES (81, 1, 10);
INSERT INTO Stock VALUES (82, 1, 10);
INSERT INTO Stock VALUES (83, 1, 10);
INSERT INTO Stock VALUES (84, 1, 10);
INSERT INTO Stock VALUES (85, 1, 10);
INSERT INTO Stock VALUES (86, 1, 10);
INSERT INTO Stock VALUES (88, 1, 10);
INSERT INTO Stock VALUES (89, 1, 10);
INSERT INTO Stock VALUES (90, 1, 10);
INSERT INTO Stock VALUES (91, 1, 10);
INSERT INTO Stock VALUES (92, 1, 10);
