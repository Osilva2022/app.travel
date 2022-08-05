/* #################################################### */
/* Remplazar 'travel_' por el SubFijo de la base de datos */
/* #################################################### */
CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `tribunetravel_app`@`187.144.%.%` 
    SQL SECURITY DEFINER
VIEW `travel_events` AS
    SELECT 
    `events`.`id_post` AS `id_post`,
    `events`.`title` AS `title`,
    `events`.`slug` AS `slug`,
    `events`.`content` AS `content`,
    `categories`.`category` AS `category`,
    `categories`.`category_slug` AS `category_slug`,
    `destinations`.`destination` AS `destination`,
    `destinations`.`destination_slug` AS `destination_slug`,
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
        `travel_posts` `p`
    WHERE
        ((`p`.`post_type` = 'tribe_events')
            AND (`p`.`post_status` = 'publish'))) `events`
    LEFT JOIN (SELECT 
        `t`.`name` AS `category`,
            `t`.`slug` AS `category_slug`,
            `tr`.`object_id` AS `id_post`
    FROM
        ((`travel_terms` `t`
    JOIN `travel_term_taxonomy` `tt`)
    JOIN `travel_term_relationships` `tr`)
    WHERE
        ((`t`.`term_id` = `tt`.`term_id`)
            AND (`tt`.`taxonomy` = 'tribe_events_cat')
            AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`))) `categories` ON ((`events`.`id_post` = `categories`.`id_post`)))
    LEFT JOIN (SELECT 
        `t`.`name` AS `destination`,
            `t`.`slug` AS `destination_slug`,
            `tr`.`object_id` AS `id_post`
    FROM
        ((`travel_terms` `t`
    JOIN `travel_term_taxonomy` `tt`)
    JOIN `travel_term_relationships` `tr`)
    WHERE
        ((`t`.`term_id` = `tt`.`term_id`)
            AND (`tt`.`taxonomy` = 'post_destinos')
            AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`))) `destinations` ON ((`events`.`id_post` = `destinations`.`id_post`)))
    LEFT JOIN (SELECT 
        `pm`.`post_id` AS `id_post`,
            `pm`.`meta_key` AS `meta_key`,
            `pm`.`meta_value` AS `meta_value`,
            im.meta_value AS image
    FROM
        `travel_postmeta` `pm`
    JOIN `travel_posts` `p` ON `pm`.`meta_value` = `p`.`ID`
        AND `pm`.`meta_key` = '_thumbnail_id'
    JOIN travel_postmeta AS im ON p.ID = im.post_id
        AND im.meta_key = '_wp_attached_file') `images` ON ((`events`.`id_post` = `images`.`id_post`))))
    LEFT JOIN (SELECT 
        `travel_postmeta`.`meta_value` AS `start_date`,
            `travel_postmeta`.`post_id` AS `id_post`
    FROM
        `travel_postmeta`
    WHERE
        (`travel_postmeta`.`meta_key` = '_EventStartDate')) `f1` ON ((`events`.`id_post` = `f1`.`id_post`)))
    LEFT JOIN (SELECT 
        `travel_postmeta`.`meta_value` AS `end_date`,
            `travel_postmeta`.`post_id` AS `id_post`
    FROM
        `travel_postmeta`
    WHERE
        (`travel_postmeta`.`meta_key` = '_EventEndDate')) `f2` ON ((`events`.`id_post` = `f2`.`id_post`)))
    LEFT JOIN (SELECT 
        `travel_postmeta`.`meta_value` AS `all_day`,
            `travel_postmeta`.`post_id` AS `id_post`
    FROM
        `travel_postmeta`
    WHERE
        (`travel_postmeta`.`meta_key` = '_EventAllDay')) `f3` ON ((`events`.`id_post` = `f3`.`id_post`)))