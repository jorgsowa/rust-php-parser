===source===
<?php
function e(): ?null {}
===errors <=7.4===
'null type' requires PHP 8.0 or higher
null cannot be marked as nullable
===errors >=8.0===
null cannot be marked as nullable
===php_error <=7.4===
PHP Fatal error:  Cannot use 'null' as class name as it is reserved in Standard input code on line 2
===php_error 8.0-8.1===
PHP Fatal error:  Null can not be used as a standalone type in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  null cannot be marked as nullable in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "e",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "null"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 21,
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
