===description===
PHP: (new Foo()) instanceof Foo. new is the highest non-primary precedence.
STATUS: parser correct because new is parsed as atom (not via parse_expr_bp). Pinned.
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
                        "Identifier": "Foo"
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
                  "Identifier": "Foo"
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
