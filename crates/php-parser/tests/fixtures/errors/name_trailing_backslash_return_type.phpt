===source===
<?php
function f(): A\ {}
===errors >=8.5===
expected identifier, found '{'
===php_error===
PHP Parse error:  syntax error, unexpected token "\", expecting "{" in Standard input code on line 2
===ast >=8.5===
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
                  "A"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            },
            "span": {
              "start": 20,
              "end": 21
            }
          },
          "by_ref": false,
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
