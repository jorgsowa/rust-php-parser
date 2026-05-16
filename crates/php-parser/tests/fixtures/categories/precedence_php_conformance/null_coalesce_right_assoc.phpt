===description===
PHP: $a ?? ($b ?? $c). Right-associative.
===source===
<?php
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
                  "start": 6,
                  "end": 8
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
                        "start": 12,
                        "end": 14
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
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
