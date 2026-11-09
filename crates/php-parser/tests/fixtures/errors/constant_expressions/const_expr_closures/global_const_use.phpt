===source===
<?php
const B = static function () use ($x) {};
===errors <=8.4===
'closures in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Cannot use(...) variables in constant expression
===php_error <=8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use(...) variables in constant expression in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Closure": {
                  "is_static": true,
                  "by_ref": false,
                  "params": [],
                  "use_vars": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 40,
                          "end": 42
                        }
                      },
                      "by_ref": false,
                      "span": {
                        "start": 40,
                        "end": 42
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 46
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 46
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
