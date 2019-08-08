CREATE DATABASE notes_db;

CREATE TABLE notes_tb {
    title varchar(40) NOT NULL,
    note varchar(100) NOT NULL,
    author varchar(40) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    PRIMARY KEY (title)
};

