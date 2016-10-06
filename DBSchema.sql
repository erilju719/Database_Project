CREATE TABLE account (
email VARCHAR(128) PRIMARY KEY,
name VARCHAR(128) NOT NULL,
address VARCHAR(128) NOT NULL,
password VARCHAR(32) NOT NULL,
admin BOOLEAN DEFAULT 'false'
);

CREATE TABLE item (
id SERIAL PRIMARY KEY,
name VARCHAR(256) NOT NULL,
location VARCHAR(512) NOT NULL,
description VARCHAR(1024) DEFAULT NULL,
condition VARCHAR(32) DEFAULT 'Good' CHECK(condition = 'Excellent'  OR condition= 'Good' OR condition='Poor' ) ,
availability BOOLEAN DEFAULT TRUE,
owner VARCHAR(128) REFERENCES account(email)
);

CREATE TABLE bid (
num SERIAL,
status VARCHAR(8) DEFAULT 'Pending' CHECK (status = 'Accepted' OR status = 'Pending' OR status = 'Declined'),
rate NUMERIC CHECK (rate >= 0),
startDate DATE NOT NULL,
endDate DATE NOT NULL,
item_id SERIAL REFERENCES item(id),
bidder_email VARCHAR(128) REFERENCES account(email),
PRIMARY KEY(num, item_id, bidder_email),
CHECK (endDate > startDate)
);