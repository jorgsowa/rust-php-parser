===source===
<?php
function foo() :
{
    return $a;
}
===errors===
expected identifier, found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
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
                "parts": [],
                "kind": "Error",
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
