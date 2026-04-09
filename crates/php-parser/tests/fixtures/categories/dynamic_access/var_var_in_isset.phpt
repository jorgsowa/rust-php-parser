===source===
<?php isset($$name);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "name"
                    },
                    "span": {
                      "start": 13,
                      "end": 18,
                      "start_line": 1,
                      "start_col": 13
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 18,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 19,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20,
    "start_line": 1,
    "start_col": 0
  }
}
