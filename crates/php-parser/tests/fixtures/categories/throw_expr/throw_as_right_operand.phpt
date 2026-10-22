===source===
<?php
$x = $a or throw $e;
===errors <=7.4===
'throw expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'throw' (T_THROW) in Standard input code on line 2
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
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Throw": {
                    "kind": {
                      "Variable": "e"
                    },
                    "span": {
                      "start": 23,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
