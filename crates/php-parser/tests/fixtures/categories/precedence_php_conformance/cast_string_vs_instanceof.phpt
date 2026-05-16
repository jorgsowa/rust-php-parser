===source===
<?php
// PHP: ((string)$a) instanceof Foo.
(string)$a instanceof Foo;
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
                    "String",
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 51,
                        "end": 53
                      }
                    }
                  ]
                },
                "span": {
                  "start": 43,
                  "end": 53
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 65,
                  "end": 68
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 68
          }
        }
      },
      "span": {
        "start": 43,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
