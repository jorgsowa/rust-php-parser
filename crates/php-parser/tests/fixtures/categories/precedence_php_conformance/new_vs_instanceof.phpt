===source===
<?php
// PHP: (new Foo()) instanceof Foo. new is the highest non-primary precedence.
// STATUS: parser correct because new is parsed as atom (not via parse_expr_bp). Pinned.
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
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 178,
                        "end": 181
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 174,
                  "end": 183
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 195,
                  "end": 198
                }
              }
            }
          },
          "span": {
            "start": 174,
            "end": 198
          }
        }
      },
      "span": {
        "start": 174,
        "end": 199
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 199
  }
}
