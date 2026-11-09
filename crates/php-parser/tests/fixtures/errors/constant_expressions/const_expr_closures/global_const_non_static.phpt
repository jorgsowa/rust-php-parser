===source===
<?php
const A = function () {};
===errors <=8.4===
'closures in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Closures in constant expressions must be static
===php_error <=8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Closures in constant expressions must be static in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Closure": {
                  "is_static": false,
                  "by_ref": false,
                  "params": [],
                  "use_vars": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 30
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 30
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
