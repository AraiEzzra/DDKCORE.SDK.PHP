

### 0.0.3
- fixed error of lost connection `Undefined offset: 2 в vendor/wisembly/elephant.io/src/Engine/AbstractSocketIO.php:125`, associated with socket timeout configure
- method for generate passphrase now is static

### 0.0.2
- change connector parser into constructor and added connection failed exception `ServerConnectionFailureException`
- fix request prepare data, wrap all request into array

### 0.0.1
- TEST VERSION