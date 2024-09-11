<?php

use Cake\Core\Configure;

?>

<style>
    #countdown {
        font-weight: bold;
    }

    h3 {
        margin-top: 53px;
        text-align: center;
    }
</style>

<div class="middle_inner">
    <div class="cmsms_row cmsms_color_scheme_default" id="cmsms_row_5551a75f00777">
        <div class="cmsms_row_outer_parent">
            <div class="cmsms_row_outer">
                <div class="cmsms_row_inner">
                    <div class="cmsms_row_margin cmsms_11">
                        <div class="cmsms_column one_first">
                            <div class="cmsms_text">

                                <h3>
                                    Redirecting to the Web Signer after <span id="countdown">10</span> seconds.
                                </h3>
                                <script type="text/javascript">
                                    var seconds = 10;

                                    function countdown() {
                                        seconds = seconds - 1;
                                        if (seconds < 0) {
                                            window.location = "<?= Configure::read('web_signer_url') ?>";
                                        } else {
                                            document.getElementById("countdown").innerHTML = seconds;
                                            window.setTimeout("countdown()", 1000);
                                        }
                                    }

                                    countdown();
                                </script>

                                <br/>
                                <br/>
                                <br/>
                            </div>
                            <div class="cmsms_divider cmsms_divider_width_long cmsms_divider_pos_center"
                                 id="cmsms_divider_5551a75f00d2d"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cl"></div>
</div>


<
