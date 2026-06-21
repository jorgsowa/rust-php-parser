===description===
PHP: `10 ** $this->maxDigits` is `10 ** ($this->maxDigits)`. Member access binds tighter than `**`.
===source===
<?php
10 ** $this->maxDigits;
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
                  "Int": 10
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "this"
                      },
                      "span": {
                        "start": 12,
                        "end": 17
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "maxDigits"
                      },
                      "span": {
                        "start": 19,
                        "end": 28
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
