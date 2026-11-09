===source===
<?php
$a = <<<X
\u{110000}
X;
===errors===
Invalid UTF-8 codepoint escape sequence: Codepoint too large
===php_error===
PHP Parse error:  Invalid UTF-8 codepoint escape sequence: Codepoint too large in Standard input code on line 3
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "X",
                    "parts": [
                      {
                        "Literal": ""
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 28
                }
              }
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
