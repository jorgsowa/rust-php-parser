===source===
<?php ($x + $y;
===errors===
unclosed '')'' opened at Span { start: 6, end: 7 }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Parenthesized": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 7,
                      "end": 9
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "Variable": "y"
                    },
                    "span": {
                      "start": 12,
                      "end": 14
                    }
                  }
                }
              },
              "span": {
                "start": 7,
                "end": 14
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
