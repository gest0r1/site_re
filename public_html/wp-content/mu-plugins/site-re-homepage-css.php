<?php
/**
 * Plugin Name: Site RE Homepage CSS
 * Description: Minimal CSS for Gutenberg blocks on homepage (Kadence Blocks stage 8).
 */
add_action('wp_head', function () {
    if (!is_front_page()) return;
    ?>
    <style id="de-homepage-css">
    /* Step cards — box shadow */
    .de-step-card {
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        background: #ffffff;
    }
    .de-step-card p:first-child {
        margin-bottom: 16px !important;
    }
    .de-step-card h3 {
        margin: 0 0 10px !important;
    }
    .de-step-card p:last-child {
        margin: 0 !important;
    }

    /* Icon round background */
    .de-icon-round figure {
        margin: 0 auto !important;
        border-radius: 50%;
        background: #F7F5F2;
        width: 120px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .de-icon-round img {
        width: 60px !important;
        height: 60px !important;
        object-fit: contain;
    }

    /* Hero tags spacing */
    .de-hero-tags {
        margin-top: 24px !important;
    }

    /* Review cards box shadow */
    .wp-block-column[style*="border-radius:12px"] blockquote,
    .wp-block-column[style*="border-radius:12px"]:has(blockquote) {
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }

    /* Knowledge base link cards hover */
    .wp-block-group[style*="background:#F8F9FB"]:hover {
        background: #f0f2f5 !important;
    }
    .wp-block-group[style*="background:#F8F9FB"] {
        transition: background 0.2s ease;
    }

    /* Fluent Forms on dark bg */
    .de-section[style*="background:#0A1628"] .ff-default .ff-el-form-control {
        background: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 14px 16px !important;
        height: 48px !important;
        font-size: 16px !important;
        color: #172033 !important;
    }
    .de-section[style*="background:#0A1628"] .ff-default .ff-el-form-control:focus {
        box-shadow: 0 0 0 2px #C8A468 !important;
    }
    .de-section[style*="background:#0A1628"] .ff-default .ff-btn-submit {
        background: #F5A623 !important;
        color: #1A202C !important;
        border-radius: 12px !important;
        padding: 16px 32px !important;
        font-weight: 600 !important;
        font-size: 16px !important;
        border: none !important;
        width: 100% !important;
    }
    .de-section[style*="background:#0A1628"] .ff-default .ff-btn-submit:hover {
        background: #e09517 !important;
    }
    .de-section[style*="background:#0A1628"] .ff-default .ff-el-input--label label {
        color: #cbd5e0 !important;
        font-size: 14px !important;
    }
    .de-section[style*="background:#0A1628"] .ff-default .ff-el-form-check-label {
        color: #cbd5e0 !important;
        font-size: 14px !important;
    }
    .de-section[style*="background:#0A1628"] .ff-default .ff-el-form-check-label a {
        color: #F5A623 !important;
    }
    .de-section[style*="background:#0A1628"] .ff-default .ff-el-group {
        margin-bottom: 16px !important;
    }
    .de-section[style*="background:#0A1628"] .ff-default {
        text-align: left !important;
    }

    @media (max-width: 767px) {
        .de-step-card {
            margin-bottom: 16px !important;
        }
        .wp-block-columns {
            flex-direction: column;
        }
    }
    </style>
    <?php
}, 20);
