<?php
/**
 * @desc smarty引擎适配器
 */
namespace PhalconViewEngine;

use Phalcon\Mvc\View\Engine;
use Phalcon\DiInterface;

class Smarty extends Engine
{

    protected $_options = [];

    private $_smarty = null;

    public function __construct($view, DiInterface $di)
    {
        parent::__construct($view, $di);
    }

    /**
     * 设置smarty选项
     *
     * @param array $options            
     * @return : object $this
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
        return $this;
    }

    /**
     * 获取选项
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * 获取smarty编译器
     *
     * @return object \Smarty
     */
    public function getSmarty()
    {
        if (is_null($this->_smarty)) {
            $smarty = new \Smarty();
            foreach ($this->_options as $k => $v) {
                $smarty->$k = $v;
            }
            $smarty->assign('di', $this->_dependencyInjector);
            $this->_smarty = $smarty;
        }
        return $this->_smarty;
    }

    /**
     * 使用模板引擎呈现视图
     *
     * @param string $path
     *            模板文件
     * @param array $params
     *            参数
     * @param bool $mustClean            
     */
    public function render($path, $params, $mustClean = false)
    {
        $view = $this->_view;
        $smarty = $this->getSmarty();
        $smarty->template_dir = $view->getViewsDir();
        $smarty->assign($params);
        if ($mustClean) {
            $view->setContent($smarty->fetch($path));
        } else {
            $smarty->display($path);
        }
    }
}