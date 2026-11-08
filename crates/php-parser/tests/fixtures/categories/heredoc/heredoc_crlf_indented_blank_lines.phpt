===description===
Blank lines inside a CRLF indented heredoc or nowdoc carry a trailing \r and still count as empty.
===source===
<?php
$x = <<<'MD'
    first

    second
    MD;
$y = <<<MD
    first

    second
    MD;

===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 7,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "MD",
                    "value": "first\r\n\r\nsecond"
                  }
                },
                "span": {
                  "start": 12,
                  "end": 52
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 52
          }
        }
      },
      "span": {
        "start": 7,
        "end": 53
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "MD",
                    "parts": [
                      {
                        "Literal": "first\r\n\r\nsecond"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 60,
                  "end": 98
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 98
          }
        }
      },
      "span": {
        "start": 55,
        "end": 99
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99
  }
}
