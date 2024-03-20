CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,  -- Уникальный идентификатор пользователя (автоинкрементируемый)
    `nickname` VARCHAR(255) NOT NULL,  -- Псевдоним пользователя
    `email` VARCHAR(255) UNIQUE NOT NULL,  -- Адрес электронной почты пользователя (уникальный)
    `password_hash` VARCHAR(255) NOT NULL,  -- Хеш пароля пользователя
    `is_confirmed` TINYINT(1) NOT NULL DEFAULT 0,  -- Флаг подтверждения пользователя (1 - подтвержден, 0 - не подтвержден)
    `role` VARCHAR(255) NOT NULL DEFAULT 'user',  -- Роль пользователя (по умолчанию установлена в 'user')
    `auth_token` VARCHAR(255) NOT NULL,  -- Токен аутентификации пользователя
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Дата и время создания записи (по умолчанию установлено текущее время)
    `photo` VARCHAR(255) NOT NULL DEFAULT '/img/author.png'  -- Путь к фотографии пользователя (по умолчанию установлено '/img/author.png')
);

CREATE TABLE `articles` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,  -- Уникальный идентификатор статьи (автоинкрементируемый)
    `author_id` INT NOT NULL,  -- Идентификатор автора статьи (ссылка на пользователя)
    `name` VARCHAR(255) NOT NULL,  -- Название статьи
    `text` TEXT NOT NULL,  -- Текст статьи
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Дата и время создания статьи (по умолчанию установлено текущее время)
    `theme` VARCHAR(255) NOT NULL,  -- Тема статьи
    `photo` VARCHAR(255) NOT NULL,  -- Путь к фотографии статьи
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`)  -- Ссылка на таблицу пользователей (связь один-ко-многим)
);

CREATE TABLE `comments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,  -- Уникальный идентификатор комментария (автоинкрементируемый)
    `author_id` INT NOT NULL,  -- Идентификатор автора комментария
    `article_id` INT NOT NULL,  -- Идентификатор статьи, к которой относится комментарий
    `text` TEXT NOT NULL,  -- Текст комментария
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Дата и время создания комментария (по умолчанию установлено текущее время)
    FOREIGN KEY (`author_id`) REFERENCES `users`(`id`),  -- Ссылка на таблицу пользователей (связь один-ко-многим)
    FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`)  -- Ссылка на таблицу статей (связь один-ко-многим)
);

CREATE TABLE `users_activation_codes` (
    `id` INT AUTO_INCREMENT PRIMARY KEY, -- Уникальный идентификатор записи активации
    `user_id` INT NOT NULL, -- Идентификатор пользователя, для которого создан код активации
    `code` VARCHAR(255) NOT NULL, -- Код активации
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) -- Ссылка на таблицу пользователей (связь один-ко-многим)
);

SELECT article_id, COUNT(article_id) FROM `comments` GROUP BY article_id ORDER BY `COUNT(article_id)` DESC;

SELECT * FROM `articles` ORDER BY created_at DESC LIMIT 5 OFFSET 0;