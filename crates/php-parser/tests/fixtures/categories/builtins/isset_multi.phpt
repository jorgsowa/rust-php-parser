===source===
<?php if (isset($a, $b, $c)) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Isset": [
                {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 16,
                    "end": 18,
                    "start_line": 1,
                    "start_col": 16
                  }
                },
                {
                  "kind": {
                    "Variable": "b"
                  },
                  "span": {
                    "start": 20,
                    "end": 22,
                    "start_line": 1,
                    "start_col": 20
                  }
                },
                {
                  "kind": {
                    "Variable": "c"
                  },
                  "span": {
                    "start": 24,
                    "end": 26,
                    "start_line": 1,
                    "start_col": 24
                  }
                }
              ]
            },
            "span": {
              "start": 10,
              "end": 27,
              "start_line": 1,
              "start_col": 10
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 29,
              "end": 31,
              "start_line": 1,
              "start_col": 29
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 31,
        "start_line": 1,
        "start_col": 6
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
