===source===
<?php eval('echo 1;');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Eval": {
              "kind": {
                "String": "echo 1;"
              },
              "span": {
                "start": 11,
                "end": 20,
                "start_line": 1,
                "start_col": 11
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
