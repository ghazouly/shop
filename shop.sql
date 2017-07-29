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
        '827CCB0EEA8A706C4C34A16891F84E7B'
    );
