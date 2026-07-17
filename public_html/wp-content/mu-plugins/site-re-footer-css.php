<?php
/**
 * Footer CSS — de-footer-links, brand, contact styles.
 */
add_action('wp_head', function () {
    echo '<style id="de-footer-css">
/* Footer link lists — no bullets */
.site-footer ul.de-footer-links {
    list-style: none !important;
    margin: 0;
    padding: 0;
}
.site-footer ul.de-footer-links li {
    margin: 0;
    padding: 0;
    line-height: 1.35;
}
.site-footer ul.de-footer-links a {
    color: #D8DEE8;
    text-decoration: none;
    font-size: 14px;
    line-height: 1.35;
}
.site-footer ul.de-footer-links a:hover {
    color: #C8A468;
    text-decoration: underline;
}

/* Remove default bullets from any ul in footer */
.site-footer .widget ul {
    list-style: none !important;
    margin: 0;
    padding: 0;
}
.site-footer .widget ul li {
    margin: 0;
    padding: 0;
}
.site-footer .widget ul li a {
    color: #D8DEE8;
    text-decoration: none;
    font-size: 14px;
    line-height: 1.35;
}
.site-footer .widget ul li a:hover {
    color: #C8A468;
    text-decoration: underline;
}

/* Footer widget headings — explicitly white */
.site-footer .widget h3,
.site-footer .widget h2,
.site-footer .widget h4 {
    color: #FFFFFF !important;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.25;
    margin: 0 0 14px;
}

/* Footer brand */
.de-footer-brand p {
    max-width: 320px;
    margin: 0;
    color: #D8DEE8;
    font-size: 14px;
    line-height: 1.5;
}

/* Footer bottom (copyright) */
.site-bottom-footer-wrap {
    background: #0C1B31;
}
.site-bottom-footer-wrap p {
    color: #98A2B3;
    font-size: 13px;
    line-height: 1.5;
    margin: 0;
}
.site-bottom-footer-wrap a {
    color: #98A2B3;
    text-decoration: none;
}
.site-bottom-footer-wrap a:hover {
    color: #C8A468;
    text-decoration: underline;
}
</style>';
}, 5);
