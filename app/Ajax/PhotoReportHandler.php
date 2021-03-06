<?php

namespace ShoAdmin\Ajax;

use ShoAdmin\DB;

class PhotoReportHandler
{
    public function __construct()
    {
        check_ajax_referer('sho-admin');
    }

    public function __destruct()
    {
        wp_reset_postdata();
    }

    public function insertReport(): string
    {
        $name = $_POST['name'];
        $image = $_FILES['image'];
        $shortcode = $_POST['shortcode'];

        // Find the id of 'photo-reports' category
        $cats = array_filter(get_categories(), function ($cat) {
            return $cat->category_nicename === 'photo-reports';
        });

        $post_id = wp_insert_post([
            'post_status' => 'publish',
            'post_author' => 1,
            'post_content' => $shortcode,
            'post_title' => $name,
            'post_category' => [current($cats)->cat_ID],
        ]);

        if ($post_id == 0) {
            return json_encode([
                'msg' => 'Ошибка сервера',
                'status' => 'error',
            ]);
        }

        $thumb_id = media_handle_sideload($image, $post_id);
        set_post_thumbnail($post_id, $thumb_id);
        $slug = get_post_field('post_name', $post_id);

        return json_encode([
            'msg' => "Фото отчет успешно создан. <a href='{$slug}'>Просмотреть!</a>",
            'status' => 'error',
        ]);
    }

    /** @return string|bool */
    public function getLastEnvira()
    {
        return json_encode(DB::getLastEnviraPost());
    }
}
