===description===
PHP: print (1 + 2). print is below +.
STATUS: parser uses ASSIGNMENT_BP (8) for print operand, which is below + (35). Pinned.
===source===
<?php
print 1 + 2;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Print": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 12,
                      "end": 13
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  }
                }
              },
              "span": {
                "start": 12,
                "end": 17
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
