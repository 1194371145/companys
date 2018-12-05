<?php
/**
 * The control file of index module of ZenTaoPMS.
 *
 * When requests the root of a website, this index module will be called.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     ZenTaoPMS
 * @version     $Id: control.php 5036 2013-07-06 05:26:44Z wyd621@gmail.com $
 * @link        http://www.zentao.net
 */
class index extends control
{
    /**
     * Construct function, load project, product.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 
     * @access public
     * @return void
     */
    public function index()
    {
		if(array_intersect($this->app->user->groups,array(15,16)))
		{
			$this->locate($this->createLink('sampleapp', 'createout'));	
		}
		elseif(array_intersect($this->app->user->groups,array(13)))
		{
			$this->locate($this->createLink('sampleapp', 'demolist'));	
		}
		elseif(array_intersect($this->app->user->groups,array(3,1,14,20)))
		{
			$this->locate($this->createLink('sampleout', 'out'));
		}
		elseif(array_intersect($this->app->user->groups,array(2,18)))
		{
			$this->locate($this->createLink('mp', 'index'));
		}

        if($this->app->getViewType() == 'mhtml') $this->locate($this->createLink($this->config->locate->module, $this->config->locate->method, $this->config->locate->params));
        $this->locate($this->createLink('my', 'index'));
    }

    /**
     * Just test the extension engine.
     * 
     * @access public
     * @return void
     */
    public function testext()
    {
        echo $this->fetch('misc', 'getsid');
    }
}
