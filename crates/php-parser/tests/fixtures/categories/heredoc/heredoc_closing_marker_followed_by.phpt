===source===
<?php foo(<<<EOT
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
                  "name": null,
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
                      "start": 10,
                      "end": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
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
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
