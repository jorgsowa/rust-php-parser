===description===
PHP: !($a instanceof Foo). ! is BELOW instanceof (exception to unary tier).
===source===
<?php
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
                        "start": 7,
                        "end": 9
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 21,
                        "end": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
