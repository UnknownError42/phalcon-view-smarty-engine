## phalcon view smarty模板引擎适配器

#### 安装
```
composer require phalcon-framwork/view-engine
```

###### 使用
``` php
use PhalconViewEngine\Smarty as ViewEngineSmarty;

// 视图配置
/* 'engines' => [ 
        '.volt' => 'viewEngineVolt',
        '.phtml' => 'viewEnginePhp',
        '.html' => 'viewEngineSmarty'
    ] */

$di->setShared('viewEngineSmarty', function (View $view, DI $di) {
	// 获取配置
    $smartyConfig = $this->getConfig()->services->view_engine_smarty->toArray();
    $viewEngineSmarty = new ViewEngineSmarty($view, $di);
    // 设置配置
    $viewEngineSmarty->setOptions($smartyConfig);
    return $viewEngineSmarty;
});

```