ZF2Invoices
===========

Invoicing Application


## Requirements

 * [Zend Framework 2](https://github.com/zendframework/zf2)
 * [ZfcUser](https://github.com/ZF-Commons/ZfcUser)
 * [ZfcUserDoctrineORM](https://github.com/ZF-Commons/ZfcUserDoctrineORM)
 * [BjyAuthorize] (https://github.com/bjyoungblood/BjyAuthorize)
 * [DoctrineORMModule](https://github.com/doctrine/DoctrineORMModule)
 
## Installation
 
1. Install the dependencies by running
```sh
php composer.phar update
```

2. Import the SQL schema located in `./data/database/mysql.sql`. 

3. Set the database credentials in `./config/autoload/local.php`. As an example:

```sh
return array(
	'doctrine' => array(
		'connection' => array(
			'orm_default' =>array(
				'params' => array(
					'user'     => 'zf2invoices',
					'password' => 'zf2invoicespass',
				)
			)
		)
	),
);
```

## Default Login

The default login username is `admin` with password `1234567890`. 