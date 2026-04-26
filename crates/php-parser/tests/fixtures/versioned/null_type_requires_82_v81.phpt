===config===
min_php=8.1
max_php=8.1
===source===
<?php function f(): null {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
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
===php_error===
PHP Fatal error:  Null can not be used as a standalone type in Standard input code on line 1
