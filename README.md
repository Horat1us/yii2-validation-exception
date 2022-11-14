# Yii2 UUID Behavior
[![Test & Lint](https://github.com/Horat1us/yii2-validation-exception/actions/workflows/php.yml/badge.svg?branch=master)](https://github.com/Horat1us/yii2-validation-exception/actions/workflows/php.yml)
[![codecov](https://codecov.io/gh/Horat1us/yii2-validation-exception/branch/master/graph/badge.svg)](https://codecov.io/gh/Horat1us/yii2-validation-exception)

This package add additional methods and exception for model validation.  
Main purpose is to prevent mistakes while models validations (forgot to check validation result for failse etc).  

Previous implementation was available in [horat1us/yii2-base](https://github.com/Horat1us/yii2-base) package
as ModelExceptionInterface and ModelException. 

## Installation
Using [packagist.org](https://packagist.org/packages/horat1us/yii2-validation-exception):
```bash
composer require horat1us/yii2-validation-exception:^1.0
```

## Structure
- [Validation\Failure](./src/Failure.php) - common interface for validation errors.

Should be used when ActiveRecord is implemented out of project repository (working with dependencies).
- [Validation\ExceptionTrait](./src/ExceptionTrait.php) - implements *Failure* and provides static failure factory.
- [Validation\Exception](./src/Exception.php) - *Failure* implementation using *ExceptionTrait*.

Should be used when ActiveRecord implemented in project repository and may implement interfaces and use traits.
- [Validation\Failure\ModelInterface](./src/Failure/ModelInterface.php) - extends `\yii\base\Model` with methods
*validateOrFail* and *checkOrFail*.
    - [Model](./src/Failure/Model.php) - trait with implementation.
- [Validation\Failure\ActiveRecordInterface] - extends `\yii\db\ActiveRecord` with *saveOrFail* method.
    - [ActiveRecord](./src/Failure/ActiveRecord.php) - trait with implementation.


## Example
With extension for model and active record:
```php
<?php

namespace App;

use Horat1us\Yii\Validation;
use yii\base;

class Model extends base\Model implements Validation\Failure\ModelInterface
{
    use Validation\Failure\Model;
    
    public $id;
    
    public function rules(): array {
        return [
            [['id',], 'required',],    
        ];
    }
}

$model = new Model;
try {
    $model->validateOrFail();
} catch (Validation\Failure $failure) {
    // handle
}
```

With exceptions factory:
```php
<?php

namespace App;

use Horat1us\Yii\Validation;
use yii\base;

class Model extends base\Model 
{
    /** @var string  */
    public $id;
    
    public function rules() {
        return [
            [['id',], 'required',],
        ];
    }
}

$model = new Model;

try {
    Validation\Exception::validateOrThrow($model);
} catch (Validation\Failure $failure) {
    // handle
}
```

## License
[MIT](./LICENSE)
