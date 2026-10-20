===source===
<?php
clone($a, [])?->b;
===errors===
Cannot dereference this expression
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "?->" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafePropertyAccess": {
              "object": {
                "kind": {
                  "CloneWith": [
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 16,
                        "end": 18
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 22,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
