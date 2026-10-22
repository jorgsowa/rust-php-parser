===source===
<?php function f(): false {}
===errors <=7.4===
'false type' requires PHP 8.0 or higher
'false as standalone type' requires PHP 8.2 or higher
===errors 8.0-8.1===
'false as standalone type' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Fatal error:  Cannot use 'false' as class name as it is reserved in Standard input code on line 1
===php_error 8.0-8.1===
PHP Fatal error:  False can not be used as a standalone type in Standard input code on line 1
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
                  "false"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 25
                }
              }
            },
            "span": {
              "start": 20,
              "end": 25
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
