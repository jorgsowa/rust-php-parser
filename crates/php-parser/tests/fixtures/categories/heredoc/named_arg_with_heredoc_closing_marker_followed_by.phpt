===source===
<?php foo(bar: <<<EOT
hello
EOT);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": {
                    "name": "bar",
                    "span": {
                      "start": 10,
                      "end": 13
                    }
                  },
                  "value": {
                    "kind": {
                      "Heredoc": {
                        "label": "EOT",
                        "parts": [
                          {
                            "Literal": "hello"
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 15,
                      "end": 31
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 31
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
