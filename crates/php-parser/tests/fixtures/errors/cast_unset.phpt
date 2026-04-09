===source===
<?php (unset)$x;
===errors===
the (unset) cast is no longer supported
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Unset",
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 13,
                  "end": 15,
                  "start_line": 1,
                  "start_col": 13
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 15,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16,
    "start_line": 1,
    "start_col": 0
  }
}
