SELECT 
    p.ID,
    p.post_author,
    p.post_date,
    p.post_content,
    p.post_title,
    p.post_type,
    pm.meta_value AS category,
    locations.term_id AS location,
    pm1.meta_value AS address,
    pm2.meta_value AS latitude,
    pm3.meta_value AS longitude,
    pm4.meta_value AS link,
    pm5.meta_value AS price,
    pm6.meta_value AS price_max,
    pm7.meta_value AS price_after,
    pm8.meta_value AS price_class,
    pm9.meta_value AS price_currency,
    pm10.meta_value AS avaliable,
    pm11.meta_value AS email,
    pm12.meta_value AS phone,
    pm13.meta_value AS website,
    pm14.meta_value AS contact_address,
    pm15.meta_value AS remark,
    pm16.meta_value AS gallert,
    pm17.meta_value AS facebook,
    pm18.meta_value AS instagram,
    pm19.meta_value AS whatsapp,
    pm20.meta_value AS thumbnail
FROM
    travel_posts AS p
        LEFT JOIN
    travel_postmeta AS pm ON p.ID = pm.post_id
        AND pm.meta_key = 'lsd_primary_category'
        LEFT JOIN
    travel_postmeta AS pm1 ON p.ID = pm1.post_id
        AND pm1.meta_key = 'lsd_address'
        LEFT JOIN
    travel_postmeta AS pm2 ON p.ID = pm2.post_id
        AND pm2.meta_key = 'lsd_latitude'
        LEFT JOIN
    travel_postmeta AS pm3 ON p.ID = pm3.post_id
        AND pm3.meta_key = 'lsd_longitude'
        LEFT JOIN
    travel_postmeta AS pm4 ON p.ID = pm4.post_id
        AND pm4.meta_key = 'lsd_link'
        LEFT JOIN
    travel_postmeta AS pm5 ON p.ID = pm5.post_id
        AND pm5.meta_key = 'lsd_price'
        LEFT JOIN
    travel_postmeta AS pm6 ON p.ID = pm6.post_id
        AND pm6.meta_key = 'lsd_price_max'
        LEFT JOIN
    travel_postmeta AS pm7 ON p.ID = pm7.post_id
        AND pm7.meta_key = 'lsd_price_after'
        LEFT JOIN
    travel_postmeta AS pm8 ON p.ID = pm8.post_id
        AND pm8.meta_key = 'lsd_price_class'
        LEFT JOIN
    travel_postmeta AS pm9 ON p.ID = pm9.post_id
        AND pm9.meta_key = 'lsd_price_currency'
        LEFT JOIN
    travel_postmeta AS pm10 ON p.ID = pm10.post_id
        AND pm10.meta_key = 'lsd_ava'
        LEFT JOIN
    travel_postmeta AS pm11 ON p.ID = pm11.post_id
        AND pm11.meta_key = 'lsd_email'
        LEFT JOIN
    travel_postmeta AS pm12 ON p.ID = pm12.post_id
        AND pm12.meta_key = 'lsd_phone'
        LEFT JOIN
    travel_postmeta AS pm13 ON p.ID = pm13.post_id
        AND pm13.meta_key = 'lsd_website'
        LEFT JOIN
    travel_postmeta AS pm14 ON p.ID = pm14.post_id
        AND pm14.meta_key = 'lsd_contact_address'
        LEFT JOIN
    travel_postmeta AS pm15 ON p.ID = pm15.post_id
        AND pm15.meta_key = 'lsd_remark'
        LEFT JOIN
    travel_postmeta AS pm16 ON p.ID = pm16.post_id
        AND pm16.meta_key = 'lsd_gallery'
        LEFT JOIN
    travel_postmeta AS pm17 ON p.ID = pm17.post_id
        AND pm17.meta_key = 'lsd_facebook'
        LEFT JOIN
    travel_postmeta AS pm18 ON p.ID = pm18.post_id
        AND pm18.meta_key = 'lsd_instagram'
        LEFT JOIN
    travel_postmeta AS pm19 ON p.ID = pm19.post_id
        AND pm19.meta_key = 'lsd_whatsapp'
        LEFT JOIN
    travel_postmeta AS pm20 ON p.ID = pm20.post_id
        AND pm20.meta_key = '_thumbnail_id'
        LEFT JOIN
    (SELECT 
        t.term_id,
            `t`.`slug` AS `destination_slug`,
            `tr`.`object_id` AS `id_post`
    FROM
        `travel_terms` `t`
    JOIN `travel_term_taxonomy` `tt`
    JOIN `travel_term_relationships` `tr`
    WHERE
        `t`.`term_id` = `tt`.`term_id`
            AND `tt`.`taxonomy` = 'post_destinos'
            AND `tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`) AS locations ON locations.id_post = p.ID
WHERE
    post_type = 'listdom-listing'
        AND post_status = 'publish';