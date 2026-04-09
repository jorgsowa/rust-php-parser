===source===
<?php require __DIR__ . '/config.php';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "Require",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "MagicConst": "Dir"
                      },
                      "span": {
                        "start": 14,
                        "end": 21,
                        "start_line": 1,
                        "start_col": 14
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "/config.php"
                      },
                      "span": {
                        "start": 24,
                        "end": 37,
                        "start_line": 1,
                        "start_col": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 37,
                  "start_line": 1,
                  "start_col": 14
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 37,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
