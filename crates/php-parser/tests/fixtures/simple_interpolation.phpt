===source===
<?php echo "Hello $name";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Hello "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "name"
                    },
                    "span": {
                      "start": 18,
                      "end": 23
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 24
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
