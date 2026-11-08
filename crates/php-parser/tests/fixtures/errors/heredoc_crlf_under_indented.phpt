===source===
<?php
$x = <<<'MD'
  short
    MD;

===errors===
Invalid body indentation level
===php_error===
PHP Parse error:  Invalid body indentation level (expecting an indentation level of at least 4) in Standard input code on line 3
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
                    "value": "short"
                  }
                },
                "span": {
                  "start": 12,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 36
          }
        }
      },
      "span": {
        "start": 7,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
