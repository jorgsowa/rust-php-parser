===source===
<?php foo(bar: <<<EOT
hello
EOT
);
===errors <=7.4===
'named arguments' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ':', expecting ')' in Standard input code on line 1
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
                  "name": {
                    "parts": [
                      "bar"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 10,
                      "end": 13
                    }
                  },
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
                        "start": 15,
                        "end": 31
                      }
                    }
                  },
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
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
