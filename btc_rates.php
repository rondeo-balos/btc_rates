<?php

/*
 * Plugin Name:       BTC Rates
 * Description:       a shortcode [btc_rates] that shows the current rate of Bitcoin in USD, GBP, and EUR.
 * Version:           0.0.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Harvey Malolot
 * License:           GNU GPL v3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:       btc_rates
 */

class BTC_Rates {

    public $plugin_ver = '0.0.3';

    public function __construct() {
        add_shortcode( 'btc_rates', [ $this, 'shortcode_callback' ] ); // create shortcode
    }

    function shortcode_callback() {
        
        wp_enqueue_script( 'btc_rates_script', plugin_dir_url( __FILE__ ) . 'btc_rates_script.js', array(), $this->plugin_ver, true ); // load script
        wp_enqueue_style( 'btc_rates_style', plugin_dir_url( __FILE__ ) . 'btc_rates_style.css', array(), $this->plugin_ver, 'all' ); // load style

        ob_start();
        ?>
            <div class="rates-container">
                <h2>BTC PRICE</h2>
                <div class="rates-row">
                    <div class="rates-col">
                        <div class="rates-price" id="rate_usd"></div>
                        <span>USD</span>
                    </div>
                    <div class="rates-col">
                        <div class="rates-price" id="rate_gbp"></div>
                        <span>GBP</span>
                    </div>
                    <div class="rates-col">
                        <div class="rates-price" id="rate_eur"></div>
                        <span>EUR</span>
                    </div>
                </div>
                <button class="rates-button" id="fetch_rates">FETCH NOW</button>
            </div>
        <?php
        return ob_get_clean();
    }
}

new BTC_Rates();