CREATE DATABASE notes_db;

CREATE TABLE notes_tb {
    title varchar(100) NOT NULL,
    note varchar(200) NOT NULL,
    author varchar(100) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    PRIMARY KEY (title)
};

