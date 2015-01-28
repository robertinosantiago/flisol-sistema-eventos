-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 28-Jan-2015 às 12:59
-- Versão do servidor: 5.5.41-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_articles`
--

CREATE TABLE IF NOT EXISTS `fli_articles` (
`id` int(11) NOT NULL,
  `short_title` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `home` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_coordinators`
--

CREATE TABLE IF NOT EXISTS `fli_coordinators` (
`id` int(11) NOT NULL,
  `edition_id` int(11) NOT NULL,
  `file_certificate` varchar(255) DEFAULT NULL,
  `fullname_position` int(11) DEFAULT NULL,
  `has_back` tinyint(1) DEFAULT NULL,
  `back_content` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_coordinator_users`
--

CREATE TABLE IF NOT EXISTS `fli_coordinator_users` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coordinator_id` int(11) NOT NULL,
  `hash_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_courses`
--

CREATE TABLE IF NOT EXISTS `fli_courses` (
`id` int(11) NOT NULL,
  `edition_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `maximum_of_students` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_editions`
--

CREATE TABLE IF NOT EXISTS `fli_editions` (
`id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `registration_begin` date NOT NULL,
  `registration_end` date NOT NULL,
  `date_of` date NOT NULL,
  `show_certificate` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_listeners`
--

CREATE TABLE IF NOT EXISTS `fli_listeners` (
`id` int(11) NOT NULL,
  `edition_id` int(11) NOT NULL,
  `file_certificate` varchar(255) DEFAULT NULL,
  `fullname_position` int(11) DEFAULT NULL,
  `has_back` tinyint(1) DEFAULT NULL,
  `back_content` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_listener_users`
--

CREATE TABLE IF NOT EXISTS `fli_listener_users` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `listener_id` int(11) NOT NULL,
  `attended` tinyint(1) NOT NULL DEFAULT '0',
  `hash_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_menus`
--

CREATE TABLE IF NOT EXISTS `fli_menus` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('menu','article','url') NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `article_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_presenters`
--

CREATE TABLE IF NOT EXISTS `fli_presenters` (
`id` int(11) NOT NULL,
  `edition_id` int(11) NOT NULL,
  `file_certificate` varchar(255) DEFAULT NULL,
  `fullname_position` int(11) DEFAULT NULL,
  `title_position` int(11) DEFAULT NULL,
  `has_back` tinyint(1) DEFAULT NULL,
  `back_content` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_presenter_users`
--

CREATE TABLE IF NOT EXISTS `fli_presenter_users` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `presenter_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `hash_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_students`
--

CREATE TABLE IF NOT EXISTS `fli_students` (
`id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `file_certificate` varchar(255) DEFAULT NULL,
  `fullname_position` int(11) DEFAULT NULL,
  `has_back` tinyint(1) DEFAULT NULL,
  `back_content` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_student_users`
--

CREATE TABLE IF NOT EXISTS `fli_student_users` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hash_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_teachers`
--

CREATE TABLE IF NOT EXISTS `fli_teachers` (
`id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `file_certificate` varchar(255) DEFAULT NULL,
  `fullname_position` int(11) DEFAULT NULL,
  `title_position` int(11) DEFAULT NULL,
  `has_back` tinyint(1) DEFAULT NULL,
  `back_content` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_teacher_users`
--

CREATE TABLE IF NOT EXISTS `fli_teacher_users` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `hash_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fli_users`
--

CREATE TABLE IF NOT EXISTS `fli_users` (
`id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `document` varchar(45) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `hash_code_verified` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fli_articles`
--
ALTER TABLE `fli_articles`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_eve_articles_eve_users1_idx` (`user_id`);

--
-- Indexes for table `fli_coordinators`
--
ALTER TABLE `fli_coordinators`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_eve_coordinators_eve_events1_idx` (`edition_id`);

--
-- Indexes for table `fli_coordinator_users`
--
ALTER TABLE `fli_coordinator_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_coordinator_user` (`user_id`,`coordinator_id`), ADD UNIQUE KEY `unique_hash_code_coordinator` (`hash_code`), ADD KEY `fk_eve_coordinator_users_eve_users1_idx` (`user_id`), ADD KEY `fk_eve_coordinator_users_eve_coordinators1_idx` (`coordinator_id`);

--
-- Indexes for table `fli_courses`
--
ALTER TABLE `fli_courses`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_fli_courses_fli_editions1_idx` (`edition_id`);

--
-- Indexes for table `fli_editions`
--
ALTER TABLE `fli_editions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fli_listeners`
--
ALTER TABLE `fli_listeners`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_eve_listeners_eve_events1_idx` (`edition_id`);

--
-- Indexes for table `fli_listener_users`
--
ALTER TABLE `fli_listener_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_listener_user` (`user_id`,`listener_id`), ADD UNIQUE KEY `unique_hash_code_listener` (`hash_code`), ADD KEY `fk_eve_listener_users_eve_users1_idx` (`user_id`), ADD KEY `fk_eve_listener_users_eve_listeners1_idx` (`listener_id`);

--
-- Indexes for table `fli_menus`
--
ALTER TABLE `fli_menus`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_eve_menus_eve_articles_idx` (`article_id`);

--
-- Indexes for table `fli_presenters`
--
ALTER TABLE `fli_presenters`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_eve_presenters_eve_events1_idx` (`edition_id`);

--
-- Indexes for table `fli_presenter_users`
--
ALTER TABLE `fli_presenter_users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_presenter_user` (`user_id`,`presenter_id`), ADD UNIQUE KEY `unique_hash_code_presenter` (`hash_code`), ADD KEY `fk_eve_presenter_users_eve_users1_idx` (`user_id`), ADD KEY `fk_eve_presenter_users_eve_presenters1_idx` (`presenter_id`);

--
-- Indexes for table `fli_students`
--
ALTER TABLE `fli_students`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_fli_students_fli_courses1_idx` (`course_id`);

--
-- Indexes for table `fli_student_users`
--
ALTER TABLE `fli_student_users`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_fli_student_users_fli_users1_idx` (`user_id`), ADD KEY `fk_fli_student_users_fli_students1_idx` (`student_id`);

--
-- Indexes for table `fli_teachers`
--
ALTER TABLE `fli_teachers`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_fli_teachers_fli_courses1_idx` (`course_id`);

--
-- Indexes for table `fli_teacher_users`
--
ALTER TABLE `fli_teacher_users`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_fli_teacher_users_fli_teachers1_idx` (`teacher_id`), ADD KEY `fk_fli_teacher_users_fli_users1_idx` (`user_id`);

--
-- Indexes for table `fli_users`
--
ALTER TABLE `fli_users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fli_articles`
--
ALTER TABLE `fli_articles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_coordinators`
--
ALTER TABLE `fli_coordinators`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_coordinator_users`
--
ALTER TABLE `fli_coordinator_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_courses`
--
ALTER TABLE `fli_courses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_editions`
--
ALTER TABLE `fli_editions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fli_listeners`
--
ALTER TABLE `fli_listeners`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_listener_users`
--
ALTER TABLE `fli_listener_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_menus`
--
ALTER TABLE `fli_menus`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_presenters`
--
ALTER TABLE `fli_presenters`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_presenter_users`
--
ALTER TABLE `fli_presenter_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_students`
--
ALTER TABLE `fli_students`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_student_users`
--
ALTER TABLE `fli_student_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_teachers`
--
ALTER TABLE `fli_teachers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_teacher_users`
--
ALTER TABLE `fli_teacher_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fli_users`
--
ALTER TABLE `fli_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `fli_articles`
--
ALTER TABLE `fli_articles`
ADD CONSTRAINT `fk_eve_articles_eve_users1` FOREIGN KEY (`user_id`) REFERENCES `fli_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_coordinators`
--
ALTER TABLE `fli_coordinators`
ADD CONSTRAINT `fk_eve_coordinators_eve_events1` FOREIGN KEY (`edition_id`) REFERENCES `fli_editions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_coordinator_users`
--
ALTER TABLE `fli_coordinator_users`
ADD CONSTRAINT `fk_eve_coordinator_users_eve_coordinators1` FOREIGN KEY (`coordinator_id`) REFERENCES `fli_coordinators` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_eve_coordinator_users_eve_users1` FOREIGN KEY (`user_id`) REFERENCES `fli_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_courses`
--
ALTER TABLE `fli_courses`
ADD CONSTRAINT `fk_fli_courses_fli_editions1` FOREIGN KEY (`edition_id`) REFERENCES `fli_editions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_listeners`
--
ALTER TABLE `fli_listeners`
ADD CONSTRAINT `fk_eve_listeners_eve_events1` FOREIGN KEY (`edition_id`) REFERENCES `fli_editions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_listener_users`
--
ALTER TABLE `fli_listener_users`
ADD CONSTRAINT `fk_eve_listener_users_eve_listeners1` FOREIGN KEY (`listener_id`) REFERENCES `fli_listeners` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_eve_listener_users_eve_users1` FOREIGN KEY (`user_id`) REFERENCES `fli_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_menus`
--
ALTER TABLE `fli_menus`
ADD CONSTRAINT `fk_eve_menus_eve_articles` FOREIGN KEY (`article_id`) REFERENCES `fli_articles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_presenters`
--
ALTER TABLE `fli_presenters`
ADD CONSTRAINT `fk_eve_presenters_eve_events1` FOREIGN KEY (`edition_id`) REFERENCES `fli_editions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_presenter_users`
--
ALTER TABLE `fli_presenter_users`
ADD CONSTRAINT `fk_eve_presenter_users_eve_presenters1` FOREIGN KEY (`presenter_id`) REFERENCES `fli_presenters` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_eve_presenter_users_eve_users1` FOREIGN KEY (`user_id`) REFERENCES `fli_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_students`
--
ALTER TABLE `fli_students`
ADD CONSTRAINT `fk_fli_students_fli_courses1` FOREIGN KEY (`course_id`) REFERENCES `fli_courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_student_users`
--
ALTER TABLE `fli_student_users`
ADD CONSTRAINT `fk_fli_student_users_fli_students1` FOREIGN KEY (`student_id`) REFERENCES `fli_students` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_fli_student_users_fli_users1` FOREIGN KEY (`user_id`) REFERENCES `fli_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_teachers`
--
ALTER TABLE `fli_teachers`
ADD CONSTRAINT `fk_fli_teachers_fli_courses1` FOREIGN KEY (`course_id`) REFERENCES `fli_courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `fli_teacher_users`
--
ALTER TABLE `fli_teacher_users`
ADD CONSTRAINT `fk_fli_teacher_users_fli_teachers1` FOREIGN KEY (`teacher_id`) REFERENCES `fli_teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_fli_teacher_users_fli_users1` FOREIGN KEY (`user_id`) REFERENCES `fli_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
