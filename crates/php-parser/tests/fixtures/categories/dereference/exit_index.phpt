===source===
<?php exit()[0];
===errors===
Cannot dereference this expression
===php_error===
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
                  "Exit": null
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 13,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
