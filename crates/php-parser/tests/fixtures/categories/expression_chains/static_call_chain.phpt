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
                        "end": 9
                      }
                    },
                    "method": "create",
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "method": {
                "kind": {
                  "Identifier": "setup"
                },
                "span": {
                  "start": 21,
                  "end": 26
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
