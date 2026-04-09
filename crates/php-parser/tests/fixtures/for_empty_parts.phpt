===source===
<?php for (;;) { break; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 17,
                    "end": 24,
                    "start_line": 1,
                    "start_col": 17
                  }
                }
              ]
            },
            "span": {
              "start": 15,
              "end": 25,
              "start_line": 1,
              "start_col": 15
            }
          }
        }
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
