===source===
<?php
// PHP: (++$a) instanceof Foo.
++$a instanceof Foo;
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
                  "UnaryPrefix": {
                    "op": "PreIncrement",
                    "operand": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 39,
                        "end": 41
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 41
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 53,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 37,
            "end": 56
          }
        }
      },
      "span": {
        "start": 37,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
