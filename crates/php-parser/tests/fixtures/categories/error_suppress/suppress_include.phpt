===source===
<?php @include 'optional.php';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "Include": [
                  "Include",
                  {
                    "kind": {
                      "String": "optional.php"
                    },
                    "span": {
                      "start": 15,
                      "end": 29,
                      "start_line": 1,
                      "start_col": 15
                    }
                  }
                ]
              },
              "span": {
                "start": 7,
                "end": 29,
                "start_line": 1,
                "start_col": 7
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30,
    "start_line": 1,
    "start_col": 0
  }
}
