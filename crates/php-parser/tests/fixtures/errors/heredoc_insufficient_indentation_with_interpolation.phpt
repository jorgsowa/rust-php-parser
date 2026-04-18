===source===
<?php
$y = "world";
$x = <<<END
  hello $y
    END;
===errors===
Invalid body indentation level
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "world"
                },
                "span": {
                  "start": 11,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 20,
                  "end": 22
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "END",
                    "parts": [
                      {
                        "Literal": "  hello "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "y"
                          },
                          "span": {
                            "start": 40,
                            "end": 42
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 25,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 50
          }
        }
      },
      "span": {
        "start": 20,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
===php_error===
PHP Parse error:  Invalid body indentation level (expecting an indentation level of at least 4) in Standard input code on line 4
