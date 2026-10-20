===source===
<?php
clone($a, )->b;
===errors===
Cannot dereference this expression
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "->" in Standard input code on line 2
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
                  "Clone": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 12,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 19,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
