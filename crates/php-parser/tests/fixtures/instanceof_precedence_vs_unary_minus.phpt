===source===
<?php -$b instanceof Foo;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Negate",
              "operand": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 7,
                        "end": 9,
                        "start_line": 1,
                        "start_col": 7
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 21,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25,
    "start_line": 1,
    "start_col": 0
  }
}
