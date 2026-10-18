===source===
<?php 1->a;
===errors===
Cannot dereference this expression
===php_error===
PHP Parse error:  syntax error, unexpected token "->" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "property": {
                "kind": {
                  "Identifier": "a"
                },
                "span": {
                  "start": 9,
                  "end": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 11
  }
}
