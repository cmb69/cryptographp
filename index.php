<?php

/**
 * Front-end of Cryptographp_XH.
 *
 * PHP versions 4 and 5
 *
 * @category  CMSimple_XH
 * @package   Crpytographp
 * @author    Sylvain Brison <cryptographp@alphpa.com>
 * @author    Christoph M. Becker <cmbecker69@gmx.de>
 * @copyright 2006-2007 Sylvain Brison
 * @copyright 2011-2014 Christoph M. Becker <http://3-magi.net>
 * @license   http://www.gnu.org/licenses/gpl-3.0.en.html GNU GPLv3
 * @link      http://3-magi.net/?CMSimple_XH/Cryptographp_XH
 */

if (!defined('CMSIMPLE_XH_VERSION')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

/**
 * The plugin version.
 */
define('CRYPTOGRAPHP_VERSION', '1beta3');

/**
 * Returns the php configuration.
 *
 * @return string
 */
function Cryptograph_config()
{
    global $plugin_cf;

    $config = array(
        'crypt_width' => array('$cryptwidth', 'int'),
        'crypt_height' => array('$cryptheight', 'int'),
        'bg_rgb_red' => array('$bgR', 'int'),
        'bg_rgb_green' => array('$bgG', 'int'),
        'bg_rgb_blue' => array('$bgB', 'int'),
        'bg_clear' => array('$bgclear', 'bool'),
        'bg_image' => array('$bgimg', 'string'),
        'bg_frame' => array('$bgframe', 'bool'),
        'char_rgb_red' => array('$charR', 'int'),
        'char_rgb_green' => array('$charG', 'int'),
        'char_rgb_blue' => array('$charB', 'int'),
        'char_color_random' => array('$charcolorrnd', 'bool'),
        'char_color_random_level' => array('$charcolorrndlevel', 'int'),
        'char_clear' => array('$charclear', 'int'),
        'fonts' => array('$tfont', 'array'),
        'char_allowed' => array('$charel', 'string'),
        'crypt_easy' => array('$crypteasy', 'bool'),
        'char_allowed_consonants' => array('$charelc', 'string'),
        'char_allowed_vowels' => array('$charelv', 'string'),
        'char_count_min' => array('$charnbmin', 'int'),
        'char_count_max' => array('$charnbmax', 'int'),
        'char_space' => array('$charspace', 'int'),
        'char_size_min' => array('$charsizemin', 'int'),
        'char_size_max' => array('$charsizemax', 'int'),
        'char_angle_max' => array('$charanglemax', 'int'),
        'char_displace' => array('$charup', 'bool'),
        'crypt_gaussian_blur' => array('$cryptgaussianblur', 'bool'),
        'crypt_gray_scale' => array('$cryptgrayscal', 'bool'),
        'noise_pixel_min' => array('$noisepxmin', 'int'),
        'noise_pixel_max' => array('$noisepxmax', 'int'),
        'noise_line_min' => array('$noiselinemin', 'int'),
        'noise_line_max' => array('$noiselinemax', 'int'),
        'noise_circle_min' => array('$nbcirclemin', 'int'),
        'noise_circle_max' => array('$nbcirclemax', 'int'),
        'noise_color_char' => array('$noisecolorchar', 'int'),
        'noise_brush_size' => array('$brushsize', 'int'),
        'noise_above' => array('$noiseup', 'bool'),
        'crypt_format' => array('$cryptformat', 'string'),
        'crypt_use_timer' => array('$cryptusetimer', 'int'),
        'crypt_use_timer_error' => array('$cryptusertimererror', 'bool'),
        'crypt_expiration' => array('$cryptexpiration', 'int')
    );

    $pcf = $plugin_cf['cryptographp'];
    $res = '<?php'."\n\n"
            .'// This file was automatically generated by Cryptographp_XH.'."\n\n";
    foreach ($config as $key => $option) {
        list($varname, $type) = $option;
        switch ($type) {
        case 'int':
            $val = $pcf[$key];
            break;
        case 'bool':
            $val = strtolower($pcf[$key] == 'yes') ? 'TRUE' : 'FALSE';
            break;
        case 'string':
            $val = '\''.addcslashes($pcf[$key], '\'\\').'\'';
            break;
        case 'array':
            $val = 'array(\''.implode('\', \'', explode(';', $pcf[$key])).'\')';
            break;
        }
        $res .= $varname.' = '.$val.';'."\n";
    }
    $res .= "\n".'?>'."\n";
    return $res;
}

/**
 * Updates the configuration, if necessary.
 *
 * @return void
 */
function Cryptographp_updateConfig()
{
    global $pth;

    $fn = $pth['folder']['plugins'].'cryptographp/config/cryptographp.cfg.php';
    $fn2 = $pth['folder']['plugins'].'cryptographp/config/config.php';
    if (!file_exists($fn) || filemtime($fn2) > filemtime($fn)) {
        if (($fh = fopen($fn, 'w')) === false
            || fwrite($fh, Cryptograph_config()) === false
        ) {
            e('cntsave', 'file', $fn);
        }
        if ($fh !== false) {
            fclose($fh);
        }
    }
}

/**
 * Update the configuration file.
 */
Cryptographp_updateConfig();

?>
