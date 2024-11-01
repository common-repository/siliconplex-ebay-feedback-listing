<?php

/**
 * @package  SpEbay
 
 * Powered by Siliconplex
 * Contact: Usama Ayaz
 * Email: usama.ayaz@siliconplex.com
 * Website: http://www.siliconplex.com

 * 
 */

use \SpEFLInc\Base\BaseController;

class SpEbayFeedbacksShortcode{

    public static function feedbacks_shortcode() {
        
        ob_start();
        $baseController = new BaseController();
        $list_title = get_option('sp_ebay_feedbacks_list_title');
        $date_format = get_option('sp_ebay_feedbacks_datetime_format');

        $feedbacksSettings = array(
            'datetime_format' => ($date_format == '') ? 'MMMM Do YYYY':$date_format,
            'list_title' => ( $list_title == '' ) ? 'Ebay Feedbacks': addslashes($list_title)
        );
        ?>
            <div id="sp-ebay-feedback-container">
                <h3><?php echo $feedbacksSettings['list_title'];?></h3>
                <div id="div_feedbacks" class="animate-bottom">
                    <p>
                    <strong><span id="span_TotalNumberOfEntries">0</span> Feedbacks</strong>
                    (Page <span id="span_PageNumber">0</span> of <span id="span_TotalNumberOfPages">0</span>)
                    </p>            
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th style="width:2%;"></th>
                        <th style="width:58%;">Feedback</th>
                        <th style="width:20%;">Buyer</th>
                        <th style="width:20%;">When</th>
                        </tr>
                    </thead>
                    <tbody id="tblFeedback"></tbody>
                    </table>
                    <div id="div_pagination"></div>
                </div>
            
                <div id="div_loader"></div>
            </div>
            <script>
                
                getEbayFeedbacks("<?php echo $baseController->plugin_url; ?>", '<?php echo json_encode($feedbacksSettings); ?>', 1);
            </script>

        <?php
        $output_string=ob_get_contents();;
        ob_end_clean();
        return $output_string;
    } 


}

add_shortcode( 'sp_sc_ebay_feedbacks', array('SpEbayFeedbacksShortcode', 'feedbacks_shortcode') );

?>