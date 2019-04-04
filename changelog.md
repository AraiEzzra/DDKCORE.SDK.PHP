

### 0.0.4
- dependency - phpize, re2c, sodium, mcrypt, pecl
- change request data format according to the core
- added method `createTransaction`
- inside change method `createAccount`
- created PK generator
- required PHP version 7.2+
- removed unnecessary schema SEND CREATE_ACCOUNT
- removed method types SEND CREATE_ACCOUNT
- added uuid generator for header

### 0.0.3
- fixed error of lost connection `Undefined offset: 2 in vendor/wisembly/elephant.io/src/Engine/AbstractSocketIO.php:125`, associated with socket timeout configure
- method for generate passphrase now is static

### 0.0.2
- change connector parser into constructor and added connection failed exception `ServerConnectionFailureException`
- fix request prepare data, wrap all request into array

### 0.0.1
- TEST VERSION
