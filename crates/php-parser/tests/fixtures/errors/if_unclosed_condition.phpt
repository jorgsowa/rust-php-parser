===source===
<?php if ( { }
===errors===
expected expression
unclosed '')'' opened at 1:9
expected statement
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": "Error",
                  "span": {
                    "start": 11,
                    "end": 12,
                    "start_line": 1,
                    "start_col": 11
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 11,
              "end": 14,
              "start_line": 1,
              "start_col": 11
            }
          },
          "then_branch": {
            "kind": "Error",
            "span": {
              "start": 14,
              "end": 14,
              "start_line": 0,
              "start_col": 0
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 14,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14,
    "start_line": 1,
    "start_col": 0
  }
}
