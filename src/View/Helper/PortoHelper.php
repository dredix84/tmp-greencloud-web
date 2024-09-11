<?php

namespace App\View\Helper;

use Cake\View\Helper;

class PortoHelper extends Helper {

    /**
     * Used to return a <hr /> based on port theme
     * @param type $hrClassed    Class that should be applied to hr tag
     * @param type $divClass    The css class to apply to the div. Set to null if hr tag should not be wrapped in a DIV
     * @return string
     */
    public function addHr($hrClassed = 'dotted tall', $divClass = 'col-sm-12') {
        $outStr = "<hr class='$hrClassed' />";
        if ($divClass != null) {
            $outStr = "<div class='col-sm-12'>$outStr</div>";
        }
        return $outStr;
    }

    /**
     * Return a HTML heade based on the porto theme
     * @param type $text    Text which should be in header
     * @param type $h   The header number to used. Example, 1 = <h1>Example</h1>
     * @param type $divClass    The css class to apply to the div. Set to null if header should not be wrapped in a DIV
     * @return string
     */
    public function addHeader($text, $h = 4, $divClass = 'col-sm-12') {
        $outStr = "<h$h class=\"mb-xlg\">" . __($text) . "</h$h>";
        if ($divClass != null) {
            $outStr = "<div class='$divClass'>$outStr</div>";
        }
        return $outStr;
    }

    /**
     * Used to return a alert box based on the Porto theme
     * @param string $message   Message to display
     * @param string $alertType Alert type (default, success, info, warning, danger, dark)
     * @param boolean $showClose Should the close button show available to the user
     * @param mixed $divClass   The css class to apply to the div. Set to null if alert in should not be wrapped in a DIV
     * @return string
     */
    public function addAlert($message, $alertType = 'info', $showClose = true, $divClass = null) {
        $outStr = "<div class=\"alert alert-$alertType\">"
                . ($showClose ? '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' : '')
                . $message
                . '</div>';
        if ($divClass != null) {
            $outStr = "<div class='$divClass'>$outStr</div>";
        }
        return $outStr;
    }

    /**
     * 
     * @param type $displayText
     * @param type $name
     * @param type $data
     * @param type $wrapperDivClass
     * @param type $labelClass
     * @param type $chkDivClass
     * @return type
     */
    public function addCheckbox($displayText, $name, $data, $wrapperDivClass = 'col-md-6', $labelClass = 'col-xs-12', $chkDivClass = 'col-md-12') {
        $displayText = __($displayText);
        $checked = ($data[$name] == 1 || $data[$name] == true ? ' checked="checked" ' : '');
        $outStr = '
        <div class="form-group">
            <label class="' . $labelClass . ' control-label mt-xs pt-none" for="' . $name . '"> ' . $displayText . '</label>
            <div class="' . $chkDivClass . '">
                <div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
                    <input type="hidden" name="' . $name . '" value="0">
                    <input type="checkbox" id="' . $name . '" name="' . $name . '" ' . $checked . '  value="1" title="' . $displayText . '">
                    <label for="' . $name . '" title="' . $displayText . '"></label>
                </div>
            </div>
        </div>';
        if ($wrapperDivClass != null) {
            $outStr = "<div class='$wrapperDivClass'>$outStr</div>";
        }
        return $outStr;
    }
    
    /**
     * 
     * @param type $displayText
     * @param type $name
     * @param type $data
     * @param type $wrapperDivClass
     * @param type $labelClass
     * @param type $chkDivClass
     * @return string
     */
    public function addCheckboxRequired($displayText, $name, $data, $wrapperDivClass = 'col-md-6', $labelClass = 'col-xs-12', $chkDivClass = 'col-md-12') {
        //$displayText = __($displayText);
        $checked = ($data[$name] == 1 || $data[$name] == true ? ' checked="checked" ' : '');
        $outStr = '
        <div class="form-group">
            <label class="' . $labelClass . ' control-label mt-xs pt-none" for="' . $name . '"> ' . $displayText . '</label>
            <div class="' . $chkDivClass . '">
                <div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
                    <input type="hidden" name="' . $name . '" value="0">
                    <input type="checkbox" id="' . $name . '" name="' . $name . '" ' . $checked . ' required  value="1">
                    <label for="' . $name . '"></label>
                </div>
            </div>
        </div>';
        if ($wrapperDivClass != null) {
            $outStr = "<div class='$wrapperDivClass'>$outStr</div>";
        }
        return $outStr;
    }

}
