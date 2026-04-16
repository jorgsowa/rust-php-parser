===source===
<?php
function foo() :
{
    return $a;
}
===errors===
expected identifier, found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 36,
                    "end": 38
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 39
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "<error>"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 23,
                  "end": 24
                }
              }
            },
            "span": {
              "start": 23,
              "end": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 3
