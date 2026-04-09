===config===
min_php=8.1
===source===
<?php if ($fiber->isTerminated()) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "MethodCall": {
                "object": {
                  "kind": {
                    "Variable": "fiber"
                  },
                  "span": {
                    "start": 10,
                    "end": 16,
                    "start_line": 1,
                    "start_col": 10
                  }
                },
                "method": {
                  "kind": {
                    "Identifier": "isTerminated"
                  },
                  "span": {
                    "start": 18,
                    "end": 30,
                    "start_line": 1,
                    "start_col": 18
                  }
                },
                "args": []
              }
            },
            "span": {
              "start": 10,
              "end": 32,
              "start_line": 1,
              "start_col": 10
            }
          },
          "then_branch": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 34,
              "end": 36,
              "start_line": 1,
              "start_col": 34
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 36,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
