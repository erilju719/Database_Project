CREATE TABLE account (
email VARCHAR(128) PRIMARY KEY,
name VARCHAR(128) NOT NULL,
address VARCHAR(128) NOT NULL,
password VARCHAR(32) NOT NULL
);

CREATE TABLE item (
id SERIAL PRIMARY KEY,
name VARCHAR(256) NOT NULL,
location VARCHAR(512) NOT NULL,
condition VARCHAR(256) DEFAULT 'Good' CHECK(condition = 'Excellent'  OR condition= 'Good' OR condition='Poor' ) ,
availability BOOLEAN DEFAULT TRUE,
owner VARCHAR(128) REFERENCES account(email)
);

CREATE TABLE bid (
status VARCHAR(8) DEFAULT 'Pending' CHECK (status = 'Accepted' OR status = 'Pending' OR status = 'Declined'),
rate INT CHECK (rate >= 0),
duration TIME NOT NULL,
item_id SERIAL REFERENCES item(id),
bidder_email VARCHAR(128) REFERENCES account(email),
PRIMARY KEY(item_id, bidder_email)
);

INSERT INTO account VALUES ('derp12@gmail.com', 'Nils Abraham', 'Never Street 52', 'zxc'); 
INSERT INTO account VALUES ('erik@gmail.com', 'Erik Ljung', 'Nonexsist Street 52', 'asdf'); 
INSERT INTO account VALUES ('ilikeme@gmail.com', 'Anna Marten', 'Pewdi Street 52', 'qwert'); 
INSERT INTO account VALUES ('alfredo@gmail.com', 'John Lidquist', 'Trollol Street 52', 'abc'); 
INSERT INTO account VALUES ('weirdo@gmail.com', 'Erro Olofson', 'Whaddup Street 52', 'weirdo'); 

INSERT INTO item(name, location, condition, availability, owner) VALUES ('Water Bottle', 'Singapore', 'Good', 'TRUE', 'derp12@gmail.com');
INSERT INTO item(name, location, condition, availability, owner) VALUES ('Table', 'Singapore', 'Good', 'TRUE', 'derp12@gmail.com');
INSERT INTO item(name, location, condition, availability, owner) VALUES ('Girlfriend'', 'Singapore', 'Excellent', 'TRUE', 'derp12@gmail.com');
INSERT INTO item(name, location, condition, availability, owner) VALUES ('Donkey', 'Singapore', 'Excellent', 'TRUE', 'erik@gmail.com');
INSERT INTO item(name, location, condition, availability, owner) VALUES ('Mug', 'Singapore', 'Excellent', 'TRUE', 'erik@gmail.com');

INSERT INTO bid VALUES('Pending', 50, 2, 3, 'erik@gmail.com');
INSERT INTO bid VALUES('Pending', 55, 2, 3, 'alfredo@gmail.com');
INSERT INTO bid VALUES('Pending', 25, 3, 1, 'alfredo@gmail.com');
INSERT INTO bid VALUES('Pending', 25, 3, 4, 'derp12@gmail.com');
INSERT INTO bid VALUES('Pending', 25, 3, 5, 'derp12@gmail.com');
