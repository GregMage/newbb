<?php
/**
 * NewBB 5.0x,  the forum module for XOOPS project
 *
 * @copyright      XOOPS Project (https://xoops.org)
 * @license        GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author         Taiwen Jiang (phppp or D.J.) <phppp@users.sourceforge.net>
 * @since          4.00
 * @package        module::newbb
 */

// defined('XOOPS_ROOT_PATH') || exit('XOOPS root path not defined');

defined('NEWBB_FUNCTIONS_INI') || include_once __DIR__ . '/functions.ini.php';
define('NEWBB_FUNCTIONS_CONFIG_LOADED', true);

if (!defined('NEWBB_FUNCTIONS_CONFIG')) {
    define('NEWBB_FUNCTIONS_CONFIG', 1);

    /**
     * @return array
     * @internal param string $category
     * @internal param string $dirname
     */
    function newbbLoadConfig()
    {
        $moduleHelper = \Xmf\Module\Helper::getHelper('newbb');
        //        global $xoopsModuleConfig;
        static $configs = null;

        if (null !== $configs) {
            return $configs;
        }

        $configs = is_object($moduleHelper) ? $moduleHelper->getConfig() : [];
        $plugins = include __DIR__ . '/plugin.php';
        if (is_array($configs) && is_array($plugins)) {
            $configs = array_merge($configs, $plugins);
        }
        if (is_array($configs)) {
            $GLOBALS['xoopsModuleConfig'] = array_merge($GLOBALS['xoopsModuleConfig'], $configs);
        }

        return $configs;
    }
}
