===source===
<?php
// PHP: (clone $a) + 1. clone binds tighter than +.
// STATUS: parser correct (clone uses bp 41 > + bp 35). Pinned.
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
                      "start": 128,
                      "end": 130
                    }
                  }
                },
                "span": {
                  "start": 122,
                  "end": 130
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 133,
                  "end": 134
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 134
          }
        }
      },
      "span": {
        "start": 122,
        "end": 135
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 135
  }
}
