===source===
<?php
$x = <<<END
  line with only 2 spaces
    END;
===errors===
Invalid body indentation level
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
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "END",
                    "parts": [
                      {
                        "Literal": "  line with only 2 spaces"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 51
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 51
          }
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
===php_error===
PHP Parse error:  Invalid body indentation level (expecting an indentation level of at least 4) in Standard input code on line 3
