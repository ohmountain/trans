API 
=====

## REQUIREMENTS

1. PHP version >= PHP7.0
2. run `php bin/symfony_requirements` and check another requirements

## INSTALL
```shell
git clone https://github.com/ohmountain/trans.git
cd tras
tar zvxf vendor.tar.gz
```

## RUN
```
php bin/console server:start
```

### VERIFY
1. `http://localhost:8000/api/v1/cx_list?id=1&page=1&count=2`
2. `http://localhost:8000/api/v1/example?data={"username":"root","password":"123456"}`
