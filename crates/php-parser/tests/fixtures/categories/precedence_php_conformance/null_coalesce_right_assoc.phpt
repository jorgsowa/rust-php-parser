===source===
<?php
// PHP: $a ?? ($b ?? $c). Right-associative.
$a ?? $b ?? $c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 51,
                  "end": 53
                }
              },
              "right": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 57,
                        "end": 59
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 63,
                        "end": 65
                      }
                    }
                  }
                },
                "span": {
                  "start": 57,
                  "end": 65
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 65
          }
        }
      },
      "span": {
        "start": 51,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
