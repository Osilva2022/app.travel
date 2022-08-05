/* #################################################### */
/* Remplazar 'travel_' por el SubFijo de la base de datos */
/* #################################################### */
CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `tribunetravel_app`@`187.144.%.%` 
    SQL SECURITY DEFINER
VIEW `travel_destinations` AS
    SELECT 
    `t`.`term_id` AS `term_id`,
    `t`.`name` AS `name`,
    `t`.`slug` AS `slug`,
    `tt`.`description` AS `description`,
    `tm`.`meta_value` AS `color`,
    `images`.`image` AS `image`
FROM
    ((((`travel_term_taxonomy` `tt`
    JOIN `travel_terms` `t` ON ((`tt`.`term_id` = `t`.`term_id`)))
    JOIN `travel_termmeta` `tm` ON (((`tt`.`term_id` = `tm`.`term_id`)
        AND (`tm`.`meta_key` = 'cc_color'))))
    JOIN (SELECT 
        `tm`.`term_id` AS `term_id`,
            `im`.`meta_value` AS `image`,
            `p`.`ID` AS `ID`
    FROM
        `travel_termmeta` `tm`
    LEFT JOIN `travel_posts` `p` ON `tm`.`meta_value` = `p`.`ID`
    JOIN travel_postmeta AS im ON p.ID = im.post_id
    WHERE
        `tm`.`meta_key` = 'imagen_destino'
            AND im.meta_key = '_wp_attached_file') `images` ON ((`tt`.`term_id` = `images`.`term_id`))))
WHERE
    (`tt`.`taxonomy` = 'post_destinos')