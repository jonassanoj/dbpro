SET NAMES utf8;

INSERT INTO `Answer` (`answerID`, `questionID`, `userID`, `body`, `rank`, `date`) VALUES
(1, 1, 3, 'Why don''t you autoload the library?\r\nIt should be available to your model then.', 0, '2012-06-05 00:00:00'),
(2, 2, 3, 'This can not be answered really objectively, since it depends on case by case.\r\n\r\nWith views, functions, triggers and stored procedures you can move part of the logic of your application into the database layer.\r\n\r\nThis can have several benefits:\r\n\r\nperformance -- you might avoid roundtrips of data, and certain treatment are handled more efficiently using the whole range of DBMS features.\r\nconsisness -- some treatment of data are expressed more easily with the DBMS features.\r\nBut also certain drawback:\r\n\r\nportability -- the more you rely on specific features of the DBMS, the less portable the application becomes.\r\n\r\nmaintenability -- the logic is scattered across two different technologies which implies more skills are needed for maintenance, and local reasoning is harder.\r\nIf you stick to the SQL92 standard it''s a good trade-off.\r\n', 0, '2012-06-03 00:00:00'),
(3, 2, 1, 'Personally I prefer views, especially for reports/apps as if there are any problems in the data you only have to update a single view rather than re-building the app or manually editing the queries.', 0, '2012-06-12 00:00:00'),
(4, 4, 5, 'بله من هم با نظر آقا وحید موافق هستم. منظور شما را در این جملات متوجه نشدم، لطفا یک بار دیگر توضیح دهید.\r\nولی به صورت کلی برای جلوگیری از تکرار و زیباتر شدم متن می توان فعل های یکسان را حذف کرد.مثلا\r\nمن به بازار رفتم و به خانه دوستم رفتم= من به بازار رفتم و به خانه دوستم\r\nیعنی در جمله بالا می توان کلمه "رفتم" را حذف کرد.\r\nاین قاعده در مورد اجزا فعل مجهول هم درست است.مثلا\r\nخانه تمیز شده(بود) پرده ها شسته شده (بود) و همه جا پاکیزه شده بود.\r\nیا این که\r\nخانه تمیز (شده بود)، پرده ها شسته(شده بود) و همه جا پاکیزه شده بود\r\nاگر شما کلمه های داخل پارانتز را حذف کنید هیچ مشکلی در فهم معنای جمله به وجود نمی آید.\r\nاما جمله شما ایراد دیگری هم دارد:در چنین جمله ای بهتر است از فعل های متفاوت استفاده شود تا متن زیباتر و گویاتر باشد', 0, '2012-06-10 00:00:00'),
(5, 2, 4, 'I have seen that views are used a lot to do two things:\r\n\r\nSimplify queries, if you have a HUGE select with multiple joins and joins and joins, you can create a view that will have the same performance but the query will be only a couple of lines.\r\nFor security reason, if you have a table with some information that shouldn''t be accessed for all the developers, you can create views and grant privileges to see the views and not the main table, I.E: table 1: Name, Last_name, User_ID, credit_card, social_security. You create a view table.table view: name, last_name, user_id .', 0, '2012-06-13 00:00:00');

INSERT INTO `Category` (`catID`, `fieldID`, `catName`) VALUES
(1, 1, 'PHP'),
(2, 2, 'SQL'),
(3, 3, 'Mesh network'),
(4, 4, 'e-Government');

INSERT INTO `Comment` (`commentID`, `answerID`, `questionID`, `userID`, `body`, `date`) VALUES
(1, NULL, 1, 1, 'it is good question but if you clearfy bet more what php means ', '2012-06-05 00:00:00'),
(2, NULL, 1, 4, 'hi this is not relevent question to this feild ', NULL);

INSERT INTO `Field` (`fieldID`, `fieldName`) VALUES
(1, 'Software Engineering'),
(2, 'Datatbase Management System'),
(3, 'Network'),
(4, 'Computer and Sociaty');

INSERT INTO `Question` (`questionID`, `catID`, `userID`, `title`, `body`, `rank`, `date`) VALUES
(1, 1, 1, 'Accessing Library from a Model in CI', 'I''m trying to access a authentication library in a User model in CodeIgniter. The problem is that if I use $this I get the accessing method on non-object error.\r\n\r\nI tried getting an instance of CI using get_instance and using the $CI object to access the library but still no luck.\r\n\r\nThe solutions where you load the library in the constructor of the model and assign the library also didn''t work.\r\n\r\nSo basically:\r\n\r\nLibrary: SimpleLoginSecure (in /libraries/) Model: User model (in /models/) Controller: Getting the html form input and passing it to the model.', 0, '2012-06-04 00:00:00'),
(2, 2, 2, 'Are views in MySQL worth it?', 'I am building a new web applications with data stored in the database. as many web applications, I need to expose data from complexe sql queries (query with conditions from multiple table). I was wondering if it could be a good idea to build my queries in the database as sql view instead of building it in the application? I mean what would be the benefit of that ? database performance? do i will code longer? debug longer?', 0, '2012-06-03 00:00:00'),
(3, 2, 3, 'اچ ټی ام ال څه شی دی ', 'مهربانی وکی که د اچ تی امل په هکله څه معلومات راکی زه په دی څانګه کی نوی یم ', 0, '2012-06-06 00:00:00'),
(4, 1, 1, 'Farsi Question', 'شاید این جمله درست باشد؟ \r\nوقتی او امشب به خانه اش برگردد، شام دیگر پخته شده باشد، صفره چیده شده باشد، تکلیفش انجام داده شده باشد و کتابها و دفترهایش توی کیفش گذاشته شده باشد\r\nیا این صحیح است:\r\nوقتی او امشب به خانه اش برگردد، شام دیگر پخته شده است، صفره چیده شده است، تکلیفش انجام داده شده است و کتابها و دفترهایش توی کیفش گذاشته شده است', 0, '2012-06-12 00:00:00'),
(5, 1, 1, 'How are you doing today?', 'bla', 0, '2012-06-12 00:00:00'),
(6, 1, 1, 'How are you doing tomorrow?', 'bla', 0, '2012-06-12 00:00:00'),
(7, 1, 1, 'How are you doing?', 'bla', 0, '2012-06-12 00:00:00'),
(8, 1, 1, 'How are you doing today?', 'bla', 0, '2012-06-12 00:00:00'),
(9, 1, 1, 'How are you doing tomorrow?', 'bla', 0, '2012-06-12 00:00:00');

INSERT INTO `User` (`userID`, `userTypeID`, `fieldID`, `userName`, `fullName`, `email`, `password`, `imagePath`, `acountCreationDate`, `rank`, `lastLogin`, `organization`, `location`, `dateOfBirth`, `degree`, `detail`) VALUES
(1, 1, 3, 'SSameem', 'Saminullah Sameem ', 'SSameem@hotmail.com', '', NULL, '2012-06-06 00:00:00', 0, '2012-06-06 00:00:00', 'Khost University ', NULL, '0000-00-00', 'master', 'Saminullah is lecturer in khost university '),
(2, 1, 2, 'Ghezal_Ahmad', 'Ghezal Ahmadzai', 'Ghezal@yahoo.com', '', NULL, '2012-06-06 00:00:00', 0, '2012-06-06 00:00:00', 'Kabul University', NULL, '0000-00-00', 'master', 'Ghezal Ahmad zia is the profisional person in Database '),
(3, 2, 3, 'AAkbary', 'Abdul Aziz Akbary', 'Akbaty1@yahoo.com', '', NULL, '2012-06-05 00:00:00', 0, '2012-06-03 00:00:00', 'Khost University', NULL, '0000-00-00', 'master', NULL),
(4, 2, 4, 'AAlizai', 'Ashuqulllah Alizai', 'Alizai.csf@hotmail.com', '', NULL, '2012-06-06 00:00:00', 0, '2012-06-06 00:00:00', 'Herat University ', 'Farah', '0000-00-00', 'master', 'Alizai is teacher in herat University'),
(5, 1, 1, 'WAhmadZai', 'Wazir khan AhmadZai', 'WAhmadzai@yahoo.com', '', NULL, '2012-06-06 00:00:00', 0, '2012-06-06 00:00:00', 'Nangarhar University', 'Nangarhar', '0000-00-00', 'master', NULL);


