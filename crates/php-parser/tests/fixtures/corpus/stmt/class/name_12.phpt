===source===
<?php interface static {}
===errors===
cannot use 'static' as interface name
===php_error===
PHP Parse error:  syntax error, unexpected token "static", expecting identifier in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "static",
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
