===source===
<?php new $className();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Variable": "className"
                },
                "span": {
                  "start": 10,
                  "end": 20,
                  "start_line": 1,
                  "start_col": 10
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 22,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23,
    "start_line": 1,
    "start_col": 0
  }
}
