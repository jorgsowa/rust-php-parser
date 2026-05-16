===source===
<?php
// PHP: (clone $a) instanceof Box. clone binds tighter than instanceof (clone is highest non-primary).
clone $a instanceof Box;
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
                      "start": 115,
                      "end": 117
                    }
                  }
                },
                "span": {
                  "start": 109,
                  "end": 117
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Box"
                },
                "span": {
                  "start": 129,
                  "end": 132
                }
              }
            }
          },
          "span": {
            "start": 109,
            "end": 132
          }
        }
      },
      "span": {
        "start": 109,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}
