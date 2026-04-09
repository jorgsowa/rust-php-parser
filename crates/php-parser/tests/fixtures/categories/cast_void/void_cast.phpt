===config===
min_php=8.5
===source===
<?php (void)$x;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 14,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15,
    "start_line": 1,
    "start_col": 0
  }
}
