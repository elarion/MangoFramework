<?php

namespace core\components;

class Builder
{
    public function controller($class)
    {

        if (!file_exists('./app/controllers/' . $class . 'Controller.php')) {
            $handle = fopen('./app/controllers/' . $class . 'Controller.php', 'w');
            $model = $class;
            $class .= 'Controller';
            $text = <<<EOT
<?php

namespace controllers;
use core\components\Rest;
use models;

class $class extends Rest
{
    public function index()
    {
        /**
        * If you need some treatment before the default behaviour
        * Insert your code here
        */

        /**
        * Comment this line to prevent the default behaviour
        */
        return parent::index();
    }

    public function get(\$id)
    {
        /**
        * If you need some treatment before the default behaviour
        * Insert your code here
        */

        /**
        * Comment this line to prevent the default behaviour
        */
        return parent::get(\$id);
    }

    public function post()
    {
        /**
        * If you need some treatment before the default behaviour
        * Insert your code here
        */

        /**
        * Comment this line to prevent the default behaviour
        */
        return parent::post();
    }

    public function put(\$id)
    {
        /**
        * If you need some treatment before the default behaviour
        * Insert your code here
        */

        /**
        * Comment this line to prevent the default behaviour
        */
        return parent::put(\$id);
    }

    public function delete (\$id)
    {
        /**
        * If you need some treatment before the default behaviour
        * Insert your code here
        */

        /**
        * Comment this line to prevent the default behaviour
        */
        return parent::delete(\$id);
    }
}
EOT;

            fwrite($handle, $text);
        }
    }

    public function customController($class)
    {
        $class = ucfirst($class);
        if (!file_exists('./app/controllers/' . $class . 'Controller.php')) {
        $handle = fopen('./app/controllers/' . $class . 'Controller.php', 'w');
        $model = $class;
        $class .= 'Controller';
        $text = <<<EOT
<?php

namespace controllers;
use core\components\Controller;
use models;

class $class extends Controller
{
    public function show()
    {

    }
}
EOT;

        fwrite($handle, $text);

        return $class.' generate in app/controllers';
    }

        return $class.'Controller already exist.';
    }

    public function model($class)
    {

        if (!file_exists('./app/models/' . $class . '.php')) {

            $handle = fopen('./app/models/' . $class . '.php', 'w');
            $text = <<<EOT
<?php

namespace models;
use core\components\BaseModel;

class $class extends BaseModel
{

}
EOT;

            fwrite($handle, $text);
        }
    }

    public function modelList($array)
    {
        $handle = fopen('./app/utils/list.php', 'w');
        $strArray = 'array(';

        foreach ($array as $key => $entity) {
            if ($key != 0)
                $strArray .= ',';
            $strArray .= '"' . $entity . '"';
        }

        $strArray .= ')';

        $text = <<<EOT
<?php

return $strArray;
EOT;

        fwrite($handle, $text);
    }

}