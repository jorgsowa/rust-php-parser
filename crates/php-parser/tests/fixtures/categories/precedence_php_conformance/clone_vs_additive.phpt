===description===
PHP: (clone $a) + 1. clone binds tighter than +.
STATUS: parser correct (clone uses bp 41 > + bp 35). Pinned.
===source===
<?php
clone $a + 1;
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
                  "Clone": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 12,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 17,
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
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
