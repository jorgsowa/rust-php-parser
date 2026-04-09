===source===
<?php match ($x) {
===errors===
expected '}', found end of file
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 13,
                  "end": 15,
                  "start_line": 1,
                  "start_col": 13
                }
              },
              "arms": []
            }
          },
          "span": {
            "start": 6,
            "end": 18,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18,
    "start_line": 1,
    "start_col": 0
  }
}
