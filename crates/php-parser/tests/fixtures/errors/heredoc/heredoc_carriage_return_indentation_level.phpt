===source===
<?php
$a = <<<EOT  a b  EOT;
===errors===
Invalid body indentation level
===php_error===
PHP Parse error:  Invalid body indentation level (expecting an indentation level of at least 2) in Standard input code on line 4
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
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "a\rb"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
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
