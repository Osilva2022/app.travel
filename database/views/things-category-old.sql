CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `tribunetravel_app`@`187.144.%.%` 
    SQL SECURITY DEFINER
VIEW `test_things_categories` AS
    SELECT 
        `t`.`term_id` AS `term_id`,
        `t`.`name` AS `name`,
        `t`.`slug` AS `slug`,
        `tt`.`description` AS `description`,
        `tm`.`meta_value` AS `color`,
        `images_old`.`image` AS `image_old`,
        `images`.`image` AS `image`
    FROM
        ((((`test_term_taxonomy` `tt`
        JOIN `test_terms` `t` ON ((`tt`.`term_id` = `t`.`term_id`)))
        JOIN `test_termmeta` `tm` ON (((`tt`.`term_id` = `tm`.`term_id`)
            AND (`tm`.`meta_key` = 'cc_color'))))
        LEFT JOIN (SELECT 
            `tm`.`term_id` AS `term_id`,
                `p`.`guid` AS `image`,
                `p`.`ID` AS `ID`
        FROM
            (`test_termmeta` `tm`
        LEFT JOIN `test_posts` `p` ON ((`tm`.`meta_value` = `p`.`ID`)))
        WHERE
            (`tm`.`meta_key` = 'tag_image')) `images_old` ON ((`tt`.`term_id` = `images_old`.`term_id`)))
        LEFT JOIN (SELECT 
            `test_postmeta`.`post_id` AS `id_post`,
                CONCAT('https://s3.us-west-2.amazonaws.com/app.tribunetravel/', `test_postmeta`.`meta_value`) AS `image`
        FROM
            `test_postmeta`
        WHERE
            (`test_postmeta`.`meta_key` = '_wp_attached_file')) `images` ON ((`images_old`.`ID` = `images`.`id_post`)))
    WHERE
        (`tt`.`taxonomy` = 'category_things')