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
                      "end": 23,
                      "start_line": 1,
                      "start_col": 18
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 24,
              "start_line": 1,
              "start_col": 11
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 25,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25,
    "start_line": 1,
    "start_col": 0
  }
}
