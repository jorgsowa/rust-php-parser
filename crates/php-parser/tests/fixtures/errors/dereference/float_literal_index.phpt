===source===
<?php 1.5[0];
===errors===
Cannot dereference this expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '[' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "[" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Float": 1.5
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 10,
                  "end": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
