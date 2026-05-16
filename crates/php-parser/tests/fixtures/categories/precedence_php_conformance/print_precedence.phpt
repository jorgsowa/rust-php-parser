===source===
<?php
// PHP: print (1 + 2). print is below +.
// STATUS: parser uses ASSIGNMENT_BP (8) for print operand, which is below + (35). Pinned.
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
                      "start": 144,
                      "end": 145
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 148,
                      "end": 149
                    }
                  }
                }
              },
              "span": {
                "start": 144,
                "end": 149
              }
            }
          },
          "span": {
            "start": 138,
            "end": 149
          }
        }
      },
      "span": {
        "start": 138,
        "end": 150
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 150
  }
}
