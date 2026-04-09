===source===
<?php Foo::create()->setup();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 6,
                        "end": 9,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "method": "create",
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "setup"
                },
                "span": {
                  "start": 21,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 21
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 28,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29,
    "start_line": 1,
    "start_col": 0
  }
}
