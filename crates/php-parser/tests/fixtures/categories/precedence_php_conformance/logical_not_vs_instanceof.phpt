===source===
<?php
// PHP: !($a instanceof Foo). ! is BELOW instanceof (exception to unary tier).
!$a instanceof Foo;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BooleanNot",
              "operand": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 86,
                        "end": 88
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 100,
                        "end": 103
                      }
                    }
                  }
                },
                "span": {
                  "start": 86,
                  "end": 103
                }
              }
            }
          },
          "span": {
            "start": 85,
            "end": 103
          }
        }
      },
      "span": {
        "start": 85,
        "end": 104
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104
  }
}
