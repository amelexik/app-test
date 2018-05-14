-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Трв 14 2018 р., 20:39
-- Версія сервера: 5.7.21-0ubuntu0.16.04.1
-- Версія PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База даних: `test-app.local`
--

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rating` tinyint(4) NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '/',
  `text` varchar(1000) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`comment_id`, `pid`, `user`, `created`, `rating`, `url`, `text`) VALUES
(17, NULL, 1, '2018-05-14 15:27:06', 0, '/', 'fdsfdsf'),
(18, NULL, 1, '2018-05-14 15:27:12', 0, '/', 'fdsfdsf'),
(19, NULL, 1, '2018-05-14 15:30:15', 0, '/', 'Ð¾Ð»Ð¾Ð»Ð¾'),
(20, NULL, 1, '2018-05-14 15:30:20', 0, '/', 'Ð¾Ð»Ð¾Ð»Ð¾');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `status`) VALUES
(1, 'user', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
(2, 'blogger', '827ccb0eea8a706c4c34a16891f84e7b', 1);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `pid` (`pid`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_PARENT` FOREIGN KEY (`pid`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE;
