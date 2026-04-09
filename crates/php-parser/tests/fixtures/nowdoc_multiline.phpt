===source===
<?php
$x = <<<'EOT'
No $interpolation
Just literal text
With 'quotes' and "doubles"
EOT;
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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "No $interpolation\nJust literal text\nWith 'quotes' and \"doubles\""
                  }
                },
                "span": {
                  "start": 11,
                  "end": 87,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 87,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 88,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88,
    "start_line": 1,
    "start_col": 0
  }
}
