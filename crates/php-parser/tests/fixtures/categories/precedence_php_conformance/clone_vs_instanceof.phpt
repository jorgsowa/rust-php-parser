===description===
PHP: (clone $a) instanceof Box. clone binds tighter than instanceof (clone is highest non-primary).
===source===
<?php
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
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Box"
                },
                "span": {
                  "start": 26,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
