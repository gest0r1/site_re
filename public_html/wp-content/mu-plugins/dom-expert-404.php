<?php
/**
 * Kadence 404 override for dom-ekspert.rf / дом-эксперт.рф.
 *
 * Purpose: replace default Kadence 404 copy + search form with project-approved
 * conversion-first 404 content.
 */

add_action( 'after_setup_theme', function () {
    remove_action( 'kadence_404_content', 'Kadence\get_404_content' );
    add_action( 'kadence_404_content', 'dom_expert_404_content' );
}, 20 );

add_action( 'wp_head', function () {
    if ( ! is_404() ) {
        return;
    }
    ?>
    <style>
        .dom-expert-404 .wp-block-buttons {
            align-items: center;
        }

        .dom-expert-404 .wp-block-button__link {
            background: #10233f;
            color: #ffffff;
            border-radius: 12px;
            padding: 14px 20px;
            text-decoration: none;
        }

        .dom-expert-404 .is-style-outline .wp-block-button__link {
            background: #ffffff;
            color: #10233f;
            border: 1px solid #d8dee8;
        }

        .dom-expert-404-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 148px;
            padding: 10px 14px;
            border: 1px solid #d8dee8;
            border-radius: 12px;
            color: #10233f;
            text-decoration: none;
        }

        @media (max-width: 767px) {
            .dom-expert-404 .wp-block-buttons,
            .dom-expert-404-links {
                flex-direction: column;
            }

            .dom-expert-404 .wp-block-button,
            .dom-expert-404-links a {
                width: 100%;
            }
        }
    </style>
    <?php
}, 20 );

function dom_expert_404_content() {
    ?>
    <section class="error">
        <div class="page-content entry content-bg">
            <div class="entry-content-wrap dom-expert-404" style="max-width:1240px;margin:0 auto;padding:clamp(32px,6vw,72px) 16px;text-align:center;">
                <h1 class="page-title 404-page-title" style="margin-bottom:16px;">Страница не найдена</h1>

                <p style="max-width:720px;margin:0 auto 24px;">
                    Попали на эту страницу? Значит, пора на бесплатную консультацию — мы подскажем по сайту и по вашему следующему шагу в недвижимости.
                </p>

                <div class="wp-block-buttons is-content-justification-center" style="justify-content:center;gap:12px;flex-wrap:wrap;margin-bottom:24px;">
                    <div class="wp-block-button">
                        <a class="wp-block-button__link wp-element-button" href="/contacts/">Закажи консультацию</a>
                    </div>
                    <div class="wp-block-button is-style-outline">
                        <a class="wp-block-button__link wp-element-button" href="/contacts/">Позвони нам</a>
                    </div>
                </div>

                <p style="margin:0 0 12px;">Или перейди в нужный раздел</p>

                <div class="dom-expert-404-links" style="display:flex;justify-content:center;flex-wrap:wrap;gap:12px;">
                    <a href="/sell/">Владельцам</a>
                    <a href="/buyers/">Покупателям</a>
                </div>
            </div>
        </div>
    </section>
    <?php
}
