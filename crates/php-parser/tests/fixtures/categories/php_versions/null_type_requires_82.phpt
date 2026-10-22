===source===
<?php function f(): null {}
===errors <=7.4===
'null type' requires PHP 8.0 or higher
'null as standalone type' requires PHP 8.2 or higher
===errors 8.0-8.1===
'null as standalone type' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Fatal error:  Cannot use 'null' as class name as it is reserved in Standard input code on line 1
===php_error 8.0-8.1===
PHP Fatal error:  Null can not be used as a standalone type in Standard input code on line 1
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
                  "null"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 20,
              "end": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
