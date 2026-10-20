===description===
`new Foo() instanceof Foo` parses as `(new Foo()) instanceof Foo`.
===source===
<?php
new Foo() instanceof Foo;
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
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 10,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 10,
                        "end": 13
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 27,
                      "end": 30
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
