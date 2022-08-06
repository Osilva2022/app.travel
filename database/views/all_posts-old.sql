CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `tribunetravel_app`@`187.144.%.%` 
    SQL SECURITY DEFINER
VIEW `test_all_posts` AS
    SELECT 
        `events`.`id_post` AS `id_post`,
        `events`.`title` AS `title`,
        `events`.`slug` AS `slug`,
        `events`.`content` AS `content`,
        `events`.`post_date` AS `post_date`,
        `events`.`post_excerpt` AS `post_excerpt`,
        `tu`.`display_name` AS `author_name`,
        `tu`.`ID` AS `author_id`,
        `categories`.`category` AS `category`,
        `categories`.`category_slug` AS `category_slug`,
        `categories`.`category_color` AS `category_color`,
        `destinations`.`destination` AS `destination`,
        `destinations`.`destination_slug` AS `destination_slug`,
        `destinations`.`destination_color` AS `destination_color`,
        `images_old`.`image` AS `image_old`,
        `images`.`image` AS `image`,
        CONCAT(`destinations`.`destination_slug`,
                '/',
                `categories`.`category_slug`,
                '/post/',
                `events`.`slug`) AS `url`
    FROM
        ((((((SELECT 
            `p`.`ID` AS `id_post`,
                `p`.`post_title` AS `title`,
                `p`.`post_name` AS `slug`,
                `p`.`post_content` AS `content`,
                `p`.`post_date` AS `post_date`,
                `p`.`post_author` AS `post_author`,
                `p`.`post_excerpt` AS `post_excerpt`
        FROM
            `test_posts` `p`
        WHERE
            ((`p`.`post_type` = 'post')
                AND (`p`.`post_status` = 'publish'))) `events`
        JOIN `test_users` `tu` ON ((`events`.`post_author` = `tu`.`ID`)))
        LEFT JOIN (SELECT 
            `t`.`name` AS `category`,
                `t`.`slug` AS `category_slug`,
                `tr`.`object_id` AS `id_post`,
                `tm`.`meta_value` AS `category_color`
        FROM
            (((`test_terms` `t`
        JOIN `test_term_taxonomy` `tt`)
        JOIN `test_term_relationships` `tr`)
        JOIN `test_termmeta` `tm`)
        WHERE
            ((`t`.`term_id` = `tt`.`term_id`)
                AND (`tt`.`taxonomy` = 'category')
                AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`)
                AND (`tt`.`term_id` = `tm`.`term_id`)
                AND (`tm`.`meta_key` = 'cc_color'))) `categories` ON ((`events`.`id_post` = `categories`.`id_post`)))
        LEFT JOIN (SELECT 
            `t`.`name` AS `destination`,
                `t`.`slug` AS `destination_slug`,
                `td`.`color` AS `destination_color`,
                `tr`.`object_id` AS `id_post`
        FROM
            (((`test_terms` `t`
        JOIN `test_term_taxonomy` `tt`)
        JOIN `test_term_relationships` `tr`)
        JOIN `test_destinations` `td`)
        WHERE
            ((`t`.`term_id` = `tt`.`term_id`)
                AND (`tt`.`taxonomy` = 'post_destinos')
                AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`)
                AND (`t`.`term_id` = `td`.`term_id`))) `destinations` ON ((`events`.`id_post` = `destinations`.`id_post`)))
        LEFT JOIN (SELECT 
            `pm`.`post_id` AS `id_post`,
                `pm`.`meta_key` AS `meta_key`,
                `pm`.`meta_value` AS `meta_value`,
                `p`.`guid` AS `image`
        FROM
            (`test_postmeta` `pm`
        JOIN `test_posts` `p`)
        WHERE
            ((`pm`.`meta_value` = `p`.`ID`)
                AND (`pm`.`meta_key` = '_thumbnail_id'))) `images_old` ON ((`events`.`id_post` = `images_old`.`id_post`)))
        LEFT JOIN (SELECT 
            `test_postmeta`.`post_id` AS `id_post`,
                CONCAT('https://s3.us-west-2.amazonaws.com/app.tribunetravel/', `test_postmeta`.`meta_value`) AS `image`
        FROM
            `test_postmeta`
        WHERE
            (`test_postmeta`.`meta_key` = '_wp_attached_file')) `images` ON ((`images_old`.`meta_value` = `images`.`id_post`)))