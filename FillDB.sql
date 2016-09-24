INSERT INTO account VALUES ('derp12@gmail.com', 'Nils Abraham', 'Never Street 52', 'zxc'); 
INSERT INTO account VALUES ('erik@gmail.com', 'Erik Ljung', 'Nonexsist Street 52', 'asdf'); 
INSERT INTO account VALUES ('ilikeme@gmail.com', 'Anna Marten', 'Pewdi Street 52', 'qwert'); 
INSERT INTO account VALUES ('alfredo@gmail.com', 'John Lidquist', 'Trollol Street 52', 'abc'); 
INSERT INTO account VALUES ('weirdo@gmail.com', 'Erro Olofson', 'Whaddup Street 52', 'weirdo');
INSERT INTO account VALUES ('dish@hotmail.com', 'Brandybuck Cheese', 'Kun Street 42', 'zxcv');
INSERT INTO account VALUES ('vegemite@gmail.com', 'Rinkydink Vegemite', 'LOL Street 20', 'veggie');
INSERT INTO account VALUES ('barn@gmail.com', 'Barnoldswick Crumplehorn', 'LOL Street 21', 'barn');
INSERT INTO account VALUES ('bomb@gmail.com', 'Bombadil Cottagecheese', 'YOLO Street 25', 'bomb');
INSERT INTO account VALUES ('blender@yahoo.com', 'Blenderdick Crackersprout', 'LOL Street 20', 'blend');




INSERT INTO item(name, location, condition, availability, owner) VALUES ('Water Bottle', 'Singapore', 'Good', 'TRUE', 'derp12@gmail.com');
INSERT INTO item(name, location, condition, availability, owner) VALUES ('Table', 'Singapore', 'Good', 'TRUE', 'derp12@gmail.com');
INSERT INTO item(name, location, condition, availability, owner) VALUES ('Girlfriend 1', 'Singapore', 'Excellent', 'TRUE', 'derp12@gmail.com');
INSERT INTO item(name, location, condition, availability, owner) VALUES ('Donkey', 'Singapore', 'Excellent', 'TRUE', 'erik@gmail.com');
INSERT INTO item(name, location, condition, availability, owner) VALUES ('Mug', 'Singapore', 'Excellent', 'TRUE', 'erik@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('Water Bottle', 'Singapore', 'dish@hotmail.com'); /*Example of excluding cols with default values */ 
INSERT INTO item(name, location, owner) VALUES ('Soap', 'Singapore', 'vegemite@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('Mum', 'Singapore', 'vegemite@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('HP Envy Laptop', 'Singapore', 'vegemite@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('Lawnmower', 'Singapore', 'derp12@gmail.com');
INSERT INTO item(name, location, condition, owner) VALUES ('Girlfriend 2', 'Singapore', 'Poor', 'derp12@gmail.com');
INSERT INTO item(name, location, condition, owner) VALUES ('Lawnmower', 'Singapore', 'Excellent','ilikeme@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('Girlfriend', 'Singapore', 'ilikeme@gmail.com');
INSERT INTO item(name, location, condition, owner) VALUES ('Girlfriend', 'Singapore', 'Excellent', 'alfredo@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('Girlfriend', 'Singapore', 'weirdo@gmail.com');
INSERT INTO item(name, location, condition, owner) VALUES ('Girlfriend', 'Singapore', 'Poor', 'dish@hotmail.com');
INSERT INTO item(name, location, owner) VALUES ('Girlfriend', 'Singapore', 'vegemite@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('Girlfriend', 'Singapore', 'barn@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('Girlfriend', 'Singapore', 'bomb@gmail.com');
INSERT INTO item(name, location, owner) VALUES ('Girlfriend', 'Singapore', 'blender@yahoo.com');

INSERT INTO bid VALUES('Pending', 50, 2, 3, 'erik@gmail.com');
INSERT INTO bid VALUES('Pending', 55, 2, 3, 'alfredo@gmail.com');
INSERT INTO bid VALUES('Pending', 25, 3, 1, 'alfredo@gmail.com');
INSERT INTO bid VALUES('Pending', 25, 3, 4, 'derp12@gmail.com');
INSERT INTO bid VALUES('Pending', 25, 3, 5, 'derp12@gmail.com');