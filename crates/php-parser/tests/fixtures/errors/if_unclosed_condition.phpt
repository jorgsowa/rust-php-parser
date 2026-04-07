===source===
<?php if ( { }
===errors===
expected expression
unclosed '')'' opened at Span { start: 9, end: 10 }
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
                    "end": 12
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 11,
              "end": 14
            }
          },
          "then_branch": {
            "kind": "Error",
            "span": {
              "start": 14,
              "end": 14
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
