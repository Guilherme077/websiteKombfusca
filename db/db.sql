CREATE DATABASE kombfusca_db;
USE kombfusca_db;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    birthDate DATE,
    role ENUM('admin', 'player') NOT NULL DEFAULT 'player'
);

CREATE TABLE cups (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    year YEAR NOT NULL,
    startDate DATETIME NOT NULL,
    endDate DATETIME NOT NULL,
    subscriptionFee DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    place VARCHAR(100),
    resultsAvailable BOOLEAN NOT NULL DEFAULT false,
    subscriptionStartDate DATETIME,
    subscriptionEndDate DATETIME,
    CHECK (startDate < endDate),
    CHECK (subscriptionStartDate <= subscriptionEndDate)
);

CREATE TABLE subscription (
    idUser INT NOT NULL,
    idCup INT NOT NULL,
    teamName VARCHAR(100),
    status ENUM('ok', 'pendingPayment', 'cancelled') NOT NULL DEFAULT 'pendingPayment',
    PRIMARY KEY (idUser, idCup),
    FOREIGN KEY (idUser) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (idCup) REFERENCES cups(id) ON DELETE CASCADE
);

CREATE TABLE scores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idPlayer INT NOT NULL, 
    idCup INT NOT NULL, 
    idUser INT NOT NULL, 
    number INT,
    kombi INT NOT NULL DEFAULT 0,
    fusca INT NOT NULL DEFAULT 0,
    newBeetle INT NOT NULL DEFAULT 0,
    countingType ENUM('auto', 'semiAuto', 'manual') NOT NULL,
    startTime DATETIME,
    endTime DATETIME,
    FOREIGN KEY (idPlayer) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (idCup) REFERENCES cups(id) ON DELETE CASCADE,
    FOREIGN KEY (idUser) REFERENCES users(id) ON DELETE RESTRICT,
    CHECK (startTime <= endTime)
);

CREATE TABLE supportMessages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idSender INT NOT NULL, 
    idReceiver INT NOT NULL, 
    content TEXT NOT NULL,
    sentAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idSender) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (idReceiver) REFERENCES users(id) ON DELETE CASCADE,
    CHECK (idSender <> idReceiver)
);