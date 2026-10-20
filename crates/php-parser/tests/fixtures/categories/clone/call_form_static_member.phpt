===source===
<?php
clone($a, [])::C;
===errors===
Cannot dereference this expression
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "::" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
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
              "member": {
                "kind": {
                  "Identifier": "C"
                },
                "span": {
                  "start": 21,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
