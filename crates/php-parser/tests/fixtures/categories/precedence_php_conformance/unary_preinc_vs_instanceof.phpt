===description===
PHP: (++$a) instanceof Foo.
===source===
<?php
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
                        "start": 8,
                        "end": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 22,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
