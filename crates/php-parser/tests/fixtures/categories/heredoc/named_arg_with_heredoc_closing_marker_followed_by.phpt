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
                  "end": 9,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": "bar",
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
                      "end": 31,
                      "start_line": 1,
                      "start_col": 15
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 31,
                    "start_line": 1,
                    "start_col": 10
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 32,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33,
    "start_line": 1,
    "start_col": 0
  }
}
