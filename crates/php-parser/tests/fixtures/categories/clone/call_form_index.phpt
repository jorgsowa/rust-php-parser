===source===
<?php
clone($a, [])['k'];
===errors===
Cannot dereference this expression
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "[" in Standard input code on line 2
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
              "index": {
                "kind": {
                  "String": "k"
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
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
