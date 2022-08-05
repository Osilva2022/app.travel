CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `tribunetravel_app`@`187.144.%.%` 
    SQL SECURITY DEFINER
VIEW `travel_things_to_do` AS
    SELECT 
    `things`.`id_post` AS `id_post`,
    `things`.`title` AS `title`,
    `things`.`slug` AS `slug`,
    `things`.`content` AS `content`,
    `things`.`post_date` AS `post_date`,
    `tu`.`display_name` AS `author_name`,
    `categories`.`category` AS `category`,
    `categories`.`category_slug` AS `category_slug`,
    `categories`.`category_color` AS `category_color`,
    `destinations`.`destination` AS `destination`,
    `destinations`.`destination_slug` AS `destination_slug`,
    `destinations`.`destination_color` AS `destination_color`,
    `images`.`image` AS `image`,
    `tpm`.`meta_value` AS `orden`
FROM
    (((((((SELECT 
        `p`.`ID` AS `id_post`,
            `p`.`post_title` AS `title`,
            `p`.`post_name` AS `slug`,
            `p`.`post_content` AS `content`,
            `p`.`post_date` AS `post_date`,
            `p`.`post_author` AS `post_author`
    FROM
        `travel_posts` `p`
    WHERE
        ((`p`.`post_type` = 'things_to_do')
            AND (`p`.`post_status` = 'publish'))) `things`
    JOIN `travel_users` `tu` ON ((`things`.`post_author` = `tu`.`ID`)))
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
            AND (`tt`.`taxonomy` = 'category_things')
            AND (`tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`)
            AND (`tt`.`term_id` = `tm`.`term_id`)
            AND (`tm`.`meta_key` = 'cc_color'))) `categories` ON ((`things`.`id_post` = `categories`.`id_post`)))
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
            AND (`t`.`term_id` = `td`.`term_id`))) `destinations` ON ((`things`.`id_post` = `destinations`.`id_post`)))
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
        AND im.meta_key = '_wp_attached_file') `images` ON ((`things`.`id_post` = `images`.`id_post`))))
    LEFT JOIN `travel_postmeta` `tpm` ON (((`things`.`id_post` = `tpm`.`post_id`)
        AND (`tpm`.`meta_key` = 'orden'))))