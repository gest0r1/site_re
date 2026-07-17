<?php
/**
 * Plugin Name:  Site Re — Clean <br> from inline elements
 * Description:  Удаляет <br> внутри <a> и <button>, которые wpautop ошибочно добавляет из переносов строк.
 * Version:      1.0.0
 */

add_filter('the_content', function ($content) {
    // Remove <br> inside <a>...</a>
    $content = preg_replace_callback('/<(a|button)([^>]*)>(.*?)<\/\1>/is', function ($m) {
        $inner = preg_replace('/<br\s*\/?>/i', '', $m[3]);
        return "<{$m[1]}{$m[2]}>{$inner}</{$m[1]}>";
    }, $content);

    return $content;
}, 20); // after wpautop (priority 10)
