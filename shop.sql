-- creating schema for table `users`
CREATE TABLE IF NOT EXISTS `users` (
    `id` int(8) NOT NULL,
    `userName` varchar(255) CHARACTER SET utf8 NOT NULL,
    `userPassword` varchar(64) NOT NULL
);

-- seeding a record to table `users`
INSERT INTO `users` (
    `id`,
    `userName`,
    `userPassword`)
    VALUES (
        1,
        'maged',
        '827ccb0eea8a706c4c34a16891f84e7b'
    );
