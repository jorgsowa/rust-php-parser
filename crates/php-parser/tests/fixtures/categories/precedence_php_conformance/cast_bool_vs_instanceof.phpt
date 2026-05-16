===source===
<?php
// PHP: ((bool)$a) instanceof Foo.
(bool)$a instanceof Foo;
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
                  "Cast": [
                    "Bool",
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 47,
                        "end": 49
                      }
                    }
                  ]
                },
                "span": {
                  "start": 41,
                  "end": 49
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 61,
                  "end": 64
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 64
          }
        }
      },
      "span": {
        "start": 41,
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}
