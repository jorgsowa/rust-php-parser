===source===
<?php
echo "\u{D800}", "\u{dfff}$a";
echo <<<E
\u{DC00}
E;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "í "
            },
            "span": {
              "start": 11,
              "end": 21
            }
          },
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "í¿¿"
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 35
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Heredoc": {
                "label": "E",
                "parts": [
                  {
                    "Literal": "í°"
                  }
                ]
              }
            },
            "span": {
              "start": 42,
              "end": 57
            }
          }
        ]
      },
      "span": {
        "start": 37,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
