===source===
<?php
if ($x > 1) {
    echo "hello";
===errors===
missing closing '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  Unclosed '{' on line 2 in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 10,
                    "end": 12
                  }
                },
                "op": "Greater",
                "right": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 15,
                    "end": 16
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 16
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "hello"
                        },
                        "span": {
                          "start": 29,
                          "end": 36
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 37
                  }
                }
              ]
            },
            "span": {
              "start": 18,
              "end": 37
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
