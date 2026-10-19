===source===
<?php foo(<<<EOT
hello
EOT
);
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
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
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
                        "start": 10,
                        "end": 26
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 26
                  }
                }
              ]
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
