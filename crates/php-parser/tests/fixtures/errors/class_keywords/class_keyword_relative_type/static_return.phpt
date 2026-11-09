===source===
<?php
function f(): namespace\static {}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
Cannot use "static" when no class scope is active
===errors 8.0-8.4===
Cannot use "static" when no class scope is active
===errors >=8.5===
Type declaration 'static' must be unqualified
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting identifier (T_STRING) in Standard input code on line 2
===php_error 8.0-8.4===
PHP Fatal error:  Cannot use "static" when no class scope is active in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Type declaration 'static' must be unqualified in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "static"
                ],
                "kind": "Relative",
                "span": {
                  "start": 20,
                  "end": 36
                }
              }
            },
            "span": {
              "start": 20,
              "end": 36
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
