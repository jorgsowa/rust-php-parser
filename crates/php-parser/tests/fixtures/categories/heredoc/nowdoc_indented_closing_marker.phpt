===source===
<?php
$y = <<<'NOW'
    nowdoc content
    NOW;
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
                  "Variable": "y"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "NOW",
                    "value": "nowdoc content"
                  }
                },
                "span": {
                  "start": 11,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 46
          }
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
