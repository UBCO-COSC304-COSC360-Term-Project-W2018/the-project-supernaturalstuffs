CREATE TABLE Store (
    storeID INT   AUTO_INCREMENT,
    storeName VARCHAR(40),
    street VARCHAR(20),
    city VARCHAR(20),
    province VARCHAR(20),
    country VARCHAR(20),
    PRIMARY KEY (storeID)
);

CREATE TABLE Shipment (
    trackingNumber INT   AUTO_INCREMENT,
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

CREATE TABLE PaymentMethod (
    method VARCHAR(20)   NOT NULL,
    nameOnCard VARCHAR(40)   NOT NULL,
    cardNumber INT   NOT NULL,
    expirationDate INT   NOT NULL,
    csv INT   NOT NULL,
    PRIMARY KEY (cardNumber)
);

CREATE TABLE User (
    userID INT   AUTO_INCREMENT,
    username VARCHAR(30)   NOT NULL,
    password VARCHAR(20)   NOT NULL,
    firstName VARCHAR(20)   NOT NULL,
    lastName VARCHAR(20)   NOT NULL,
    email VARCHAR(40)   NOT NULL,
    cardNumber INT,
    PRIMARY KEY (userID),
    FOREIGN KEY (cardNumber) REFERENCES
    PaymentMethod(cardNumber)
);

CREATE TABLE Customer (
    userID INT,
    PRIMARY KEY (userID)
);     

CREATE TABLE Product (
    pID INT   AUTO_INCREMENT,
    pName VARCHAR(40),
    description VARCHAR(500),
    price DECIMAL(9,2)   NOT NULL,
    category VARCHAR(20),
    PRIMARY KEY (pID)
);


CREATE TABLE Reviews(
    userID INT,
    pID INT,
    comment VARCHAR(500)   NOT NULL,
    PRIMARY KEY (userID, pID),
    FOREIGN KEY (userID) REFERENCES
    Customer (userID),
    FOREIGN KEY (pID) REFERENCES Product
    (pID)
);

CREATE TABLE Orders (
    orderID INT   AUTO_INCREMENT,
    totalPrice DECIMAL(9,2)   NOT NULL,
    trackingNumber INT,
    userID INT,
    storeID INT,
    PRIMARY KEY (orderID),
    FOREIGN KEY (trackingNumber)
    REFERENCES Shipment (trackingNumber),
    FOREIGN KEY (userID) REFERENCES User
    (userID),
    FOREIGN KEY (storeID) REFERENCES Store
    (storeID)
);

CREATE TABLE InOrder (
    orderID INT,
    pID INT,
    quantity INT   NOT NULL,
    PRIMARY KEY (orderID, pID),
    FOREIGN KEY (orderID) REFERENCES Orders
    (orderID),
    FOREIGN KEY (pID) REFERENCES Product
    (pID)
);


CREATE TABLE Admin (
    userID INT,
    title VARCHAR(30)   NOT NULL,
    PRIMARY KEY (userID),
    FOREIGN KEY (userID) REFERENCES User
    (userID)           
);

CREATE TABLE CommentsOn (
    userID INT,
    pID INT,
    comment VARCHAR(500)   NOT NULL,
    PRIMARY KEY (userID, pID),
    FOREIGN KEY (userID) REFERENCES Customer
    (userID),
    FOREIGN KEY (pID) REFERENCES Product
    (pID)
);

CREATE TABLE Stock (
    pID INT,
    storeID INT,
    quantity INT   NOT NULL,
    PRIMARY KEY ( pID, storeID),
    FOREIGN KEY (pID) REFERENCES Product
    (pID),
    FOREIGN KEY (storeID) REFERENCES Store
    (storeID) 
);
