/* #################################################### */
/* Remplazar 'travel_' por el SubFijo de la base de datos */
/* #################################################### */
CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `tribunetravel_app`@`187.144.%.%` 
    SQL SECURITY DEFINER
VIEW `travel_all_posts` AS
    SELECT 
        `posts`.`id_post` AS `id_post`,
        `posts`.`title` AS `title`,
        `posts`.`slug` AS `slug`,
        `posts`.`content` AS `content`,
        `posts`.`post_date` AS `post_date`,
        `posts`.`post_excerpt` AS `post_excerpt`,
        `tu`.`display_name` AS `author_name`,
        `tu`.`ID` AS `author_id`,
        `tu`.`user_nicename` AS `user_nicename`,
        `categories`.`category` AS `category`,
        `categories`.`category_slug` AS `category_slug`,
        `categories`.`category_color` AS `category_color`,
        `destinations`.`destination` AS `destination`,
        `destinations`.`destination_slug` AS `destination_slug`,
        `destinations`.`destination_color` AS `destination_color`,
        `images`.`image` AS `image`,
        CONCAT(`destinations`.`destination_slug`,
                '/',
                `categories`.`category_slug`,
                '/post/',
                `posts`.`slug`) AS `url`
    FROM
        (((((SELECT 
            `p`.`ID` AS `id_post`,
                `p`.`post_title` AS `title`,
                `p`.`post_name` AS `slug`,
                `p`.`post_content` AS `content`,
                `p`.`post_date` AS `post_date`,
                `p`.`post_author` AS `post_author`,
                `p`.`post_excerpt` AS `post_excerpt`
        FROM
            `travel_posts` `p`
        WHERE
            ((`p`.`post_type` = 'post')
                AND (`p`.`post_status` = 'publish'))) `posts`
        JOIN `travel_users` `tu` ON ((`posts`.`post_author` = `tu`.`ID`)))
        LEFT JOIN (SELECT 
            `t`.`name` AS `category`,
                `t`.`slug` AS `category_slug`,
                `tr`.`object_id` AS `id_post`,
                `tm`.`meta_value` AS `category_color`
        FROM
            (((`travel_terms` `t`
        JOIN `travel_term_taxonomy` `tt`)
        JOIN `travel_term_relationships` `tr`)
        JOIN `travel_termmeta` `tm`)
        WHERE
            ((`t`.`term_id` = `tt`.`term_id`)
                AND (`tt`.`taxonomy` = 'category')
                AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`)
                AND (`tt`.`term_id` = `tm`.`term_id`)
                AND (`tm`.`meta_key` = 'cc_color'))) `categories` ON ((`posts`.`id_post` = `categories`.`id_post`)))
        LEFT JOIN (SELECT 
            `t`.`name` AS `destination`,
                `t`.`slug` AS `destination_slug`,
                `td`.`color` AS `destination_color`,
                `tr`.`object_id` AS `id_post`
        FROM
            (((`travel_terms` `t`
        JOIN `travel_term_taxonomy` `tt`)
        JOIN `travel_term_relationships` `tr`)
        JOIN `travel_destinations` `td`)
        WHERE
            ((`t`.`term_id` = `tt`.`term_id`)
                AND (`tt`.`taxonomy` = 'post_destinos')
                AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`)
                AND (`t`.`term_id` = `td`.`term_id`))) `destinations` ON ((`posts`.`id_post` = `destinations`.`id_post`)))
        LEFT JOIN (SELECT 
            `pm`.`post_id` AS `id_post`,
                `pm`.`meta_key` AS `meta_key`,
                `pm`.`meta_value` AS `meta_value`,
                `im`.`meta_value` AS `image`
        FROM
            ((`travel_postmeta` `pm`
        JOIN `travel_posts` `p` ON (((`pm`.`meta_value` = `p`.`ID`)
            AND (`pm`.`meta_key` = '_thumbnail_id'))))
        JOIN `travel_postmeta` `im` ON (((`p`.`ID` = `im`.`post_id`)
            AND (`im`.`meta_key` = '_wp_attached_file'))))) `images` ON ((`posts`.`id_post` = `images`.`id_post`)))