===source===
<?php
// PHP: (+$a) instanceof Foo.
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
                        "start": 37,
                        "end": 39
                      }
                    }
                  }
                },
                "span": {
                  "start": 36,
                  "end": 39
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 51,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 54
          }
        }
      },
      "span": {
        "start": 36,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
