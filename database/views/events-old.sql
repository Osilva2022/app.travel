CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `tribunetravel_app`@`187.144.%.%` 
    SQL SECURITY DEFINER
VIEW `test_events` AS
    SELECT 
        `events`.`id_post` AS `id_post`,
        `events`.`title` AS `title`,
        `events`.`slug` AS `slug`,
        `events`.`content` AS `content`,
        `categories`.`category` AS `category`,
        `categories`.`category_slug` AS `category_slug`,
        `destinations`.`destination` AS `destination`,
        `destinations`.`destination_slug` AS `destination_slug`,
        `images_old`.`img` AS `image_old`,
        `images`.`image` AS `image`,
        `f1`.`start_date` AS `start_date`,
        `f2`.`end_date` AS `end_date`,
        `f3`.`all_day` AS `all_day`
    FROM
        ((((((((SELECT 
            `p`.`ID` AS `id_post`,
                `p`.`post_title` AS `title`,
                `p`.`post_name` AS `slug`,
                `p`.`post_content` AS `content`
        FROM
            `test_posts` `p`
        WHERE
            ((`p`.`post_type` = 'tribe_events')
                AND (`p`.`post_status` = 'publish'))) `events`
        LEFT JOIN (SELECT 
            `t`.`name` AS `category`,
                `t`.`slug` AS `category_slug`,
                `tr`.`object_id` AS `id_post`
        FROM
            ((`test_terms` `t`
        JOIN `test_term_taxonomy` `tt`)
        JOIN `test_term_relationships` `tr`)
        WHERE
            ((`t`.`term_id` = `tt`.`term_id`)
                AND (`tt`.`taxonomy` = 'tribe_events_cat')
                AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`))) `categories` ON ((`events`.`id_post` = `categories`.`id_post`)))
        LEFT JOIN (SELECT 
            `t`.`name` AS `destination`,
                `t`.`slug` AS `destination_slug`,
                `tr`.`object_id` AS `id_post`
        FROM
            ((`test_terms` `t`
        JOIN `test_term_taxonomy` `tt`)
        JOIN `test_term_relationships` `tr`)
        WHERE
            ((`t`.`term_id` = `tt`.`term_id`)
                AND (`tt`.`taxonomy` = 'post_destinos')
                AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`))) `destinations` ON ((`events`.`id_post` = `destinations`.`id_post`)))
        LEFT JOIN (SELECT 
            `pm`.`post_id` AS `id_post`,
                `pm`.`meta_key` AS `meta_key`,
                `pm`.`meta_value` AS `meta_value`,
                `p`.`guid` AS `img`
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
        LEFT JOIN (SELECT 
            `test_postmeta`.`meta_value` AS `start_date`,
                `test_postmeta`.`post_id` AS `id_post`
        FROM
            `test_postmeta`
        WHERE
            (`test_postmeta`.`meta_key` = '_EventStartDate')) `f1` ON ((`events`.`id_post` = `f1`.`id_post`)))
        LEFT JOIN (SELECT 
            `test_postmeta`.`meta_value` AS `end_date`,
                `test_postmeta`.`post_id` AS `id_post`
        FROM
            `test_postmeta`
        WHERE
            (`test_postmeta`.`meta_key` = '_EventEndDate')) `f2` ON ((`events`.`id_post` = `f2`.`id_post`)))
        LEFT JOIN (SELECT 
            `test_postmeta`.`meta_value` AS `all_day`,
                `test_postmeta`.`post_id` AS `id_post`
        FROM
            `test_postmeta`
        WHERE
            (`test_postmeta`.`meta_key` = '_EventAllDay')) `f3` ON ((`events`.`id_post` = `f3`.`id_post`)))