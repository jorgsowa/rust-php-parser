===description===
PHP: `10 ** Foo::BAR` is `10 ** (Foo::BAR)`. Scope resolution binds tighter than `**`.
===source===
<?php
10 ** Foo::BAR;
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
                  "Int": 10
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "BAR"
                      },
                      "span": {
                        "start": 17,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
