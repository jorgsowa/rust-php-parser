===description===
PHP: (+$a) instanceof Foo.
===source===
<?php
+$a instanceof Foo;
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
                    "op": "Plus",
                    "operand": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
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
