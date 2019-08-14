CREATE DATABASE IF NOT EXISTS notes_db;

CREATE TABLE IF NOT EXISTS notes_tb {
    title varchar(100) NOT NULL,
    note varchar(1000) NOT NULL,
    author varchar(100) NOT NULL,
    tijd TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    PRIMARY KEY (title)
};

