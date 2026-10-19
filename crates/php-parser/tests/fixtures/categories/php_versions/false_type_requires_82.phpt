===config===
min_php=8.1
max_php=8.1
===source===
<?php function f(): false {}
===errors===
'false as standalone type' requires PHP 8.2 or higher
===php_error===
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
