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
INSERT INTO Store VALUES (DEFAULT,'Toronto Super(natural) Store', '666 Church Street', 'Toronto', 'Ontario', 'Canada'); 
INSERT INTO Store VALUES (DEFAULT,'Kelowna Super(natural) Store', '2040 Harvey Ave', 'Kelowna', 'British Columbia', 'Canada');

/*Create Users*/
INSERT INTO User VALUES (DEFAULT, 'Admin', 'Password1', 'Courtney', 'Gosselin', 'courtneygosselin@gmail.com');
INSERT INTO User VALUES (DEFAULT, 'Customer', 'Password1', 'Bob', 'Builder', 'bobbuilder@hotmail.com');

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

INSERT INTO Stock VALUES (60, 2, 10);
INSERT INTO Stock VALUES (61, 2, 10);
INSERT INTO Stock VALUES (62, 2, 10);
INSERT INTO Stock VALUES (63, 2, 10);
INSERT INTO Stock VALUES (64, 2, 10);
INSERT INTO Stock VALUES (65, 2, 10);
INSERT INTO Stock VALUES (66, 2, 10);
INSERT INTO Stock VALUES (67, 2, 10);
INSERT INTO Stock VALUES (68, 2, 10);
INSERT INTO Stock VALUES (69, 2, 10);
INSERT INTO Stock VALUES (70, 2, 10);
INSERT INTO Stock VALUES (71, 2, 10);
INSERT INTO Stock VALUES (72, 2, 10);
INSERT INTO Stock VALUES (73, 2, 10);
INSERT INTO Stock VALUES (74, 2, 10);
INSERT INTO Stock VALUES (75, 2, 10);
INSERT INTO Stock VALUES (76, 2, 10);
INSERT INTO Stock VALUES (77, 2, 10);
INSERT INTO Stock VALUES (78, 2, 10);
INSERT INTO Stock VALUES (79, 2, 10);
INSERT INTO Stock VALUES (80, 2, 10);
INSERT INTO Stock VALUES (81, 2, 10);
INSERT INTO Stock VALUES (82, 2, 10);
INSERT INTO Stock VALUES (83, 2, 10);
INSERT INTO Stock VALUES (84, 2, 10);
INSERT INTO Stock VALUES (85, 2, 10);
INSERT INTO Stock VALUES (86, 2, 10);
INSERT INTO Stock VALUES (88, 2, 10);
INSERT INTO Stock VALUES (89, 2, 10);
INSERT INTO Stock VALUES (90, 2, 10);
INSERT INTO Stock VALUES (91, 2, 10);
INSERT INTO Stock VALUES (92, 2, 10);

INSERT INTO Stock VALUES (60, 3, 10);
INSERT INTO Stock VALUES (61, 3, 10);
INSERT INTO Stock VALUES (62, 3, 10);
INSERT INTO Stock VALUES (63, 3, 10);
INSERT INTO Stock VALUES (64, 3, 10);
INSERT INTO Stock VALUES (65, 3, 10);
INSERT INTO Stock VALUES (66, 3, 10);
INSERT INTO Stock VALUES (67, 3, 10);
INSERT INTO Stock VALUES (68, 3, 10);
INSERT INTO Stock VALUES (69, 3, 10);
INSERT INTO Stock VALUES (70, 3, 10);
INSERT INTO Stock VALUES (71, 3, 10);
INSERT INTO Stock VALUES (72, 3, 10);
INSERT INTO Stock VALUES (73, 3, 10);
INSERT INTO Stock VALUES (74, 3, 10);
INSERT INTO Stock VALUES (75, 3, 10);
INSERT INTO Stock VALUES (76, 3, 10);
INSERT INTO Stock VALUES (77, 3, 10);
INSERT INTO Stock VALUES (78, 3, 10);
INSERT INTO Stock VALUES (79, 3, 10);
INSERT INTO Stock VALUES (80, 3, 10);
INSERT INTO Stock VALUES (81, 3, 10);
INSERT INTO Stock VALUES (82, 3, 10);
INSERT INTO Stock VALUES (83, 3, 10);
INSERT INTO Stock VALUES (84, 3, 10);
INSERT INTO Stock VALUES (85, 3, 10);
INSERT INTO Stock VALUES (86, 3, 10);
INSERT INTO Stock VALUES (88, 3, 10);
INSERT INTO Stock VALUES (89, 3, 10);
INSERT INTO Stock VALUES (90, 3, 10);
INSERT INTO Stock VALUES (91, 3, 10);
INSERT INTO Stock VALUES (92, 3, 10);0.