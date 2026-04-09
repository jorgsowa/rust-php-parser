===source===
<?php isset($a, $b); empty($x);
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
                  "Variable": "a"
                },
                "span": {
                  "start": 12,
                  "end": 14,
                  "start_line": 1,
                  "start_col": 12
                }
              },
              {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 16,
                  "end": 18,
                  "start_line": 1,
                  "start_col": 16
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
        "end": 21,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Empty": {
              "kind": {
                "Variable": "x"
              },
              "span": {
                "start": 27,
                "end": 29,
                "start_line": 1,
                "start_col": 27
              }
            }
          },
          "span": {
            "start": 21,
            "end": 30,
            "start_line": 1,
            "start_col": 21
          }
        }
      },
      "span": {
        "start": 21,
        "end": 31,
        "start_line": 1,
        "start_col": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31,
    "start_line": 1,
    "start_col": 0
  }
}
