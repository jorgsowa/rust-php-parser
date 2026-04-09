===source===
<?php print 'hello';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Print": {
              "kind": {
                "String": "hello"
              },
              "span": {
                "start": 12,
                "end": 19,
                "start_line": 1,
                "start_col": 12
              }
            }
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
