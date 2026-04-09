===source===
<?php switch { }
===errors===
expected '(', found '{'
expected expression
unclosed '')'' opened at 1:13
expected '{', found end of file
expected '}', found end of file
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": "Error",
                  "span": {
                    "start": 13,
                    "end": 14,
                    "start_line": 1,
                    "start_col": 13
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 13,
              "end": 16,
              "start_line": 1,
              "start_col": 13
            }
          },
          "cases": []
        }
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16,
    "start_line": 1,
    "start_col": 0
  }
}
