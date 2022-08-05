/* #################################################### */
/* Remplazar 'travel_' por el SubFijo de la base de datos */
/* #################################################### */
CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `tribunetravel_app`@`187.144.%.%` 
    SQL SECURITY DEFINER
VIEW `travel_categories` AS
    SELECT 
        `t`.`term_id` AS `term_id`,
        `t`.`name` AS `name`,
        `t`.`slug` AS `slug`,
        `tt`.`description` AS `description`,
        `tm`.`meta_value` AS `color`
    FROM
        ((`travel_term_taxonomy` `tt`
        JOIN `travel_terms` `t` ON ((`tt`.`term_id` = `t`.`term_id`)))
        JOIN `travel_termmeta` `tm` ON (((`tt`.`term_id` = `tm`.`term_id`)
            AND (`tm`.`meta_key` = 'cc_color'))))
    WHERE
        (`tt`.`taxonomy` = 'category')