===config===
min_php=8.1
===source===
<?php
$a === $b == $c;
===errors===
Chaining non-associative operators requires explicit parentheses.
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 13,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Equal",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 19,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "==" in Standard input code on line 2
