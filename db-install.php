<?php

include_once './db.php';

$mysqli->query("DROP TABLE IF EXISTS blog_views");
echo "Dropping `blog_views` if it exists...<br />";

$mysqli->query("DROP TABLE IF EXISTS blog_posts");
echo "Dropping `blog_posts` if it exists...<br />";

$mysqli->query("DROP TABLE IF EXISTS users");
echo "Dropping `users` if it exists...<br />";




$createUsers = "CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(250) NOT NULL,
    last_name VARCHAR(250) NOT NULL,
    access_level VARCHAR(50) NOT NULL DEFAULT 'user',
    initials VARCHAR(4) NOT NULL,    
    INDEX (id)
)";
if (!$mysqli->query($createUsers)) {
    echo "Error creating `users`: " . $mysqli->error . "<br /><br />";
} else {
    echo "Creating `users` table...<br /><br />";
}




$createBlogPosts = "CREATE TABLE IF NOT EXISTS blog_posts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(250) NOT NULL,
    url_slug VARCHAR(200) NOT NULL UNIQUE,
    author_id BIGINT UNSIGNED,
    content MEDIUMTEXT,
    created_at DATETIME DEFAULT NOW(),
    updated_at DATETIME,
    CONSTRAINT `blog_posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)";
if (!$mysqli->query($createBlogPosts)) {
    echo "Error creating `blog_posts`: " . $mysqli->error . "<br /><br />";
} else {
    echo "Creating `blog_posts` table...<br /><br />";
}




$createBlogViews = "CREATE TABLE IF NOT EXISTS blog_views (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    blog_post_id BIGINT UNSIGNED NOT NULL,
    viewed_at DATETIME DEFAULT NOW(),
    viewer_ip VARCHAR(15),
    CONSTRAINT `blog_views_blog_post_id_foreign` FOREIGN KEY (blog_post_id)
        REFERENCES blog_posts(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)";
if (!$mysqli->query($createBlogViews)) {
    echo "Error creating `blog_views`: " . $mysqli->error . "<br /><br />";
} else {
    echo "Creating `blog_views` table...<br /><br />";
}




$insertUsers = "INSERT INTO users (first_name, last_name, access_level, initials)
    VALUES ('Michael', 'Lynch', 'admin', 'ML'),
           ('Tom', 'Lynch', DEFAULT, 'TL'),
           ('Phil', 'Lynch', 'user', 'PL'),
           ('Charlie', 'Lynch', DEFAULT, 'CL'),
           ('Hanna', 'Pickering', 'user', 'HP'),
           ('Rosie', 'North', DEFAULT, 'RN'),
           ('Shaun', 'Rees', 'user', 'SR'),
           ('Lily', 'Lynch', DEFAULT, 'LL')
";
if (!$mysqli->query($insertUsers)) {
    echo "Error inserting users: " . $mysqli->error . "<br /><br />";
} else {
    echo "Inserting users...<br /><br />";
}




$insertBlogPosts = "INSERT INTO blog_posts (title, url_slug, author_id, content)
    VALUES ('Phase One of the MCU', 'phase-one-mcu', '1', 'Phase one of the Marvel Cinematic Universe contained the following films: Iron Man (2008), The Incredible Hulk (2008), Iron Man 2 (2010), Thor (2011), Captain America: The First Avenger (2011), The Avengers (2012)'),
           ('Phase Two of the MCU', 'phase-two-mcu', '3', 'Phase two of the Marvel Cinematic Universe contained the following films: Iron Man 3 (2013), Thor: The Dark World (2013), Captain America: The Winter Soldier (2014), Guardians of the Galaxy (2014), Avengers: Age of Ultron (2015), Ant-Man (2015)'),
           ('Phase Three of the MCU', 'phase-three-mcu', '5', 'Phase three of the Marvel Cinematic Universe contained the following films: Captain America: Civil War (2016), Doctor Strange (2016), Guardians of the Galaxy Vol. 2 (2017), Spider-Man: Homecoming (2017), Thor: Ragnarok (2017), Black Panther (2018), Avengers: Infinity War (2018), Ant-Man and the Wasp (2018), Captain Marvel (2019), Avengers: Endgame (2019), Spider-Man: Far From Home (2019)'),
           ('Phase Four of the MCU', 'phase-four-mcu', '7', 'Phase four of the Marvel Cinematic Universe will contain the following films: Black Widow (due 2021), Shang-Chi and the Legend of the Ten Rings (due 2021), Eternals (due 2021), Spider-Man: No Way Home (due 2021), Doctor Strange in the Multiverse of Madness (due 2022), Thor: Love and Thunder (due 2022), Black Panther II (due 2022), Captain Marvel 2 (due 2022), Ant-Man and the Wasp: Quantumania (due 2022), Guardians of the Galaxy Vol. 3 (due 2023), Fantastic Four (TBA)'),
           ('Original Avengers roster', 'original-avengers-roster', '6', 'Tony Stark/Iron Man; Steve Rogers/Captain America; Thor (God of Thunder); Bruce Banner/Hulk; Clint Barton/Hawkeye; Natasha Romanov/Black Widow'),
           ('Nick Fury & Goose', 'nick-fury-goose', '4', 'Nick Fury and Goose met each other when they stole a plane alongside Captain Marvel'),
           ('Doctor Strange or Turk? We discuss who is the superior surgeon', 'strange-turk-superior', '2', 'Who is the superior surgeon between Doctor Stephen Strange and Turk? We discuss below!')
";
if (!$mysqli->query($insertBlogPosts)) {
    echo "Error inserting blog posts: " . $mysqli->error . "<br /><br />";
} else {
    echo "Inserting blog posts...<br /><br />";
}